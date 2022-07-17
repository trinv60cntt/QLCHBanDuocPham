@extends('layouts.clients')

@section('title')
  <title>Trang chủ</title>
@endsection

@section('js')
    <script src="clients/detailsSanPham/details.js"></script>
    <script type="text/javascript">
      $('.js-news-control').on('click', (e) => {
        const $target = $(e.currentTarget)
        console.log($target);
        const $parent = $target.parents('.news-item')
        const $content = $parent.find('.news-content')
        $content.slideToggle('medium', function() {
          if ($(this).is(':visible'))
              $(this).css('display','flex');
        });
        if ($parent.hasClass('is-collapse')) {
          $parent.removeClass('is-collapse')
        } else {
          $parent.addClass('is-collapse')
        }
      })

    </script>
@endsection

@section('content')
  <section class="module mod-menu pb-12">
    <div class="testimonial">
      <img src="assets/img/banner-1.png" alt="banner 1" class="w-full">
    </div>
    <img src="/assets/img/xit-khoang.png" alt="ion muoi" class="mx-auto p-4">
   <div class="p-4">
    5 lưu ý quan trọng để sử dụng xịt khoáng đúng cách
    Nếu bạn ngồi trong phòng sử dụng điều hòa tần suất lớn thì dùng xịt khoáng 2 lần/ngày, nhất là khi thấy da khô ráp.
    Sử dụng đúng loại xịt khoáng phù hợp cho da nếu không càng xịt da càng khô hoặc đổ dầu.
    Nếu bạn là người có làn da khô hãy dùng cả kem dưỡng ẩm và serum để giữ cho da tươi mát song song với việc dùng xịt khoáng.
    Rửa mặt thật sạch trước khi xịt khoáng vì da không sạch sẽ ngăn cản quá trình thẩm thấu dưỡng chất, nguyên tố vi lượng vào da.
    Nếu bạn dùng xịt khoáng mà da vẫn khô thì hãy nên chuyển qua loại xịt khoáng có hàm lượng muối thấp và chứa các thành phần dưỡng ẩm, nước hoa hồng,... sẽ phù hợp hơn. 
   </div>
  </section>
@endsection
