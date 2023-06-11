<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartProduct;
use Illuminate\Http\Request;
use Throwable;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
         return Cart::select('*','carts.id as id')->join('clients', 'clients.id', '=', 'carts.client_id')->get();
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

        $total_value = 0;

        try {

            $cart = new Cart;
            $cart->total_value = null;
            $cart->client_id = $request->client_id;
            $cart->save();

            foreach($request->products as $product){
                $cart_product = new CartProduct;
                $cart_product->product_id = $product['id'];
                $cart_product->cart_id = $cart->id;
                $cart_product->value = $product['value'];
                $cart_product->quantity = $product['quantity'];
                $cart_product->save();

                $total_value = $total_value + ($product['value'] * $product['quantity']);
            }

            $cart->total_value = $total_value;
            $cart->save();

            return 'succcess';
        } catch(Throwable $e) {
            return $e;
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        return CartProduct::join('products', 'products.id', '=', 'cart_products.product_id')->where('cart_id', $id)->get();
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        return CartProduct::join('products', 'products.id', '=', 'cart_products.product_id')->where('cart_id', $id)->get();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //

        $total_value = 0;

        try {

            CartProduct::where('cart_id', $id)->delete();

            foreach($request->json()->all() as $product){
                $cart_product = new CartProduct;
                $cart_product->product_id = $product['id'];
                $cart_product->cart_id = $id;
                $cart_product->value = $product['value'];
                $cart_product->quantity = $product['quantity'];
                $cart_product->save();

                $total_value = $total_value + ($product['value'] * $product['quantity']);
            }

            $cart = Cart::find($id);
            $cart->total_value = $total_value;
            $cart->save();

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
        try {
            CartProduct::where('cart_id', $id)->delete();
            Cart::destroy($id);
            return 'succcess';
        } catch(Throwable $e) {
            return $e;
        }
    }
}
