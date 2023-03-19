<?php
if(!function_exists('debug')){
	function debug($data=null){
		if($data!=null){
			 echo '<pre>',print_r($data),'</pre>';
			 exit();
		}else{
			exit();
		}
	}
}
function addPayment($post_data='')
{
	$CI=& get_instance();
    $response=[];
	if(!empty($post_data))
	{
		$id = isset($post_data['id']) ? $post_data['id']:'';
		$orders_detail = $CI->common_model->getOne('orders_detail',array('id'=>$id));
        $discount = (isset($post_data['discount']) && $post_data['discount'] > 0) ? str_replace(',','',$post_data['discount']):0;
        $payment = (isset($post_data['payment']) && $post_data['payment'] > 0) ? str_replace(',','',$post_data['payment']):0;
        $total_payable = (isset($post_data['total_payable']) && $post_data['total_payable'] > 0) ? str_replace(',','',$post_data['total_payable']):0;
        $balance_due = ($total_payable) - ($payment + $discount);
        $transactions = [];
        $transactions['user_id'] = $CI->current_user_id;
        $transactions['order_master_id'] = isset($orders_detail->master_id) ? $orders_detail->master_id:'';
        $transactions['order_detail_id'] = isset($orders_detail->id) ? $orders_detail->id:'';
        $transactions['customer_id'] = isset($orders_detail->customer_id) ? $orders_detail->customer_id:'';
        $transactions['rider_id'] = isset($orders_detail->rider_id) ? $orders_detail->rider_id:'';
        $transactions['bility_no'] = isset($orders_detail->bility_no) ? $orders_detail->bility_no:'';
        $transactions['total'] = isset($orders_detail->total) ? $orders_detail->total:0;
        $transactions['total_payable'] = isset($total_payable) ? $total_payable:0;
        $transactions['payment'] = isset($payment) ? $payment:0;
        $transactions['credit'] = isset($payment) ? $payment:0;
        $transactions['discount'] = isset($discount) ? $discount:0;
        $transactions['due_balance'] = isset($balance_due) ? $balance_due:0;
        $saved = $CI->common_model->add('transactions',$transactions);
        if($saved)
        {
            if($transactions['due_balance'] <= 0)
            {
                $CI->common_model->update('orders_detail',array('id'=>$id),array('payment_status'=>1));
                $CI->common_model->update('orders_master',array('id'=>$orders_detail->master_id),array('payment_status'=>1));
            }
            $response['response']=1;
        }
        else
        {
            $response['response']=0;
        }
	}
	return $response;
}
function getExpensesHead($id=null)
{
	$CI=& get_instance();
	$data = '';
	if($id!=null)
	{
		$row=$CI->common_model->universal("SELECT name FROM expenses_head WHERE id=$id")->row();
		$data = isset($row->name) ? $row->name:0;
	}
	return $data;
}
function getOrderDueBalance($id=null)
{
	$CI=& get_instance();
	$data = '';
	if($id!=null)
	{
		$row=$CI->common_model->universal("SELECT due_balance FROM transactions WHERE order_detail_id=$id ORDER BY id DESC LIMIT 1")->row();
		$data = isset($row->due_balance) ? $row->due_balance:0;
	}
	return $data;
}
function getOrderTotalPaidAmount($id=null)
{
	$CI=& get_instance();
	$data = '';
	if($id!=null)
	{
		$row=$CI->common_model->universal("SELECT SUM(payment) AS total FROM transactions WHERE order_detail_id=$id")->row();
		$data = isset($row->total) ? $row->total:0;
	}
	return $data;
}
function getOrderTotalDiscount($id=null)
{
	$CI=& get_instance();
	$data = '';
	if($id!=null)
	{
		$row=$CI->common_model->universal("SELECT SUM(discount) AS total FROM transactions WHERE order_detail_id=$id")->row();
		$data = isset($row->total) ? $row->total:0;
	}
	return $data;
}
function getStatusDetail($id=null)
{
	$CI=& get_instance();
	$data = '';
	if($id!=null)
	{
		$data=$CI->common_model->getOne('status_names',array('id'=>$id));
	}
	return $data;
}
function getProfilePicture($id)
{
	$CI=& get_instance();
	$Profile_image=$CI->common_model->getById('users',$id);
	return $Profile_image;
}
function in_multi_array($value, $array, $field = null) {
	foreach ($array as $obj) {
		$obj = (object)$obj;
		if(isset($obj->$field) && $value == $obj->$field)
			return true;
	}
	return false;
}
function array_multi_search($value, $array, $field = 'id') {
	foreach ($array as $index => $obj) {
		if(isset($obj->$field) && $value == $obj->$field)
			return $index;
	}
	return -1;
}
if(!function_exists('getTotalSuppliers'))
{
	function getTotalSuppliers()
	{
		$CI=& get_instance();
		$data = $CI->db->query("SELECT count(id) AS total FROM suppliers")->row();
		return isset($data->total) ? $data->total:0;
	}
}
if(!function_exists('getTotalDrivers'))
{
	function getTotalDrivers()
	{
		$CI=& get_instance();
		$data = $CI->db->query("SELECT count(id) AS total FROM drivers")->row();
		return isset($data->total) ? $data->total:0;
	}
}
if(!function_exists('getTotalCustomers'))
{
	function getTotalCustomers()
	{
		$CI=& get_instance();
		$data = $CI->db->query("SELECT count(id) AS total FROM customers")->row();
		return isset($data->total) ? $data->total:0;
	}
}
if(!function_exists('getRiders'))
{
	function getRiders($id=null)
	{
		$CI=& get_instance();
		$data = [];
		if($id!=null)
		{
			$data=$CI->db->select()->from('riders')->where('id',$id)->get()->row();
		}
		else
		{
			$data=$CI->db->select()->from('riders')->order_by('id',"desc")->get()->result();
		}
		return $data;
	}
}
if(!function_exists('getDrivers'))
{
	function getDrivers($id=null)
	{
		$CI=& get_instance();
		$data = [];
		if($id!=null)
		{
			$data=$CI->db->select()->from('drivers')->where('id',$id)->get()->row();
		}
		else
		{
			$data=$CI->db->select()->from('drivers')->order_by('id',"desc")->get()->result();
		}
		return $data;
	}
}
if(!function_exists('getSuppliers'))
{
	function getSuppliers($id=null)
	{
		$CI=& get_instance();
		$data = [];
		if($id!=null)
		{
			$data=$CI->db->select()->from('suppliers')->where('id',$id)->get()->row();
		}
		else
		{
			$data=$CI->db->select()->from('suppliers')->order_by('id',"desc")->get()->result();
		}
		return $data;
	}
}
if(!function_exists('getCustomers'))
{
	function getCustomers($id=null)
	{
		$CI=& get_instance();
		$data = [];
		if($id!=null)
		{
			$data=$CI->db->select()->from('customers')->where('id',$id)->get()->row();
		}
		else
		{
			$data=$CI->db->select()->from('customers')->order_by('id',"desc")->get()->result();
		}
		return $data;
	}
}
if(!function_exists('generalSettings'))
{
	function generalSettings()
	{
		$CI=& get_instance();
		$data=$CI->db->select()->from('general_settings')->order_by('id',"desc")->limit(1)->get()->row();
		return $data;
	}
}
if(!function_exists('showFlash'))
{
	function showFlash(){
		$CI=& get_instance();
	  	$error = $CI->session->userdata('errors');
	 	$success = $CI->session->userdata('success');
		 if($error){
		    echo '<div class="alert alert-danger alert-dismissable"> ';
		    echo '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
		    print_r($error);
		    echo'</div>';
		    unset($_SESSION['errors']);
	  	}else if($success) {
	      	echo '<div class="alert alert-success alert-dismissable"> ';
	      	echo '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
	      	print_r($success);
	      
	      	echo'</div>';
	      	unset($_SESSION['success']);
	  	}
	} 
}
if(!function_exists('sendEmail')){
	function sendEmail($to = null, $from = null, $subject = null, $data = array()) {
		$CI=& get_instance();
		if($to != null) {

			// $config = Array(   
	  //           'protocol' => 'mail',
	  //           'smtp_host' => '',
	  //           'smtp_port' => 587,
	  //           'smtp_user' => '',
	  //           'smtp_pass' => '',
	  //           'smtp_timeout' => '7',
	  //           'mailtype'  => 'html', 
	  //       );
	        if($from == null){
	        	$from = 'info@newmagendavid.com';
	        }
			$CI->load->library('email');
			 // $CI->email->initialize($config);
	        $CI->email->from($from);
	        $CI->email->to($to);
	        $CI->email->subject($subject);
	        $body = isset($data['message']) ? $data['message'] : null;
	        // debug($data);


	        // $body = $CI->load->view('admin/emails/email_templates/action.php',$data,TRUE);
	        $CI->email->message($body);
	        return $CI->email->send();
        }

        return false;
	}
}
?>
