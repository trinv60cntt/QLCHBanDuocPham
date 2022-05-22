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
                DANH SÁCH ĐƠN ĐẶT HÀNG TRỰC TUYẾN
            </h4>
      
            <div class="w-full mt-4 overflow-hidden rounded-lg shadow-xs">
                <div class="w-full overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr
                                class="text-xs font-semibold tracking-wide text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800 text-center">
                                <th class="px-4 py-3">STT</th>
                                <th class="px-4 py-3">Họ tên</th>
                                <th class="px-4 py-3">Tổng tiền</th>
                                <th class="px-4 py-3">Ngày mua</th>
                                <th class="px-4 py-3">Tình trạng</th>
                                <th class="px-4 py-3">Shipper</th>
                                <th class="px-4 py-3 text-left">Chức năng</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800 text-center">
                            @foreach ($hoadons as $hoadon)
                                <tr class="text-gray-700 dark:text-gray-400">
                                    <td class="px-4 py-3 text-sm whitespace-nowrap">
                                        {{ $loop->index + 1 }}
                                    </td>
                                    <td class="px-4 py-3 text-sm">
                                        {{ $hoadon->hoTenKH }}
                                    </td>
                                    <td class="px-4 py-3 text-sm whitespace-nowrap">
                                      {{ $hoadon->tongTien }}
                                    </td>
                                    <td class="px-4 py-3 text-sm whitespace-nowrap">
                                        {{ date('d/m/Y', strtotime($hoadon->created_at)) }}
                                    </td>
                                    <td class="px-4 py-3 text-sm whitespace-nowrap">
                                    <?php
                                    switch ($hoadon->tinhTrang)
                                    {
                                        case 1:
                                            echo 'Đơn chờ kiểm';
                                            break;
                                        case 2:
                                            echo 'Đã giao cho shipper';
                                            break;
                                        case 3:
                                            echo 'Đã giao hàng';
                                            break;
                                        case 4:
                                            echo 'Đã nhận tiền từ shipper';
                                        break;
                                        default:
                                            echo 'Đơn hủy';
                                        break;
                                    }
                                    ?>
                                    </td>
                                    <td class="px-4 py-3 text-sm whitespace-nowrap">
                                        @if($hoadon->nhanvien_id === NULL)
                                            Chưa có
                                        @endif
                                            {{ optional($hoadon->nhanvien)->hotenNV }}
                                    </td>

                                    <td class="px-4 py-3 whitespace-nowrap">
                                        <div class="flex items-center text-sm">
                                            <a href="{{ route('hoadons.edit', ['hoaDon_id' => $hoadon->hoaDon_id]) }}"><i class='fa fa-edit text-purple-600'></i></a>&nbsp;|&nbsp;
                                            <a href="{{ route('hoadons.details', ['hoaDon_id' => $hoadon->hoaDon_id]) }}"><i class='fa fa-info-circle text-purple-600'></i></a>&nbsp;|&nbsp;
                                            <a href="#" data-url="{{ route('hoadons.delete', ['hoaDon_id' => $hoadon->hoaDon_id]) }}" class="js-action-delete"><i class='fa fa-trash text-purple-600'></i></a>&nbsp;|&nbsp;
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
                        {{ $hoadons->links() }}

                    </span>
                </div>
            </div>
        </div>
    </main>
@endsection
