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

	public  function NhanVienRecursive($nhanvien_id_fk, $id = 0, $text = '')
	{

    foreach ($this->data as $value) {
      if ($value['id'] != '' && $nhanvien_id_fk == $value['id']) {
        $this->htmlSelectNhanVien .= "<option selected value='" . $value['id'] . "'>" . $value['hotenNV'] . "</option>";
      } else {
        $this->htmlSelectNhanVien .= "<option value='" . $value['id'] . "'>" . $value['hotenNV'] . "</option>";
			}
    }
    return $this->htmlSelectNhanVien;
	}


}
