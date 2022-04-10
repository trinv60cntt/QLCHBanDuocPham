<?php

namespace App\Components;

class NSXRecursive
{
	private $data;
	private $htmlSelectNSX = '';

	public function __construct($data)
	{
		$this->data = $data;
	}

	public  function NSXRecursive($NSX_id_fk, $NSX_id = 0, $text = '')
	{
		// echo "<pre>";
		// var_dump($this->data);
		// echo "</pre>";
		// die();

    foreach ($this->data as $value) {
      if ($value['NSX_id'] != '' && $NSX_id_fk == $value['NSX_id']) {
        $this->htmlSelectNSX .= "<option selected value='" . $value['NSX_id'] . "'>" . $value['tenNSX'] . "</option>";
      } else {
        $this->htmlSelectNSX .= "<option value='" . $value['NSX_id'] . "'>" . $value['tenNSX'] . "</option>";
			}
    }
    return $this->htmlSelectNSX;
	}


}
