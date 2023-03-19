<?php
  $CI = & get_instance();
?>
<?php showFlash(); ?>
<div class="card">
  <div class="card-header">
    <div class="page-title d-flex">
      <h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">Drivers List</span></h4>
    </div>
  </div>
  <div class="card-body">
    <div class="row">
      <div class="col-sm-12">
        <table class="datatable table table-striped table-sm card-text table-bordered text-center">
          <thead class="bg-light">
            <tr>
              <th>Sr.No</th>
              <th>Company Name</th>
              <th>Driver Name</th>
              <th>Driver Number</th>
              <th>Truck Number</th>
              <th>Created Date</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php if(!empty($allData)){ 
              foreach($allData as $key=>$row){ ?>
                <tr>
                    <td><?php echo $key+1;?></td>
                    <td><?php echo isset($row->company_name) ? $row->company_name :'';  ?></td>
                    <td><?php echo isset($row->driver_name) ? $row->driver_name :'';  ?></td>
                    <td><?php echo isset($row->driver_number) ? $row->driver_number :'';  ?></td>
                    <td><?php echo isset($row->truck_number) ? $row->truck_number :'';  ?></td>
                    <td><?php echo isset($row->created_at) ? date('M d, Y',strtotime($row->created_at)) :'';  ?></td>
                    <td>
                      <a href="<?php echo base_url('admin/drivers/add_drivers').'/'.$row->id ?>" class="btn btn-info btn-xs"><i class="fa fa-edit"></i></a>
                      <a href="<?php echo base_url('admin/drivers/delete_driver').'/'.$row->id ?>" class="btn btn-danger btn-xs delete_confirm"><i class="fa fa-trash"></i></a>
                    </td>
                </tr>
              <?php } }?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

