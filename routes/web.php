<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*Route::get('/', function () {
    return view('welcome');
});*/

Route::get('/', 'ClientController@home');
Route::get('/cart', 'ClientController@cart');
Route::get('/shopall', 'ClientController@shopAll');
Route::get('/shopcategory/{id}', 'ClientController@shopCategory');
Route::get('/addtocart/{id}', 'ClientController@addToCart');
Route::get('/addtocartremove/{rowId}', 'ClientController@addToCartRemove');
Route::POST('/addtocartupdate', 'ClientController@addToCartUpdate');
Route::get('/checkout', 'ClientController@checkout');
Route::get('/login', 'ClientController@loginForm');
Route::get('/logout', 'ClientController@logout');
Route::get('/admin-logout', 'AdminController@logout');
Route::POST('/login', 'ClientController@login');
Route::get('/signup', 'ClientController@signupForm');
Route::POST('/signup', 'ClientController@signup');

Route::get('/admin','AdminController@dashboard');
Route::get('/admin-login','AdminController@loginForm');
Route::POST('/admin-login','AdminController@login');
Route::get('/orders','AdminController@orders');
Route::get('/orderstatus/{id}','OrderController@statusUpdate');

Route::get('/addcategory','CategoryController@categoryForm');
Route::post('/addcategory','CategoryController@addCategory');

Route::get('/editcategory/{id}','CategoryController@editCategoryForm');
Route::patch('/editcategory','CategoryController@editCategory');
Route::get('/deletecategory/{id}','CategoryController@deleteCategory');
Route::get('/categories','CategoryController@categories');

Route::get('/addbrand','BrandController@addBrandForm');
Route::post('/addbrand','BrandController@addBrand');
Route::post('/deletebrand/{id}','BrandController@deleteBrand');

Route::get('/editbrand/{id}','BrandController@editBrandForm');
Route::patch('/editbrand','BrandController@editBrand');
Route::get('/deletebrand/{id}','BrandController@deleteBrand');
Route::get('/brands','BrandController@brands');

Route::get('/addproduct','ProductController@productForm');
Route::post('/addproduct','ProductController@addProduct');

Route::get('/editproduct/{id}','ProductController@editProductForm');
Route::patch('/editproduct','ProductController@editProduct');
Route::get('/deleteproduct/{id}','ProductController@deleteProduct');
Route::get('/products','ProductController@products');
Route::get('/changestatusproduct/{id}','ProductController@changeStatusProduct');

Route::get('/sliders','SliderController@sliders');
Route::get('/addslider','SliderController@addSliderForm');
Route::post('/addslider','SliderController@addSlider');

Route::post('/orderplace','OrderController@orderPlace');

Route::get('/getinvoice/{id}','InvoiceController@generateInvoice');

/*Route::get('/addtocart/{id}', 'TestSession@addToCart');
Route::get('/addtocartremove/{rowId}', 'TestSession@removeCart');
Route::POST('/addtocartupdate', 'TestSession@updateCart');*/
