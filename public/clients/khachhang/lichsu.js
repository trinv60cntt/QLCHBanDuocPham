function actionDelete(event) {
  event.preventDefault();
  let urlRequest = $(this).data('url');
  let that = $(this);

  Swal.fire({
    title: 'Bạn chắc chắn muốn hủy hóa đơn này ?',
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Đồng ý',
    cancelButtonText: 'Hủy bỏ',
  }).then((result) => {
    if (result.isConfirmed) {
      $.ajax({
        type: 'GET',
        url: urlRequest,
        success: function (data) {
          if (data.code == 200) {
            // that.parent().parent().parent().remove();
            // console.log("🚀 ~ file: lichsu.js ~ line 22 ~ actionDelete ~ that.parent()", that.parent().parent().parent())
            Swal.fire(
              'Đã hủy thành công!',
              '',
              'success'
            )
          }
        },
        error: function () {

        },
      });
    }
  })
}

$(function () {
  $(document).on('click', '.js-action-delete', actionDelete);
});