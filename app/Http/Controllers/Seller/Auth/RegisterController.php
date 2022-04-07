<?php

namespace App\Http\Controllers\Seller\Auth;

use App\CPU\ImageManager;
use App\Http\Controllers\Controller;
use App\Model\Seller;
use App\Model\Shop;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\CPU\Helpers;
use Image;

class RegisterController extends Controller
{
    public function create()
    {
        return view('seller-views.auth.register');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name'             => 'required|max:100',
            'address'          => 'required|max:150',
            'image'            => 'required|image|mimes:jpeg,png,jpg,gif,bmp,bmp,tiff|max:200',
            'description'      => 'required|max:200',
            'collection_point' => 'required',
            'payment_number'   => 'required',
            'payment_option'   => 'required',
            'email'            => 'required|unique:sellers',
            'password'         => 'required|confirmed|min:6',
        ]);

        DB::transaction(function ($r) use ($request) {
            $seller = new Seller();
            $seller->name = $request->name;
            $seller->address = $request->address;
            $seller->description = $request->description;
            $seller->collection_point = $request->collection_point;
            $seller->payment_number = $request->payment_number;
            $seller->payment_option = $request->payment_option;

            if($request->hasFile('image')) {
                $image    = $request->file('image');
                $filename = Helpers::random_slug(10) . '.jpg';
                $location = public_path('/public/images/publisher/'. $filename);
                Image::make($image)->fit(200, 200)->save($location);
                $seller->image = $filename;
            }
            $seller->email = $request->email;
            $seller->password = bcrypt($request->password);
            $seller->status = "pending";
            $seller->save();

            // 
            // $shop = new Shop();
            // $shop->seller_id = $seller->id;
            // $shop->name = $request->shop_name;
            // $shop->address = $request->shop_address;
            // $shop->contact = $request->phone;
            // $shop->image = ImageManager::upload('shop/', 'png', $request->file('logo'));
            // $shop->banner = ImageManager::upload('shop/banner/', 'png', $request->file('banner'));
            // $shop->save();

            DB::table('seller_wallets')->insert([
                'seller_id' => $seller['id'],
                'withdrawn' => 0,
                'commission_given' => 0,
                'total_earning' => 0,
                'pending_withdraw' => 0,
                'delivery_charge_earned' => 0,
                'collected_cash' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

        });

        Toastr::success('Publication applied successfully!');
        return redirect()->route('seller.auth.login');

    }
}
