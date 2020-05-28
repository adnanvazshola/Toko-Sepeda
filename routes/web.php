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


Route::get('/', function () {
    return view('welcome');
});
*/
 
Auth::routes();

Route::group(['prefix' => 'administrator', 'middleware' => 'auth'], function() {
	Route::get('/home', 'HomeController@index')->name('home');
	Route::resource('kategori', 'kategoriController')->except(['create', 'show']);
	Route::resource('merk', 'merkController')->except(['create', 'show']);
	Route::resource('produk', 'produkController')->except(['show']);
	Route::get('/produk/massal', 'ProdukController@uploadProdukMassal')->name('produk.massal');
	Route::post('/produk/bulk', 'ProdukController@produkUpload')->name('produk.saveMassal');
	Route::resource('berita', 'beritaController')->except(['show']);
});

Route::group(['prefix' => 'member', 'namespace' => 'ecomm'], function() {
	Route::get('login', 'LoginController@loginForm')->name('pelanggan.login');
});

Route::group(['prefix' => 'member'], function() {
    Route::get('verifikasi/{token}', 'FrontController@verifikasiPelanggan')->name('pelanggan.verifikasi');
});


Route::group(['middleware' => 'pelanggan'], function() {
    Route::get('dashboard', 'LoginController@dashboard')->name('pelanggan.dashboard');
    Route::get('logout', 'LoginController@logout')->name('pelanggan.logout');
});

Route::get('/', 'frontController@index')->name('front.index');
Route::get('/produk', 'frontController@produk')->name('front.produk');
Route::get('/kategori/{slug}', 'FrontController@kategoriProduk')->name('front.kategori');
Route::get('/merk/{slug}', 'FrontController@merkProduk')->name('front.merk');
Route::get('/produk/{slug}', 'FrontController@detailProduk')->name('front.detailProduk');
Route::post('/cart', 'CartController@addToCart')->name('front.cart');
Route::get('/cart', 'CartController@listCart')->name('front.list_cart');
Route::post('/cart/update', 'CartController@updateCart')->name('front.update_cart');
Route::get('/checkout', 'CartController@checkout')->name('front.checkout');
Route::post('/checkout', 'CartController@processCheckout')->name('front.store_checkout');
Route::get('/checkout/{invoice}', 'CartController@checkoutFinish')->name('front.finish_checkout');