<?php
  $CI = & get_instance();
?>
<?php showFlash(); ?>
<div class="card">
  <div class="card-header">
    <div class="page-title d-flex">
      <h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">Customers List</span></h4>
    </div>
  </div>
  <div class="card-body">
    <div class="row">
      <div class="col-sm-12">
        <table class="datatable table table-striped table-sm card-text table-bordered text-center">
          <thead class="bg-light">
            <tr>
              <th>Sr.No</th>
              <th>Customer Name</th>
              <th>Customer Number</th>
              <th>Unloading Expenses</th>
              <th>Address</th>
              <th>Created Date</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php if(!empty($allData)){ 
              foreach($allData as $key=>$row){ ?>
                <tr>
                    <td><?php echo $key+1;?></td>
                    <td><?php echo isset($row->customer_name) ? $row->customer_name :'';  ?></td>
                    <td><?php echo isset($row->customer_number) ? $row->customer_number :'';  ?></td>
                    <td><?php echo isset($row->unloading_expenses) ? $row->unloading_expenses :0;  ?></td>
                    <td><?php echo isset($row->address) ? $row->address :'';  ?></td>
                    <td><?php echo isset($row->created_at) ? date('M d, Y',strtotime($row->created_at)) :'';  ?></td>
                    <td>
                      <a href="<?php echo base_url('admin/customers/add_customers').'/'.$row->id ?>" class="btn btn-info btn-xs"><i class="fa fa-edit"></i></a>
                      <a href="<?php echo base_url('admin/customers/delete_customer').'/'.$row->id ?>" class="btn btn-danger btn-xs delete_confirm"><i class="fa fa-trash"></i></a>
                    </td>
                </tr>
              <?php } }?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

