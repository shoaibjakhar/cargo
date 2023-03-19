<?php $ci=& get_instance() ?>
<?php showFlash(); ?>
<form action="<?php echo base_url('admin/orders/create_booking')?>" method="POST" enctype="multipart/form-data">
  <div class="row">
    <div class="col-sm-6">
      <div class="card">
        <div class="card-header">
          <div class="page-title d-flex">
            <h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">Sender Detail</span></h4>
          </div>
        </div>
        <div class="card-body">
            <div class="row">
              <div class="col-sm-6">
                <input type="hidden" name="id" value="<?php echo isset($model->id) ? $model->id :'';?>">
                <label for="#" class="mr-sm-2">Name</label>
                <input type="text" name="sender_name" required="" class="form-control" value="<?php echo isset($model->sender_name) ? $model->sender_name :'';?>">
              </div>
              <div class="col-sm-6">
                <label for="#" class="mr-sm-2">Phone Number</label>
                <input type="text" name="sender_phone_number" required="" class="form-control" value="<?php echo isset($model->sender_phone_number) ? $model->sender_phone_number :'';?>">
              </div>
            </div>
            <div class="row">
              <div class="col-sm-6">
                <input type="hidden" name="id" value="<?php echo isset($model->id) ? $model->id :'';?>">
                <label for="#" class="mr-sm-2">CNIC</label>
                <input type="text" name="sender_cnic" required="" class="form-control" value="<?php echo isset($model->sender_cnic) ? $model->sender_cnic :'';?>">
              </div>
              <div class="col-sm-6">
                <label for="#" class="mr-sm-2">Address</label>
                <textarea class="form-control" name="sender_address"><?php echo isset($model->sender_address) ? $model->sender_address:''; ?></textarea>
              </div>
            </div>
        </div>
      </div>
    </div>
    <div class="col-sm-6">
      <div class="card">
        <div class="card-header">
          <div class="page-title d-flex">
            <h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">Receiver Detail</span></h4>
          </div>
        </div>
        <div class="card-body">
            <div class="row">
              <div class="col-sm-6">
                <label for="#" class="mr-sm-2">Name</label>
                <input type="text" name="receiver_name" required="" class="form-control" value="<?php echo isset($model->receiver_name) ? $model->receiver_name :'';?>">
              </div>
              <div class="col-sm-6">
                <label for="#" class="mr-sm-2">Phone Number</label>
                <input type="text" name="receiver_phone_number" required="" class="form-control" value="<?php echo isset($model->receiver_phone_number) ? $model->receiver_phone_number :'';?>">
              </div>
            </div>
            <div class="row">
              <div class="col-sm-6">
                <input type="hidden" name="id" value="<?php echo isset($model->id) ? $model->id :'';?>">
                <label for="#" class="mr-sm-2">CNIC</label>
                <input type="text" name="receiver_cnic" required="" class="form-control" value="<?php echo isset($model->receiver_cnic) ? $model->receiver_cnic :'';?>">
              </div>
              <div class="col-sm-6">
                <label for="#" class="mr-sm-2">Address</label>
                <textarea class="form-control" name="receiver_address"><?php echo isset($model->receiver_address) ? $model->receiver_address:''; ?></textarea>
              </div>
            </div>
        </div>
      </div>
    </div>
  </div>
  <div class="card">
    <div class="card-header">
      <div class="page-title d-flex">
        <h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">Booking Detail</span></h4>
      </div>
    </div>
    <div class="card-body">
        <div class="row">
          <div class="col-sm-6">
            <label for="#" class="mr-sm-2">Qty</label>
            <input type="text" name="qty" required="" class="form-control" value="<?php echo isset($model->qty) ? $model->qty :'';?>">
          </div>
          <div class="col-sm-6">
            <label for="#" class="mr-sm-2">Rent</label>
            <input type="text" name="rent" required="" class="form-control" value="<?php echo isset($model->rent) ? $model->rent :'';?>">
          </div>
        </div>
        <div class="row">
          <div class="col-sm-6">
            <label for="#" class="mr-sm-2">Loading Expense</label>
            <input type="text" name="loading_expense" class="form-control" value="<?php echo isset($model->loading_expense) ? $model->loading_expense :0;?>">
          </div>
          <div class="col-sm-6">
            <label for="#" class="mr-sm-2">Local Expense</label>
            <input type="text" name="local_expense" class="form-control" value="<?php echo isset($model->local_expense) ? $model->local_expense :0;?>">
          </div>
        </div>
        <div class="row">
          <div class="col-sm-6">
            <label for="#" class="mr-sm-2">Descriptions</label>
            <textarea class="form-control" name="description"><?php echo isset($model->description) ? $model->description:''; ?></textarea>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-4">
            <button type="submit" class="btn btn-info" style="margin-top:30px">Save</button>
          </div>
        </div>
    </div>
  </div>
</form>
