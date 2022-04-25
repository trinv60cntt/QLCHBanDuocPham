<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers;

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
// Login - Logout
Route::get('/admin', 'App\Http\Controllers\NhanVienController@loginAdmin');
Route::post('/admin', 'App\Http\Controllers\NhanVienController@postLoginAdmin');
Route::get('logout', 'App\Http\Controllers\AdminHomeController@getLogout');

// Route::get('/home', 'App\Http\Controllers\HomeController@index');

Route::get('/', 'App\Http\Controllers\HomeController@index');

Route::prefix('home')->group(function () {
  Route::get('/', [
    'as' => 'home.index',
    'uses' => 'App\Http\Controllers\HomeController@index'
  ]);

  Route::get('/giohang', [
    'as' => 'home.giohang',
    'uses' => 'App\Http\Controllers\HomeController@giohang'
  ]);

});

Route::prefix('menu')->group(function () {

  Route::get('/details/{sanPham_id}', [
    'as' => 'menus.details',
    'uses' => 'App\Http\Controllers\MenuController@details'
  ]);

});

Route::prefix('admin')->group(function () {
  
  Route::prefix('lops')->group(function () {
    Route::get('/', [
      'as' => 'lops.index',
      'uses' => 'App\Http\Controllers\LopController@index'
    ]);
    Route::get('/create', [
      'as' => 'lops.create',
      'uses' => 'App\Http\Controllers\LopController@create'
    ]);
  
    Route::post('/store', [
      'as' => 'lops.store',
      'uses' => 'App\Http\Controllers\LopController@store'
    ]);
  
    Route::get('/edit/{MaLop}', [
      'as' => 'lops.edit',
      'uses' => 'App\Http\Controllers\LopController@edit'
    ]);
  
    Route::post('/update/{MaLop}', [
      'as' => 'lops.update',
      'uses' => 'App\Http\Controllers\LopController@update'
    ]);
  
    Route::get('/delete/{MaLop}', [
      'as' => 'lops.delete',
      'uses' => 'App\Http\Controllers\LopController@delete'
    ]);
  });
  
  Route::prefix('danhmucs')->group(function () {
    Route::get('/', [
      'as' => 'danhmucs.index',
      'uses' => 'App\Http\Controllers\DanhMucController@index'
    ]);
  
    Route::get('/create', [
      'as' => 'danhmucs.create',
      'uses' => 'App\Http\Controllers\DanhMucController@create'
    ]);
  
    Route::post('/store', [
      'as' => 'danhmucs.store',
      'uses' => 'App\Http\Controllers\DanhMucController@store'
    ]);
  
    Route::get('/edit/{danhMuc_id}', [
      'as' => 'danhmucs.edit',
      'uses' => 'App\Http\Controllers\DanhMucController@edit'
    ]);
  
    Route::post('/update/{danhMuc_id}', [
      'as' => 'danhmucs.update',
      'uses' => 'App\Http\Controllers\DanhMucController@update'
    ]);
  
    Route::get('/delete/{danhMuc_id}', [
      'as' => 'danhmucs.delete',
      'uses' => 'App\Http\Controllers\DanhMucController@delete'
    ]);
  });

  Route::prefix('nhasanxuats')->group(function () {
    Route::get('/', [
      'as' => 'nhasanxuats.index',
      'uses' => 'App\Http\Controllers\NhaSanXuatController@index'
    ]);
  
    Route::get('/create', [
      'as' => 'nhasanxuats.create',
      'uses' => 'App\Http\Controllers\NhaSanXuatController@create'
    ]);
  
    Route::post('/store', [
      'as' => 'nhasanxuats.store',
      'uses' => 'App\Http\Controllers\NhaSanXuatController@store'
    ]);
  
    Route::get('/edit/{NSX_id}', [
      'as' => 'nhasanxuats.edit',
      'uses' => 'App\Http\Controllers\NhaSanXuatController@edit'
    ]);
  
    Route::post('/update/{NSX_id}', [
      'as' => 'nhasanxuats.update',
      'uses' => 'App\Http\Controllers\NhaSanXuatController@update'
    ]);
  
    Route::get('/delete/{NSX_id}', [
      'as' => 'nhasanxuats.delete',
      'uses' => 'App\Http\Controllers\NhaSanXuatController@delete'
    ]);
  });

  Route::prefix('sanphams')->group(function () {
    Route::get('/', [
      'as' => 'sanphams.index',
      'uses' => 'App\Http\Controllers\AdminSanPhamController@index'
    ]);
  
    Route::get('/create', [
      'as' => 'sanphams.create',
      'uses' => 'App\Http\Controllers\AdminSanPhamController@create'
    ]);
  
    Route::post('/store', [
      'as' => 'sanphams.store',
      'uses' => 'App\Http\Controllers\AdminSanPhamController@store'
    ]);
  
    Route::get('/edit/{sanPham_id}', [
      'as' => 'sanphams.edit',
      'uses' => 'App\Http\Controllers\AdminSanPhamController@edit'
    ]);
  
    Route::post('/update/{sanPham_id}', [
      'as' => 'sanphams.update',
      'uses' => 'App\Http\Controllers\AdminSanPhamController@update'
    ]);
  
    Route::get('/delete/{sanPham_id}', [
      'as' => 'sanphams.delete',
      'uses' => 'App\Http\Controllers\AdminSanPhamController@delete'
    ]);
  });

  Route::prefix('users')->group(function () {
    Route::get('/', [
      'as' => 'users.index',
      'uses' => 'App\Http\Controllers\AdminUserController@index'
    ]);
  
    Route::get('/create', [
      'as' => 'users.create',
      'uses' => 'App\Http\Controllers\AdminUserController@create'
    ]);
  
    Route::post('/store', [
      'as' => 'users.store',
      'uses' => 'App\Http\Controllers\AdminUserController@store'
    ]);
  
    Route::get('/edit/{id}', [
      'as' => 'users.edit',
      'uses' => 'App\Http\Controllers\AdminUserController@edit'
    ]);
  
    Route::post('/update/{id}', [
      'as' => 'users.update',
      'uses' => 'App\Http\Controllers\AdminUserController@update'
    ]);
  
    Route::get('/delete/{id}', [
      'as' => 'users.delete',
      'uses' => 'App\Http\Controllers\AdminUserController@delete'
    ]);
  });

  Route::prefix('hoadons')->group(function () {
    Route::get('/', [
      'as' => 'hoadons.index',
      'uses' => 'App\Http\Controllers\AdminHoaDonController@index'
    ]);

    Route::get('/details/{hoaDon_id}', [
      'as' => 'hoadons.details',
      'uses' => 'App\Http\Controllers\AdminHoaDonController@details'
    ]);
  
    // Route::get('/create', [
    //   'as' => 'sanphams.create',
    //   'uses' => 'App\Http\Controllers\AdminSanPhamController@create'
    // ]);
  
    // Route::post('/store', [
    //   'as' => 'sanphams.store',
    //   'uses' => 'App\Http\Controllers\AdminSanPhamController@store'
    // ]);
  
    // Route::get('/edit/{sanPham_id}', [
    //   'as' => 'sanphams.edit',
    //   'uses' => 'App\Http\Controllers\AdminSanPhamController@edit'
    // ]);
  
    // Route::post('/update/{sanPham_id}', [
    //   'as' => 'sanphams.update',
    //   'uses' => 'App\Http\Controllers\AdminSanPhamController@update'
    // ]);
  
    // Route::get('/delete/{sanPham_id}', [
    //   'as' => 'sanphams.delete',
    //   'uses' => 'App\Http\Controllers\AdminSanPhamController@delete'
    // ]);
  });
});


// Cart 
Route::post('/update-cart-quantity', 'App\Http\Controllers\CartController@update_cart_quantity');
Route::post('/save-cart', 'App\Http\Controllers\CartController@save_cart');
Route::get('/show-cart', 'App\Http\Controllers\CartController@show_cart');
Route::get('/delete-to-cart/{rowId}', 'App\Http\Controllers\CartController@delete_to_cart');
Route::get('/update', 'App\Http\Controllers\CartController@getUpdateCart');

// Checkout
Route::get('/login-checkout', 'App\Http\Controllers\CheckoutController@login_checkout');
Route::get('/logout-checkout', 'App\Http\Controllers\CheckoutController@logout_checkout');
Route::get('/register-checkout', 'App\Http\Controllers\CheckoutController@register_checkout');
Route::post('/order-place', 'App\Http\Controllers\CheckoutController@order_place');
Route::post('/add-customer', 'App\Http\Controllers\CheckoutController@add_customer');
Route::post('/login-customer', 'App\Http\Controllers\CheckoutController@login_customer');
Route::get('/checkout', 'App\Http\Controllers\CheckoutController@checkout');
Route::get('/announceGioHang', 'App\Http\Controllers\CheckoutController@announceGioHang');

// 