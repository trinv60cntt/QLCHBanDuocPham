<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Components\Recursive;
use App\Components\NSXRecursive;
use App\Models\DanhMuc;
use App\Models\SanPham;
use App\Models\NhaSanXuat;
use App\Traits\StorageImageTrait;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class AdminSanPhamController extends Controller
{
  use StorageImageTrait;
  private $danhmuc;

  public function __construct(
    DanhMuc $danhmuc,
    SanPham $sanpham,
    NhaSanXuat $nhasanxuat
  ) {
    $this->danhmuc = $danhmuc;
    $this->sanpham = $sanpham;
    $this->nhasanxuat = $nhasanxuat;
  }

  public function index()
  {
    $sanphams = $this->sanpham->latest()->paginate(5);
    // foreach ($sanphams as $value) {
    //   dd($value['created_at']);
    // }
    return view('admin.sanpham.index', compact('sanphams'));
  }

  public function create()
  {
    $htmlOption = $this->getDanhMuc($danhMucChaId = '');
    $htmlOptionNSX = $this->getNSX($NSX_id_fk = '');
    // dd($htmlOptionNSX);
    // $data = $this->nhasanxuat->all();
    // foreach ($data as $value) {
    //   if ($value['NSX_id'] != '') {
    //     $this->htmlOptionNSX .= "<option>" . $value['tenNSX'] . "</option>";
    //   }
    // }
    // return $this->htmlOptionNSX;

    return view('admin.sanpham.add', compact('htmlOption', 'htmlOptionNSX'));
  }

  public function getDanhMuc($danhMucChaId)
  {
    $data = $this->danhmuc->all();
    $recursive = new Recursive($data);
    $htmlOption = $recursive->danhMucRecursive($danhMucChaId);
    return $htmlOption;
  }

  public function getNSX($NSX_id_fk)
  {
    $data = $this->nhasanxuat->all();
    $recursiveNSX = new NSXRecursive($data);
    $htmlOptionNSX = $recursiveNSX->NSXRecursive($NSX_id_fk);
    return $htmlOptionNSX;
  }

  public function store(Request $request)
  {
    try {
      DB::beginTransaction();
      $dataProductCreate = [
        'tenSP' => $request->tenSP,
        'donGia' => $request->donGia,
        'donViTinh' => $request->donViTinh,
        'congDung' => $request->congDung,
        'ngaySanXuat' => $request->ngaySanXuat,
        'hanSuDung' => $request->hanSuDung,
        'NSX_id' => $request->NSX_id,
        'danhMuc_id' => $request->danhMuc_id,
        'user_id' => auth()->id(),
      ];
      if ($request->banChay == 1) {
        $dataProductCreate['banChay'] = 1;
      }
      else {
        $dataProductCreate['banChay'] = 0;
      }
      $dataUploadFeatureImage = $this->storageTraitUpload($request, 'hinhAnh', 'sanpham');
      if (!empty($dataUploadFeatureImage)) {
        $dataProductCreate['hinhAnh'] = $dataUploadFeatureImage['file_name'];
      }
      $sanpham = $this->sanpham->create($dataProductCreate);

      DB::commit();
      return redirect()->route('sanphams.index');
    } catch (\Exception $exception) {
      DB::rollBack();
      Log::error('Message: ' . $exception->getMessage() . ' --- Line : ' . $exception->getLine());
    }
  }

  public function edit($sanPham_id) {
    $sanpham = $this->sanpham->find($sanPham_id);
    $htmlOption = $this->getDanhMuc($sanpham->danhMuc_id);
    $htmlOptionNSX = $this->getNSX($sanpham->NSX_id);
    return view('admin.sanpham.edit', compact('sanpham', 'htmlOption', 'htmlOptionNSX'));
  }

  public function update(Request $request, $sanPham_id) {
    try {
      DB::beginTransaction();
      $dataProductUpdate = [
        'tenSP' => $request->tenSP,
        'donGia' => $request->donGia,
        'donViTinh' => $request->donViTinh,
        'congDung' => $request->congDung,
        'ngaySanXuat' => $request->ngaySanXuat,
        'hanSuDung' => $request->hanSuDung,
        'NSX_id' => $request->NSX_id,
        'danhMuc_id' => $request->danhMuc_id,
        'user_id' => auth()->id(),
      ];
      if ($request->banChay == 1) {
        $dataProductUpdate['banChay'] = 1;
      }
      else {
        $dataProductUpdate['banChay'] = 0;
      }
      $dataUploadFeatureImage = $this->storageTraitUpload($request, 'hinhAnh', 'sanpham');
      if (!empty($dataUploadFeatureImage)) {
        $dataProductUpdate['hinhAnh'] = $dataUploadFeatureImage['file_name'];
      }
      $this->sanpham->find($sanPham_id)->update($dataProductUpdate);
      $sanpham = $this->sanpham->find($sanPham_id);

      DB::commit();
      return redirect()->route('sanphams.index');
    } catch (\Exception $exception) {
      DB::rollBack();
      Log::error('Message: ' . $exception->getMessage() . ' --- Line : ' . $exception->getLine());
    }
  }

  public function delete($sanPham_id) {
    try {
      $this->sanpham->find($sanPham_id)->delete();
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
