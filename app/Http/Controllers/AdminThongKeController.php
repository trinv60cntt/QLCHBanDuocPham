<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ThongKe;


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

  // public 
}
