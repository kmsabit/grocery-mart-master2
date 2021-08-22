<?php

namespace App\Http\Controllers;

use App\Brand;
use App\Category;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function productForm()
    {
        if(session()->has('admin-email')){
            $categories = Category::all()->pluck('category_name', 'id');
            $brands = Brand::all()->pluck('brand_name', 'id');

            return view('admin.addproduct')->with('categories', $categories)->with('brands', $brands);
        }
        else{
            return view('admin.admin-login');
        }
    }

    public function addProduct(Request $request)
    {
        $this->validate($request, ['product_name' => 'required'],
            ['product_price' => 'required'],
            ['product_image' => 'image|nullable|max:1999']);

        if($request->input('product_category') === null || $request->input('product_brand') === null){
            return redirect('/addproduct');
        }

        if ($request->hasFile('product_image')) {
            // 1: Get The File Name With Extension
            $file_name_with_ext = $request->file('product_image')->getClientOriginalName();
            // 2: Get Just The File Name
            $file_name = pathinfo($file_name_with_ext, PATHINFO_FILENAME);
            // 3: Get Just The Extension
            $extension = $request->file('product_image')->getClientOriginalExtension();
            // 4: Store the File Name
            $file_name_to_store = $file_name . '_' . time() . '.' . $extension;
            // 5: Upload Image to Localhost
            $request->file('product_image')->storeAs('public/product_images', $file_name_to_store);
        } else {
            $file_name_to_store = 'noimage.jpg';
        }

        $check_product = Product::where('product_name', $request->input('product_name'))->first();
        $product = new Product();

        if (!$check_product) {
            $slug = Str::slug($request->input('product_name'), '-');
            $product->product_name = $request->input('product_name');
            $product->product_slug = $slug;
            $product->product_description = $request->input('product_description');
            $product->product_category = $request->input('product_category');
            $product->product_brand = $request->input('product_brand');
            $product->product_price = $request->input('product_price');
            $product->product_image = $file_name_to_store;
            if ($request->input('product_status')) {
                $product->product_status = 1;
            } else {
                $product->product_status = 0;
            }
            $product->save();

            return redirect('/addproduct')->with('status', 'Product ' . $request->input('product_name') . ' Added Successfully!');
        } else {
            return redirect('/addproduct')->with('alert', 'Product ' . $request->input('product_name') . ' already Exist!');
        }
    }

    public function products()
    {
        if(session()->has('admin-email')){
            $products = Product::get();

            return view('admin.products')->with('products', $products);
        }
        else{
            return view('admin.admin-login');
        }
    }

    public function editProductForm($id){
        if(session()->has('admin-email')){
            $product = Product::where('id', $id)->first();
            $categories = Category::all()->pluck('category_name', 'id');
            $brands = Brand::all()->pluck('brand_name', 'id');

            if($product->product_status == 1) {
                $bool = "true";
            }
            else{
                $bool = null;
            }

            return view('admin.editproduct')->with('product', $product)->with('brands', $brands)->with('categories', $categories)->with('bool', $bool);
        }
        else{
            return view('admin.admin-login');
        }
    }

    public function editProduct(Request $request){

        $product = Product::find($request->input('id'));

        $this->validate($request, ['product_name' => 'required'],
            ['product_price' => 'required'],
            ['product_image' => 'image|nullable|max:1999']);

        if ($request->hasFile('product_image')) {
            Storage::disk('public')->delete('/product_images/'.$product->product_image);
            // 1: Get The File Name With Extension
            $file_name_with_ext = $request->file('product_image')->getClientOriginalName();
            // 2: Get Just The File Name
            $file_name = pathinfo($file_name_with_ext, PATHINFO_FILENAME);
            // 3: Get Just The Extension
            $extension = $request->file('product_image')->getClientOriginalExtension();
            // 4: Store the File Name
            $file_name_to_store = $file_name .'_' . time() . '.' . $extension;
            // 5: Upload Image to Localhost
            $request->file('product_image')->storeAs('public/product_images', $file_name_to_store);
        } else {
            $file_name_to_store = $product->product_image;
        }

        $product_update = Product::find($request->input('id'));

            $slug = Str::slug($request->input('product_name'), '-');
            $product_update->product_name = $request->input('product_name');
            $product_update->product_slug = $slug;
            $product_update->product_description = $request->input('product_description');
            $product_update->product_category = $request->input('product_category');
            $product_update->product_brand = $request->input('product_brand');
            $product_update->product_price = $request->input('product_price');
            $product_update->product_image = $file_name_to_store;
            if ($request->input('product_status')) {
                $product_update->product_status = 1;
            } else {
                $product_update->product_status = 0;
            }
            $product_update->save();

            return redirect('/editproduct/'.$request->input('id').'')->with('status', 'Product ' . $request->input('product_name') . ' Added Successfully!');
    }

    public function deleteProduct($id){
        if(session()->has('admin-email')){
            $product_delete = Product::find($id);
            Storage::disk('public')->delete('/product_images/'.$product_delete->product_image);
            $product = new Product();
            $product->destroy($id);
            return redirect('/products');
        }
        else{
            return view('admin.admin-login');
        }
    }

    public function changeStatusProduct($id){
        if(session()->has('admin-email')){
            $product = Product::find($id);

            if($product->product_status === 1){
                $product->product_status = 0;
                $product->save();
                return redirect('/products');
            }
            else{
                $product->product_status = 1;
                $product->save();
                return redirect('/products');
            }
        }
        else{
            return view('admin.admin-login');
        }

    }
}
