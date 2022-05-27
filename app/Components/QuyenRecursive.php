<?php

namespace App\Components;

class QuyenRecursive
{
	private $data;
	private $htmlSelect = '';

	public function __construct($data)
	{
		$this->data = $data;
	}

	public  function quyenRecursive($parent_id, $quyen_id = 0, $text = '')
	{
		foreach ($this->data as $value) {
			if ($value['parent_id'] == $quyen_id) {
				if (!empty($parent_id) && $parent_id == $value['quyen_id']) {
					$this->htmlSelect .= "<option selected value='" . $value['quyen_id'] . "'>" . $text . $value['moTa'] . "</option>";
				} else {
					$this->htmlSelect .= "<option value='" . $value['quyen_id'] . "'>" . $text . $value['moTa'] . "</option>";
				}

				$this->quyenRecursive($parent_id, $value['quyen_id'], $text . '--');
			}
		}
		return $this->htmlSelect;
	}
}
