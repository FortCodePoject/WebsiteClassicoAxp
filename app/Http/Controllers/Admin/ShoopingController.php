<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Darryldecode\Cart\Facades\CartFacade as Cart;
use Illuminate\Support\Facades\Session;

class ShoopingController extends Controller
{
    //
    public function index()
    {
        $curl = curl_init();

        curl_setopt_array($curl, [
        CURLOPT_URL => "https://kytutes.com/api/items",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_POSTFIELDS => "",
        CURLOPT_HTTPHEADER => [
            "Accept: application/json",
            "Authorization: Bearer 2|KLgAGFkyGxcwcMQIg1GAPPPBvR64BwtRxw9oTWsRd9fee9ee",
            "Content-Type: application/json"
        ],
        ]);

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            $data = Collect(json_decode($response,true));
            return view("sbadmin.shooping.home.App", compact("data"));
        }
    }

    public function addCart($id)
    {
        $curl = curl_init();

         curl_setopt_array($curl, [
        
         CURLOPT_URL => "https://kytutes.com/api/items?reference=$id",
         CURLOPT_RETURNTRANSFER => true,
         CURLOPT_ENCODING => "",
         CURLOPT_MAXREDIRS => 10,
         CURLOPT_TIMEOUT => 30,
         CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
         CURLOPT_CUSTOMREQUEST => "GET",
         CURLOPT_POSTFIELDS => "",
         CURLOPT_HTTPHEADER => [
             "Accept: application/json",
             "Authorization: Bearer 2|KLgAGFkyGxcwcMQIg1GAPPPBvR64BwtRxw9oTWsRd9fee9ee",
             "Content-Type: application/json"
         ]
        ]);

         $response = curl_exec($curl);
         $err = curl_error($curl);

         curl_close($curl);

         if ($err) {
             echo "cURL Error #:" . $err;
         } else {
            $data = Collect(json_decode($response,true));
           
            Cart::add(array(
                'id' => $data[0]["reference"],
                'name' => $data[0]["nome"],
                'price' => $data[0]["preco"],
                'quantity' => 1,
                'attributes' => array(
                    'image' => $data[0]["imagem"]
                )
            ));
            return redirect()->back()->with("success", "Adicionado");
         }
    }

    public function getTotalCart(){
        try {

        Session::put('locationPrice',0);
        $curl = curl_init();

        curl_setopt_array($curl, [
        CURLOPT_URL => "https://kytutes.com/api/locations",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_POSTFIELDS => "",
        CURLOPT_HTTPHEADER => [
            "Accept: application/json",
            "Authorization: Bearer 2|KLgAGFkyGxcwcMQIg1GAPPPBvR64BwtRxw9oTWsRd9fee9ee",
            "Content-Type: application/json"
        ],
        ]);

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            $cartContent = Cart::getContent();
            $getTotal = Cart::getTotal();
            $getSubTotal = Cart::getSubTotal();
            $getTotalQuantity = Cart::getTotalQuantity();
            $location = Collect(json_decode($response,true));
            $result = ($getTotal * 14) / 100;
            $taxapb = $result + $getSubTotal;
            return view("sbadmin.shooping.home.cart",compact(
                'location',
                'cartContent',
                'getTotal',
                'getSubTotal',
                'getTotalQuantity',
                'result',
                'taxapb'
            ));
        }
        } catch (\Throwable $th) {
            return redirect()->back()->with("error", "Falha ao carregar dados");

        }
    }
}