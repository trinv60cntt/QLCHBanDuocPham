<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\VaiTro;
use App\Models\Quyen;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use App\Traits\StorageImageTrait;

class AdminQuyenController extends Controller
{
  use StorageImageTrait;

  public function __construct(
    VaiTro $vaitro,
    Quyen $quyen
  ) {
    $this->vaitro = $vaitro;
    $this->quyen = $quyen;
  }

  // public function index()
  // {
  //   $vaitros = $this->vaitro->latest()->paginate(5);
  //   return view('admin.vaitro.index', compact('vaitros'));
  // }

  public function create()
  {
    return view('admin.quyen.add');
  }

  public function store(Request $request)
  {
    $quyen = Quyen::create([
      'tenQuyen' => $request->module_parent,
      'moTa' => $request->module_parent,
      'parent_id' => 0,
    ]);
    // dd($request->module_children);
    foreach ($request->module_children as $value) {
      // dd($value);
      Quyen::create([
        'tenQuyen' => $value,
        'moTa' => $value,
        'parent_id' => $quyen->quyen_id,
        'key_code' => $request->module_parent . '_' . $value
      ]);
    }
  }


}
