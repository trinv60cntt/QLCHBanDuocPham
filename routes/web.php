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

Route::get('/admin', 'App\Http\Controllers\NhanVienController@loginAdmin');
Route::post('/admin', 'App\Http\Controllers\NhanVienController@postLoginAdmin');

Route::get('/home', function () {
  return view('home');
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

});

