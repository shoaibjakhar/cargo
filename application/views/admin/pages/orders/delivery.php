<?php
  $CI = & get_instance();
?>
<?php showFlash(); ?>
<div class="card">
  <div class="card-header">
    <div class="page-title d-flex">
      <h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">Delivery List</span></h4>
    </div>
  </div>
  <div class="card-body">
    <div class="row">
      <div class="col-sm-12">
        <table id="getDeliveryLists" class="table table-striped table-sm card-text table-bordered text-center">
          <thead class="bg-light">
            <tr>
              <th>Sr.No</th>
              <th>Name</th>
              <th>Number</th>
              <th>Truck Number</th>
              <th>Date</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
           <td></td>
           <td></td>
           <td></td>
           <td></td>
           <td></td>
           <td></td>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
  document.addEventListener('DOMContentLoaded',function(){
    if(('#getDeliveryLists').length > 0)
    {
      $('#getDeliveryLists').DataTable({});
      // $('#getOrderLists').DataTable({
      //     "processing": true,
      //     "serverSide": true,
      //     "responsive": true,
      //     "ordering": false,
      //     "order": [],
      //     "ajax": {
      //         "url":'<?php echo base_url()?>admin/orders/getOrderLists',
      //         "type": "POST",
      //     },
      //     "columnDefs":[{ 
      //         "orderable": false,
      //     }]
      // }); 
    }
  },false);
</script>

