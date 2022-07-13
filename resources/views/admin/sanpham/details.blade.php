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
                    @include('success.notification')
                    <tbody><tr>
                        <td>
                            <table class="m-14 mt-5" cellpadding="2" cellspacing="10">
                                <tbody><tr>
                                    <td colspan="3">
                                        <h3 class="text-center mb-4"><b>THÔNG TIN CHI TIẾT</b></h3>
                                    </td>
                                </tr>
                                <tr>
                                    <td rowspan="10"><img src="uploads/sanpham/{{ $sanpham->hinhAnh }}" width="300" height="300" class="w-full mr-5"></td>
                                </tr>
                                <tr>
                                    <td class="whitespace-nowrap">Tên sản phẩm:</td>
                                    <td>{{ $sanpham->tenSP }}</td>
                                </tr>
                                <tr>
                                    <td>Số lượng tồn:</td>
                                    <td>{{ $sanpham->soLuongTon }}</td>
                                </tr>
                                <tr>
                                    <td>Giá nhập:</td>
                                    <td>{{ number_format($sanpham->giaNhap) }}</td>
                                </tr>
                                <tr>
                                    <td>Đơn giá:</td>
                                    <td>{{ number_format($sanpham->donGia) }}</td>
                                </tr>
                                <tr>
                                    <td>Công dụng:</td>
                                    <td style="max-width: 300px;">{{ $sanpham->congDung }}</td>
                                </tr>
                                <tr>
                                    <td class="whitespace-nowrap">Ngày sản xuất:</td>
                                    <td>{{ date('d/m/Y', strtotime($sanpham->ngaySanXuat)) }}</td>
                                </tr>
                                <tr>
                                    <td>Hạn sử dụng:</td>
                                    <td>{{ date('d/m/Y', strtotime($sanpham->hanSuDung)) }}</td>
                                </tr>
                                <tr>
                                  <td>Nhà sản xuất:</td>
                                  <td>{{ optional($sanpham->nhasanxuat)->tenNSX }}</td>
                                </tr>
                                <tr>
                                    <td>Danh mục:</td>
                                    <td>{{ optional($sanpham->danhmuc)->tenDM }}</td>
                                </tr>

                            </tbody></table>
                        </td>
                    </tr>
                </tbody></table>


            </div>

            <div class="mt-6 flex justify-center items-center">
              <a href="{{ route('sanphams.edit', ['sanPham_id' => $sanpham->sanPham_id]) }}"
                class="px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                Cập nhật
                </a>
                &nbsp;|&nbsp;
                <a href="{{ route('sanphams.index') }}"
                    class="px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                    Quay lại
                </a>
            </div>
        </div>
    </main>
@endsection
