<?php
  $CI = & get_instance();
?>
<?php showFlash(); ?>
<div class="card">
  <div class="card-header">
    <div class="page-title d-flex">
      <h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">Receive Truck List</span></h4>
    </div>
  </div>
  <div class="card-body">
    <div class="row">
      <div class="col-sm-12">
        <table id="getOrderLists" class="table table-striped table-sm card-text table-bordered text-center">
          <thead class="bg-light">
            <tr>
              <th>Sr.No</th>
              <th>Supplier Name</th>
              <th>Driver Name</th>
              <th>Subtotal</th>
              <th>Commission</th>
              <th>Damages</th>
              <th>Damages Detail</th>
              <th>Total</th>
              <th>Date</th>
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
    if(('#getOrderLists').length > 0)
    {
      $('#getOrderLists').DataTable({
          "processing": true,
          "serverSide": true,
          "responsive": true,
          "ordering": false,
          "order": [],
          "ajax": {
              "url":'<?php echo base_url()?>admin/orders/getOrderLists',
              "type": "POST",
          },
          "columnDefs":[{ 
              // "targets": [0],
              "orderable": false,
          }]
      }); 
    }
  },false);
</script>

