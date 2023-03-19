<?php
  $CI = & get_instance();
?>
<?php showFlash(); ?>
<div class="card">
  <div class="card-header">
    <div class="page-title d-flex">
      <h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">Collect Payment</span></h4>
    </div>
  </div>
  <div class="card-body">
    <div class="row">
      <div class="col-sm-12">
        <table id="getDelivered" class="table table-striped table-sm card-text table-bordered text-center">
          <thead class="bg-light">
            <tr>
              <th>Sr.No</th>
              <th>Date</th>
              <th>Customer Name</th>
              <th>Rider Name</th>
              <th>Bility#</th>
              <th>Total</th>
              <th>Paid</th>
              <th>Dis</th>
              <th>Bal</th>
              <th>Payable</th>
              <th style="width: 125.2px !important;">Payment</th>
              <th style="width: 125.2px !important;">Discount</th>
              <th>Status</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
  document.addEventListener('DOMContentLoaded',function(){
    if(('#getDelivered').length > 0)
    {
      $('#getDelivered').DataTable({
          "processing": true,
          "serverSide": true,
          "responsive": true,
          "ordering": false,
          "order": [],
          "ajax": {
              "url":'<?php echo base_url()?>admin/payments/getDelivered',
              "type": "POST",
          },
          "columnDefs":[{ 
              "orderable": false,
          }]
      }); 
    }

    $('body').on("click",".pay_now",function (event){
        event.preventDefault();
        var element = $(this);
        var tr = element.closest('tr');
        var total_payable =tr.find('.total_payable').text().trim();
        total_payable = (total_payable) ? total_payable:0;
        var payment =tr.find('.payment').val();
        payment = (payment) ? payment:0;
        var discount =tr.find('.discount').val();
        discount = (discount) ? discount:0;
        var id =element.attr('data-id');
        var href = $(this).attr('href');
        if(payment == 0 || payment == '')
        {
          swal.fire({
                title: 'Alert!',
                text: 'Payment should be greater then 0',
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Ok",
                closeOnConfirm: false
            }).then(()=> {
            });
            return false;
        }
        swal.fire({
            title: "Are you sure?",
            text: "You will not be able to recover this record!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes",
            closeOnConfirm: false
        }).then((result) => {
            if(result.value){
                $.ajax({
                    url: href,
                    type: 'POST',
                    data:{id:id,total_payable:total_payable,discount:discount,payment:payment},
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
  },false);
</script>

