<?php

namespace App\Http\Controllers;

use App\CPU\CartManager;
use App\CPU\Convert;
use App\CPU\Helpers;
use App\CPU\OrderManager;
use App\Library\sslcommerz\SslCommerzNotification;
use App\Model\BusinessSetting;
use App\Model\Cart;
use App\Model\Currency;
use App\Model\Order;
use App\Model\Product;
use App\User;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use smukhidev\ShurjopayLaravelPackage\ShurjopayService as ShurjopayLaravelPackageShurjopayService;

use function App\CPU\convert_price;

use Sowren\ShurjoPay\ShurjoPayService;

class ShurjoPayController extends Controller
{

    public function paytest() {
        return view('web-views.testpg');
    }

    public function pay(Request $request)
    {
        $config = Helpers::get_business_settings('shurjo_pay');
        // dd($config);

        $client = new ShurjoPayService(
            10, 
            route('success-or-failure'),
            $config['shurjopay_server_url'], 
            $config['merchant_username'], 
            $config['merchant_password'], 
            $config['merchant_key_prefix'],
        );

        $txnId = $client->generateTxnId();
        // $data= [
        //     'amount'=>10, // Your order total amount
        //     'custom1'=>'Rifat', // Custom data like User Name
        //     'custom2'=>'test@rifat.com', // Custom data like User Email
        //     'custom3'=>'017854545445', // Custom data like User Phone Number
        //     'custom4'=>'22B Baker Street', // Custom data like user address
        //     'is_emi'=>0 //0 No EMI 1 EMI active
        // ];
        // $shurjopay_service->sendPayment($data, $success_route);
        // dd($client->makePayment());
        // dd($client);
        $client->makePayment();
    }

    public function verifyShurjoPay(Request $request)
    {
        // dd($request->order_id);

        $verifyurl = 'https://sandbox.shurjopayment.com/api/verification';
        // Live: https://engine.shurjopayment.com/api/verification
        // Sandbox : https://sandbox.shurjopayment.com/api/verification


        $data = array(
            'order_id' => $request->order_id,
        );
        // initialize send status
        $ch = curl_init(); // Initialize cURL
        curl_setopt($ch, CURLOPT_URL, $verifyurl);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // this is important
        $paymentresult = curl_exec($ch);
        curl_close ($ch);
        
        dd($paymentresult);
    }
    
    public function successOrFailure(Request $request)
    {
        // $tran_id = $request->input('tran_id');
        // $amount = $request->input('amount');
        // $currency = $request->input('currency');

        // $sslc = new SslCommerzNotification();
        // $validation = $sslc->orderValidate($tran_id, $amount, $currency, $request->all());

        // $unique_id = OrderManager::gen_unique_id();
        // $order_ids = [];
        // foreach (CartManager::get_cart_group_ids() as $group_id) {
        //     $data = [
        //         'payment_method' => 'sslcommerz',
        //         'order_status' => 'confirmed',
        //         'payment_status' => 'paid',
        //         'transaction_ref' => $tran_id,
        //         'order_group_id' => $unique_id,
        //         'cart_group_id' => $group_id
        //     ];
        //     $order_id = OrderManager::generate_order($data);
        //     array_push($order_ids, $order_id);
        // }

        // if (session()->has('payment_mode') && session('payment_mode') == 'app') {
        //     if ($validation == TRUE) {
        //         CartManager::cart_clean();
        //         return redirect()->route('payment-success');
        //     } else {
        //         return redirect()->route('payment-fail');
        //     }
        // } else {
        //     if ($validation == TRUE) {
        //         CartManager::cart_clean();
        //         return view('web-views.checkout-complete');
        //     } else {
        //         DB::table('orders')
        //             ->whereIn('id', $order_ids)
        //             ->update(['order_status' => 'failed']);
        //         Toastr::error('Payment failed!');
        //         return back();
        //     }
        // }

    }

    // public function fail(Request $request)
    // {
    //     if (session()->has('payment_mode') && session('payment_mode') == 'app') {
    //         return redirect()->route('payment-fail');
    //     }
    //     Toastr::error('Payment process failed!');
    //     return back();
    // }

    // public function cancel(Request $request)
    // {
    //     if (session()->has('payment_mode') && session('payment_mode') == 'app') {
    //         return redirect()->route('payment-fail');
    //     }
    //     Toastr::error('Payment process canceled!');
    //     return back();
    // }
}
