<?php

namespace App\Http\Controllers;

use App\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BrandController extends Controller
{
    public function addBrandForm() {
        if(session()->has('admin-email')){
            return view('admin.addbrand');
        }
        else{
            return view('admin.admin-login');
        }
    }

    public function addbrand(Request $request) {
        $this->validate($request, ['brand_name' => 'required'],
            ['brand_image' => 'image|nullable|max:1999']);

        if ($request->hasFile('brand_image')) {
            // 1: Get The File Name With Extension
            $file_name_with_ext = $request->file('brand_image')->getClientOriginalName();
            // 2: Get Just The File Name
            $file_name = pathinfo($file_name_with_ext, PATHINFO_FILENAME);
            // 3: Get Just The Extension
            $extension = $request->file('brand_image')->getClientOriginalExtension();
            // 4: Store the File Name
            $file_name_to_store = $file_name . '_' . time() . '.' . $extension;
            // 5: Upload Image to Localhost
            $request->file('brand_image')->storeAs('public/brand_images', $file_name_to_store);
        } else {
            $file_name_to_store = 'nobrandimage.jpg';
        }

        $check_brand = Brand::where('brand_name', $request->input('brand_name'))->first();
        $brand = new Brand();

        if (!$check_brand) {
            $brand->brand_name = $request->brand_name;
            $brand->brand_description = $request->brand_description;
            $brand->brand_image = $file_name_to_store;
            $brand->save();

            return redirect('/addbrand')->with('status', 'Brand ' . $request->input('brand_name') . ' Added Successfully!');
        } else {
            return redirect('/addbrand')->with('alert', 'Brand ' . $request->input('brand_name') . ' already Exist!');
        }

    }

    public function editBrandForm($id) {
        $brand = Brand::where('id', $id)->first();

        return view('admin.editbrand')->with('brand', $brand);
    }

    public function editBrand(Request $request) {
        $brand = Brand::find($request->input('id'));

        $this->validate($request, ['brand_name' => 'required'],
            ['brand_price' => 'required'],
            ['brand_image' => 'image|nullable|max:1999']);

        if ($request->hasFile('brand_image')) {
            Storage::disk('public')->delete('/brand_images/'.$brand->brand_image);
            // 1: Get The File Name With Extension
            $file_name_with_ext = $request->file('brand_image')->getClientOriginalName();
            // 2: Get Just The File Name
            $file_name = pathinfo($file_name_with_ext, PATHINFO_FILENAME);
            // 3: Get Just The Extension
            $extension = $request->file('brand_image')->getClientOriginalExtension();
            // 4: Store the File Name
            $file_name_to_store = $file_name .'_' . time() . '.' . $extension;
            // 5: Upload Image to Localhost
            $request->file('brand_image')->storeAs('public/brand_images', $file_name_to_store);
        } else {
            $file_name_to_store = $brand->brand_image;
        }

        $brand_update = Brand::find($request->input('id'));

        $brand_update->brand_name = $request->input('brand_name');
        $brand_update->brand_description = $request->input('brand_description');
        $brand_update->brand_image = $file_name_to_store;

        $brand_update->save();

        return redirect('/editbrand/'.$request->input('id').'')->with('status', 'Product ' . $request->input('brand_name') . ' Update Successfully!');

    }

    public function deleteBrand($id) {
        if(session()->has('admin-email')){
            $brand = new Brand();
            $brand->destroy($id);
            return redirect('/brands');
        }
        else{
            return view('admin.admin-login');
        }
    }

    public function brands() {
        $brands = Brand::get();

        return view('admin.brands')->with('brands', $brands);
    }
}
