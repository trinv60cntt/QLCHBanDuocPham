<?php

namespace App\Components;

class NhanVienRecursive
{
	private $data;
	private $htmlSelectNhanVien = '';

	public function __construct($data)
	{
		$this->data = $data;
	}

	public  function NhanVienRecursive($nhanvien_id_fk, $nhanvien_id = 0, $text = '')
	{

    foreach ($this->data as $value) {
      if ($value['nhanvien_id'] != '' && $nhanvien_id_fk == $value['nhanvien_id']) {
        $this->htmlSelectNhanVien .= "<option selected value='" . $value['nhanvien_id'] . "'>" . $value['hotenNV'] . "</option>";
      } else {
        $this->htmlSelectNhanVien .= "<option value='" . $value['nhanvien_id'] . "'>" . $value['hotenNV'] . "</option>";
			}
    }
    return $this->htmlSelectNhanVien;
	}


}
