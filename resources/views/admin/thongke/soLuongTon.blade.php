@extends('layouts.admin')

@section('title')
    <title>Trang chủ</title>
@endsection

@section('css')
  <link rel="stylesheet" href="//code.jquery.com/ui/1.13.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
@endsection



@section('content')
<main class="h-full pb-16">
  <!-- Remove everything INSIDE this div to a really blank page -->
  <div class="container px-6 mx-auto py-4">
      <h4 class="mb-4 text-2xl text-center font-semibold text-gray-600 dark:text-gray-300">
        THỐNG KÊ SỐ LƯỢNG TỒN TỪNG SẢN PHẨM THEO TỪNG NGÀY/THÁNG/NĂM
      </h4>
      <hr class="mb-4">
      <form autocomplete="off">
        @csrf
        <div class="option-statistical flex items-center justify-start">
          <div class="w-1/5 mr-3">
            <p>Sản phẩm
              <select name="sanPham_id"
                  class="select-product w-full bg-gray-50 border-1 border-black text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block px-3 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-purple-300 form-select">
                  <option value="null">Chọn tất cả</option>
                  {!! $htmlOptionSanPham !!}
              </select>
            </p>
          </div>
          <div class="w-1/5 mr-3">
          <p>Số lượng
            <select name="danhMuc_id"
            class="dashboard-filter w-full bg-gray-50 border-1 border-black text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block px-3 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-purple-300 form-select">
              <option value="null">--Chọn Số lượng--</option>
              <option value="5">5</option>
              <option value="10">10</option>
              <option value="15">15</option>
              <option value="20">20</option>
            </select>
          </p>
          </div>
          <input type="button" id="btn-dashboard-filter" value="Thống kê" class="btn-statistical mt-5 px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple" >
        </div>
      </div>

      </form>
      <hr class="mt-4">
      <p class="alert-error mt-5 text-2xl hidden">Không có dữ liệu.</p>
      <div class="wrap-chart mt-4 hidden">
        <canvas id="myChart" style="width:100%;max-width:1100px" class="m-auto"></canvas>
      </div>

      <div class="table-details hidden">
        <hr class="mt-7">
        <div id="parentDiv" class="tblThongKe">
          <h4 class="my-4 text-2xl text-center font-semibold text-gray-600 dark:text-gray-300">
            DỮ LIỆU CHI TIẾT BIỂU ĐỒ DOANH THU
          </h4>
          <div class="w-full mt-4 overflow-hidden rounded-lg shadow-xs">
            <div class="w-full overflow-x-auto">
          <table class="w-full">
            <thead>
              <tr
              class="text-xs font-semibold tracking-wide uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800 text-center">
                <th class="px-4 py-3 font-bold">STT</th>
                <th class="px-4 py-3 font-bold">Tên sản phẩm</th>
                <th class="px-4 py-3 font-bold whitespace-nowrap">Số lượng tồn</th>
              </tr>
            </thead>
            <tbody class="wrap-table bg-white divide-y dark:divide-gray-700 dark:bg-gray-800 text-center">
            </tbody>
          </table>
        </div>
      </div>
      </div>
    </div>
    <div class="wrap-btn hidden">
      <div class="mt-8 flex justify-center items-center">
        <a id="printPDF"
         class="cursor-pointer px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
          In báo cáo
        </a>
          &nbsp;|&nbsp;
        <a id="btnExport"
        class="cursor-pointer px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
          Xuất excel
        </a>
      </div>
    </div>
  </div>
</main>
@endsection

@section('js')
<script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
  <script type="text/javascript">
    $(document).ready(function(){

      $('#btn-dashboard-filter').click(function() {
        var _token = $('input[name="_token"]').val();

        var product_id = $('.select-product').val();
        var dashboard_value = $('.dashboard-filter').val();

        $.ajax({
          url: "{{ url('admin/thongkes/qty-filter-by-date') }}",
          method: 'POST',
          dataType: 'json',
          data: {dashboard_value: dashboard_value, _token: _token, product_id: product_id},
          beforeSend: () => {
            $('.wrap-chart').addClass('hidden')
            $('.table-details').addClass('hidden')
          },
          success: function (data) {
            console.log(data);
            if (data.length === 0) {
              $('.alert-error').removeClass('hidden');
            } else {
            $('.alert-error').addClass('hidden');
            $('.wrap-chart').removeClass('hidden')
            $('.table-details').removeClass('hidden')
            $('.wrap-btn').removeClass('hidden')

            var html ="";
            let allQtyTon = 0;
            for(var i = 0; i < data.length; i++) {

              allQtyTon += data[i].qtyTon;
              html += "<tr class='text-gray-700 dark:text-gray-400'><td class='px-4 py-3 text-sm whitespace-nowrap'>" + i + "</td><td class='px-4 py-3 text-sm'>" + data[i].product + "</td><td class='px-4 py-3 text-sm whitespace-nowrap'>" + data[i].qtyTon + "</td></tr>";
            }
            $(".wrap-table").html(html);
            var total = "<tr class='text-gray-700 dark:text-gray-400'><td class='px-4 py-3 text-sm whitespace-nowrap text-center font-bold' colspan='2'>Tổng cộng</td><td class='px-4 py-3 text-sm whitespace-nowrap'>" + allQtyTon + "</td></tr>";
            $(".wrap-table").append(total);

            let product = [];
            let qtyTon = [];
            for(var i = 0; i < data.length; i++) {
              product.push(data[i]['product']);
              qtyTon.push(data[i]['qtyTon']);
            }
            var xValues = product;
            var yValues = qtyTon;
            var barColors = ['#FF6633', '#FFB399', '#FF33FF', '#FFFF99', '#00B3E6',
            '#E6B333', '#3366E6', '#999966', '#99FF99', '#B34D4D',
            '#80B300', '#809900', '#E6B3B3', '#6680B3', '#66991A',
            '#FF99E6', '#CCFF1A', '#FF1A66', '#E6331A', '#33FFCC',
            '#66994D', '#B366CC', '#4D8000', '#B33300', '#CC80CC',
            '#66664D', '#991AFF', '#E666FF', '#4DB3FF', '#1AB399',
            '#E666B3', '#33991A', '#CC9999', '#B3B31A', '#00E680',
            '#4D8066', '#809980', '#E6FF80', '#1AFF33', '#999933',
            '#FF3380', '#CCCC00', '#66E64D', '#4D80CC', '#9900B3',
            '#E64D66', '#4DB380', '#FF4D4D', '#99E6E6', '#6666FF'];

            var chart = new Chart("myChart", {
              type: "bar",
              data: {
                labels: xValues,
                datasets: [{
                  backgroundColor: barColors,
                  data: yValues
                }]
              },
              options: {
                legend: {display: false},
                title: {
                  display: true,
                  text: "BIỂU ĐỒ SỐ LƯỢNG TỒN",
                  fontSize: 30
                }
              }
            });
            }
          }
        });
      })
    });
  </script>
    <script>
      $(document).ready(function(){
        $('.select-product').on('change', function() {
          if($('.select-product').val() != "null") {
            $(".dashboard-filter").val($("select option:first").val());
            document.querySelector('.dashboard-filter').style.pointerEvents = 'none';
          }
          else {
            document.querySelector('.dashboard-filter').style.pointerEvents = 'auto';
          }
        })
      });
    </script>
  <script src="admins/hoadon/html2pdf.bundle.min.js"></script>
  <script src="admins/thongke/jquery.table2excel.js" type="text/javascript"></script>
  <script>
    $("#printPDF").click(function() {
        var element = document.getElementById('parentDiv');
        console.log(element);
        html2pdf().from(element).set({
            margin: [30, 10, 5, 10],
            pagebreak: {
                avoid: 'tr'
            },
            filename: 'ThongKeSoLuongTonSP' + '.pdf',
            jsPDF: {
                orientation: 'landscape',
                unit: 'pt',
                format: 'letter',
                compressPDF: true
            }
        }).save()
    });
  </script>
   <script type="text/javascript">
    $(function () {
      $("#btnExport").click(function () {
        $(".tblThongKe").table2excel({
          filename: "ThongKeSoLuongTonSP.xls",
        });
      });
    });
  </script>
@endsection
