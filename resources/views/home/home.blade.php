@extends('layouts.clients')

@section('title')
    <title>Trang chủ</title>
@endsection

@section('content')
    <section class="module mod-testimonial">
        <img src="assets/img/banner-1.png" alt="banner 1" class="w-full">
    </section>

    <section class="module mod-category my-12">
        <div class="container mx-auto">
            <div class="content">
                <h2 class="text-2xl font-semibold">Nhà thuốc trực tuyến thân thiện cho cả gia đình</h2>
                <p>Mọi nhu cầu chăm sóc sức khoẻ của gia đình bạn sẽ được đáp ứng nhanh chóng, tận tâm, và hoàn toàn trực
                    tuyến.</p>
            </div>
            <div class="row flex flex-wrap justify-center mt-4">
                <div class="col w-1/3">
                    <a href="#">
                        <div class="category-item" style="background-image: url('assets/img/bg-tpcn.png')">
                            <div class="category-overlay text-center">
                                <p class="text-white">Thực phẩm chức năng</p>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col w-1/3">
                    <a href="#">
                        <div class="category-item" style="background-image: url('assets/img/bg-thuoc.png')">
                            <div class="category-overlay text-center">
                                <p class="text-white">Thuốc</p>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col w-1/3">
                    <a href="#">
                        <div class="category-item" style="background-image: url('assets/img/bg-covid.png')">
                            <div class="category-overlay text-center">
                                <p class="text-white">Tủ thuốc Covid</p>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col w-1/3">
                    <a href="#">
                        <div class="category-item" style="background-image: url('assets/img/bg-chamsoccanhan.png')">
                            <div class="category-overlay text-center">
                                <p class="text-white">Chăm sóc cá nhân</p>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col w-1/3">
                    <a href="#">
                        <div class="category-item" style="background-image: url('assets/img/bg-chamsocsacdep.png')">
                            <div class="category-overlay text-center">
                                <p class="text-white">Chăm sóc sắc đẹp</p>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <section class="module mod-product-covid py-8">
        <div class="container px-3 mx-auto">
            <div class="title text-left">
                <h2 class="text-white text-xl font-semibold">Hỗ trợ mùa dịch</h2>
            </div>
            <div class="slide-product mt-3 flex flex-wrap">
              @foreach ($sanPhamCovid as $sanPhamCovidItem)
                  <div class="border-product mr-5 mb-5 shadow-lg">
                      <div class="product-image">
                        <a href="{{ route('menus.details', ['sanPham_id' => $sanPhamCovidItem->sanPham_id]) }}"><img src="storage/sanpham/1/{{ $sanPhamCovidItem->hinhAnh }}" alt="ion muoi"></a>
                      </div>
                      <div class="product-info text-left">
                          <h3 class="truncate2 font-bold text-lg mb-5">{{ $sanPhamCovidItem->tenSP }}</h3>
                          <span
                          class="product-price text-lg font-medium">{{ str_replace(',', '.', number_format($sanPhamCovidItem->donGia)) }}đ</span>
                      / {{ $sanPhamCovidItem->donViTinh }}
                      </div>
                  </div>
              @endforeach
            </div>
        </div>
    </section>

    <section class="module mod-product-best-selling py-8">
        <div class="container px-3 mx-auto">
            <div class="title text-left">
                <h2 class="text-xl font-semibold">Bán chạy nhất</h2>
            </div>
            <div class="slide-product mt-3 flex flex-wrap">
                @foreach ($sanphams as $sanpham)
                    <div class="border-product mr-5 mb-5 shadow-lg">
                        <div class="product-image">
                            <a href="{{ route('menus.details', ['sanPham_id' => $sanpham->sanPham_id]) }}"><img src="storage/sanpham/1/{{ $sanpham->hinhAnh }}" alt="ion muoi"></a>
                        </div>
                        <div class="product-info text-left">
                            <h3 class="truncate2 font-bold text-lg mb-5">{{ $sanpham->tenSP }}</h3>
                            <span
                                class="product-price text-lg font-medium">{{ str_replace(',', '.', number_format($sanpham->donGia)) }}đ</span>
                            / {{ $sanpham->donViTinh }}
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <section class="module mod-posts py-8">
        <div class="container px-3 mx-auto">
            <div class="title text-left">
                <h2 class="text-xl font-semibold">Tin mới nhất sức khoẻ và thuốc</h2>
            </div>

            <div class="posts-list mt-3 flex flex-wrap">
                <div class="border-posts mr-5 mb-5">
                    <div class="product-image">
                        <a href="#"><img src="/assets/img/xit-khoang.png" alt="ion muoi" class="img-border"></a>
                    </div>
                    <div class="product-info text-left p-4">
                        <h3 class="truncate2 font-bold text-lg mb-5">Mách bạn gái cách dùng xịt khoáng tiết kiệm</h3>
                        <span class="product-price text-lg font-medium">2 ngày trước</span>
                    </div>
                </div>

                <div class="border-posts mr-5 mb-5">
                    <div class="product-image">
                        <a href="#"><img src="/assets/img/xit-khoang.png" alt="ion muoi" class="img-border"></a>
                    </div>
                    <div class="product-info text-left p-4">
                        <h3 class="truncate2 font-bold text-lg mb-5">Mách bạn gái cách dùng xịt khoáng tiết kiệm</h3>
                        <span class="product-price text-lg font-medium">2 ngày trước</span>
                    </div>
                </div>


                <div class="border-posts mr-5 mb-5">
                    <div class="product-image">
                        <a href="#"><img src="/assets/img/xit-khoang.png" alt="ion muoi" class="img-border"></a>
                    </div>
                    <div class="product-info text-left p-4">
                        <h3 class="truncate2 font-bold text-lg mb-5">Mách bạn gái cách dùng xịt khoáng tiết kiệm</h3>
                        <span class="product-price text-lg font-medium">2 ngày trước</span>
                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection
