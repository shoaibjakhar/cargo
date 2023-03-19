<?php $ci=& get_instance() ?>
<?php showFlash(); ?>
<div class="card">
  <div class="card-header">
    <div class="page-title d-flex">
      <h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">Add New Rider</span></h4>
    </div>
  </div>
  <div class="card-body">
    <form action="<?php echo base_url('admin/riders/add_riders')?>" method="POST" enctype="multipart/form-data">
      <input type="hidden" name="id" value="<?php echo isset($model->id) ? $model->id :'';?>">
      <div class="row">
        <div class="col-sm-4">
          <label for="#" class="mr-sm-2">Rider Name</label>
          <input type="text" name="rider_name" required="" class="form-control" value="<?php echo isset($model->rider_name) ? $model->rider_name :'';?>">
        </div>
        <div class="col-sm-4">
          <label for="#" class="mr-sm-2">Rider Number</label>
          <input type="text" name="rider_number" required="" class="form-control" value="<?php echo isset($model->rider_number) ? $model->rider_number :'';?>">
        </div>
        <div class="col-sm-4">
          <label for="#" class="mr-sm-2">Email</label>
          <input type="email" name="email" class="form-control" value="<?php echo isset($model->email) ? $model->email :'';?>">
        </div>
      </div>
      <div class="row">
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
