@extends('layouts.admin')

@section('title')
    <title>Cập nhật sản phẩm</title>
@endsection

@section('content')
    <main class="h-full pb-16">
        <!-- Remove everything INSIDE this div to a really blank page -->
        <div class="container px-6 mx-auto py-4">
            {{-- @php dd($nhanvien) @endphp --}}
                <table class="details details-table mx-auto mt-2" cellpadding="0" cellspacing="0">
                    <tbody><tr>
                        <td>
                            <table class="m-14 mt-5" cellpadding="2" cellspacing="10">
                                <tbody><tr>
                                    <td colspan="3">
                                        <h3 class="text-center mb-4"><b>THÔNG TIN CHI TIẾT</b></h3>
                                    </td>
                                </tr>
                                <tr>
                                    <td rowspan="8"><img src="storage/khachhang/{{ $khachhang->hinhAnh }}" width="300" height="300" class="mr-5"></td>
                                </tr>
                                <tr>
                                    <td>Họ tên khách hàng:</td>
                                    <td>{{ $khachhang->hoKH }} {{ $khachhang->tenKH }}</td>
                                </tr>
                      
                                <tr>
                                    <td>Giới tính:</td>
                                    <td>{{ $khachhang->gioiTinh == 1 ? 'Nam' : 'Nữ' }}</td>
                                </tr>
                                <tr>
                                    <td>Ngày sinh:</td>
                                    <td>{{ str_replace('-', '/', date('d-m-Y', strtotime($khachhang->ngaySinh))) }}</td>
                                </tr>
                                <tr>
                                    <td>Địa chỉ:</td>
                                    <td>{{ $khachhang->diaChi }}</td>
                                </tr>
                                <tr>
                                    <td>Email:</td>
                                    <td>{{ $khachhang->email }}</td>
                                </tr>
                                <tr>
                                    <td>Số điện thoại:</td>
                                    <td>{{ $khachhang->sdt }}</td>
                                </tr>
                
                            </tbody></table>
                        </td>
                    </tr>
                </tbody></table>
  

            </div>

            <div class="mt-6 flex justify-center items-center">
                <a href="{{ route('khachhangs.edit', ['khachhang_id' => $khachhang->khachhang_id]) }}"
                class="px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                Cập nhật
                </a>
                &nbsp;|&nbsp;
                <a href="{{ route('khachhangs.index') }}"
                    class="px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                    Quay lại
                </a>
            </div>
        </div>
    </main>
@endsection
