<?php $ci=& get_instance() ?>
<?php showFlash(); ?>
<div class="card">
  <div class="card-header">
    <div class="page-title d-flex">
      <h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">Expenses Heads</span></h4>
    </div>
  </div>
  <div class="card-body">
    <form action="<?php echo base_url('admin/expenses/add_expense')?>" method="POST" enctype="multipart/form-data">
      <input type="hidden" name="id" value="<?php echo isset($model->id) ? $model->id :'';?>">
      <div class="row">
        <div class="col-sm-3">
          <label for="#" class="mr-sm-2">Expenses Head</label>
          <select class="form-control select2" required="" name="expense_head_id">
            <option value="">--select--</option>
              <?php
                if(!empty($expenses_head)){
                  foreach($expenses_head as $key=>$row){?>
                    <option <?php echo (isset($model->expense_head_id) && $model->expense_head_id == $row->id) ? 'selected':''; ?> value="<?php echo isset($row->id) ? $row->id:''; ?>">
                        <?php echo isset($row->name) ? $row->name:''; ?>
                    </option>
            <?php } } ?>
          </select>
        </div>
        <div class="col-sm-2">
          <label for="#" class="mr-sm-2">Expenses Name</label>
          <input type="text" required="" class="form-control" value="<?php echo isset($model->name) ? $model->name :'';?>" name="name">
        </div>
        <div class="col-sm-2">
          <label for="#" class="mr-sm-2">Amount</label>
          <input type="text" required="" class="form-control" value="<?php echo isset($model->amount) ? $model->amount :'';?>" name="amount">
        </div>
        <div class="col-sm-3">
          <label for="#" class="mr-sm-2">Description</label>
          <input type="text" class="form-control" value="<?php echo isset($model->description) ? $model->description :'';?>" name="description">
        </div>
        <div class="col-sm-1">
          <button type="submit" class="btn btn-info" style="margin-top:30px">Save</button>
        </div>
      </div>
    </form>
  </div>
</div>
<div class="card">
  <div class="card-body">
    <div class="row">
      <div class="col-sm-12">
        <table id="get_expenses" class="table table-striped table-sm card-text table-bordered text-center">
          <thead class="bg-light">
            <tr>
              <th>Sr.No</th>
              <th>Date</th>
              <th>Expense Head</th>
              <th>Name</th>
              <th>Amount</th>
              <th>Descriptions</th>
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
    if(('#get_expenses').length > 0)
    {
      $('#get_expenses').DataTable({
          "processing": true,
          "serverSide": true,
          "responsive": true,
          "ordering": false,
          "order": [],
          "ajax": {
              "url":'<?php echo base_url()?>admin/expenses/get_expenses',
              "type": "POST",
          },
          "columnDefs":[{ 
              "orderable": false,
          }]
      }); 
    }
  },false);
</script>