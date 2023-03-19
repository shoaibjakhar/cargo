<?php $ci=& get_instance() ?>
<?php showFlash(); ?>
<div class="card">
  <div class="card-header">
    <div class="page-title d-flex">
      <h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">Receive  Track</span></h4>
    </div>
  </div>
  <div class="card-body">
    <form action="<?php echo base_url('admin/orders/receive_truck')?>" method="POST" enctype="multipart/form-data">
      <input type="hidden" name="id" value="<?php echo isset($model->id) ? $model->id :'';?>">
      <div class="row">
        <div class="col-sm-3">
          <label for="#" class="mr-sm-2">Suppliers</label>
          <select class="form-control select2 supplier_id" required="" name="supplier_id">
            <option value="">-select-</option>
            <?php 
                $suppliers = getSuppliers();
                if(!empty($suppliers)){
                    foreach($suppliers as $key=>$row){?>
                      <option <?php echo (isset($model->supplier_id) && $model->supplier_id == $row->id) ? 'selected':''; ?> value="<?php echo isset($row->id) ? $row->id:''; ?>">
                          <?php echo isset($row->supplier_name) ? $row->supplier_name:''; ?>
                      </option>
            <?php } } ?>
          </select>
        </div>
        <div class="col-sm-1">
          <a href="#" style="margin-top: 31px;" class="btn btn-info" title="Add New Supplier"><i class="fa fa-plus"></i></a>
        </div>
        <div class="col-sm-3">
          <label for="#" class="mr-sm-2">Driver(Truck) Name</label>
          <select class="form-control select2" required="" name="driver_id">
            <option value="">-select-</option>
            <?php 
                $drivers = getDrivers();
                if(!empty($drivers)){
                    foreach($drivers as $key=>$row){?>
                      <option <?php echo (isset($model->driver_id) && $model->driver_id == $row->id) ? 'selected':''; ?> value="<?php echo isset($row->id) ? $row->id:''; ?>">
                          <?php echo isset($row->driver_name) ? $row->driver_name:''; ?>
                      </option>
            <?php } } ?>
          </select>
        </div>
        <div class="col-sm-1">
          <a href="#" style="margin-top: 31px;" class="btn btn-info" title="Add New Drvier"><i class="fa fa-plus"></i></a>
        </div>
      </div>
      <div class="row" style="margin-top: 46px;">
        <div class="col-sm-12">
          <table class="table table-striped table-sm card-text table-bordered text-center track_table">
            <thead class="bg-light">
              <tr>
                <th>Sr.No</th>
                <th style="width: 354px;">Customer</th>
                <th>Bility#</th>
                <th>Bility Desc</th>
                <th>Qty</th>
                <th>Price</th>
                <th>Unloading Exp</th>
                <th>Expenses</th>
                <th>Total</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <?php
                if(!empty($detail)){
                  foreach($detail as $index=>$value){?>
                        <tr>
                  <td><?php echo $index+1; ?></td>
                  <td style="position: relative;">
                    <select style="width: 276px;" class="form-control customer_data select2" required="" name="detail[<?php echo $index ?>][customer_id]">
                        <option value="">-select-</option>
                        <?php 
                          $customers = getCustomers();
                          if(!empty($customers)){
                              foreach($customers as $key=>$row){?>
                                <option data-unloading_exp="<?php echo isset($row->unloading_expenses) ? $row->unloading_expenses:''; ?>" <?php echo (isset($value->customer_id) && $value->customer_id == $row->id) ? 'selected':''; ?> value="<?php echo isset($row->id) ? $row->id:''; ?>">
                                    <?php echo isset($row->customer_name) ? $row->customer_name:''; ?>
                                </option>
                        <?php } } ?>
                    </select>
                    <a href="#" style="top: 11px;position: absolute;left: 320px" class="btn btn-info btn-xs" title="Add New Customer"><i class="fa fa-plus"></i></a>
                  </td>
                  <td>
                    <input type="text" value="<?php echo isset($value->bility_no) ? $value->bility_no:''; ?>" required="" class="form-control" name="detail[<?php echo $index ?>][bility_no]">
                  </td>
                  <td>
                    <input type="text" value="<?php echo isset($value->bility_desc) ? $value->bility_desc:''; ?>" class="form-control" name="detail[<?php echo $index ?>][bility_desc]">
                  </td>
                  <td>
                    <input type="text" value="<?php echo isset($value->qty) ? $value->qty:''; ?>" required="" class="form-control qty" name="detail[<?php echo $index ?>][qty]">
                  </td>
                  <td>
                    <input type="text" value="<?php echo isset($value->price) ? $value->price:''; ?>" required="" class="form-control price" name="detail[<?php echo $index ?>][price]">
                  </td>
                  <td>
                    <input type="text" value="<?php echo isset($value->unloading_expenses) ? $value->unloading_expenses:''; ?>" class="form-control unloading_expenses" name="detail[<?php echo $index ?>][unloading_expenses]">
                  </td>
                  <td>
                    <input type="text" value="<?php echo isset($value->expenses) ? $value->expenses:''; ?>" class="form-control expenses" name="detail[<?php echo $index ?>][expenses]">
                  </td>
                  <td>
                    <input type="text" value="<?php echo isset($value->total) ? $value->total:''; ?>" required="" class="form-control total" name="detail[<?php echo $index ?>][total]">
                  </td>
                  <td>
                    <a href="#" class="btn btn-info btn-xs addNewRow"><i class="fa fa-plus"></i></a>
                  </td>
                </tr>
              <?php } }else{ ?>
              <tr>
                <td>1</td>
                <td style="position: relative;">
                  <select style="width: 276px;" class="form-control customer_data select2" required="" name="detail[0][customer_id]">
                      <option value="">-select-</option>
                      <?php 
                        $customers = getCustomers();
                        if(!empty($customers)){
                            foreach($customers as $key=>$row){?>
                              <option data-unloading_exp="<?php echo isset($row->unloading_expenses) ? $row->unloading_expenses:''; ?>" value="<?php echo isset($row->id) ? $row->id:''; ?>">
                                  <?php echo isset($row->customer_name) ? $row->customer_name:''; ?>
                              </option>
                      <?php } } ?>
                  </select>
                  <a href="#" style="top: 11px;position: absolute;left: 320px" class="btn btn-info btn-xs" title="Add New Customer"><i class="fa fa-plus"></i></a>
                </td>
                <td>
                  <input type="text" value="" required="" class="form-control" name="detail[0][bility_no]">
                </td>
                <td>
                  <input type="text" value="" class="form-control" name="detail[0][bility_desc]">
                </td>
                <td>
                  <input type="text" value="" required="" class="form-control qty" name="detail[0][qty]">
                </td>
                <td>
                  <input type="text" value="" required="" class="form-control price" name="detail[0][price]">
                </td>
                <td>
                  <input type="text" value="" class="form-control unloading_expenses" name="detail[0][unloading_expenses]">
                </td>
                <td>
                  <input type="text" value="" class="form-control expenses" name="detail[0][expenses]">
                </td>
                <td>
                  <input type="text" value="" required="" class="form-control total" name="detail[0][total]">
                </td>
                <td>
                  <a href="#" class="btn btn-info btn-xs addNewRow"><i class="fa fa-plus"></i></a>
                </td>
              </tr>
            <?php } ?>
            </tbody>
          </table>
        </div>
      </div>
      <div class="row" style="margin-top: 46px;">
          <div class="col-sm-2">
            <div class="form-group">
                <label>Subtotal</label>
                <input type="text" class="form-control subtotal" value="<?php echo isset($model->subtotal) ? $model->subtotal:''; ?>" name="subtotal">
            </div>
          </div>
          <div class="col-sm-2">
            <div class="form-group">
                <label>Commission(%)</label>
                <input type="text" class="form-control commission_percentage" value="<?php echo isset($model->commission_percentage) ? $model->commission_percentage:''; ?>" name="commission_percentage">
                <input type="hidden" class="form-control commission" name="commission" value="<?php echo isset($model->commission) ? $model->commission:''; ?>">
            </div>
          </div>
          <div class="col-sm-2">
            <div class="form-group">
                <label>Damages</label>
                <input type="text" class="form-control damages" value="<?php echo isset($model->damages) ? $model->damages:''; ?>" name="damages">
            </div>
          </div>
          <div class="col-sm-2">
            <div class="form-group">
                <label>Damages Detail</label>
                <input type="text" class="form-control" value="<?php echo isset($model->damages_detail) ? $model->damages_detail:''; ?>" name="damages_detail">
            </div>
          </div>
          <div class="col-sm-2">
            <div class="form-group">
                <label>Total</label>
                <input type="text" class="form-control grand_total" value="<?php echo isset($model->total) ? $model->total:''; ?>" name="total">
            </div>
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
<script type="text/javascript">
  document.addEventListener('DOMContentLoaded',function(){
  	  $('body').on('change','.customer_data',function(event){
  	  	var unloading_expenses = $(this).find(':selected').attr('data-unloading_exp');
  	  	var element = $(this).closest('tr').find('.unloading_expenses').val(unloading_expenses);
  	  });
      $('body').on('click','.addNewRow',function(event){
        event.preventDefault();
        var body = $('body');
        var index = body.find('.track_table').find('tbody').find('tr').length;
        var length  = parseFloat(index + 1);
        var customer_html = body.find('.customer_data').html();
        var tr_html = '';
        tr_html+='<tr>';
          tr_html+='<td>'+length+'</td>';
          tr_html+='<td style="position: relative;">';
            tr_html+='<select style="width: 276px;" required="" class="form-control select2" name="detail['+index+'][customer_id]">';
              tr_html+=customer_html;
            tr_html+='</select>';
            tr_html+='<a href="#" style="top: 11px;position: absolute;left: 320px" class="btn btn-info btn-xs" title="Add New Customer"><i class="fa fa-plus"></i></a>';
            tr_html+='</td>';
          tr_html+='<td><input type="text" value="" class="form-control" name="detail['+index+'][bility_no]"></td>';
          tr_html+='<td><input type="text" value="" class="form-control" name="detail['+index+'][bility_desc]"></td>';
          tr_html+='<td><input type="text" value="" required="" class="form-control qty" name="detail['+index+'][qty]"></td>';
          tr_html+='<td><input type="text" value="" required="" class="form-control price" name="detail['+index+'][price]"></td>';
          tr_html+='<td><input type="text" value="" class="form-control unloading_expenses" name="detail['+index+'][unloading_expenses]"></td>';
          tr_html+='<td><input type="text" value="" class="form-control expenses" name="detail['+index+'][expenses]"></td>';
          tr_html+='<td><input type="text" value="0" required="" class="form-control total" name="detail['+index+'][total]"></td>';
          tr_html+='<td><a href="#" class="btn btn-danger btn-xs delete_tr"><i class="fa fa-trash"></i></a></td>';
        tr_html+='</tr>';
        body.find('.track_table').find('tbody').append(tr_html);
        body.find('.select2').select2();
      });
      $('body').on('click','.delete_tr',function(event){
        event.preventDefault();
        $(this).closest('tr').remove();
      });
      $('body').on('change','.supplier_id',function(event){
      	event.preventDefault();
      	var body = $('body');
      	var supplier_id  = $(this).find(':selected').val();
      	if(supplier_id)
      	{
      		$.ajax({
      			url:'<?php echo base_url() ?>admin/suppliers/getSuppliersDetail/'+supplier_id,
      			type:'GET',
      			success:function(response)
      			{
      				var result = jQuery.parseJSON(response);
      				var detail = result.detail;
      				var commmission = (detail.commission_percentage && detail.commission_percentage > 0) ? detail.commission_percentage : 0;
      				body.find('.commission_percentage').val(commmission);
      				calculateTotal();
      			}
      		});
      	}
      });
      $('body').on('keyup','.qty',function(event){
      	var element = $(this);
      	calculateRowValue(element);
      });
      $('body').on('keyup','.price',function(event){
      	var element = $(this);
      	calculateRowValue(element);
      });
      $('body').on('keyup','.unloading_expenses',function(event){
      	var element = $(this);
      	calculateRowValue(element);
      });
      $('body').on('keyup','.expenses',function(event){
      	var element = $(this);
      	calculateRowValue(element);
      });
      $('body').on('keyup','.commission_percentage',function(event){
      	calculateTotal();
      });
      $('body').on('keyup','.damages',function(event){
        calculateTotal();
      });
      var calculateRowValue = function(element)
      {
      	var rowTotal = 0;
      	var parent = element.closest('tr');
      	var qty = parent.find('.qty').val();
      	var price = parent.find('.price').val();
      	var unloading_expenses = parent.find('.unloading_expenses').val();
      	var expenses = parent.find('.expenses').val();
      	qty = (qty && qty > 0) ? qty:0;
      	price = (price && price > 0) ? price:0;
      	unloading_expenses = (unloading_expenses && unloading_expenses > 0) ? unloading_expenses:0;
      	expenses = (expenses && expenses > 0) ? expenses:0;
      	// rowTotal = parseFloat(qty) * parseFloat(price);
      	rowTotal = parseFloat(price);
      	rowTotal = parseFloat(rowTotal) + parseFloat(unloading_expenses);
      	rowTotal = parseFloat(rowTotal) + parseFloat(expenses);
      	parent.find('.total').val(rowTotal);
      	calculateTotal();
      }
      var calculateTotal = function()
      {
      	var body = $('body');
      	var subtotal = 0;
      	var grand_total = 0;
        var commission = 0;
      	var damages = 0;
      	var tr = body.find('.track_table').find('tbody').find('tr');
      	tr.each(function(){
      		var element = $(this);
      		var total = element.find('.price').val();
      		total = (total && total > 0) ? total:0;
      		subtotal = parseFloat(subtotal) + parseFloat(total);
      	});
      	body.find('.subtotal').val(subtotal);
        var commission_percentage = body.find('.commission_percentage').val();
      	damages = body.find('.damages').val();
        damages = (damages && damages > 0) ? damages:0;
      	commission_percentage = (commission_percentage && commission_percentage > 0) ? commission_percentage:0;
      	commission = parseFloat(subtotal/100) * parseFloat(commission_percentage);
      	commission = parseFloat(commission).toFixed(2);
        grand_total = parseFloat(subtotal) - parseFloat(commission);
      	grand_total = parseFloat(grand_total) - parseFloat(damages);
      	grand_total = parseFloat(grand_total).toFixed(2);
      	body.find('.grand_total').val(grand_total);
      	body.find('.commission').val(commission);
      }
  },false);
</script>
