<?php

namespace App\Components;

class SanPhamRecursive
{
	private $data;
	private $htmlSelectSanPham = '';

	public function __construct($data)
	{
		$this->data = $data;
	}

	public  function SanPhamRecursive($sanPham_id_fk, $sanPham_id = 0, $text = '')
	{

    foreach ($this->data as $value) {
      if ($value['sanPham_id'] != '' && $sanPham_id_fk == $value['sanPham_id']) {
        $this->htmlSelectSanPham .= "<option selected value='" . $value['sanPham_id'] . "'>" . $value['tenSP'] . "</option>";
      } else {
        $this->htmlSelectSanPham .= "<option value='" . $value['sanPham_id'] . "'>" . $value['tenSP'] . "</option>";
			}
    }
    return $this->htmlSelectSanPham;
	}


}
