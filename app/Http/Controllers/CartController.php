<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Gloudemans\Shoppingcart\Facades\Cart;

session_start();

class CartController extends Controller
{
  public function save_cart(Request $request) {
    $productId = $request->productid_hidden;
    $quantity = $request->qty;

    $product_info = DB::table('san_phams')->where('sanPham_id', $productId)->first();

    // Cart::destroy();

    $data['id'] = $product_info->sanPham_id;
    $data['qty'] = $quantity;
    $data['name'] = $product_info->tenSP;
    $data['price'] = $product_info->donGia;
    $data['weight'] = '0';
    $data['options']['image'] = $product_info->hinhAnh;
    Cart::add($data);
    return Redirect::to('/show-cart');
  }
  
  public function show_cart() {
    return view('home.cart.show_cart');
  }

  public function delete_to_cart($rowId) {
    Cart::update($rowId, 0);
    return Redirect::to('/show-cart');
  }

  public function update_cart_quantity(Request $request) {
    $rowId = $request->rowId_cart;
    $qty = $request->cart_quantity;
    Cart::update($rowId, $qty);
    return Redirect::to('/show-cart');
  }
}
