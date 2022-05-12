<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\VaiTro;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use App\Traits\StorageImageTrait;

class AdminVaiTroController extends Controller
{
  use StorageImageTrait;

  public function __construct(
    VaiTro $vaitro
  ) {
    $this->vaitro = $vaitro;
  }

  public function index()
  {
    $vaitros = $this->vaitro->latest()->paginate(5);
    return view('admin.vaitro.index', compact('vaitros'));
  }

  public function create()
  {
    return view('admin.vaitro.add');
  }

  public function store(Request $request)
  {
    try {
      DB::beginTransaction();
      $dataProductCreate = [
        'tenVT' => $request->tenVT,
        'moTa' => $request->moTa,
      ];
      
      $vaitro = $this->vaitro->create($dataProductCreate);

      DB::commit();
      return redirect()->route('vaitros.index');
    } catch (\Exception $exception) {
      DB::rollBack();
      Log::error('Message: ' . $exception->getMessage() . ' --- Line : ' . $exception->getLine());
    }
  }

}
