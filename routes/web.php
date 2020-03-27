<?php

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

Route::get("/", "HomeController@index");
Route::get("/about", "PagesController@about");
Route::get("/contact", "PagesController@contact");
Route::get("/shop", "ShopController@index");
Route::get("/collections", "CollectionControler@getAllCollections");
Route::get("/categories", "CategoryController@getAllCategories");
Route::prefix("socks")->group(function(){
    Route::get("bigImage{id}", "SockController@getBigImage");
    Route::get("", "SockController@index");
    Route::get("smallImages/{id}", "SockController@getSmallImages");
});
Route::post("/login", "AuthController@login");
Route::post("/register", "AuthController@register");
Route::get("/logout", "AuthController@logout");
Route::prefix("cart")->group(function(){
    Route::get("", "CartController@addToCart");
    Route::get("delete/{id}", "CartController@deleteFromCart");
    Route::get("update", "CartController@updateCart");
    Route::get("show", "CartController@getCartData");
});
Route::group(['prefix' => 'admin', 'middleware' => 'admin.check'],function(){
    Route::get("", "Admin\AdminController@index");
    Route::get("socks{limit}", "SockController@getAllSocks");
    Route::get("delete/sock", "SockController@destroy");
    Route::get("sock/{id}", "SockController@getOneSockAllInfo");
    Route::post('socks/edit', "SockController@update");

});
Route::get("/user/check-user", "AuthController@checkUser");
Route::post("/socks/store", "SockController@store")->middleware('admin.check');;
Route::group(['prefix' => 'social-networks', 'middleware' => 'admin.check'],function(){
    Route::get("", "Admin\SocialNetworkController@index");
    Route::post("store", "Admin\SocialNetworkController@store");
    Route::post("update", "Admin\SocialNetworkController@update");
    Route::get("delete/{id}", "Admin\SocialNetworkController@delete");
});

Route::get("/contact", "ContactController@index")->middleware('admin.check');
Route::post("/contact/update", "ContactController@update")->middleware('admin.check');
Route::get("/about-me", "AboutController@index")->middleware('admin.check');
Route::post("/about/update", "AboutController@update")->middleware('admin.check');
Route::group(['prefix' => 'collections', 'middleware' => 'admin.check'],function(){
    Route::get("", "CollectionControler@index");
    Route::get("{id}", "CollectionControler@getOneCollection");
    Route::post("insert", "CollectionControler@insert");
    Route::post("update", "CollectionControler@update");
    Route::get("delete/{id}", "CollectionControler@delete");
});
Route::group(['prefix' => 'users', 'middleware' => 'admin.check'],function(){
    Route::get("", "UserController@index");
    Route::post("insert", "AuthController@register");
    Route::get("delete/{id}", "UserController@deleteUser");
});

Route::get("/contact-us", "PagesController@contact");
Route::post("/send-email/send", "SendEmailController@send");
Route::get("/activity", "ActivityController@index")->middleware('admin.check');;
Route::get("/activity/nextpage", "ActivityController@getActivities")->middleware('admin.check');;
