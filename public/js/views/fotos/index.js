$(document).ready(function () {
    $('#datatable').DataTable();

    $('.form-delete').on('submit',function(e){
        e.preventDefault();
        let form = this;
        swal({
            title: "Are you sure?",
            text: "Once deleted, you will not be able to recover this imaginary file!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
          })
          .then((willDelete) => {
            if (willDelete) {

              swal("Poof! Your imaginary file has been deleted!", {
                icon: "success",
              });
              form.submit();
            } else {
              swal("Your imaginary file is safe!");
            }
          });
    })
});