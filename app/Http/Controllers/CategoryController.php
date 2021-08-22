<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function categoryForm() {
        if(session()->has('admin-email')){
            return view('admin.addcategory');
        }
        else{
            return view('admin.admin-login');
        }

    }

    public function addCategory(Request $request) {
        $this->validate($request, ['category_name' => 'required']);
        $check_cat = Category::where('category_name', $request->input('category_name'))->first();
        $category = new Category();

        if (!$check_cat){
            $category->category_name = $request->input('category_name');
            $category->category_description = $request->input('category_description');
            $category->save();
            return redirect('/addcategory')->with('status', 'Category '.$request->input('category_name').' Added Successfully!');
        }
        else{
            return redirect('/addcategory')->with('alert', 'Category '.$request->input('category_name').' already Exist!');
        }
    }

    public function categories() {
        $categories = Category::get();

        return view('admin.categories')->with('categories', $categories);
    }

    public function editCategoryForm($id) {
        $category = Category::where('id', $id)->first();

        return view('admin.editcategory')->with('category', $category);
    }

    public function editCategory(Request $request) {
        $check_cat = Category::where('category_name', $request->input('category_name'))->first();
        $category = Category::find($request->input('id'));

        if(!$check_cat){
            $category->category_name = $request->input('category_name');
            $category->category_description = $request->input('category_description');
            $category->save();
            return redirect('/categories');
        }
        else{
            return redirect('/editcategory/'.$request->input('id').'')->with('alert', 'Category '.$request->input('category_name').' already Exist!');
        }

    }

    public function deleteCategory($id) {
        if(session()->has('admin-email')){
            $category = new Category();
            $category->destroy($id);
            return redirect('/categories');
        }
        else{
            return view('admin.admin-login');
        }
    }
}
