<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;


class TestSession extends Controller
{
    public function addToCart($id)
    {
        $product = Product::where('id', $id)->first();
        $product_id = $id;
        $product_name = $product->product_name;
        $product_description = $product->product_description;
        $product_image = $product->product_image;
        $product_price = $product->product_price;
        $product_qty = 1;

        $cart = session()->get('cart');

        if(!$cart){
            $cart = [ $id =>
                [
                    'product_id' => $product_id,
                    'product_name' => $product_name,
                    'product_description' => $product_description,
                    'product_image' => $product_image,
                    'product_price' => $product_price,
                    'product_qty' => $product_qty
                ]];
            session()->put('cart', $cart);
            return redirect('/cart')->with('success', 'Added to Cart');
        }

        if(isset($cart[$id])){
            $cart[$id]['product_qty']++;
            session()->put('cart', $cart);
            return redirect('/cart')->with('success', 'Added to Cart');
        }

        $cart[$id] = [
            'product_id' => $product_id,
            'product_name' => $product_name,
            'product_description' => $product_description,
            'product_image' => $product_image,
            'product_price' => $product_price,
            'product_qty' => $product_qty
        ];
        session()->put('cart', $cart);
        return redirect('/cart')->with('success', 'Added to Cart');
    }

    public function updateCart(Request $request){
        $cart = session()->get('cart');

        if(isset($cart[$request->rowId])){
            $cart[$request->rowId]['product_qty'] = $request->quantity;
            session()->put('cart', $cart);
            return redirect('/cart')->with('success', 'Cart Updated');
        }

    }

    public function removeCart($rowId) {
        $cart = session()->get('cart');

        if(isset($cart[$rowId])){
            unset($cart[$rowId]);
            session()->put('cart', $cart);
            return redirect('/cart')->with('success', 'Product Removed');
        }
    }
}
