<?php

namespace App\Http\Controllers;

use App\Slider;
use Illuminate\Http\Request;

class SliderController extends Controller
{
    public function addSliderForm() {
        if(session()->has('admin-email')){
            return view('admin.addslider');
        }
        else{
            return view('admin.admin-login');
        }
    }

    public function addSlider(Request $request) {
        $this->validate($request, ['slider_description_one' => 'max:60'],
            ['slider_description_two' => 'max:60'],
            ['slider_image' => 'image|nullable|max:6999']);


        if ($request->hasFile('slider_image')) {
            // 1: Get The File Name With Extension
            $file_name_with_ext = $request->file('slider_image')->getClientOriginalName();
            // 2: Get Just The File Name
            $file_name = pathinfo($file_name_with_ext, PATHINFO_FILENAME);
            // 3: Get Just The Extension
            $extension = $request->file('slider_image')->getClientOriginalExtension();
            // 4: Store the File Name
            $file_name_to_store = $file_name . '_' . time() . '.' . $extension;
            // 5: Upload Image to Localhost
            $request->file('slider_image')->storeAs('public/slider_images', $file_name_to_store);
        } else {
            $file_name_to_store = 'noimage.jpg';
        }

        $slider = new Slider();

        $slider->slider_description_one = $request->input('slider_description_one');
        $slider->slider_description_two = $request->input('slider_description_two');
        $slider->slider_image = $file_name_to_store;
        if ($request->input('slider_status')) {
            $slider->slider_status = 1;
        } else {
            $slider->slider_status = 0;
        }
        $slider->save();

        return redirect('/addslider')->with('status', 'Product ' . $request->input('slider_description_one') . ' Added Successfully!');

    }

    public function sliders() {
        if(session()->has('admin-email')){
            return view('admin.sliders');
        }
        else{
            return view('admin.admin-login');
        }
    }
}
