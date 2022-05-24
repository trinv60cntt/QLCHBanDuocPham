<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SanPhamsAddRequest extends FormRequest
{
	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		return true;
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
			'tenSP' => 'bail|unique:san_phams',
		];
	}

	public function messages()
	{
		return [
			'tenSP.unique' => 'Tên sản phẩm này đã tồn tại',
		];
	}
}
