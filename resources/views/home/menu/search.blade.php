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
    {{-- <script type="text/javascript">
      setTimeout(() => {
        $('html, body').animate({
        scrollTop: $(".container").offset().top - 18
        }, 700);
      }, 500);
    </script> --}}
@endsection

@section('content')
  <section class="module mod-menu pb-12">
    <div class="testimonial">
      <img src="assets/img/banner-1.png" alt="banner 1" class="w-full">
    </div>
    <div class="container container-aaa">
      <h1 class="text-4xl pt-5 pb-3 font-semibold menu-title">Tra cứu thuốc kê đơn</h1>
      <div class="row">
        <div class="col w-1/4 px-4">
          <div class="group-filter">
            <h2 class="font-semibold text-3xl">Bộ lọc</h2>
            <div class="my-5">
              <h5 class="text-base my-2 font-semibold">Sắp xếp theo</h5>
              <select name="danhMuc_id" class="form-select">
                <option>Giá: Từ thấp đến cao</option>
                <option>Giá: Từ cao xuống thấp</option>
                <option>Đánh giá: Từ thấp đến cao</option>
                <option>Đánh giá: Từ cao xuống thấp</option>
              </select>
            </div>
            <div class="flex flex-col">
              <h5 class="text-base my-2 font-semibold">Danh mục</h5>
              @foreach($categorys as $category)
              <div class="news-item is-collapse mb-2">
                <div class="news-title border-b-2 border-linebrown p-5 cursor-pointer">
                  @if($category->categoryChildren->count())
                  <span class="js-news-control">
                    <i class="fas fa-solid fa-plus absolute right-0 bottom-0 top-0 block m-auto text-3xl font-icon"></i>
                  </span>
                  @endif
                  <a href="{{ route('menus.getCategory', ['danhMuc_id' => $category->danhMuc_id]) }}" class="relative">{{ $category->tenDM }}</a>
                </div>
                <div class="news-content bg-gray p-5 flex flex-col shadow-lg">
                  <ul>
                    @foreach($category->categoryChildren as $childrentList)
                    <li><a href="{{ route('menus.getCategory', ['danhMuc_id' => $childrentList->danhMuc_id]) }}" class="mt-1 cate-children">{{ $childrentList->tenDM }}</a></li>
                    @endforeach
                  </ul>
                </div>
              </div>
              @endforeach
          
            </div>
          </div>
        </div>
        <div class="col list-products w-3/4 px-4">
          <h2 class="text-center text-3xl font-semibold mb-5">Kết quả tìm kiếm</h2>
          <div class="row">
            @foreach ($search_product as $key => $sanpham)
            <div class="col w-1/4 product-item">
              <div class="border-product mr-5 mb-5 shadow-lg">
                <div class="product-image">
                  <a href="{{ route('menus.details', ['sanPham_id' => $sanpham->sanPham_id]) }}"><img src="storage/sanpham/1/{{ $sanpham->hinhAnh }}" alt="ion muoi"></a>
                </div>
                <div class="product-info text-left">
                    <h3 class="truncate2 font-bold text-lg mb-5">{{  $sanpham->tenSP  }}</h3>
                    <span
                    class="product-price text-lg font-medium">{{ str_replace(',', '.', number_format($sanpham->donGia)) }}đ</span>
                    / {{ $sanpham->donViTinh }}
                </div>
              </div>
            </div>
            @endforeach
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection

