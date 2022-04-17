$(document).ready(
  function () {
    var btn_count = $('.js-product-count')
    $("#themSL").click(
      function () {
          var sl = eval($("#quantity").val() + "+ 1");
          $("#quantity").val(sl);
      }
    )
    $("#botSL").click(
      function () {
          if (eval($("#quantity").val()) > 1) {
              var sl = eval($("#quantity").val() + "- 1");
              $("#quantity").val(sl);
          }
      }
    )
    
    // disabled
  }
)
