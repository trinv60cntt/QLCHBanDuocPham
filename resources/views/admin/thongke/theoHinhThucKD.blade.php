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
          THỐNG KÊ DOANH THU THEO HÌNH THỨC KINH DOANH THEO TỪNG NGÀY/THÁNG/NĂM
      </h4>

      <form autocomplete="off">
        @csrf
        <div class="flex">
          <div class="w-25p mr-3">
            <p class="mb-2">Từ ngày <input type="text" id="datepicker" class="w-full px-3 text-sm text-gray-700 border-1 border-black rounded-md dark:placeholder-gray-500 dark:focus:shadow-outline-gray dark:focus:placeholder-gray-600 dark:bg-gray-700 dark:text-gray-200 focus:placeholder-gray-500 focus:bg-white focus:border-purple-300 focus:outline-none focus:shadow-outline-purple form-input" ></p> 
            <input type="button" id="btn-dashboard-filter" value="Thống kê" class="px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple" >
          </div>
          
          <div class="w-25p mr-3">
            <p>Đến ngày <input type="text" id="datepicker2" class="w-full px-3 text-sm text-gray-700 border-1 border-black rounded-md dark:placeholder-gray-500 dark:focus:shadow-outline-gray dark:focus:placeholder-gray-600 dark:bg-gray-700 dark:text-gray-200 focus:placeholder-gray-500 focus:bg-white focus:border-purple-300 focus:outline-none focus:shadow-outline-purple form-input" ></p> 
          </div>

          <div class="w-25p">
            <p>Lọc theo 
              <select name="danhMuc_id"
              class="dashboard-filter w-full bg-gray-50 border-1 border-black text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block px-3 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-purple-300 form-select">
                <option>--Chọn--</option>
                <option value="7ngay">7 ngày qua</option>
                <option value="thangtruoc">1 tháng trước</option>
                <option value="thangnay">Tháng hiện tại</option>
                <option value="1nam">1 năm qua</option>
              </select>
            </p> 
          </div>
        </div>
   
      </form>

      <div class="mt-4">
        <canvas id="myChart" style="width:100%;max-width:600px" class="m-auto"></canvas>
      </div>
  </div>
</main>
@endsection

@section('js')
  <script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
  <script type="text/javascript">
    $(document).ready(function(){
      // chart30daysorder();
      // GetChartData();
  

      $('.dashboard-filter').change(function() {
        var dashboard_value = $(this).val();
        var _token = $('input[name="_token"]').val();
        
        $.ajax({
          url: "{{ url('admin/thongkes/dashboard-filter') }}",
          method: 'POST',
          dataType: 'json',
          data: {dashboard_value: dashboard_value, _token: _token},
          success: function (data) {
            chart.setData(data);
          }
        });
      })

      $('#btn-dashboard-filter').click(function() {
        var _token = $('input[name="_token"]').val();

        var from_date = $('#datepicker').val();
        var to_date = $('#datepicker2').val();

        $.ajax({
          url: "{{ url('admin/thongkes/type-bussiness-filter-by-date') }}",
          method: 'POST',
          dataType: 'json',
          data: {from_date: from_date, to_date: to_date, _token: _token},
          success: function (data) {
            console.log(data);
            // chart.setData(data);
            var xValues = ["Doanh thu trực tuyến", "Doanh thu tại quầy"];
        var yValues = [data[0]['DoanhThuOnl'], data[0]['DoanhThuOff']];
        var barColors = [
          "#b91d47",
          "#00aba9",
          "#2b5797",
          "#e8c3b9",
          "#1e7145"
        ];

        var chart = new Chart("myChart", {
          type: "pie",
          data: {
            labels: xValues,
            datasets: [{
              backgroundColor: barColors,
              data: yValues
            }]
          },
          options: {
            title: {
              display: true,
              text: "BIỂU ĐỒ DOANH THU",
              fontSize: 30
            }
          }
        });
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
@endsection
