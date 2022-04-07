<?php

namespace App\Http\Controllers;


use App\Models\NhaSanXuat;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class NhaSanXuatController extends Controller
{
  private $nhasanxuat;

  public function __construct(NhaSanXuat $nhasanxuat)
  {
    $this->nhasanxuat = $nhasanxuat;
  }

  public function create()
  {
    return view('admin.nhasanxuat.add');
  }

  public function index()
  {
    $nhasanxuats = $this->nhasanxuat->paginate(5);
    return view('admin.nhasanxuat.index', compact('nhasanxuats'));
  }

  public function store(Request $request)
  {
    $this->nhasanxuat->create([
      'tenNSX' => $request->tenNSX,
      'nuocSX' => $request->nuocSX,
    ]);

    return redirect()->route('nhasanxuats.index');
  }

  public function edit($NSX_id, Request $request)
  {
    $nhasanxuat = $this->nhasanxuat->find($NSX_id);
    return view('admin.nhasanxuat.edit', compact('nhasanxuat'));
  }

  public function update($NSX_id, Request $request)
  {
    $this->nhasanxuat->find($NSX_id)->update([
      'tenNSX' => $request->tenNSX,
      'nuocSX' => $request->nuocSX,
    ]);
    return redirect()->route('nhasanxuats.index');
  }

  public function delete($NSX_id)
  {
    // return $this->deleteModelTrait($id, $this->category);
    $this->nhasanxuat->find($NSX_id)->delete();
    return redirect()->route('nhasanxuats.index');
  }
}
