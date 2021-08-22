<?php

namespace App\Http\Controllers;

use App\Brand;
use App\Category;
use App\Client;
use App\Order;
use App\Product;
use App\Slider;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class ClientController extends Controller
{
    public function home() {
        $products = Product::where('product_status', '=' , '1')->inRandomOrder()->limit(12)->get();
        $brands = Brand::inRandomOrder()->limit(5)->get();
        $sliders = Slider::get();
        return view('client.home')->with('products', $products)->with('brands', $brands)->with('sliders', $sliders);
    }

    public function shopAll() {
        $products = Product::where('product_status', '=' , '1')->inRandomOrder()->paginate(12);
        $categories = Category::inRandomOrder()->limit(4)->get();
        return view('client.shop')->with('products', $products)->with('categories', $categories);

    }

    public function shopCategory($id) {
        $products = Product::where('product_category', '=' , $id)->inRandomOrder()->paginate(12);
        $categoryThis = Category::where('id', '=', $id)->get();
        $categories = Category::where('id', '!=', $id)->inRandomOrder()->limit(3)->get();
        return view('client.shopcategory')->with('products', $products)->with('categories', $categories)->with('categoryThis', $categoryThis);
    }

    public function addToCart($id) {
        $product = Product::where('id',$id)->first();

        $addedCart = Cart::add([
                                'id' => $id,
                                'name' => $product->product_name,
                                'qty' => 1,
                                'price' => $product->product_price,
                                'weight' => 0,
                                'options' => [
                                    'image' => $product->product_image,
                                    'description' => $product->product_description
                                ]
                                ]);

        ///dd($addedCart);
        return redirect()->back()->with('status', 'Product '.$product->product_name.' Added Successfully');
        //return redirect('/shopall')->with('status', 'Product '.$product->product_name.' Added Successfully');

    }

    public function AddToCartRemove($rowId) {
        Cart::remove($rowId);
        return redirect('/cart')->with('alert', 'Product Removed Successfully');
    }

    public function AddToCartUpdate(Request $request) {
        //Cart::remove($rowId);
        Cart::update($request->rowId, $request->quantity);
        return redirect('/cart')->with('status', 'Product Updated Successfully');
    }

    public function checkout() {
        /*if(Cart::total() != 0){
            return view('client.checkout');
        }
        else{
            return redirect()->back();
        }*/
        /*$cart = session()->get('cart');
        if(count($cart) != 0){

            return view('client.checkout');
        }
        else{
            return redirect()->back();
        }*/

        if(\session()->has('client-email')){
            if(Cart::total() != 0){
                $informations = Order::where('client_id',\session()->get('client-id'))->get();
                //dd($informations);
                return view('client.checkout')->with('informations', $informations);
            }
            else{
                return redirect()->back();
            }
        }
        else{
            return redirect('/login');
        }
    }

    public function cart(){

        return view('client.cart');

    }

    public function loginForm() {
        return view('client.login');
    }

    public function login(Request $request) {
        $this->validate($request, [
                'email' => 'email|required',
                'pass' => 'required'
        ]);

        $client = Client::where('email', $request->input('email'))->first();

        if($client){
            if(Hash::check($request->input('pass'), $client->password)){
                 \session()->put('client-email', $client->email);
                 \session()->put('client-id', $client->id);

                 return redirect('/');
            }
            else{
                return redirect('/login')->with('alert', "Email or Password Wrong");
            }
        }
        else{
            return redirect('/login')->with('alert', "You Don't Have Any Account");
        }

    }

    public function signupForm() {
        return view('client.signup');
    }

    public function signup(Request $request) {
        $this->validate($request, [
                'email' => 'email|required|unique:clients',
                'pass' => 'required|min:6'
        ]);

        $client = new Client();
        $client->email = $request->input('email');
        $client->password = bcrypt($request->input('pass'));
        $client->save();

        return redirect('/signup')->with('status', 'Your Account Has been Created Successfully');
    }

    public function logout() {
        \session()->forget('client-email');
        \session()->forget('client-id');
        return redirect('/');
    }

}
