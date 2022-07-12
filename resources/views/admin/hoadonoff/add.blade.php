@extends('layouts.admin')

@section('title')
    <title>Thêm mới</title>
@endsection

@section('css') 
    <link rel="stylesheet" href="admins/khachhang/add.css">
@endsection


@section('js')
  <script src="vendors/sweetAlert2/sweetalert2@11.js"></script>
  <script src="admins/hoadonoff/index.js"></script>
  <script src="admins/khachhang/add.js"></script>
  <script>
        Validator({
        form: '.form-validate',
        formGroupSelector: '.form-group',
        errorSelector: '.form-message',
        rules: [
          Validator.isRequired('.soLuong', 'Số lượng sản phẩm không được phép để trống'),
        ],

      });


      $(".btn-submit").click(function () {
      setTimeout(() => {
          $('html, body').animate({
          scrollTop: $(".form-group.invalid:first").offset().top
          }, 200);
      }, 10);

      });
  </script>
  <script type="text/javascript">
    $(document).ready(function(){
      if(!$('.tb-row-item').length) {
        $('#MyButton-hoadonoff').css('pointer-events','none');
        $('#MyButton-hoadonoff').css('background', '#ccc');
      }
      $('#product_show').on('DOMSubtreeModified', (e) => {
        if(!$('.tb-row-item').length) {
          $('#MyButton-hoadonoff').css('pointer-events','none');
          $('#MyButton-hoadonoff').css('background', '#ccc');
        } 
        // else {
        //   $('.upCart').on('input', (e) => {
        //     const $currentInput = $(e.currentTarget);
        //     var $qtyTon = $(e.currentTarget).parents('.tb-row-item').find('.qty-hidden');
        //     var $priceHidden = $(e.currentTarget).parents('.tb-row-item').find('.don-gia-hidden');
        //     var $productPriceCurrent = $(e.currentTarget).parents('.tb-row-item').find('.product-price');
        //     if (+$currentInput.val() > $qtyTon.val()) {
        //       $currentInput.val($qtyTon.val())
        //     }

        //     $productPriceCurrent.text(($currentInput.val() * $priceHidden.val()).toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&.').replace(/\.00$/,''))
        //   });
        // }
      })

      var sanPham_id = $('.select-product').val();
      var totalPrice = 0;
      $('.sanPham_id').val(sanPham_id);
      $('select').on('change', function() {
        var sanPham_id = $('.select-product').val();
        $('.sanPham_id').val(sanPham_id);
      });

      $('.add-product').click(function (e) {
        // setTimeout(() => {
        //   if(!($(e.currentTarget).parents('form').find('.form-group').hasClass('invalid')))
        //   {
        //     console.log('a');
        //     e.preventDefault();
        //     load_product();
      
        //     $('#product_hidden').text('');
        //   }
        // }, 10);
        e.preventDefault();
        load_product();
  
        $('#product_hidden').text('');
      })

      $('#MyButton-hoadonoff').click(function(e) {
        for(var i = 0; i < $('.product-price').length; i++)
        {
          var priceItem = $('.product-price')[i];
          var priceHidden = parseInt(priceItem.innerText.trim().replace(/([.*+?^=!:${}()|\[\]\/\\])/g, '').replace('đ', ''));
          totalPrice += priceHidden;
          $('#price_hidden').val(totalPrice);
        }
        // var priceHidden = parseInt($('#product_hidden').find('.product-price').text().trim().replace(/([.*+?^=!:${}()|\[\]\/\\])/g, '').replace('đ', ''));
        // totalPrice += priceHidden;
        // $('#price_hidden').val(totalPrice);
      })


      function load_product() {
        var sanPham_id = $('.sanPham_id').val();
        var _token = $('input[name="_token"]').val();
        var productQuantity = parseInt($('.product-quantity').val());
        let flag = false;
        $('.tb-row-item').each((_i, el) => {
          if(sanPham_id == $(el).find('.product-id').val()) {
            $('.product-exist').removeClass('hidden');
            flag = true;
          }
        })
        if(!flag) {
          if (!$('.product-exist').hasClass('hidden')) {
            $('.product-exist').addClass('hidden');
          }

          $('#product_show').on('DOMSubtreeModified', (e) => {
            if(!$('.tb-row-item').length) {
              $('#MyButton-hoadonoff').css('pointer-events','none');
              $('#MyButton-hoadonoff').css('background', '#ccc');
            } else {
              $('#MyButton-hoadonoff').css('pointer-events','auto');
              $('#MyButton-hoadonoff').css('background', '');
            }
          })

          $.ajax({
            url: "{{ url('/admin/hoadonoffline/load-product') }}",
            method: "POST",
            data: {sanPham_id:sanPham_id, _token:_token, productQuantity: productQuantity},
            async: false,
            success:function (data) {
              $('#product_hidden').html(data);
              $('#product_show').append($('#product_hidden').html());
            }
          });
        }

      }
    });
  </script>

@endsection

@section('content')
    <main class="h-full pb-16">
        <div class="container px-6 mx-auto py-4">
          <form method="post" class="form-validate">
            @csrf
            <div class="mb-6 w-40p">
                <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Chọn sản phẩm</label>
                <select name="sanPham_id"
                    class="select-product w-full bg-gray-50 border-1 border-black text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block px-3 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-purple-300 form-select">
                    <option value="0">--- Chọn sản phẩm ---</option>
                    {!! $htmlOptionSanPham !!}
                </select>
              <div class="hidden product-exist form-message text-red-600 mt-2">Sản phẩm này đã tồn tại trong hóa đơn vui lòng cập nhật số lượng</div>
            </div>

            <div class="mb-6 w-40p form-group">
              <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Chọn số lượng</label>
              <input name="soLuong" placeholder="Nhập số lượng sản phẩm"
                class="@error('soLuong') error @enderror soLuong product-quantity w-full px-3 text-sm text-gray-700 border-1 border-black rounded-md dark:placeholder-gray-500 dark:focus:shadow-outline-gray dark:focus:placeholder-gray-600 dark:bg-gray-700 dark:text-gray-200 focus:placeholder-gray-500 focus:bg-white focus:border-purple-300 focus:outline-none focus:shadow-outline-purple form-input"
                value="{{ old('soLuong') }}"
                type="number">
              <div class="form-message text-red-600 mt-2"></div>
            </div>

            <input type="hidden" name="sanPham_id" class="sanPham_id" value="">
            <input type="hidden" name="donGia" class="donGia" value="">
            <button type="submit" id="MyButton-add-product"
            class="btn-submit add-product px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
            Thêm sản phẩm
            </button>
          </form>
                <form action="{{ route('hoadonoffline.store') }}" method="post" enctype="multipart/form-data" id="form-nhanvien">
                  @csrf
                <div class="details my-5">
                    <h2 class="title-details text-center py-4">CHI TIẾT ĐƠN ĐẶT HÀNG</h2>
                    <hr>
                    <div class="info-products">
                        <h4 class="title-products py-4">CÓ 1 SẢN PHẨM TRONG GIỎ HÀNG</h4>
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
                                    <th class="px-4 py-3"></th>
                                </tr>
                            </thead>
                              <tbody id="product_show"></tbody>
                            </table>
                          </div>
                      </div>
                    </div>
                    <div class="hidden" id="product_hidden"></div>
                    <input class="hidden" name="price_hidden" id="price_hidden" value="" />
                </div>

                <button type="submit" id="MyButton-hoadonoff"
                    class="mb-5 px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                    Thêm mới hóa đơn
                </button>
                <br />
                <a href="{{ route('hoadonoffline.index') }}"
                class="px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                  Quay lại
                </a>
            </form>
        </div>
    </main>
@endsection
