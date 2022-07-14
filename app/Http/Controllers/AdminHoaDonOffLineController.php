<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HoaDon;
use App\Models\HoaDonOff;
use App\Models\SanPham;
use App\Models\ChiTietHD;
use App\Models\ChiTietHDOff;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Components\SanPhamRecursive;
use App\Components\NhanVienRecursive;
use Carbon\Carbon;


class AdminHoaDonOffLineController extends Controller
{

  public function __construct(
    HoaDon $hoadon,
    HoaDonOff $hoadonoff,
    SanPham $sanpham,
    ChiTietHD $chitiethd,
    ChiTietHDOff $chitiethdoff,
    User $nhanvien
  ) {
    $this->hoadon = $hoadon;
    $this->hoadonoff = $hoadonoff;
    $this->chitiethdoff = $chitiethdoff;
    $this->chitiethd = $chitiethd;
    $this->sanpham = $sanpham;
    $this->nhanvien = $nhanvien;
  }

  public function index(Request $request)
  {
    $htmlOptionNhanVien = $this->getThuNgan($nhanvien_id_fk = '');
    if(!empty($request->query('ngayLap'))) {
      $search = DB::table('hoadonoff')->leftJoin('users', 'users.id','=', 'hoadonoff.nhanvien_id')->where('ngayLap','=', $request->ngayLap)->where('hoadonoff.deleted_at', NULL);
    }
    if(!empty($request->query('nhanvien_id'))) {
      $search = DB::table('hoadonoff')->leftJoin('users', 'users.id','=', 'hoadonoff.nhanvien_id')->where('nhanvien_id','=', $request->nhanvien_id)->where('hoadonoff.deleted_at', NULL);
    }
    if(!empty($request->query('ngayLap')) && !empty($request->query('nhanvien_id'))) {
      $search = DB::table('hoadonoff')->leftJoin('users', 'users.id','=', 'hoadonoff.nhanvien_id')->where('ngayLap','=', $request->ngayLap)->where('nhanvien_id','=', $request->nhanvien_id)->where('hoadonoff.deleted_at', NULL);
    }
    if(!empty($search)) {
      $hoadonoffs = $search->paginate(5);
    }
    else {
      $hoadonoffs = DB::table('hoadonoff')->leftJoin('users', 'users.id','=', 'hoadonoff.nhanvien_id')->orderBy('hoadonoff.hoaDonOff_id', 'DESC')->where('hoadonoff.deleted_at', NULL)->paginate(5);
    }
    return view('admin.hoadonoff.index', compact('hoadonoffs', 'htmlOptionNhanVien'));
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
    $order_data['nhanvien_id'] = auth()->id();
    $order_data['created_at'] =new \DateTime();
    $order_id = DB::table('hoadonoff')->insertGetId($order_data);

    // insert order details
    $content = $request->sanPhamId;
    $itemQuantity = $request->itemQuantity;

    for($i = 0; $i < count($request->sanPhamId); $i++){
      $order_d_data = array();
      $order_d_data['hoaDonOff_id'] = $order_id;
      $order_d_data['sanPham_id'] = $content[$i];
      $order_d_data['soLuong'] = $itemQuantity[$i];

      $sanpham = $this->sanpham->find($content[$i]);
      $dataProductUpdate['soLuongTon'] = $sanpham->soLuongTon - $itemQuantity[$i];
      $sanpham->update($dataProductUpdate);
  
      DB::table('chitiethdoff')->insert($order_d_data);
    }

    return redirect()->route('hoadonoffline.index')->with('success', 'Thêm mới hóa đơn thành công');
  }

  public function getSanPham($sanPham_id_fk)
  {
    $data = $this->sanpham->where('soLuongTon', '>', 0)->get();
    $recursiveSanPham = new SanPhamRecursive($data);
    $htmlOptionSanPham = $recursiveSanPham->SanPhamRecursive($sanPham_id_fk);
    return $htmlOptionSanPham;
  }

  public function getThuNgan($nhanvien_id_fk)
  {
    $data = $this->nhanvien->where('vaiTro_id', 6)->get();
    $recursiveNhanVien = new NhanVienRecursive($data);
    $htmlOptionNhanVien = $recursiveNhanVien->NhanvienRecursive($nhanvien_id_fk);
    return $htmlOptionNhanVien;
  }

  public function loadProduct(Request $request) {
    $sanPham_id = $request->sanPham_id;
    $sanpham = SanPham::where('sanPham_id', $sanPham_id)->get();
    $productQuantity = $request->productQuantity;
    $output = '';
    foreach ($sanpham as $key => $sp) {
      $output .= '
      <tr class="js-product-count tb-row-item">
        <input type="hidden" name="sanPhamId[]" value="'.$sp->sanPham_id.'" class="product-id" />
        <input type="hidden" name="qtyHidden" value="'.$sp->soLuongTon.'" class="qty-hidden">
        <input type="hidden" name="donGiaHidden" value="'.$sp->donGia.'" class="don-gia-hidden">
        <td>
          <div class="flex justify-center">
            <img height="100px" width="100px" src="uploads/sanpham/'.$sp->hinhAnh.'" alt="San pham" class="sanpham-img mx-auto">
          </div>
        </td>
        <td class="p-4 px-6 text-center">
          <div class="flex flex-col items-center justify-center">
          '. $sp->tenSP .'
          </div>
        </td>
        <td class="p-4 px-6 text-center whitespace-nowrap">
          <input
          type="number"
          min="1"
          name="itemQuantity[]"
          value="'.$productQuantity.'"
          class="upCart number-product w-12 text-center bg-gray-100 outline-none"
          />
        </td>
        <td class="p-4 px-6 text-center whitespace-nowrap"><span class="product-qty">' . number_format($sp->donGia, 0, ',', '.') . '</td>
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

  public function details($hoaDonOff_id) {
    $chitiethdoff = $this->chitiethdoff->find($hoaDonOff_id);
    $hoadonoff = $this->hoadonoff->find($hoaDonOff_id);
    $order_d_by_id = DB::table('chitiethdoff')
    ->join('hoadonoff', 'chitiethdoff.hoaDonOff_id','=', 'hoadonoff.hoaDonOff_id')
    ->join('san_phams', 'chitiethdoff.sanPham_id','=', 'san_phams.sanPham_id')
    ->select('hoadonoff.*','chitiethdoff.*','san_phams.*')->where('chitiethdoff.hoaDonOff_id', $hoaDonOff_id)->get();
    // dd($order_d_by_id);
    return view('admin.hoadonoff.details', compact('chitiethdoff', 'hoadonoff', 'order_d_by_id'));
  }

  public function printDH($hoaDonOff_id) {
    $chitiethdoff = $this->chitiethdoff->find($hoaDonOff_id);
    $hoadonoff = $this->hoadonoff->find($hoaDonOff_id);
    $order_d_by_id = DB::table('chitiethdoff')
    ->join('hoadonoff', 'chitiethdoff.hoaDonOff_id','=', 'hoadonoff.hoaDonOff_id')
    ->join('san_phams', 'chitiethdoff.sanPham_id','=', 'san_phams.sanPham_id')
    ->select('hoadonoff.*','chitiethdoff.*','san_phams.*')->where('chitiethdoff.hoaDonOff_id', $hoaDonOff_id)->get();
    // dd($order_d_by_id);
    return view('admin.hoadonoff.printDH', compact('chitiethdoff', 'hoadonoff', 'order_d_by_id'));
  }

  public function delete($hoaDonOff_id) {
    try {
      $this->hoadonoff->find($hoaDonOff_id)->delete();
      return response()->json([
        'code' => 200,
        'message' => 'success'
      ], 200);

    } catch (\Exception $exception) {
      Log::error('Message: ' . $exception->getMessage() . ' --- Line : ' . $exception->getLine());
      return response()->json([
        'code' => 500,
        'message' => 'fail'
      ], 500);
    }
  }
}
