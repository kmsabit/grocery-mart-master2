<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function dashboard(){
        if(session()->has('admin-email')){
            return view('admin.dashboard');
        }
        else{
            return view('admin.admin-login');
        }

    }

    public function orders() {
        if(session()->has('admin-email')) {
            $orders = DB::table('orders')->groupByRaw('order_id')->get();
            //dd($orders);
            return view('admin.orders')->with('orders', $orders);
        }
        else{
            return view('admin.admin-login');
        }
    }

    public function loginForm() {
        return view('admin.admin-login');
    }

    public function login(Request $request) {
        $this->validate($request, [
            'email' => 'email|required',
            'pass' => 'required'
        ]);

        if($request->input('email') === 'admin@farm.test' && $request->input('pass') === 'admin1234'){
            session()->put('admin-email', 'admin@farm.test');
            return redirect('/admin')->with('status', 'Your Have been Successfully Logged In');
        }
        else{
            return redirect('/admin')->with('alert', "Email or Password Wrong");
        }

    }

    public function logout(){
        session()->forget('admin-email');
        return redirect('/admin')->with('status', 'Logged Out Successfully');
    }

}
