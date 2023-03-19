<?php
  $CI = & get_instance();
?>
<?php showFlash(); ?>
<div class="card">
  <div class="card-header">
    <div class="page-title d-flex">
      <h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">All Bookings</span></h4>
    </div>
  </div>
  <div class="card-body">
    <div class="row">
      <div class="col-sm-12">
        <table id="getAllBookings" class="table table-striped table-sm card-text table-bordered text-center">
          <thead class="bg-light">
            <tr>
              <th>Sr.No</th>
              <th>Date</th>
              <th>Sender Name</th>
              <th>Sender Phone</th>
              <th>Sender CNIC</th>
              <th>Receiver Name</th>
              <th>Receiver Phone</th>
              <th>Receiver CNIC</th>
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
    if(('#getAllBookings').length > 0)
    {
      $('#getAllBookings').DataTable({
          "processing": true,
          "serverSide": true,
          "responsive": true,
          "ordering": false,
          "order": [],
          "ajax": {
              "url":'<?php echo base_url()?>admin/orders/getAllBookings',
              "type": "POST",
          },
          "columnDefs":[{ 
              "orderable": false,
          }]
      }); 
    }
  },false);
</script>

