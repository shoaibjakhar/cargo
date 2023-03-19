<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Riders extends NN_Controller{
	function __construct()
	{
		parent::__construct();
		if(!$this->isLoggedIn())
			redirect(base_url('login'));
	}
	public function riders_list()
	{
		$data['active']='riders_list';
		$data['allData']=$this->common_model->getAll('riders',null,array('id','desc'));
		$data['content'] = 'admin/pages/riders/riders_list';
		$this->load->view('admin/layout/master',$data);
	}
	public function add_riders($id=null)
	{
		$data['active']='add_riders';
		if($this->input->post())
		{
			$formData = $this->input->post();
			$id = isset($formData['id']) ? $formData['id']:'';
			$formData['user_id']=$this->current_user_id;
			if($id)
			{
				$update=$this->common_model->update('riders',array('id'=>$id),$formData);
				if($update)
				{
					$this->session->set_userdata('success','Updated Successfully!');
				}
				else
				{
					$this->session->set_userdata('errors','Data Not Updated!');
				}
				redirect(base_url('admin/riders/riders_list'));
			}
			else
			{
				$saved=$this->common_model->insert('riders',$formData);
			 	if($saved){
					$this->session->set_userdata('success','New rider created successfully!');
				}
				else{
					$this->session->set_userdata('errors','Data Not Inserted!');
				}
				redirect($_SERVER['HTTP_REFERER']);
			}
		}
		if($id!=null)
		{
			$data['model'] = $this->common_model->getOne('riders',array('id'=>$id));
		}
		$data['allData'] = $this->common_model->getAll('riders',null,array('id','desc'));
		$data['content'] = 'admin/pages/riders/add_riders';
		$this->load->view('admin/layout/master',$data);
	}
	public function delete_riders($id=null)
	{
		$id=array('id'=>$id);
		$deleted=$this->common_model->delete('riders',$id);
		if($deleted)
		{
			$response['success']='Deleted Successfully';
			$response['response']=1;
	        echo json_encode($response);exit();
		}
	}
	public function delivery()
	{
		$data['active']='delivery';
		$data['content'] = 'admin/pages/deliveries/delivery';
		$this->load->view('admin/layout/master',$data);
	}
	public function assign_delivery()
	{
		$data['active']='assign_delivery';
		$data['bilities']=$this->common_model->universal("SELECT id,bility_no FROM orders_detail WHERE is_assigned = 0")->result();
		$data['content'] = 'admin/pages/deliveries/assign_delivery';
		$this->load->view('admin/layout/master',$data);
	}
	public function assigned_deliveries()
	{
		$data['active']='assigned_deliveries';
		$data['content'] = 'admin/pages/deliveries/assigned_deliveries';
		$this->load->view('admin/layout/master',$data);
	}
	public function getAssignedDeliveries()
	{
		$this->load->model('deliveries_pagination_model');
		$where=array('orders_detail.is_assigned'=>1,'status'=>1);
        $data = $row = array();
        $column_order = array('orders_detail.id','orders_detail.customer_id','orders_detail.rider_id','customers.customer_name','riders.rider_name','orders_detail.bility_no','orders_detail.bility_desc','orders_detail.qty','orders_detail.price','orders_detail.unloading_expenses','orders_detail.expenses','orders_detail.total','orders_detail.created_at');
        $column_search = array('orders_detail.id','orders_detail.customer_id','orders_detail.rider_id','customers.customer_name','riders.rider_name','orders_detail.bility_no','orders_detail.bility_desc','orders_detail.qty','orders_detail.price','orders_detail.unloading_expenses','orders_detail.expenses','orders_detail.total','orders_detail.created_at');
        $order = array('orders_detail.id' => 'desc');
        $memData = $this->deliveries_pagination_model->getRows('orders_detail',$_POST,$column_order,$column_search,$order,$where);
        $i = $_POST['start'];
        foreach($memData as $value){
            $i++;
            $customer_name=isset($value->customer_name) ? $value->customer_name :'';
            $rider_name=isset($value->rider_name) ? $value->rider_name :'';
            $bility_no=isset($value->bility_no) ? $value->bility_no:'';
            $discount='<input type="text" class="discount" name="discount['.$i.']">';
            $payment='<input type="text" class="payment" name="payment['.$i.']">';
            $total=isset($value->total) ? $value->total:0;
            $total = '<span class="total">'.$total.'</span>';
            $created_at=isset($value->created_at) ? date('M d,Y',strtotime($value->created_at)) :'';
            $action='';
        	$action.='<a href="'.base_url().'admin/payments/delivered_status" data-id="'.$value->id.'" data-status="Delivered" class="btn btn-info btn-xs confirm_status">Delivered</a>';
        	$action.='<a href="'.base_url().'admin/orders/update_status/'.$value->id.'/3" data-status="Not Delivered" class="btn btn-warning btn-xs confirm_status">Not Delivered</a>';
            $data[] = array($i,$created_at,$customer_name,$rider_name,$bility_no,$total,$payment,$discount,$action);
        }
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->deliveries_pagination_model->countAll('orders_detail',$where),
            "recordsFiltered" => $this->deliveries_pagination_model->countFiltered('orders_detail',$_POST,$column_order,$column_search,$order,$where),
            "data" => $data,
        );
        echo json_encode($output);exit();
	}
	public function assign_new_delivery()
	{
		if($this->input->post())
		{
			$post_data = $this->input->post();
			$rider_id=isset($post_data['rider_id']) ? $post_data['rider_id']:'';
			if(!empty($post_data['detail']))
			{
				$detail = isset($post_data['detail']) ? $post_data['detail']:'';
				$update = '';
				foreach($detail as $key=>$row)
				{
					$update_data =[];
					$id = isset($row['id']) ? $row['id']:'';
					$update_data['rider_id'] = isset($rider_id) ? $rider_id:'';
					$update_data['is_assigned'] = 1;
					$update=$this->common_model->update('orders_detail',array('id'=>$id),$update_data);
				}
				if($update)
				{
					$this->session->set_userdata('success','Updated Successfully!');
				}
				else
				{
					$this->session->set_userdata('errors','Data Not Updated!');
				}
				redirect(base_url('admin/riders/assign_delivery'));
			}
		}
	}
	public function searchByBilityNo()
	{
		$post_data = $this->input->post();
		$response = [];
		$id = isset($post_data['id']) ? $post_data['id']:'';
		if($id)
		{
			$detail = $this->common_model->getOne('orders_detail',array('id'=>$id,'is_assigned'=>0));
			if(isset($detail->customer_id))
			{
				$customer_data = getCustomers($detail->customer_id);
				$detail->customer_name = isset($customer_data->customer_name) ? $customer_data->customer_name:'';
			}
			$response['detail'] = $detail;
		}
		echo json_encode($response);exit();
	}
}
?>