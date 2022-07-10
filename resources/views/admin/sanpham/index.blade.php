@extends('layouts.admin')

@section('title')
    <title>Trang chủ</title>
@endsection

@section('css')
    <link rel="stylesheet" href="admins/sanpham/index.css">
@endsection

@section('js')
    <script src="vendors/sweetAlert2/sweetalert2@11.js"></script>
    <script src="admins/sanpham/index.js"></script>
    <script>
        $(document).ready(function() {
          $('.alert').fadeOut(5000);
        });
    </script>
@endsection

@section('content')
    <main class="h-full pb-16">
        <!-- Remove everything INSIDE this div to a really blank page -->
        <div class="container px-6 mx-auto py-4">
            <h4 class="mb-4 text-2xl text-center font-semibold text-gray-600 dark:text-gray-300">
                Danh sách sản phẩm
            </h4>
            <a href="{{ route('sanphams.create') }}"
                class="px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                Thêm sản phẩm
            </a>
            <form action="{{ route('sanphams.index') }}" method="get" class="mt-6 md:mt-0">
                <table style="margin: auto; width:350px;">
                    <tbody>

                    <tr>
                        <td class="text-gray-500"><b>Tên sản phẩm: </b></td>
                        <td><input type="text" name="tenSP" class="w-5/6 md:w-full px-3 text-sm text-gray-700 border-1 border-black rounded-md dark:placeholder-gray-500 dark:focus:shadow-outline-gray dark:focus:placeholder-gray-600 dark:bg-gray-700 dark:text-gray-200 focus:placeholder-gray-500 focus:bg-white focus:border-purple-300 focus:outline-none focus:shadow-outline-purple form-input" value=""></td>
                    </tr>

                    <tr>
                        <td class="text-gray-500"><b>Danh mục: </b></td>
                        <td class="pt-3">
                            <select name="danhMuc_id" class="form-select border-1 border-solid border-black w-full">
                                <option value=''>--- Chọn tất cả ---</option>
                                {!! $htmlOption !!}
                            </select>
                        </td>
                    </tr>

                    <tr>
                        <td colspan="2" align="center" class="pl-24 pt-3">
                            <input type="submit" value="Tìm kiếm" class="px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple" name="searchBtn">
                            <a href="{{ route('sanphams.index') }}" class="px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">Làm mới</a>
                        </td>
                    </tr>
                </tbody>
            </table>
            </form>
            @include('success.notification')
            <div class="w-full mt-4 overflow-hidden rounded-lg shadow-xs">
                <div class="w-full overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr
                                class="text-xs font-semibold tracking-wide text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800 text-center">
                                <th class="px-4 py-3">STT</th>
                                <th class="px-4 py-3">Hình ảnh</th>
                                <th class="px-4 py-3">Tên sản phẩm</th>
                                <th class="px-4 py-3">Số lượng tồn</th>
                                <th class="px-4 py-3">Giá</th>
                                <th class="px-4 py-3">Ngày thêm</th>
                                <th class="px-4 py-3">Bán chạy</th>
                                <th class="px-4 py-3">Danh mục</th>
                                <th class="px-4 py-3 text-left">Chức năng</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800 text-center">
                            @foreach ($sanphams as $sanpham)
                                <tr class="text-gray-700 dark:text-gray-400">
                                    <td class="px-4 py-3 text-sm whitespace-nowrap">
                                        {{ $loop->index + 1 }}
                                    </td>
                                    <td class="px-4 py-3 text-sm whitespace-nowrap">
                                        <img src="uploads/sanpham/{{ $sanpham->hinhAnh }}" alt="San pham"
                                            class="sanpham-img mx-auto">
                                    </td>
                                    <td class="px-4 py-3 text-sm">
                                        {{ $sanpham->tenSP }}
                                    </td>
                                    <td class="px-4 py-3 text-sm whitespace-nowrap">
                                        {{ number_format($sanpham->soLuong) }}
                                    </td>
                                    <td class="px-4 py-3 text-sm whitespace-nowrap">
                                        {{ number_format($sanpham->donGia) }}
                                    </td>
                                    <td class="px-4 py-3 text-sm whitespace-nowrap">
                                        {{-- {{ date('d/m/Y', $sanpham->created_at->timestamp) }} --}}
                                        {{ date('d/m/Y', strtotime($sanpham->created_at)) }}
                                    </td>
                                    <td class="px-4 py-3 text-sm whitespace-nowrap">
                                        {{ $sanpham->banChay == 1 ? 'X' : '' }}
                                    </td>
                                    <td class="px-4 py-3 text-sm whitespace-nowrap name-category">
                                        {{-- {{ optional($sanpham->danhmuc)->tenDM }} --}}
                                        {{ $sanpham->tenDM }}
                                    </td>
                                    <td class="px-4 py-3 whitespace-nowrap">
                                        <div class="flex items-center space-x-4 text-sm">
                                            <a href="{{ route('sanphams.edit', ['sanPham_id' => $sanpham->sanPham_id]) }}"
                                                class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray"
                                                aria-label="Edit">
                                                <svg class="w-5 h-5" aria-hidden="true" fill="currentColor"
                                                    viewBox="0 0 20 20">
                                                    <path
                                                        d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z">
                                                    </path>
                                                </svg>
                                            </a>
                                            <a href="#"
                                                data-url="{{ route('sanphams.delete', ['sanPham_id' => $sanpham->sanPham_id]) }}"
                                                class="js-action-delete flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray"
                                                aria-label="Delete">
                                                <svg class="w-5 h-5" aria-hidden="true" fill="currentColor"
                                                    viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd"
                                                        d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                                        clip-rule="evenodd"></path>
                                                </svg>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div
                    class="px-4 py-3 text-xs font-semibold tracking-wide text-gray-500 uppercase border-t dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">


                    {{-- <span class="flex items-center col-span-3">
                        Showing 21-30 of 100
                    </span>
                    <span class="col-span-2"></span> --}}
                    <!-- Pagination -->
                    <span class="flex col-span-4 mt-2 sm:mt-auto sm:justify-end">
                        {{ $sanphams->appends(['search' => Request::get('page')])->withQueryString()->links() }}
                    </span>
                </div>
            </div>
        </div>
    </main>
@endsection
