<?php

namespace App\Components;

class VaiTroRecursive
{
	private $data;
	private $htmlSelectVaiTro = '';

	public function __construct($data)
	{
		$this->data = $data;
	}

	public  function VaiTroRecursive($vaiTro_id_fk, $vaiTro_id = 0, $text = '')
	{

    foreach ($this->data as $value) {
      if ($value['vaiTro_id'] != '' && $vaiTro_id_fk == $value['vaiTro_id']) {
        $this->htmlSelectVaiTro .= "<option selected value='" . $value['vaiTro_id'] . "'>" . $value['moTa'] . "</option>";
      } else {
        $this->htmlSelectVaiTro .= "<option value='" . $value['vaiTro_id'] . "'>" . $value['moTa'] . "</option>";
			}
    }
    return $this->htmlSelectVaiTro;
	}


}
