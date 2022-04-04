<?php

namespace App\Http\Controllers;


use App\Models\Lop;
use Illuminate\Http\Request;
use App\Components\Recusive;
use Illuminate\Support\Str;

class LopController extends Controller
{
    private $lop;
    public $incrementing = false;

    public function __construct(Lop $lop)
    {
        $this->lop = $lop;
    }

    public function create()
    {
        return view('lop.add');
    }

    public function index()
    {
        $lops = $this->lop->paginate(5);
        return view('lop.index', compact('lops'));
    }

    public function store(Request $request)
    {
        $this->lop->create([
            'MaLop' => $request->MaLop,
            'TenLop' => $request->TenLop,
        ]);

        return redirect()->route('lops.index');
    }

    public function edit($MaLop, Request $request)
    {
        $lop = $this->lop->find($MaLop);
        return view('lop.edit', compact('lop'));
    }

    public function update($MaLop, Request $request)
    {
        $this->lop->find($MaLop)->update([
            'MaLop' => $request->MaLop,
            'TenLop' => $request->TenLop,
        ]);
        return redirect()->route('lops.index');

    }

    public function delete($MaLop)
    {
        // return $this->deleteModelTrait($id, $this->category);
        $this->lop->find($MaLop)->delete();
        return redirect()->route('lops.index');
    }
}