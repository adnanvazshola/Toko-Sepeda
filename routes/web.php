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
	Route::get('/produk/massal', 'produkController@uploadProdukMassal')->name('produk.massal');
	Route::post('/produk/bulk', 'produkController@produkUpload')->name('produk.saveMassal');
	Route::resource('berita', 'beritaController')->except(['show']);
	Route::get('/member', 'memberController@index')->name('member');
	Route::group(['prefix' => 'orders'], function() {
    	Route::get('/', 'adminOrderController@index')->name('orders.index');
    	Route::delete('/{id}', 'adminOrderController@destroy')->name('orders.destroy');
    	Route::get('/{invoice}', 'adminOrderController@view')->name('orders.view');
    	Route::get('/payment/{invoice}', 'adminOrderController@acceptPayment')->name('orders.approve_payment');
    	Route::post('/shipping', 'adminOrderController@shippingOrder')->name('orders.shipping');
	});
});

Route::group(['prefix' => 'member'], function() {
    Route::get('verifikasi/{token}', 'frontController@verifikasiPelanggan')->name('pelanggan.verifikasi');
	Route::get('login', 'loginController@loginForm')->name('pelanggan.login');
	Route::post('login', 'loginController@login')->name('pelanggan.postLogin');
	Route::group(['middleware' => 'pelanggan'], function() {
	    Route::get('dashboard', 'loginController@dashboard')->name('pelanggan.dashboard');
        Route::get('logout', 'loginController@logout')->name('pelanggan.logout');
        Route::get('orders', 'orderController@index')->name('pelanggan.orders');
        Route::get('order/{invoice}', 'orderController@view')->name('pelanggan.view_order');
        Route::get('pembayaran', 'orderController@pembayaranForm')->name('pelanggan.pembayaranForm');
        Route::post('pembayaran', 'orderController@storePembayaran')->name('pelanggan.simpanPembayaran');
        Route::get('/formUpdateData', 'loginController@updateData')->name('pelanggan.updateData');
        Route::post('/updateData', 'loginController@simpan')->name('pelanggan.update');
	});
});


Route::get('/', 'frontController@index')->name('front.index');
Route::get('/produk', 'frontController@produk')->name('front.produk');
Route::get('/kategori/{slug}', 'frontController@kategoriProduk')->name('front.kategori');
Route::get('/merk/{slug}', 'frontController@merkProduk')->name('front.merk');
Route::get('/produk/{produk}', 'frontController@detailProduk')->name('front.detailProduk');
Route::post('/cart', 'CartController@addToCart')->name('front.cart');
Route::get('/cart', 'CartController@listCart')->name('front.list_cart');
Route::post('/cart/update', 'CartController@updateCart')->name('front.update_cart');
Route::get('/checkout', 'CartController@checkout')->name('front.checkout');
Route::post('/checkout', 'CartController@processCheckout')->name('front.store_checkout');
Route::get('/checkout/{invoice}', 'CartController@checkoutFinish')->name('front.finish_checkout');
Route::get('/blog', 'frontController@blog')->name('front.blog');
Route::get('/blog/{slug}', 'frontController@detailBlog')->name('front.detailBlog');

Route::resource('favorites', 'FavoriteController');
