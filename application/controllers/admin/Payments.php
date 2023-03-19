<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Payments extends NN_Controller{
	function __construct(){
		parent::__construct();
		if(!$this->isLoggedIn())
			redirect(base_url('login'));
	}
	public function index()
	{
		$data['active']='payment';
		$data['content'] = 'admin/pages/payments/payment';
		$this->load->view('admin/layout/master',$data);
	}
	public function getDelivered()
	{
		$this->load->model('deliveries_pagination_model');
		$where=array('orders_detail.is_assigned'=>1,'status'=>DELIVERED_STATUS_ID,'orders_detail.payment_status'=>0);
        $data = $row = array();
        $column_order = array('orders_detail.id','orders_detail.customer_id','orders_detail.rider_id','customers.customer_name','riders.rider_name','orders_detail.bility_no','orders_detail.bility_desc','orders_detail.qty','orders_detail.price','orders_detail.unloading_expenses','orders_detail.expenses','orders_detail.total','orders_detail.status','orders_detail.created_at');
        $column_search = array('orders_detail.id','orders_detail.customer_id','orders_detail.rider_id','customers.customer_name','riders.rider_name','orders_detail.bility_no','orders_detail.bility_desc','orders_detail.qty','orders_detail.price','orders_detail.unloading_expenses','orders_detail.expenses','orders_detail.total','orders_detail.status','orders_detail.created_at');
        $order = array('orders_detail.id' => 'desc');
        $memData = $this->deliveries_pagination_model->getRows('orders_detail',$_POST,$column_order,$column_search,$order,$where);
        $i = $_POST['start'];
        foreach($memData as $value){
            $i++;
            $customer_name=isset($value->customer_name) ? $value->customer_name :'';
            $rider_name=isset($value->rider_name) ? $value->rider_name :'';
            $bility_no=isset($value->bility_no) ? $value->bility_no:'';
            $total=isset($value->total) ? $value->total:'';
            $due_balance = getOrderDueBalance($value->id);
            $paid = getOrderTotalPaidAmount($value->id);
            $previou_discount = getOrderTotalDiscount($value->id);
            $total_payable = ($due_balance && $due_balance > 0) ? $due_balance:$total;
            $total_payable='<span class="total_payable">'.$total_payable.'</span>';
            $created_at=isset($value->created_at) ? date('M d,Y',strtotime($value->created_at)) :'';
            $discount='<input type="text" class="discount" name="discount['.$i.']">';
            $payment='<input type="text" class="payment" name="payment['.$i.']">';

            $status_detail=getStatusDetail($value->status);
            $status_name = isset($status_detail->name) ? $status_detail->name:'';
            $status_color = isset($status_detail->color) ? $status_detail->color:'';
            $status='<a href="javascript:void(0)" class="btn '.$status_color.' btn-xs">'.$status_name.'</a>';
            $action='<a href="'.base_url().'admin/payments/payNow" data-id="'.$value->id.'" class="btn btn-primary btn-xs pay_now">Pay Now</a>';
            $data[] = array($i,$created_at,$customer_name,$rider_name,$bility_no,$total,$paid,$previou_discount,$due_balance,$total_payable,$payment,$discount, $status,$action);
        }
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->deliveries_pagination_model->countAll('orders_detail',$where),
            "recordsFiltered" => $this->deliveries_pagination_model->countFiltered('orders_detail',$_POST,$column_order,$column_search,$order,$where),
            "data" => $data,
        );
        echo json_encode($output);exit();
	}
	public function payNow()
	{
		$post_data = $this->input->post();
		$response=[];
        $result = addPayment($post_data);
        if($result['response'] == 1)
        {
            $response['success']='Done Successfully';
            $response['response']=1;
        }
        else
        {
            $response['errors']='Erorr try again!';
            $response['response']=0;
        }
        echo json_encode($response);exit();
	}
    public function delivered_status()
    {
        $response=[];
        $post_data = $this->input->post();
        $id = isset($post_data['id']) ? $post_data['id']:'';
        $payment = isset($post_data['payment']) ? $post_data['payment']:0;
        $status = DELIVERED_STATUS_ID;
        if($payment > 0)
        {
            $result = addPayment($post_data);
        }
        $where=array('id'=>$id);
        $update=$this->common_model->update('orders_detail',$where,array('status'=>$status));
        if($update)
        {
            $response['success']='Done Successfully';
            $response['response']=1;
            echo json_encode($response);exit();
        }
    }
}