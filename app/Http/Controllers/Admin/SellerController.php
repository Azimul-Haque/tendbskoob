<?php

namespace App\Http\Controllers\Admin;

use App\CPU\Convert;
use App\CPU\Helpers;
use App\CPU\ImageManager;
use App\CPU\BackEndHelper;
use App\Http\Controllers\Controller;
use App\Model\Order;
use App\Model\OrderDetail;
use App\Model\Product;
use App\Model\Publisher;
use App\Model\Seller;
use App\Model\WithdrawRequest;
use App\Model\SellerWallet;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Model\Review;
use App\Model\OrderTransaction;
use Illuminate\Support\Facades\File;
use Illuminate\Filesystem\Filesystem;
use Image;

class SellerController extends Controller
{
    public function index(Request $request)
    {
        $query_param = [];
        $search = $request['search'];
        if ($request->has('search')) {
            $key = explode(' ', $request['search']);
            $sellers = Seller::with(['orders', 'product'])
                ->where(function ($q) use ($key) {
                    foreach ($key as $value) {
                        $q->orWhere('name', 'like', "%{$value}%")
                            ->orWhere('address', 'like', "%{$value}%")
                            ->orWhere('payment_number', 'like', "%{$value}%")
                            ->orWhere('email', 'like', "%{$value}%");
                    }
                });
            $query_param = ['search' => $request['search']];
        } else {
            $sellers = Seller::with(['orders', 'product']);
        }
        $sellers = $sellers->latest()->paginate(Helpers::pagination_limit())->appends($query_param);
        return view('admin-views.seller.index', compact('sellers', 'search'));
    }

    public function view(Request $request, $id, $tab = null)
    {
        $seller = Seller::findOrFail($id);
        if ($tab == 'order') {
            $id = $seller->id;
            $orders = Order::where(['seller_is'=>'seller'])->where(['seller_id'=>$id])->latest()->paginate(Helpers::pagination_limit());
            // $orders->map(function ($data) {
            //     $value = 0;
            //     foreach ($data->details as $detail) {
            //         $value += ($detail['price'] * $detail['qty']) + $detail['tax'] - $detail['discount'];
            //     }
            //     $data['total_sum'] = $value;
            //     return $data;
            // });
            return view('admin-views.seller.view.order', compact('seller', 'orders'));
        } else if ($tab == 'product') {
            $products = Product::where('added_by', 'seller')->where('user_id', $seller->id)->paginate(Helpers::pagination_limit());
            return view('admin-views.seller.view.product', compact('seller', 'products'));
        } else if ($tab == 'setting') {
            $commission = $request['commission'];
            if ($request->has('commission')) {
                request()->validate([
                    'commission' => 'required | numeric | min:1',
                ]);

                if ($request['commission_status'] == 1 && $request['commission'] == null) {
                    Toastr::error('You did not set commission percentage field.');
                    //return back();
                } else {
                    $seller = Seller::find($id);
                    $seller->sales_commission_percentage = $request['commission_status'] == 1 ? $request['commission'] : null;
                    $seller->save();

                    Toastr::success('Commission percentage for this seller has been updated.');
                }
            }
            $commission = 0;
            if ($request->has('gst')) {
                if ($request['gst_status'] == 1 && $request['gst'] == null) {
                    Toastr::error('You did not set GST number field.');
                    //return back();
                } else {
                    $seller = Seller::find($id);
                    $seller->gst = $request['gst_status'] == 1 ? $request['gst'] : null;
                    $seller->save();

                    Toastr::success('GST number for this seller has been updated.');
                }
            }

            //return back();
            return view('admin-views.seller.view.setting', compact('seller'));
        } else if ($tab == 'transaction') {
            $transactions = OrderTransaction::where('seller_is','seller')->where('seller_id',$seller->id);

            $query_param = [];
            $search = $request['search'];
            if ($request->has('search'))
            {
                $key = explode(' ', $request['search']);
                $transactions = $transactions->where(function ($q) use ($key) {
                    foreach ($key as $value) {
                        $q->Where('order_id', 'like', "%{$value}%")
                            ->orWhere('transaction_id', 'like', "%{$value}%");
                    }
                });
                $query_param = ['search' => $request['search']];
            }else{
                $transactions = $transactions;
            }
            $status = $request['status'];
            if ($request->has('status'))
            {
                $key = explode(' ', $request['status']);
                $transactions = $transactions->where(function ($q) use ($key) {
                    foreach ($key as $value) {
                        $q->Where('status', 'like', "%{$value}%");
                    }
                });
                $query_param = ['status' => $request['status']];
            }
               $transactions = $transactions->latest()->paginate(Helpers::pagination_limit())->appends($query_param);

            return view('admin-views.seller.view.transaction', compact('seller', 'transactions','search','status'));

        } else if ($tab == 'review') {
            $sellerId = $seller->id;

            $query_param = [];
            $search = $request['search'];
            if ($request->has('search')) {
                $key = explode(' ', $request['search']);
                $product_id = Product::where('added_by','seller')->where('user_id',$sellerId)->where(function ($q) use ($key) {
                    foreach ($key as $value) {
                        $q->where('name', 'like', "%{$value}%");
                    }
                })->pluck('id')->toArray();

                $reviews = Review::with(['product'])
                    ->whereIn('product_id',$product_id);

                $query_param = ['search' => $request['search']];
            } else {
                $reviews = Review::with(['product'])->whereHas('product', function ($query) use ($sellerId) {
                    $query->where('user_id', $sellerId)->where('added_by', 'seller');
                });
            }
            //dd($reviews->count());
            $reviews = $reviews->paginate(Helpers::pagination_limit())->appends($query_param);

            return view('admin-views.seller.view.review', compact('seller', 'reviews', 'search'));
        }
        return view('admin-views.seller.view', compact('seller'));
    }

    public function edit($seller_id)
    {
        $seller = Seller::findOrFail($seller_id);
        return view('admin-views.seller.edit', compact('seller'));
    }

    public function update(Request $request, $id)
    {
        $seller = Seller::findOrFail($id);
        $this->validate($request, [
            'name'             => 'required|max:100',
            'address'          => 'required|max:150',
            'image'            => 'sometimes|image|mimes:jpeg,png,jpg,gif,bmp,bmp,tiff|max:200',
            'description'      => 'required|max:200',
            'collection_point' => 'required',
            'payment_number'   => 'required',
            'payment_option'   => 'required',
            'email'            => 'required|unique:sellers,email,' . $id,
            'password'         => 'sometimes|confirmed',
        ]);

        $seller->name = $request->name;
        $seller->address = $request->address;
        $seller->description = $request->description;
        $seller->collection_point = $request->collection_point;
        $seller->payment_number = $request->payment_number;
        $seller->payment_option = $request->payment_option;

        if($request->hasFile('image')) {
            $image_path = public_path('/public/images/publisher/'. $seller->image);
            if(File::exists($image_path)) {
                File::delete($image_path);
            }
            $image    = $request->file('image');
            $filename = Helpers::random_slug(10) . '.jpg';
            $location = public_path('/public/images/publisher/'. $filename);
            Image::make($image)->fit(200, 200)->save($location);
            $seller->image = $filename;
        }
        $seller->email = $request->email;
        if($request->password) {
            $seller->password = bcrypt($request->password);
        }
        // $seller->status = "pending";
        $seller->save();

        Toastr::success('Publication updated successfully!');
        return redirect()->route('admin.sellers.seller-list');
    }

    public function approvalPage($seller_id)
    {
        $seller = Seller::findOrFail($seller_id);
        $publishers = Publisher::get();
        return view('admin-views.seller.approve', compact('seller', 'publishers'));
    }

    public function updateStatus(Request $request)
    {
        $seller = Seller::findOrFail($request->id);
        $seller->status = $request->status;
        if ($request->status == "approved") {
            $seller->publisher_id = $request->publisher_id;
            Toastr::success('Seller has been approved successfully');
        } else if ($request->status == "rejected") {
            Toastr::info('Seller has been rejected successfully');
        } else if ($request->status == "suspended") {
            $seller->auth_token = Str::random(80);
            Toastr::info('Seller has been suspended successfully');
        }
        $seller->save();
        return redirect()->route('admin.sellers.seller-list');
    }

    public function order_list($seller_id)
    {
        $orders = Order::where('seller_id', $seller_id)->where('seller_is', 'seller');

        $orders = $orders->latest()->paginate(Helpers::pagination_limit());
        $seller = Seller::findOrFail($seller_id);
        return view('admin-views.seller.order-list', compact('orders', 'seller'));
    }

    public function product_list($seller_id)
    {
        $product = Product::where(['user_id' => $seller_id, 'added_by' => 'seller'])->latest()->paginate(Helpers::pagination_limit());
        $seller = Seller::findOrFail($seller_id);
        return view('admin-views.seller.porduct-list', compact('product', 'seller'));
    }

    public function order_details($order_id, $seller_id)
    {
        $order = Order::with('shipping')->where(['id' => $order_id])->first();
        return view('admin-views.seller.order-details', compact('order', 'seller_id'));
    }

    public function withdraw()
    {
        $all = session()->has('withdraw_status_filter') && session('withdraw_status_filter') == 'all' ? 1 : 0;
        $active = session()->has('withdraw_status_filter') && session('withdraw_status_filter') == 'approved' ? 1 : 0;
        $denied = session()->has('withdraw_status_filter') && session('withdraw_status_filter') == 'denied' ? 1 : 0;
        $pending = session()->has('withdraw_status_filter') && session('withdraw_status_filter') == 'pending' ? 1 : 0;

        $withdraw_req = WithdrawRequest::with(['seller'])
            ->when($all, function ($query) {
                return $query;
            })
            ->when($active, function ($query) {
                return $query->where('approved', 1);
            })
            ->when($denied, function ($query) {
                return $query->where('approved', 2);
            })
            ->when($pending, function ($query) {
                return $query->where('approved', 0);
            })
            ->orderBy('id', 'desc')
            ->latest()
            ->paginate(Helpers::pagination_limit());

        return view('admin-views.seller.withdraw', compact('withdraw_req'));
    }

    public function withdraw_view($withdraw_id, $seller_id)
    {
        $seller = WithdrawRequest::with(['seller'])->where(['id' => $withdraw_id])->first();
        return view('admin-views.seller.withdraw-view', compact('seller'));
    }

    public function withdrawStatus(Request $request, $id)
    {
        $withdraw = WithdrawRequest::find($id);
        $withdraw->approved = $request->approved;
        $withdraw->transaction_note = $request['note'];
        if ($request->approved == 1) {
            SellerWallet::where('seller_id', $withdraw->seller_id)->increment('withdrawn', $withdraw['amount']);
            SellerWallet::where('seller_id', $withdraw->seller_id)->decrement('pending_withdraw', $withdraw['amount']);
            $withdraw->save();
            Toastr::success('Seller Payment has been approved successfully');
            return redirect()->route('admin.sellers.withdraw_list');
        }

        SellerWallet::where('seller_id', $withdraw->seller_id)->increment('total_earning', $withdraw['amount']);
        SellerWallet::where('seller_id', $withdraw->seller_id)->decrement('pending_withdraw', $withdraw['amount']);
        $withdraw->save();
        Toastr::info('Seller Payment request has been Denied successfully');
        return redirect()->route('admin.sellers.withdraw_list');

    }

    public function sales_commission_update(Request $request, $id)
    {
        if ($request['status'] == 1 && $request['commission'] == null) {
            Toastr::error('You did not set commission percentage field.');
            return back();
        }

        $seller = Seller::find($id);
        $seller->sales_commission_percentage = $request['status'] == 1 ? $request['commission'] : null;
        $seller->save();

        Toastr::success('Commission percentage for this seller has been updated.');
        return back();
    }
}
