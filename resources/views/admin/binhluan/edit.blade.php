@extends('layouts.admin')

@section('title')
    <title>Cập nhật sản phẩm</title>
@endsection

@section('css')
    <link rel="stylesheet" href="admins/hoadon/edit.css">
@endsection

@section('content')
    <main class="h-full pb-16">
        <!-- Remove everything INSIDE this div to a really blank page -->
        <div class="container px-6 mx-auto py-4">
            <form action="{{ route('hoadons.update') }}" method="post" enctype="multipart/form-data">
                @csrf
            <div class="details">
                <h2 class="title-details text-center py-4">TRẢ LỜI BÌNH LUẬN</h2>
                <hr>
                <div class="info-details-edit mx-auto py-4">
                    <div class="row">
                        <div class="mb-6 form-group flex items-center justify-around">
                            <label for="email" class="w-2p6 block mb-2 font-bold text-gray-900 dark:text-gray-300">Tên khách hàng:</label>
                            <input name="ten"
                                class="@error('hotenNV') error @enderror hotenNV w-4p6 px-3 text-sm text-gray-700 border-1 border-black rounded-md dark:placeholder-gray-500 dark:focus:shadow-outline-gray dark:focus:placeholder-gray-600 dark:bg-gray-700 dark:text-gray-200 focus:placeholder-gray-500 focus:bg-white focus:border-purple-300 focus:outline-none focus:shadow-outline-purple form-input"
                                value="{{ $binhluan->ten }}"
                                type="text"
                                readonly>
                            <div class="form-message text-red-600 mt-2"></div>
                        </div>
                        {{-- <div class="col w-full flex">
                            <p class="flex"><span class="font-bold">Số Hóa đơn:</span>
                                <input type="text" class="w-full px-3 text-sm text-gray-700 border-1 border-black rounded-md dark:placeholder-gray-500 dark:focus:shadow-outline-gray dark:focus:placeholder-gray-600 dark:bg-gray-700 dark:text-gray-200 focus:placeholder-gray-500 focus:bg-white focus:border-purple-300 focus:outline-none focus:shadow-outline-purple form-input" 
                                readonly value="">
                            </p>
                        </div> --}}

                        {{-- <div class="mb-6 form-group flex items-center justify-around">
                            <label for="email" class="w-2p6 block mb-2 font-bold text-gray-900 dark:text-gray-300 name-category">Tình trạng:</label>
                            <div class="radio-status w-4p6">
                                <div class="mr-5">
                                    <input type="radio" name="tinhTrang" id="" value="0" {{ $hoadon->tinhTrang == '0' ? 'checked' : '' }}> &nbsp;Đơn hủy
                                </div>
                                <div>
                                    <input type="radio" name="tinhTrang" id="" value="1" {{ $hoadon->tinhTrang == '1' ? 'checked' : '' }}> &nbsp;Chưa kiểm duyệt
                                </div>
                                <div>
                                    <input type="radio" name="tinhTrang" id="" value="2" {{ $hoadon->tinhTrang == '2' ? 'checked' : '' }}> &nbsp;Đã giao cho shipper
                                </div>
                                <div>
                                    <input type="radio" name="tinhTrang" id="" value="3" {{ $hoadon->tinhTrang == '3' ? 'checked' : '' }}> &nbsp;Đã giao hàng
                                </div>
                                <div>
                                    <input type="radio" name="tinhTrang" id="" value="4" {{ $hoadon->tinhTrang == '4' ? 'checked' : '' }}> &nbsp;Đã nhận tiền từ shipper
                                </div>
                            </div>
                        </div> --}}

                        {{-- <div class="mb-6 form-group flex items-center justify-around">
                            <label for="email" class="w-2p6 block mb-2 font-bold text-gray-900 dark:text-gray-300">Shipper:</label>
                            <select name="nhanvien_id"
                            class="w-4p6 bg-gray-50 border-1 border-black text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block px-3 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-purple-300 form-select">
                                <option value=''>Chưa có</option>
                                {!! $htmlOptionNhanVien !!}

                            </select>
                        </div> --}}
                    </div>
                    <div class="flex">
                        <div class="w-50p flex">
                            <button type="submit" class="px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                                Lưu
                              </button>
                        </div>
                        <div class="w-50p flex justify-end">
                            <a href="{{ route('binhluans.index') }}"
                                class="px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                                Quay lại
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            </form>
        </div>
    </main>
@endsection
