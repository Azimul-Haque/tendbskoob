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
use function GuzzleHttp\json_decode;

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
            route('shurjopay.success-or-failure'),
            route('shurjopay.cancel'),
            $config['shurjopay_server_url'], 
            $config['merchant_username'], 
            $config['merchant_password'], 
            $config['merchant_key_prefix'],
            'Custom Data 1',
        );
        $client->generateTxnId();
        // dd($client);
        $client->makePayment();
    }

    public function response(Request $request)
    {
        try {
            $data = ShurjoPayService::decryptResponse($request->spdata);
            // dd($data);
            $txnId = $data->txID;
            $bankTxnId = $data->bankTxID;
            $amount = $data->txnAmount;
            $bankStatus = $data->bankTxStatus;
            $resCode = $data->spCode;
            $resCodeDescription = $data->spCodeDes;
            $custom1 = $data->custom1;
            $paymentOption = $data->paymentOption;
            $status = "";
            $res = [];

            switch ($resCode) {
                case '000':
                    $status = 'Success';
                    $res['status'] = true;
                    $res['message'] = "Transaction attempt successful";
                    break;
                default:
                    $status = 'Failed';
                    $res['status'] = false;
                    $res['message'] = "Transaction attempt failed";
                    break;
            }

            $redirectUrl = $request->get('success_url').
                "?status={$status}&msg={$res['message']}".
                "&tx_id={$txnId}&bank_tx_id={$bankTxnId}".
                "&amount={$amount}&bank_status={$bankStatus}&sp_code={$resCode}".
                "&sp_code_des={$resCodeDescription}&sp_payment_option={$paymentOption}&custom1={$custom1}";

            return redirect($redirectUrl);

        } catch (\Exception $exception) {
            throw $exception;
        }
    }

    public function successOrFailure(Request $request)
    {
        Toastr::error('Payment process canceled!');
        return redirect()->route('customer.checkout-payment');
        dd($request->all());
    }

    public function cancel(Request $request)
    {
        Toastr::error('Payment process canceled!');
        return redirect()->route('customer.checkout-payment');
    }

    // public function verifyShurjoPay(Request $request)
    // {
    //     // dd($request->order_id);

    //     $verifyurl = 'https://sandbox.shurjopayment.com/api/verification';
    //     // Live: https://engine.shurjopayment.com/api/verification
    //     // Sandbox : https://sandbox.shurjopayment.com/api/verification


    //     $data = array(
    //         'token' => 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwczpcL1wvc2FuZGJveC5zaHVyam9wYXltZW50LmNvbVwvYXBpXC9sb2dpbiIsImlhdCI6MTY0MTE1MDMxMCwiZXhwIjoxNjQxMTUzOTEwLCJuYmYiOjE2NDExNTAzMTAsImp0aSI6ImFGTTY5MHE1M2FJZmtrc0giLCJzdWIiOjEsInBydiI6IjgwNWYzOWVlZmNjNjhhZmQ5ODI1YjQxMjI3ZGFkMGEwNzZjNDk3OTMifQ.Ed_FTWANdHXn5UnGp6Rkox7JsWi48sZaN4FC4f7PXl8',
    //         'order_id' => $request->order_id,
    //     );
    //     // initialize send status
    //     $ch = curl_init(); // Initialize cURL
    //     curl_setopt($ch, CURLOPT_URL, $verifyurl);
    //     curl_setopt($ch, CURLOPT_POST, 1);
    //     curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
    //     curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    //     curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // this is important
    //     $paymentresult = curl_exec($ch);
    //     curl_close ($ch);
        
    //     dd($paymentresult);
    //     dd(json_decode($paymentresult)[0]->sp_code);
    // }
}
