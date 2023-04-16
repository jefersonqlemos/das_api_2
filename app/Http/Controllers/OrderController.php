<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartProduct;
use App\Models\Order;
use App\Models\OrderProduct;
use Illuminate\Http\Request;
use Throwable;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return Order::join('clients', 'clients.id', '=', 'orders.client_id')->get();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        return Order::join('products', 'products.id', '=', 'order_products.product_id')->where('order_id', $id)->get();
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        try{
            $cart = Cart::find($id);
            $cart_products = CartProduct::where('cart_id', $id)->get();
            Order::create(json_decode($cart, true));
            foreach($cart_products as $cart_product){
                $json = json_decode($cart_product, true);
                unset($json['cart_id']);
                $json['order_id'] = $cart_product->cart_id;
                OrderProduct::create($json);
            }
            return 'succcess';
        } catch(Throwable $e) {
            return $e;
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
