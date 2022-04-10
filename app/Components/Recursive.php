<?php

namespace App\Components;

class Recursive
{
	private $data;
	private $htmlSelect = '';

	public function __construct($data)
	{
		$this->data = $data;
	}

	public  function danhMucRecursive($danhMucChaId, $danhMuc_id = 0, $text = '')
	{
		// echo "<pre>";
		// var_dump($this->data);
		// echo "</pre>";
		// die();

		foreach ($this->data as $value) {
			if ($value['danhMucCha_id'] == $danhMuc_id) {
				if (!empty($danhMucChaId) && $danhMucChaId == $value['danhMuc_id']) {
					$this->htmlSelect .= "<option selected value='" . $value['danhMuc_id'] . "'>" . $text . $value['tenDM'] . "</option>";
				} else {
					$this->htmlSelect .= "<option value='" . $value['danhMuc_id'] . "'>" . $text . $value['tenDM'] . "</option>";
				}

				$this->danhMucRecursive($danhMucChaId, $value['danhMuc_id'], $text . '--');
			}
		}
		return $this->htmlSelect;
	}


}
