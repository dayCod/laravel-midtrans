<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;

class MidtransController extends Controller
{
    public function index(Request $request)
    {
        // Set your Merchant Server Key
        \Midtrans\Config::$serverKey = Config::get('midtrans.server-key');
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = false;
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = true;
        
        $params = array(
            'transaction_details' => array(
                'order_id' => rand(),
                'gross_amount' => 13000,
            ),
            "item_details" => [
                [
                  "id"=> "a01",
                  "price"=> 7000,
                  "quantity"=> 1,
                  "name"=> "Apple"
                ],
                [
                  "id"=> "b02",
                  "price"=> 3000,
                  "quantity"=> 2,
                  "name"=> "Orange"
                ]
              ],
            'customer_details' => array(
                'first_name' => $request->get('full_name'),
                'last_name' => '',
                'email' => $request->get('email'),
                'phone' => $request->get('number'),
            ),
        );
        
        $snapToken = \Midtrans\Snap::getSnapToken($params);
        $clientKey = Config::get('midtrans.client-key');
        // dd($clientKey);
        return view('index', compact('snapToken', 'clientKey'));
    }

    public function checkout_form()
    {
        return view('checkout-form');
    }

    public function checkout_post(Request $request)
    {
        $json = json_decode($request->get('json'));
        $order = new Order();

        $order->full_name = $request->get('full_name');
        $order->email = $request->get('email');
        $order->number = $request->get('number');
        $order->transaction_status = $json->transaction_status;
        $order->order_id = $json->order_id;
        $order->payment_code = isset($json->payment_code) ? $json->payment_code : null;
        $order->pdf_url = isset($json->pdf_url) ? $json->pdf_url : null;
        $order->status_message = $json->status_message;
        $order->payment_type = $json->payment_type;

        // dd($request);
        return $order->save() ? redirect(url('/'))->with('alert-success', 'Berhasil Dibuat') : redirect(url('/'))->with('alert-failed', 'Terjadi Kesalahan');

    }
}
