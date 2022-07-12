@extends('layouts.admin')

@section('title')
    <title>Cập nhật sản phẩm</title>
@endsection

@section('content')
    <main class="h-full pb-16">
        <!-- Remove everything INSIDE this div to a really blank page -->
        <div class="container px-6 mx-auto py-4">
            <div class="details" id="parentDiv">
              <img src="clientsAssets/img/logo.png" alt="Pharmacy Number 2" class="header-logo-custom mx-auto my-3">
                <hr>
                <div class="info-details py-4">
                    <div class="row flex flex-wrap">
                        <div class="col w-50p flex">
                            <input type="hidden" name="hoaDonOff_id" value={{ $chitiethdoff->hoaDonOff_id }} class="hoaDon-id-hidden">
                            <p><span class="font-bold">Số HĐ:</span> {{ $chitiethdoff->hoaDonOff_id }}</p>
                        </div>

                        <div class="col w-50p flex">
                            <p><span class="font-bold">Ngày lập:</span>
                                {{ date('d/m/Y', strtotime($hoadonoff->created_at)) }}</p>
                        </div>

                        <div class="col w-50p flex mt-1">
                            <p><span class="font-bold">Thu ngân:</span>
                            @if($hoadonoff->nhanvien_id === NULL)
                                Chưa có
                            @endif
                                {{ optional($hoadonoff->nhanvien)->hotenNV }}</p>
                        </div>

                        <div class="col w-50p flex mt-1">
                            <p><span class="font-bold">Ghi chú:</span> </p>
                        </div>

                    </div>

                </div>

                <div class="info-products">
                    <h4 class="title-products py-4">Danh sách sản phẩm</h4>
                    <hr>
                    <div class="w-full mt-4 overflow-hidden rounded-lg shadow-xs">
                      <div class="w-full overflow-x-auto">
                          <table class="w-full">
                              <thead>
                                  <tr
                                      class="text-xs font-semibold tracking-wide text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800 text-center">
                                      <th class="px-4 py-3">Hình ảnh</th>
                                      <th class="px-4 py-3">Tên sản phẩm</th>
                                      <th class="px-4 py-3">Số lượng</th>
                                      <th class="px-4 py-3">Đơn giá</th>
                                      <th class="px-4 py-3">Thành tiền</th>
                                  </tr>
                              </thead>
                              <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800 text-center">
                                  @foreach ($order_d_by_id as $v_order_d_by_id)

                                      <tr class="text-gray-700 dark:text-gray-400">
                                          <td class="px-4 py-3 text-sm whitespace-nowrap">
                                            <img height="100px" width="100px" src="uploads/sanpham/{{ $v_order_d_by_id->hinhAnh }}" alt="San pham"
                                            class="sanpham-img mx-auto">
                                          </td>
                                          <td class="px-4 py-3 text-sm name-product">
                                            {{ $v_order_d_by_id->tenSP }}
                                          </td>
                                          <td class="px-4 py-3 text-sm whitespace-nowrap">
                                            {{ $v_order_d_by_id->soLuong }}
                                          </td>
                                          <td class="px-4 py-3 text-sm whitespace-nowrap">
                                            {{ $v_order_d_by_id->soLuong }} x {{ number_format($v_order_d_by_id->donGia, 0, ',', '.') }}
                                          </td>
                                          <td class="px-4 py-3 text-sm whitespace-nowrap">
                                            <?php
                                              $total = $v_order_d_by_id->donGia * $v_order_d_by_id->soLuong;
                                              echo number_format($total, 0, ',', '.');
                                            ?>
                                          </td>
                                      </tr>
                                  @endforeach
                              </tbody>
                          </table>
                      </div>
                  </div>
                </div>

                <div class="py-4">
                  <hr>
                </div>

                <div class="details-total">
                  <p><span class="font-bold">Tổng tiền: </span> {{ number_format($v_order_d_by_id->tongTien, 0, ',', '.') }}đ</p>
                </div>
                <p class="font-bold text-center">Thank you & see you again!!!</p>
            </div>

            <div class="mt-6 text-center">
              <button id="printPDF"
              class="px-4 py-2 mr-5 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
              In hóa đơn
              </button>
                <a href="{{ route('hoadonoffline.index') }}"
                    class="px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                    Trở về
                </a>
            </div>
        </div>
    </main>
@endsection

@section('js')
    <script src="admins/hoadon/html2pdf.bundle.min.js"></script>
    <script>
      $("#printPDF").click(function() {
        console.log('abc');
          var element = document.getElementById('parentDiv');
          console.log(element);
          html2pdf().from(element).set({
              margin: [30, 10, 5, 10],
              pagebreak: {
                  avoid: 'tr'
              },
              filename: $('.hoaDon-id-hidden').val() + '.pdf',
              jsPDF: {
                  orientation: 'landscape',
                  unit: 'pt',
                  format: 'letter',
                  compressPDF: true
              }
          }).save()
      });
  </script>
@endsection
