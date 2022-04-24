@extends('layouts.clients')

@section('title')
  <title>Trang chủ</title>
@endsection

@section('content')
<section id="menu">
  <div style="text-align:center; font-size: 24px; font-weight:bold; margin-top:100px; height:300px; margin-bottom:300px;">
      <div class="container">
          <div class="row">
              <div class="col-lg-12 col-md-12 col-sm-12 contact-w3-agile2" data-aos="flip-left">
                  <h4 style="color:green; font-size:25px; text-align:center">GỬI ĐƠN ĐẶT HÀNG THÀNH CÔNG!</h4>
                  <h5 style="color:black; font-size:20px; text-align:center">Bạn vui lòng đợi ít phút, chúng mình sẽ nhanh chóng liên lạc với bạn để xác nhận đơn hàng.</h5>
                  <h5 style="color:black; font-size:20px; text-align:center">Chúc bạn một ngày tốt lành.</h5>
                  <div>
                      <img src="clientsAssets/img/plzwait.png" alt="" class="m-auto" style="height:auto;width:40%" />
                  </div>
                  <a href="{{ URL::to('/home') }}" class="lock w-full px-4 py-2 mt-4 text-sm font-medium leading-5 text-center text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">Trở về trang chủ</a>
              </div>
          </div>
          <div class="clearfix"></div>
      </div>
  </div>
</section>
@endsection

