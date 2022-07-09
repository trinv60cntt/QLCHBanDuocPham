@extends('layouts.admin')

@section('title')
    <title>Trang chủ</title>
@endsection

@section('js')
    <script src="vendors/sweetAlert2/sweetalert2@11.js"></script>
    <script src="admins/hoadon/index.js"></script>
@endsection

@section('content')
    <main class="h-full pb-16 overflow-y-auto">
        <!-- Remove everything INSIDE this div to a really blank page -->
        <div class="container px-6 mx-auto py-4">
            <h4 class="mb-4 text-2xl text-center font-semibold text-gray-600 dark:text-gray-300">
                DANH SÁCH ĐƠN ĐẶT HÀNG TẠI QUẦY
            </h4>
            <a href="{{ route('hoadonoffline.create') }}"
            class="px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
            Thêm mới
            </a>
            <form action="{{ route('hoadonoffline.index') }}" method="get">
                <table style="margin: auto; width:350px;">
                    <tbody>

                    <tr>
                        <td class="text-gray-500"><b>Ngày lập: </b></td>
                        <td><input type="date" name="ngayLap" class="w-4/5 px-3 text-sm text-gray-700 border-1 border-black rounded-md dark:placeholder-gray-500 dark:focus:shadow-outline-gray dark:focus:placeholder-gray-600 dark:bg-gray-700 dark:text-gray-200 focus:placeholder-gray-500 focus:bg-white focus:border-purple-300 focus:outline-none focus:shadow-outline-purple form-input" value=""></td>
                    </tr>

                    <tr>
                        <td class="text-gray-500"><b>Thu ngân: </b></td>
                        <td class="pt-3">
                            <select name="nhanvien_id" class="form-select border-1 border-solid border-black w-4/5">
                                <option value=''>--- Chọn tất cả ---</option>
                                {!! $htmlOptionNhanVien !!}
                            </select>
                        </td>
                    </tr>

                    <tr>
                        <td colspan="2" align="center" style="padding-left: 30px;padding-top: 10px;">
                            <input type="submit" value="Tìm kiếm" class="px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple" name="searchBtn">
                            <a href="{{ route('hoadonoffline.index') }}" class="px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">Làm mới</a>
                        </td>
                    </tr>
                </tbody>
            </table>
            </form>
            <div class="w-full mt-4 overflow-hidden rounded-lg shadow-xs">
                <div class="w-full overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr
                                class="text-xs font-semibold tracking-wide text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800 text-center">
                                <th class="px-4 py-3">STT</th>
                                <th class="px-4 py-3">Số hóa đơn</th>
                                <th class="px-4 py-3">Tổng tiền</th>
                                <th class="px-4 py-3">Ngày lập</th>
                                <th class="px-4 py-3">Thu ngân</th>
                                <th class="px-4 py-3 text-left">Chức năng</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800 text-center">
                            @foreach ($hoadonoffs as $hoadonoff)
                                <tr class="text-gray-700 dark:text-gray-400">
                                    <td class="px-4 py-3 text-sm whitespace-nowrap">
                                        {{ $loop->index + 1 }}
                                    </td>
                                    <td class="px-4 py-3 text-sm">
                                        {{ $hoadonoff->hoaDonOff_id }}
                                    </td>
                                    <td class="px-4 py-3 text-sm whitespace-nowrap">
                                      {{ $hoadonoff->tongTien }}
                                    </td>
                                    <td class="px-4 py-3 text-sm whitespace-nowrap">
                                        {{ date('d/m/Y', strtotime($hoadonoff->ngayLap)) }}
                                    </td>
                                    <td class="px-4 py-3 text-sm whitespace-nowrap">
                                        {{ $hoadonoff->hotenNV }}
                                    </td>

                                    <td class="px-4 py-3 whitespace-nowrap">
                                        <div class="flex items-center text-sm">
                                            <a href="{{ route('hoadonoffline.edit', ['hoaDonOff_id' => $hoadonoff->hoaDonOff_id]) }}"><i class='fa fa-edit text-purple-600'></i></a>&nbsp;|&nbsp;
                                            <a href="{{ route('hoadonoffline.details', ['hoaDonOff_id' => $hoadonoff->hoaDonOff_id]) }}"><i class='fa fa-info-circle text-purple-600'></i></a>&nbsp;|&nbsp;
                                            <a href="#" data-url="{{ route('hoadonoffline.delete', ['hoaDonOff_id' => $hoadonoff->hoaDonOff_id]) }}" class="js-action-delete"><i class='fa fa-trash text-purple-600'></i></a>&nbsp;|&nbsp;
                                            <a href="#"><i class='fa fa-print text-purple-600'></i></a>
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
                        {{ $hoadonoffs->appends(['search' => Request::get('page')])->withQueryString()->links() }}
                    </span>
                </div>
            </div>
        </div>
    </main>
@endsection
