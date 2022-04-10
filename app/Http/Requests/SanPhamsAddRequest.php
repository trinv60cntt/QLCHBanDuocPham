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
			'tenSP' => 'bail|required|unique:san_phams|max:255|min:10',
			'donGia' => 'required',
			'donViTinh' => 'required',
			'hinhAnh' => 'required',
			'congDung' => 'required',
			'ngaySanXuat' => 'required',
			'hanSuDung' => 'required',
		];
	}

	public function messages()
	{
		return [
			'tenSP.required' => 'Tên sản phẩm không được phép để trống',
			'tenSP.unique' => 'Tên sản phẩm này đã tồn tại',
			'tenSP.max' => 'Tên sản phẩm không được phép quá 255 kí tự',
			'tenSP.min' => 'Tên sản phẩm phải lớn hơn 10 kí tự',
			'donGia.required' => 'Giá sản phẩm không được phép để trống',
			'donViTinh.required' => 'Đơn vị tính không được phép để trống',
			'hinhAnh.required' => 'Vui lòng chọn ảnh sản phẩm',
			'congDung.required' => 'Công dụng không được phép để trống',
			'ngaySanXuat.required' => 'Ngày sản xuất không được phép để trống',
			'hanSuDung.required' => 'Hạn sử dụng không được phép để trống',
		];
	}
}
