<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ThongKe;
use App\Models\HoaDon;
use App\Models\ChiTietHD;
use Carbon\Carbon;


class AdminThongKeController extends Controller
{  
  public function __construct(
  HoaDon $hoadon,
  ChiTietHD $chitiethd
  ) {
    $this->hoadon = $hoadon;
    $this->chitiethd = $chitiethd;
  }
  public function doanhThu()
  {
    return view('admin.thongke.doanhThu');
  }

  public function filter_by_date(Request $request) {
    $data = $request->all();
    $from_date = $data['from_date'];
    $to_date = $data['to_date'];
    
    $get = ThongKe::whereBetween('hoaDonNgay', [$from_date, $to_date])->orderBy('hoaDonNgay', 'ASC')->get();
    $hoadon = HoaDon::whereBetween('ngayLap', [$from_date, $to_date])->where('tinhTrang', 4)->orderBy('ngayLap', 'ASC')->get();
    date_default_timezone_set('UTC');

    $chart_data = [];
    while (strtotime($from_date) <= strtotime($to_date)) {
        $tongHD = 0;
        $tongTien = 0;
        $tongSL = 0;
        foreach($hoadon as $item) {
          if($item->ngayLap == $from_date) {
            $tongHD++;
            $tongTien += $item->tongTien;
            $tongSL = 10;
          }
        }
        $chart_data[] = array(
          'period' => $from_date,
          'order' => $tongHD,
          'sales' => $tongTien,
          'quantity' => $tongSL
        );
        $from_date = date("Y-m-d", strtotime("+1 days", strtotime($from_date)));
    }
    $temp = $chart_data;
    for ($i = 0; $i < count($temp); $i++) {
      if($chart_data[$i]['order'] == 0) {
        unset($chart_data[$i]);
      }
    }
    $chart_data = array_values($chart_data);
    // $chart_data = $temp;
    // dd($hoadon);
    $total_order = 0; // tong HD
    $sales = 0; // tong Tien
    $quantity = 0; // so luong
    // foreach($hoadon as $key => $product_id){
    //   // $total_order =  $total_order + 1;
    //   // $sales += $product_id->tongTien;
    // }
    // dd($sales);
    // dd($hoadon->where('hoaDon_id'));
    // foreach($hoadon->where('hoaDon_id') as $key => $product_id){
    //   dd($product_id);
    // }
    // dd($hoadon);

    echo $data = json_encode($chart_data);
  }

  public function dashboard_filter(Request $request) {
    $data = $request->all();

    // $today = Carbon::now('Asia/Ho_Chi_Minh')->format('d-m-Y H:i:s');

    $dau_thangnay = Carbon::now('Asia/Ho_Chi_Minh')->startOfMonth()->toDateString();
    $dau_thangtruoc = Carbon::now('Asia/Ho_Chi_Minh')->subMonth()->startOfMonth()->toDateString();
    $cuoi_thangtruoc = Carbon::now('Asia/Ho_Chi_Minh')->subMonth()->endOfMonth()->toDateString();
    
    $sub7days = Carbon::now('Asia/Ho_Chi_Minh')->subdays(7)->toDateString();
    $sub365days = Carbon::now('Asia/Ho_Chi_Minh')->subdays(365)->toDateString();

    $now = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();

    if($data['dashboard_value'] == '7ngay') {
      $get = ThongKe::whereBetween('hoaDonNgay', [$sub7days, $now])->orderBy('hoaDonNgay', 'ASC')->get();
    } else if($data['dashboard_value'] == 'thangtruoc') {
      $get = ThongKe::whereBetween('hoaDonNgay', [$dau_thangtruoc, $cuoi_thangtruoc])->orderBy('hoaDonNgay', 'ASC')->get();
    } else if($data['dashboard_value'] == 'thangnay') {
      $get = ThongKe::whereBetween('hoaDonNgay', [$dau_thangnay, $now])->orderBy('hoaDonNgay', 'ASC')->get();
    } else {
      $get = ThongKe::whereBetween('hoaDonNgay', [$sub365days, $now])->orderBy('hoaDonNgay', 'ASC')->get();
    }

    foreach ($get as $key => $val) {
      $chart_data[] = array(
        'period' => $val->hoaDonNgay,
        'order' => $val->tongHD,
        'sales' => $val->tongTien, 
        'quantity' => $val->soLuongSP
      );
    }

    echo $data = json_encode($chart_data);
  }
}
