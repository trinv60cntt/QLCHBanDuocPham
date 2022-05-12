<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ThongKe;
use Carbon\Carbon;


class AdminThongKeController extends Controller
{
  public function doanhThu()
  {
    return view('admin.thongke.doanhThu');
  }

  public function filter_by_date(Request $request) {
    $data = $request->all();
    $from_date = $data['from_date'];
    $to_date = $data['to_date'];
  
    $get = ThongKe::whereBetween('hoaDonNgay', [$from_date, $to_date])->orderBy('hoaDonNgay', 'ASC')->get();
  
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
