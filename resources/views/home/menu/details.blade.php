@extends('layouts.clients')

@section('title')
  <title>Trang chủ</title>
@endsection

@section('js')
    <script src="clients/detailsSanPham/details.js"></script>
@endsection

@section('content')
  <section class="mod mod-details-product py-10">
    <div class="container mx-auto">
      <div class="row flex flex-wrap">
        <div class="col w-1/2 pl-3 pr-5">
          <div class="img-left">
            <img src="storage/sanpham/1/{{ $sanpham->hinhAnh }}" alt="xit mui">
          </div>
        </div>
        <div class="col w-1/2 details-right pl-5 pr-3">
          <h1 class="title-product text-2xl font-medium pb-4">
            {{ $sanpham->tenSP }}
          </h1>
          <div class="detail-line"></div>
          <div class="pt-4">
            <span class="detail-price text-3xl">{{ str_replace(',', '.', number_format($sanpham->donGia)) }}đ</span><span class="text-2xl"> / {{ $sanpham->donViTinh }}</span>
          </div>
          <div>
            <table>
              <tbody>
                <tr class="block mb-2">
                  <td class="font-medium inline">Danh mục: </td>
                  <td class="inline"><a href="#" class="text-blue-500">{{ optional($sanpham->danhmuc)->tenDM }}</a></td>
                </tr>

                <tr class="block mb-2">
                  <td class="font-medium inline">Công dụng: </td>
                  <td class="inline">{{ $sanpham->congDung }}</td>
                </tr>
                
                <tr class="block mb-2">
                  <td class="font-medium inline">Nhà sản xuất: </td>
                  <td class="inline"><a href="#">{{ optional($sanpham->nhasanxuat)->tenNSX }}</a></td>
                </tr>

                <tr class="block mb-2">
                  <td class="font-medium inline">Nước sản xuất: </td>
                  <td class="inline"><a href="#">{{ optional($sanpham->nhasanxuat)->nuocSX }}</a></td>
                </tr>
              </tbody>
            </table>
          </div>

          <div class="detail-quantity flex mt-5">
            <p class="font-medium">Chọn số lượng</p>
            <div class="flex ml-4">
              <button id="botSL" class="input-group-addon input-minus">
                <span class="fas fa-minus" style="margin-top: 7px" aria-hidden="true"></span>
              </button>
              <input type="text" 
              class="input-quantity text-center text-base font-bold" 
              name="quantity" id="quantity" value="1">
            </div>
            <button id="themSL" class="input-group-addon input-plus">
              <span class="fas fa-plus" style="margin-top: 7px" aria-hidden="true"></span>
            </button>
          </div>

          <div class="add-to-cart mt-5">
            <a href="#" class="btn text-xl">Thêm vào giỏ hàng</a>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection
