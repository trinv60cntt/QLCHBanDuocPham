<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HoaDon;
use App\Models\SanPham;
use App\Models\ChiTietHD;
use App\Models\NhanVien;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Components\SanPhamRecursive;
use Carbon\Carbon;


class AdminHoaDonOffLineController extends Controller
{

  public function __construct(
    HoaDon $hoadon,
    SanPham $sanpham,
    ChiTietHD $chitiethd,
    Nhanvien $nhanvien
  ) {
    $this->hoadon = $hoadon;
    $this->chitiethd = $chitiethd;
    $this->sanpham = $sanpham;
    $this->nhanvien = $nhanvien;
  }

  public function create()
  {
    $htmlOptionSanPham = $this->getSanPham($sanPham_id_fk = '');
    return view('admin.hoadonoff.add', compact('htmlOptionSanPham'));
  }

  public function store(Request $request) {
    // dd($request->all());
    $now = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
    // insert order
    $order_data = array(); 
    $order_data['tongTien'] = $request->price_hidden;
    $order_data['ngayLap'] = $now;
    $order_data['created_at'] =new \DateTime();
    $order_id = DB::table('hoadonoff')->insertGetId($order_data);

    // insert order details
    $content = $request->sanPhamId;
    $itemQuantity = $request->itemQuantity;

    for($i = 0; $i < count($request->sanPhamId); $i++){
      $order_d_data = array();
      $order_d_data['hoaDon_id'] = $order_id;
      $order_d_data['sanPham_id'] = $content[$i];
      $order_d_data['soLuong'] = $itemQuantity[$i];
  
      DB::table('chitiethdoff')->insert($order_d_data);
    }

    return redirect()->route('hoadons.index');
  }

  public function getSanPham($sanPham_id_fk)
  {
    $data = $this->sanpham->all();
    $recursiveSanPham = new SanPhamRecursive($data);
    $htmlOptionSanPham = $recursiveSanPham->SanPhamRecursive($sanPham_id_fk);
    return $htmlOptionSanPham;
  }

  public function loadProduct(Request $request) {
    $sanPham_id = $request->sanPham_id;
    $sanpham = SanPham::where('sanPham_id', $sanPham_id)->get();
    $productQuantity = $request->productQuantity;
    $output = '';
    foreach ($sanpham as $key => $sp) {
      $output .= '
      <tr class="js-product-count">
        <input type="hidden" name="sanPhamId[]" value="'.$sp->sanPham_id.'" />
        <td>
          <div class="flex justify-center">
            <img height="100px" width="100px" src="storage/sanpham/1/'.$sp->hinhAnh.'" alt="San pham" class="sanpham-img mx-auto">
          </div>
        </td>
        <td class="p-4 px-6 text-center">
          <div class="flex flex-col items-center justify-center">
          '. $sp->tenSP .'
          </div>
        </td>
        <td class="p-4 px-6 text-center whitespace-nowrap">
          <div>
            <a class="button-count button-minus">
              <svg
                xmlns="http://www.w3.org/2000/svg"
                class="inline-flex w-6 h-6 text-red-600"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor"
              >
                <path
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  d="M15 12H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"
                />
              </svg>
            </a>
            <input
              type="text"
              name="itemQuantity[]"
              value="'.$productQuantity.'"
              class="upCart number-product w-12 text-center bg-gray-100 outline-none"
            />
            <a class="button-count button-add">
              <svg
                xmlns="http://www.w3.org/2000/svg"
                class="inline-flex w-6 h-6 text-green-600"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor"
              >
                <path
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"
                />
              </svg>
            </a>
            <div class="loading-ajax loading hidden fixed inset-0 z-9999">
              <div class="absolute inset-0 bg-gray-500 opacity-50 z-a-1"></div>
              <div div class="flex justify-center items-center w-full h-full">
                  <svg class="lds-spinner" width="54px"  height="54px"
                  xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 100 100"
                  preserveAspectRatio="xMidYMid" style="background: none;">
                  <g transform="rotate(0 50 50)">
                      <rect x="47" y="24" rx="9.4" ry="4.8" width="6" height="12" fill="#f5490f">
                      <animate attributeName="opacity" values="1;0" times="0;1" dur="1s"
                      begin="-0.9166666666666666s" repeatCount="indefinite"></animate>
                      </rect>
                  </g><g transform="rotate(30 50 50)">
                      <rect x="47" y="24" rx="9.4" ry="4.8" width="6" height="12" fill="#f5490f">
                      <animate attributeName="opacity" values="1;0" times="0;1" dur="1s"
                      begin="-0.8333333333333334s" repeatCount="indefinite"></animate>
                      </rect>
                  </g><g transform="rotate(60 50 50)">
                      <rect x="47" y="24" rx="9.4" ry="4.8" width="6" height="12" fill="#f5490f">
                      <animate attributeName="opacity" values="1;0" times="0;1" dur="1s"
                      begin="-0.75s" repeatCount="indefinite"></animate>
                      </rect>
                  </g><g transform="rotate(90 50 50)">
                      <rect x="47" y="24" rx="9.4" ry="4.8" width="6" height="12" fill="#f5490f">
                      <animate attributeName="opacity" values="1;0" times="0;1" dur="1s"
                      begin="-0.6666666666666666s" repeatCount="indefinite"></animate>
                      </rect>
                  </g><g transform="rotate(120 50 50)">
                      <rect x="47" y="24" rx="9.4" ry="4.8" width="6" height="12" fill="#f5490f">
                      <animate attributeName="opacity" values="1;0" times="0;1" dur="1s"
                      begin="-0.5833333333333334s" repeatCount="indefinite"></animate>
                      </rect>
                  </g><g transform="rotate(150 50 50)">
                      <rect x="47" y="24" rx="9.4" ry="4.8" width="6" height="12" fill="#f5490f">
                      <animate attributeName="opacity" values="1;0" times="0;1" dur="1s"
                      begin="-0.5s" repeatCount="indefinite"></animate>
                      </rect>
                  </g><g transform="rotate(180 50 50)">
                      <rect x="47" y="24" rx="9.4" ry="4.8" width="6" height="12" fill="#f5490f">
                      <animate attributeName="opacity" values="1;0" times="0;1" dur="1s"
                      begin="-0.4166666666666667s" repeatCount="indefinite"></animate>
                      </rect>
                  </g><g transform="rotate(210 50 50)">
                      <rect x="47" y="24" rx="9.4" ry="4.8" width="6" height="12" fill="#f5490f">
                      <animate attributeName="opacity" values="1;0" times="0;1" dur="1s"
                      begin="-0.3333333333333333s" repeatCount="indefinite"></animate>
                      </rect>
                  </g><g transform="rotate(240 50 50)">
                      <rect x="47" y="24" rx="9.4" ry="4.8" width="6" height="12" fill="#f5490f">
                      <animate attributeName="opacity" values="1;0" times="0;1" dur="1s"
                      begin="-0.25s" repeatCount="indefinite"></animate>
                      </rect>
                  </g><g transform="rotate(270 50 50)">
                      <rect x="47" y="24" rx="9.4" ry="4.8" width="6" height="12" fill="#f5490f">
                      <animate attributeName="opacity" values="1;0" times="0;1" dur="1s"
                      begin="-0.16666666666666666s" repeatCount="indefinite"></animate>
                      </rect>
                  </g><g transform="rotate(300 50 50)">
                      <rect x="47" y="24" rx="9.4" ry="4.8" width="6" height="12" fill="#f5490f">
                      <animate attributeName="opacity" values="1;0" times="0;1" dur="1s"
                      begin="-0.08333333333333333s" repeatCount="indefinite"></animate>
                      </rect>
                  </g><g transform="rotate(330 50 50)">
                      <rect x="47" y="24" rx="9.4" ry="4.8" width="6" height="12" fill="#f5490f">
                      <animate attributeName="opacity" values="1;0" times="0;1" dur="1s"
                      begin="0s" repeatCount="indefinite"></animate>
                      </rect>
                  </g>
                  </svg>
              </div>
            </div>
          </div>
        </td>
        <td class="p-4 px-6 text-center whitespace-nowrap">'.$productQuantity.' x ' . number_format($sp->donGia, 0, ',', '.') . '</td>
        <td class="product-price p-4 px-6 text-center whitespace-nowrap">
        '.
        number_format($productQuantity * $sp->donGia, 0, ',', '.')
        .'
        </td>
        <td class="p-4 px-6 text-center whitespace-nowrap">
          <a href="#"
          class="js-action-delete">
            <svg
              xmlns="http://www.w3.org/2000/svg"
              class="w-6 h-6 text-red-400"
              fill="none"
              viewBox="0 0 24 24"
              stroke="currentColor"
            >
              <path
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"
              />
            </svg>
          </a>
        </td>
      </tr>
      '; 
    }
    echo $output;
  }

  
}
