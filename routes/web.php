<?php

use Illuminate\Support\Facades\Route;
use App\Cart;
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

Route::get('/', 'localController@index')->name('fash');

Route::resource('/blog', 'BlogController');



Route::get('/contact', function () {if(Auth::user()){$carts = Cart::where('user_id' , Auth::user()->id)->count();}
    return view('contact', ['totalCart'=>$carts ?? '0']);
})->name('contact');

Route::get('/about', function () {if(Auth::user()){$carts = Cart::where('user_id' , Auth::user()->id)->count();}
    return view('about', ['totalCart'=>$carts ?? '0']);
})->name('about');

Auth::routes();

Route::resource('/product', 'ProductController')->only(['index' , 'show' , 'create' , 'store' ]);
Route::resource('/cart', 'CartController')->middleware('auth');
Route::get('subscribe', 'LocalController@addSubscription')->name('subscribe');
Route::get('/home', 'HomeController@index')->name('home');

Route::get('/product/short/{cate}', 'ProductController@category')->name('cate');

Route::view('/productdetail', 'productdetail')->name('productdetail');
Route::view('/productdetail', 'productdetail')->name('productdetail');
Route::post('/pay', 'PaymentController@PayWithPaypal')->name('pay');
Route::get('/status ', 'PaymentController@status')->name('status');
Route::get('/canceled ', 'PaymentController@canceled')->name('canceled');


