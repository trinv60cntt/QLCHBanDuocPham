$(document).ready(
  function () {
    // console.log('abc');
    var btn_count = $('.js-product-count')
    btn_count.each(function () {
      var btn = $(this).find('.button-count'),
          input = $(this).find('.number-product');

      // -
      btn.first().off().on('click', function () {
          var that = $(this), data = that.data();
          num = parseInt(input.val());
          
          if (num > 1 && input.val(num - 1)) {
              data.qty = num - 1;

              // let isValidPromotion = checkSLKM(that, input.val());
              // if(!isValidPromotion)
              // {
              //     let parent = that.closest('.cart-product');
              //     let firstPromotionNotCheck = parent.find('.groupPromotionArea1').not('.active').first();
              //     firstPromotionNotCheck.trigger('click');
              // }

              // data.listPromotions = getPromotionChoose();
              // data = Object.assign(data, addDataVourcher());

              // sendSer('/cart/updateCart', data, that, opt);
          }

          // num == 2 && btn.first().addClass('disabled');
          // num == MAX && btn.last().removeClass('disabled');
      });

      // +
      btn.last().off().click(function () {

          var that = $(this), data = that.data();
          // console.log(data);
          num = parseInt(input.val());
          // that.addClass('disabled');

          if (num >= 1 && input.val(num + 1)) {
            data.qty = num + 1;
            // input.val(num + 1);
            // let isValidPromotion = checkSLKM(that, input.val());
            // if(!isValidPromotion)
            // {
            //     let parent = that.closest('.cart-product');
            //     let firstPromotionNotCheck = parent.find('.groupPromotionArea1').not('.active').first();
            //     firstPromotionNotCheck.trigger('click');
            // }

            // data.listPromotions = getPromotionChoose();
            // data = Object.assign(data, addDataVourcher());

            // sendSer('/cart/updateCart', data, that, opt);
        }

      });

  });
    
    // disabled
  }
)
