<?php $ci=& get_instance() ?>
<?php showFlash(); ?>
<div class="card">
  <div class="card-header">
    <div class="page-title d-flex">
      <h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">Assign Delivery</span></h4>
    </div>
  </div>
  <div class="card-body">
    <form action="<?php echo base_url('admin/riders/assign_new_delivery')?>" method="POST" enctype="multipart/form-data">
      <input type="hidden" name="id" value="<?php echo isset($model->id) ? $model->id :'';?>">
      <div class="row">
        <div class="col-sm-3">
          <label for="#" class="mr-sm-2">Delivery Sale Men</label>
          <select class="form-control select2 rider_id" required="" name="rider_id">
            <option value="">-select-</option>
            <?php 
                $riders = getRiders();
                if(!empty($riders)){
                    foreach($riders as $key=>$row){?>
                      <option <?php echo (isset($model->rider_id) && $model->rider_id == $row->id) ? 'selected':''; ?> value="<?php echo isset($row->id) ? $row->id:''; ?>">
                          <?php echo isset($row->rider_name) ? $row->rider_name:''; ?>
                      </option>
            <?php } } ?>
          </select>
        </div>
        <div class="col-sm-1">
          <a href="#" style="margin-top: 31px;" class="btn btn-info" title="Add New Rider"><i class="fa fa-plus"></i></a>
        </div>
        <div class="col-sm-3">
          <label for="#" class="mr-sm-2">Select Bility#</label>
          <select class="form-control select2 bility_no searchByBilityNo">
            <option value="">-select-</option>
            <?php 
                if(!empty($bilities)){
                    foreach($bilities as $key=>$row){?>
                      <option data-bility_no="<?php echo isset($row->bility_no) ? $row->bility_no:''; ?>" value="<?php echo isset($row->id) ? $row->id:''; ?>">
                          <?php echo isset($row->bility_no) ? $row->bility_no:''; ?>
                      </option>
            <?php } } ?>
          </select>
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
              <!-- <tr>
                <td>1</td>
                <td style="position: relative;">
                  <select style="width: 276px;" class="form-control customer_data select2" required="" name="detail[0][customer_id]">
                      <option value="">-select-</option>
                      <?php 
                        $customers = getCustomers();
                        if(!empty($customers)){
                            foreach($customers as $key=>$row){?>
                              <option value="<?php echo isset($row->id) ? $row->id:''; ?>">
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
              </tr> -->
            </tbody>
          </table>
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
      $('body').on('change','.searchByBilityNo',function(){
        var id = $(this).find(':selected').val();
        addNewRow(id);
        
      });
      var addNewRow = function(id = '')
      {
      	var body = $('body');
        var index = body.find('.track_table').find('tbody').find('tr').length;
        var length  = parseFloat(index + 1);
        var tr_html = '';
        if(id)
        {
          var checkId=body.find('.checkId_'+id).val();
          if(checkId == id)
          {
            swal.fire({
                title: 'Alert!',
                text: 'This bility no already added in the cart',
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Ok",
                closeOnConfirm: false
            }).then(()=> {
            });
            return false;
          }
        	$.ajax({
        		url:'<?php echo base_url() ?>admin/riders/searchByBilityNo',
        		type:'POST',
        		data:{id:id},
        		success:function(response)
        		{
        			var result = jQuery.parseJSON(response);
        			if(result.detail)
        			{
        				var detail = result.detail;
				        tr_html+='<tr>';
				          tr_html+='<td>'+length+'</td>';
				          tr_html+='<td>';
				          	tr_html+='<input type="hidden" readonly="true" value="'+detail.id+'" class="form-control checkId_'+detail.id+'" name="detail['+index+'][id]">';
                    tr_html+='<input type="hidden" readonly="true" value="'+detail.customer_id+'" class="form-control" name="detail['+index+'][customer_id]">';
				          	tr_html+='<input type="text" readonly="true" value="'+detail.customer_name+'" class="form-control">';
				          tr_html+='</td>';
				          tr_html+='<td>';
				          	tr_html+='<input type="text" readonly="true" value="'+detail.bility_no+'" class="form-control" name="detail['+index+'][bility_no]">';
				          tr_html+='</td>';
				          tr_html+='<td>';
				          	tr_html+='<input type="text" readonly="true" value="'+detail.bility_desc+'" class="form-control" name="detail['+index+'][bility_desc]">';
				          tr_html+='</td>';
				          tr_html+='<td>';
				          	tr_html+='<input type="text" readonly="true" value="'+detail.qty+'" required="" class="form-control qty" name="detail['+index+'][qty]">';
				          tr_html+='</td>';
				          tr_html+='<td>';
				         	 tr_html+='<input type="text" readonly="true" value="'+detail.price+'" required="" class="form-control price" name="detail['+index+'][price]">';
				          tr_html+='</td>';
				          tr_html+='<td>';
				          	tr_html+='<input type="text" readonly="true" value="'+detail.unloading_expenses+'" class="form-control unloading_expenses" name="detail['+index+'][unloading_expenses]">';
				          tr_html+='</td>';
				          tr_html+='<td>';
				          	tr_html+='<input type="text" readonly="true" value="'+detail.expenses+'" class="form-control expenses" name="detail['+index+'][expenses]">';
				          tr_html+='</td>';
				          tr_html+='<td>';
				          	tr_html+='<input type="text" readonly="true" value="'+detail.total+'" required="" class="form-control total" name="detail['+index+'][total]">';
				          tr_html+='</td>';
				          tr_html+='<td><a href="#" class="btn btn-danger btn-xs delete_tr"><i class="fa fa-trash"></i></a></td>';
				        tr_html+='</tr>';
				        body.find('.track_table').find('tbody').append(tr_html);
        			}
        		}
        	});


        }
        else
        {
        	alert('Please enter bility no');
        	return false;
        }

      }
      $('body').on('click','.delete_tr',function(event){
        event.preventDefault();
        $(this).closest('tr').remove();
      });
  },false);
</script>
