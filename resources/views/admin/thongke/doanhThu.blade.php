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
          THỐNG KÊ TỔNG DOANH THU THEO TỪNG NGÀY/THÁNG/NĂM
      </h4>
      <hr class="mb-4">
      <form autocomplete="off">
        @csrf
        <div class="option-statistical flex items-center justify-start">
          <h2 class="font-bold text-xl mr-3 mt-4">Tùy chọn 1: </h2>
          <div class="w-1/5 mr-3">
            <p class="">Từ ngày <input type="text" id="datepicker" class="input-date w-full px-3 text-sm text-gray-700 border-1 border-black rounded-md dark:placeholder-gray-500 dark:focus:shadow-outline-gray dark:focus:placeholder-gray-600 dark:bg-gray-700 dark:text-gray-200 focus:placeholder-gray-500 focus:bg-white focus:border-purple-300 focus:outline-none focus:shadow-outline-purple form-input" ></p> 
          </div>
          
          <div class="w-1/5 mr-3">
            <p>Đến ngày <input type="text" id="datepicker2" class="input-date w-full px-3 text-sm text-gray-700 border-1 border-black rounded-md dark:placeholder-gray-500 dark:focus:shadow-outline-gray dark:focus:placeholder-gray-600 dark:bg-gray-700 dark:text-gray-200 focus:placeholder-gray-500 focus:bg-white focus:border-purple-300 focus:outline-none focus:shadow-outline-purple form-input" ></p> 
          </div>
          <input type="button" id="btn-dashboard-filter" value="Thống kê" disabled class="btn-statistical disabled mt-5 px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple" >
        </div>
        <div class="option-statistical flex items-center justify-start mt-2">
          <h2 class="font-bold text-xl mr-3 mt-4">Tùy chọn 2: </h2>
        <div class="w-1/5 mr-3">
          <p>Lọc nhanh 
            <select name="danhMuc_id"
            class="dashboard-filter w-full bg-gray-50 border-1 border-black text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block px-3 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-purple-300 form-select">
              <option value="null">--Chọn--</option>
              <option value="7ngay">7 ngày qua</option>
              <option value="thangtruoc">1 tháng trước</option>
              <option value="thangnay">Tháng hiện tại</option>
              <option value="1nam">1 năm qua</option>
            </select>
          </p> 
        </div>
        <input type="button" id="btn-quickly-filter" value="Thống kê" disabled class="btn-quickly-statistical disabled mt-5 px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple" >
        </div>
      </form>
      <hr class="mt-4">
      <p class="alert-error mt-5 text-2xl hidden">Không có dữ liệu.</p>
      <h2 class="font-bold text-gray-600 text-3xl title-line hidden mt-4 text-center">BIỂU ĐỒ DOANH THU</h2>
      <div id="chart" style="height: 250px;"></div>
      <div class="table-details hidden">
        <hr class="mt-7">
        <h4 class="my-4 text-2xl text-center font-semibold text-gray-600 dark:text-gray-300">
          DỮ LIỆU CHI TIẾT BIỂU ĐỒ DOANH THU
        </h4>
        <div class="w-full mt-4 overflow-hidden rounded-lg shadow-xs">
          <div class="w-full overflow-x-auto">
        <table class="w-full">
          <thead>
            <tr
            class="text-xs font-semibold tracking-wide text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800 text-center">
                  <th class="px-4 py-3">STT</th>
                  <th class="px-4 py-3">Ngày</th>
                  <th class="px-4 py-3 whitespace-nowrap">Doanh thu tại quầy</th>
                  <th class="px-4 py-3 whitespace-nowrap">Doanh thu trực tuyến</th>
                  <th class="px-4 py-3 whitespace-nowrap">Tổng doanh thu</th>
              </tr>
          </thead>
          <tbody class="wrap-table bg-white divide-y dark:divide-gray-700 dark:bg-gray-800 text-center">
          </tbody>
        </table>
      </div>
      </div>
    </div>
  </div>
</main>
@endsection

@section('js')
  <script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
  <script type="text/javascript">

  </script>
  <script type="text/javascript">
    $(document).ready(function(){
      // chart30daysorder();
      var chart = new Morris.Line({

      element: 'chart',
      // option chart
      lineColors: ['#819c79', '#0B62A4', '#ff6541', '#a4add3'],
      // lineColors: ['red', 'blue'],

      // Line
      pointFillColors: ['#fff'], // points
      pointStrokeColors: ['black'], // duong vien
      parseTime: false, // time error

      hideHover: 'auto',

      xkey: 'period',
      ykeys: ['order', 'sales', 'quantity'],

      labels: ['Tổng hóa đơn', 'Tổng doanh thu', 'Số lượng sản phẩm đã bán']
      });

      $('#btn-quickly-filter').click(function() {
        var dashboard_value = $('.dashboard-filter').val();
        var _token = $('input[name="_token"]').val();

        $.ajax({
          url: "{{ url('admin/thongkes/dashboard-filter') }}",
          method: 'POST',
          dataType: 'json',
          data: {dashboard_value: dashboard_value, _token: _token},
          beforeSend: () => {
            $('.title-line').addClass('hidden')
            $('.table-details').addClass('hidden')
          },
          success: function (data) {
            if (data.length === 0) {
              $('.alert-error').removeClass('hidden');
            } else {
            $('.alert-error').addClass('hidden');
            $('.title-line').removeClass('hidden')
            $('.table-details').removeClass('hidden')
            chart.setData(data);
            var html ="";
            for(var i = 0; i < data.length; i++) {
              var dtOff = (data[i].doanhThuOff).toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&.').replace(/\.00$/,'');
              var dtOnl = (data[i].doanhThuOnl).toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&.').replace(/\.00$/,'');
              var dtTotal = (data[i].sales).toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&.').replace(/\.00$/,'');
              var fmdate = formatDate(new Date(data[i].period));
              html += "<tr class='text-gray-700 dark:text-gray-400'><td class='px-4 py-3 text-sm whitespace-nowrap'>" + i + "</td><td class='px-4 py-3 text-sm'>" + fmdate + "</td><td class='px-4 py-3 text-sm whitespace-nowrap'>" + dtOff + "</td><td class='px-4 py-3 text-sm whitespace-nowrap'>" + dtOnl + "</td><td class='px-4 py-3 text-sm whitespace-nowrap'>" + dtTotal + "</td></tr>";
            }
            $(".wrap-table").html(html);
            }
          }
        });
      })

      function padTo2Digits(num) {
        return num.toString().padStart(2, '0');
      }

      function formatDate(date) {
        return [
          padTo2Digits(date.getDate()),
          padTo2Digits(date.getMonth() + 1),
          date.getFullYear(),
        ].join('/');
      }

      $('#btn-dashboard-filter').click(function() {
        var _token = $('input[name="_token"]').val();

        var from_date = $('#datepicker').val();
        var to_date = $('#datepicker2').val();

        $.ajax({
          url: "{{ url('admin/thongkes/filter-by-date') }}",
          method: 'POST',
          dataType: 'json',
          data: {from_date: from_date, to_date: to_date, _token: _token},
          beforeSend: () => {
            $('.title-line').addClass('hidden')
            $('.table-details').addClass('hidden')
          },
          success: function (data) {
            if (data.length === 0) {
              $('.alert-error').removeClass('hidden');
            } else {
            $('.alert-error').addClass('hidden');
            $('.title-line').removeClass('hidden')
            $('.table-details').removeClass('hidden')
            chart.setData(data);
            var html ="";
            for(var i = 0; i < data.length; i++) {
              var dtOff = (data[i].doanhThuOff).toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&.').replace(/\.00$/,'');
              var dtOnl = (data[i].doanhThuOnl).toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&.').replace(/\.00$/,'');
              var dtTotal = (data[i].sales).toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&.').replace(/\.00$/,'');
              var fmdate = formatDate(new Date(data[i].period));
              html += "<tr class='text-gray-700 dark:text-gray-400'><td class='px-4 py-3 text-sm whitespace-nowrap'>" + i + "</td><td class='px-4 py-3 text-sm'>" + fmdate + "</td><td class='px-4 py-3 text-sm whitespace-nowrap'>" + dtOff + "</td><td class='px-4 py-3 text-sm whitespace-nowrap'>" + dtOnl + "</td><td class='px-4 py-3 text-sm whitespace-nowrap'>" + dtTotal + "</td></tr>";
            }
            $(".wrap-table").html(html);
            }
          }
        });
      })
    });
  </script>
  <script type="text/javascript">
    $(document).ready(function(){
      $("#datepicker").datepicker({
        prevText: "Tháng trước",
        nextText: "Tháng sau",
        dateFormat: "yy-mm-dd",
        dayNamesMin: ["Thứ 2", "Thứ 3", "Thứ 4", "Thứ 5", "Thứ 6", "Thứ 7", "Chủ nhật"],
        duration: "slow"
      });
      $("#datepicker2").datepicker({
        prevText: "Tháng trước",
        nextText: "Tháng sau",
        dateFormat: "yy-mm-dd",
        dayNamesMin: ["Thứ 2", "Thứ 3", "Thứ 4", "Thứ 5", "Thứ 6", "Thứ 7", "Chủ nhật"],
        duration: "slow"
      });
    });
  </script>
  <script>
    $(document).ready(function(){
      $('.input-date').on('change', function() {
        if($('#datepicker').val() != '' && $('#datepicker2').val() != '') {
          $("#btn-dashboard-filter").prop('disabled', false);
          $(".btn-statistical").removeClass('disabled');
        }
        else {
          $("#btn-dashboard-filter").prop('disabled', true);
          $(".btn-statistical").addClass('disabled');
        }
      })

      $('.dashboard-filter').on('change', function() {
        if($('.dashboard-filter').val() != 'null') {
          $("#btn-quickly-filter").prop('disabled', false);
          $(".btn-quickly-statistical").removeClass('disabled');
        }
        else {
          $("#btn-quickly-filter").prop('disabled', true);
          $(".btn-quickly-statistical").addClass('disabled');
        }
      })
    });
  </script>
@endsection
