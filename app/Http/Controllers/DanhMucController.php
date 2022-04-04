<?php

namespace App\Http\Controllers;
use App\Models\DanhMuc;
use Illuminate\Http\Request;
use App\Components\Recursive;

class DanhMucController extends Controller
{
  private $danhmuc;
  public function __construct(DanhMuc $danhmuc)
  {
    $this->danhmuc = $danhmuc;
  }

  public function create()
  {
    $htmlOption = $this->getDanhMuc($danhMucChaId = '');
    return view('danhmuc.add', compact('htmlOption'));
  }

  public function index()
  {
    $danhmucs = $this->danhmuc->paginate(5);
    return view('danhmuc.index', compact('danhmucs'));
  }

  public function store(Request $request)
  {
    $this->danhmuc->create([
        'tenDM' => $request->tenDM,
        'danhMucCha_id' => $request->danhMucCha_id
    ]);

    return redirect()->route('danhmucs.index');
  }

  public function getDanhMuc($danhMucChaId)
  {
    $data = $this->danhmuc->all();
    $recursive = new Recursive($data);
    $htmlOption = $recursive->danhMucRecursive($danhMucChaId);
    return $htmlOption;
  }

  public function edit($danhMuc_id, Request $request)
  {
    $danhmuc = $this->danhmuc->find($danhMuc_id);
    $htmlOption = $this->getDanhMuc($danhmuc->danhMucCha_id);
    return view('danhmuc.edit', compact('danhmuc', 'htmlOption'));
  }

  public function update($danhMuc_id, Request $request)
  {
    $this->danhmuc->find($danhMuc_id)->update([
        'tenDM' => $request->tenDM,
        'danhMucCha_id' => $request->danhMucCha_id,
    ]);
    return redirect()->route('danhmucs.index');
  }

  public function delete($danhMuc_id)
  {
    $this->danhmuc->find($danhMuc_id)->delete();
    return redirect()->route('danhmucs.index');
    // return $this->deleteModelTrait($id, $this->category);
  }
}
