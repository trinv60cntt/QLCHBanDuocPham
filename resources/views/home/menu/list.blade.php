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
    <div class="container container-aaa">
      <h1 class="text-base lg:text-4xl pt-5 pb-3 font-semibold menu-title">Tra cứu thuốc kê đơn</h1>
      <div class="row">
        <div class="col w-full lg:w-1/4 lg:px-4">
          <div class="group-filter">
            <h2 class="font-semibold text-3xl">Bộ lọc</h2>
            <div class="my-5">
              <label for="amount" class="text-base my-2 font-semibold">Sắp xếp theo</label>
              <form action="" class="mt-3">
                @csrf
                <select name="sort" id="sort" class="form-select">
                  <option value="{{ Request::url() }}?sort_by=none">--Lọc--</option>
                  <option value="{{ Request::url() }}?sort_by=tang_dan" @php if(strpos($_SERVER['REQUEST_URI'], "tang_dan")) echo "selected"; else echo ''; @endphp>Giá: Từ thấp đến cao</option>
                  <option value="{{ Request::url() }}?sort_by=giam_dan" @php if(strpos($_SERVER['REQUEST_URI'], "giam_dan")) echo "selected"; else echo ''; @endphp>Giá: Từ cao xuống thấp</option>
                  <option value="{{ Request::url() }}?sort_by=kytu_az" @php if(strpos($_SERVER['REQUEST_URI'], "kytu_az")) echo "selected"; else echo ''; @endphp>Theo bảng chữ cái từ A-Z</option>
                  <option value="{{ Request::url() }}?sort_by=kytu_za" @php if(strpos($_SERVER['REQUEST_URI'], "kytu_za")) echo "selected"; else echo ''; @endphp>Theo bảng chữ cái từ Z-A</option>
                  <option>Đánh giá: Từ thấp đến cao</option>
                  <option>Đánh giá: Từ cao xuống thấp</option>
                </select>
              </form>
            </div>
            <div class="flex flex-col">
              <h5 class="text-base my-2 font-semibold">Danh mục</h5>
              @foreach($categorys as $category)
              <div class="news-item is-collapse mb-2">
                <div class="news-title border-b-2 border-linebrown p-5 cursor-pointer">
                  @if($category->categoryChildren->count())
                  <span class="js-news-control">
                    <i class="fas fa-solid fa-plus absolute right-0 bottom-0 top-0 block m-auto text-xl font-icon"></i>
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
        <div class="col w-full list-products lg:w-3/4 lg:px-4">
          <div class="row">
            @foreach ($category_by_id as $cate)
            <div class="border-product-custom p-2 mr-3 sm:mr-5 mb-5 shadow-lg lg:p-3">
              <div class="product-image">
                <a href="{{ route('menus.details', ['sanPham_id' => $cate->sanPham_id]) }}"><img src="storage/sanpham/{{ $cate->hinhAnh }}" alt="ion muoi"></a>
              </div>
              <div class="product-info text-left">
                  <h3 class="truncate2 font-bold text-lg mb-5">{{  $cate->tenSP  }}</h3>
                  <span
                  class="product-price text-lg font-medium">{{ str_replace(',', '.', number_format($cate->donGia)) }}đ</span>
                  / {{ $cate->donViTinh }}
              </div>
            </div>
            @endforeach
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection
