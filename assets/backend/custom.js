$(document).ready(function(){
    $(".chosen_select").chosen();
    $('.i-checks').iCheck({
        checkboxClass: 'icheckbox_square-green',
        radioClass: 'iradio_square-green',
    });
    $('.date_range_picker').daterangepicker();
    $('body').on("click",".delete_confirm",function (event){
        event.preventDefault();
        var href = $(this).attr('href');
        swal.fire({
            title: "Are you sure?",
            text: "You will not be able to recover this record!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, delete it!",
            closeOnConfirm: false
        }).then((result) => {
            if(result.value){
                $.ajax({
                    url: href,
                    method: 'GET',
                    success: function(result) {
                        result = jQuery.parseJSON(result);
                        if(result.success) {
                            swal.fire({
                                title: 'Deleted!',
                                text: result.message,
                                type: 'success'
                            }).then(()=> {
                                window.location.reload();
                            });    
                        } else {
                            swal.fire("Error!", result.message, "error");    
                        }
                    }
                });
            }
        });
    });
    $('body').on("click",".confirm_status",function (event){
        event.preventDefault();
        var href = $(this).attr('href');
        var id = $(this).attr('data-id');
        var element = $(this).closest('tr');
        var payment = element.find('.payment').val();
        var discount = element.find('.discount').val();
        var total = element.find('.total').text().trim();
        swal.fire({
            title: "Are you sure?",
            text: "This order will be marked as "+status,
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes",
            closeOnConfirm: false
        }).then((result) => {
            if(result.value){
                $.ajax({
                    url: href,
                    method: 'POST',
                    data:{id:id,total_payable:total,payment:payment,discount:discount},
                    success: function(result) {
                        result = jQuery.parseJSON(result);
                        if(result.success) {
                            swal.fire({
                                title: 'Done!',
                                text: result.message,
                                type: 'success'
                            }).then(()=> {
                                window.location.reload();
                            });    
                        } else {
                            swal.fire("Error!", result.message, "error");    
                        }
                    }
                });
            }
        });
    });
    $('.datatable').DataTable({
        ordering:false,
    });
    $('.select2').select2();

    $('body').on("click",".search",function (event){
        event.preventDefault();
        var method=$(this).data('method');
        var parent = $(this).closest('form');
        var member_id = parent.find('[name="member_id"]').val();
        var start = null;
        var end = null;
        var date = null;
        if (member_id != '') {
            start = parent.find('[name="from_date"]').val();
            start = new Date(start);
            end = parent.find('[name="to_date"]').val();
            end = new Date(end);
            var startMonth = parseInt(start.getMonth()) + 1;
            var endMonth = parseInt(end.getMonth()) + 1;
            start = start.getFullYear() + '-' + ("0" + startMonth).slice(-2) + '-' + ("0" + start.getDate()).slice(-2);
            end = end.getFullYear() + '-' + ("0" + endMonth).slice(-2) + '-' + ("0" + end.getDate()).slice(-2);
        } 
        var url = base_url+'admin/reports/'+method+'/'+member_id+'/'+start+'/'+end;
        $.ajax({
            url: url,
            method: 'GET',
            success: function(result) {
                $('body').find('.member_detail').removeClass('d-none');
                var table = $('body').find('.report_table').html(result);
            }
        });
    });
});
