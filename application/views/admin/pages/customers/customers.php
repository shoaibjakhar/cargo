<?php $ci=& get_instance() ?>
<?php showFlash(); ?>
<div class="card">
  <div class="card-header">
    <div class="page-title d-flex">
      <h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">Add New Customer</span></h4>
    </div>
  </div>
  <div class="card-body">
    <form action="<?php echo base_url('admin/customers/add_customers')?>" method="POST" enctype="multipart/form-data">
      <div class="row">
        <div class="col-sm-4">
          <input type="hidden" name="id" value="<?php echo isset($model->id) ? $model->id :'';?>">
          <label for="#" class="mr-sm-2">Customer Name</label>
          <input type="text" name="customer_name" required="" class="form-control" value="<?php echo isset($model->customer_name) ? $model->customer_name :'';?>">
        </div>
        <div class="col-sm-4">
          <label for="#" class="mr-sm-2">Customer Number</label>
          <input type="text" name="customer_number" required="" class="form-control" value="<?php echo isset($model->customer_number) ? $model->customer_number :'';?>">
        </div>
        <div class="col-sm-4">
          <label for="#" class="mr-sm-2">Opening Balance</label>
          <input type="text" name="opening_balance" <?php echo (isset($model->id) && $model->id && $model->opening_balance > 0) ? 'readonly':''; ?> class="form-control" value="<?php echo isset($model->opening_balance) ? $model->opening_balance :0;?>">
        </div>
        <!-- <div class="col-sm-4">
          <label for="#" class="mr-sm-2">Email</label>
          <input type="email" name="email" class="form-control" value="<?php echo isset($model->email) ? $model->email :'';?>">
        </div> -->
      </div>
      <div class="row">
        <div class="col-sm-4">
          <label for="#" class="mr-sm-2">Unloading Charges</label>
          <input type="text" name="unloading_expenses" class="form-control" value="<?php echo isset($model->unloading_expenses) ? $model->unloading_expenses :0;?>">
        </div>
        <div class="col-sm-4">
          <label for="#" class="mr-sm-2">Address</label>
          <input type="text" name="address" required="" class="form-control" value="<?php echo isset($model->address) ? $model->address :'';?>">
        </div>
        <div class="col-sm-4">
          <label for="#" class="mr-sm-2">Description</label>
          <textarea name="description" class="form-control"><?php echo isset($model->description) ? $model->description :'';?></textarea>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-4">
          <button type="submit" class="btn btn-info" style="margin-top:30px">Save</button>
        </div>
      </div>
    </form>
  </div>
</div>
