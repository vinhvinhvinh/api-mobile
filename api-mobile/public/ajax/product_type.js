$(document).ready(function() {
  $.ajaxSetup({
    headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    },
 });
 $('#form_add_product_type').validate({
   rules: {
     name: 'required',
   },
   messages:{
     name: 'Vui lòng nhập tên loại bánh'
   },
 });

 $('#form_add_product_type').submit(function (e) {
  $('#name-error').css('color', 'red');
  });
  $('#form_update_product_type').submit(function () { 
    $('name-error').css('color', 'red');
   });
});
window.DeleteProductType = function (id) {
  Swal.fire({
    title: 'Thông báo?',
    text: "Bạn có muốn xóa sản phẩm này!",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Xóa'
  }).then((result) => {
    if (result.isConfirmed) {
      $.ajax({
        type: "POST",
        url: "/api/product_types/delete/"+id,
        data: {
          _token: $('input[name="_token"]').val()
        },
        dataType: "json",
        success: function (response) {
          Swal.fire(
            'Đã xóa thành công!',
            response.message,
            'success'
          )
          $('#ptid'+id).remove();
        }
      });
     
    }
   
  })    
};