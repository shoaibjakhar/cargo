<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Orders extends NN_Controller{
	function __construct(){
		parent::__construct();
		if(!$this->isLoggedIn())
			redirect(base_url('login'));
	}
	public function index($id=null)
	{
		$data['active']='receive_truck';
		if($id!=null)
		{
			$data['model']=$this->common_model->getOne('orders_master',array('id'=>$id));
			$data['detail']=$this->common_model->getAll('orders_detail',array('master_id'=>$id));
		}
		$data['content'] = 'admin/pages/orders/receive_truck';
		$this->load->view('admin/layout/master',$data);
	}
	public function order_list()
	{
		$data['active']='order_list';
		$data['content'] = 'admin/pages/orders/order_list';
		$this->load->view('admin/layout/master',$data);
	}
	public function receive_truck()
	{
		if($this->input->post())
		{
			$post_data = $this->input->post();
			$id = isset($post_data['id']) ? $post_data['id']:'';
			$detail = isset($post_data['detail']) ? $post_data['detail']:'';
			unset($post_data['detail']);
			$post_data['user_id'] = $this->current_user_id;
			$post_data['created_at'] = date('Y-m-d H:i:s');
			if($id)
			{
				$update=$this->common_model->update('orders_master',array('id'=>$id),$post_data);
				$this->common_model->delete('orders_detail',array('master_id'=>$id));
				if(!empty($detail))
				{
					foreach($detail as $key=>$row)
					{
						$row['master_id'] = $id;
						$row['user_id'] = $this->current_user_id;
						$row['created_at'] = date('Y-m-d H:i:s');
						$this->common_model->insert('orders_detail',$row);
					}
				}
				if($update)
				{
					$this->session->set_userdata('success','Updated Successfully!');
				}
				else
				{
					$this->session->set_userdata('errors','Data Not Updated!');
				}
				redirect(base_url('admin/orders/index'));
			}
			else
			{
				$saved_master = $this->common_model->insert('orders_master',$post_data);
				if($saved_master)
				{
					if(!empty($detail))
					{
						foreach($detail as $key=>$row)
						{
							$row['master_id'] = $saved_master;
							$row['user_id'] = $this->current_user_id;
							$row['created_at'] = date('Y-m-d H:i:s');
							$this->common_model->insert('orders_detail',$row);
						}
					}
					$this->session->set_userdata('success','Done successfully!');
				}
				else
				{
					$this->session->set_userdata('errors','Data Not Inserted!');
				}
				redirect($_SERVER['HTTP_REFERER']);
			}
		}
	}
	public function getOrderLists()
	{
		$this->load->model('ajax_pagination_model');
		$where=null;
        $data = $row = array();
        $column_order = array('orders_master.id','orders_master.supplier_id','orders_master.driver_id','suppliers.supplier_name','drivers.driver_name','orders_master.subtotal','orders_master.commission','orders_master.damages','orders_master.damages_detail','orders_master.total','orders_master.created_at');
        $column_search = array('orders_master.id','orders_master.supplier_id','orders_master.driver_id','suppliers.supplier_name','drivers.driver_name','orders_master.subtotal','orders_master.commission','orders_master.damages','orders_master.damages_detail','orders_master.total','orders_master.created_at');
        $order = array('orders_master.id' => 'desc');
        $memData = $this->ajax_pagination_model->getRows('orders_master',$_POST,$column_order,$column_search,$order,$where);
        $i = $_POST['start'];
        foreach($memData as $value){
            $i++;
            $supplier_name=isset($value->supplier_name) ? $value->supplier_name :'';
            $driver_name=isset($value->driver_name) ? $value->driver_name :'';
            $subtotal=isset($value->subtotal) ? $value->subtotal:'';
            $commission=isset($value->commission) ? $value->commission:'';
            $damages=isset($value->damages) ? $value->damages:'';
            $damages_detail=isset($value->damages_detail) ? $value->damages_detail:'';
            $total=isset($value->total) ? $value->total:'';
            $created_at=isset($value->created_at) ? date('M d,Y',strtotime($value->created_at)) :'';
            $action='';
        	$action.='<a href="'.base_url().'/admin/orders/index/'.$value->id.'" class="btn btn-info btn-xs"><i class="fa fa-edit"></i></a>';
        	$action.='<a href="'.base_url().'/admin/orders/delete_receive_truck/'.$value->id.'" class="btn btn-danger btn-xs delete_confirm"><i class="fa fa-trash"></i></a>';
            $data[] = array($i,$supplier_name,$driver_name,$subtotal,$commission,$damages,$damages_detail,$total,$created_at,$action);
        }
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->ajax_pagination_model->countAll('orders_master',$where),
            "recordsFiltered" => $this->ajax_pagination_model->countFiltered('orders_master',$_POST,$column_order,$column_search,$order,$where),
            "data" => $data,
        );
        echo json_encode($output);exit();
	}
	public function delete_receive_truck($id=null)
	{
		$where=array('id'=>$id);
		$deleted=$this->common_model->delete('orders_master',$where);
		if($deleted)
		{
			$this->common_model->delete('orders_detail',array('master_id'=>$id));
			$response['success']='Deleted Successfully';
			$response['response']=1;
	        echo json_encode($response);exit();
		}
	}
	public function update_status($id=null,$status = null)
	{
		$response=[];
		$where=array('id'=>$id);
		$update=$this->common_model->update('orders_detail',$where,array('status'=>$status));
		if($update)
		{
			if($status == NOT_DELIVERED_STATUS_ID)
			{
				$this->common_model->update('orders_detail',$where,array('is_assigned'=>0));
				$this->common_model->update('orders_detail',$where,array('status'=>1));
			}
			$response['success']='Done Successfully';
			$response['response']=1;
	        echo json_encode($response);exit();
		}
	}
	public function all_deliveries()
	{
		$data['active']='all_deliveries';
		$data['content'] = 'admin/pages/deliveries/all_deliveries';
		$this->load->view('admin/layout/master',$data);
	}
	public function getAllDeliveries()
	{
		$this->load->model('deliveries_pagination_model');
		$where=array('orders_detail.is_assigned'=>1);
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
            $created_at=isset($value->created_at) ? date('M d,Y',strtotime($value->created_at)) :'';
            $status_detail=getStatusDetail($value->status);
            $status_name = isset($status_detail->name) ? $status_detail->name:'';
            $status_color = isset($status_detail->color) ? $status_detail->color:'';
            $status='<a href="javascript:void(0)" class="btn '.$status_color.' btn-xs">'.$status_name.'</a>';
        	// $action.='<a href="'.base_url().'admin/orders/update_status/'.$value->id.'/1" data-status="Delivered" class="btn btn-info btn-xs confirm_status">Delivered</a>';
        	// $action.='<a href="'.base_url().'admin/orders/update_status/'.$value->id.'/2" data-status="Not Delivered" class="btn btn-warning btn-xs confirm_status">Not Delivered</a>';
            $data[] = array($i,$created_at,$customer_name,$rider_name,$bility_no,$total, $status);
        }
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->deliveries_pagination_model->countAll('orders_detail',$where),
            "recordsFiltered" => $this->deliveries_pagination_model->countFiltered('orders_detail',$_POST,$column_order,$column_search,$order,$where),
            "data" => $data,
        );
        echo json_encode($output);exit();
	}
	public function create_booking($id=null)
	{
		$data['active']='create_booking';
		if($this->input->post())
		{
			$formData = $this->input->post();
			$id = isset($formData['id']) ? $formData['id']:'';
			$formData['user_id']=$this->current_user_id;
			if($id)
			{
				$update=$this->common_model->update('booking',array('id'=>$id),$formData);
				if($update)
				{
					$this->session->set_userdata('success','Updated Successfully!');
				}
				else
				{
					$this->session->set_userdata('errors','Data Not Updated!');
				}
				redirect(base_url('admin/orders/create_booking'));
			}
			else
			{
				$saved=$this->common_model->insert('booking',$formData);
			 	if($saved){
					$this->session->set_userdata('success','New booking created successfully!');
				}
				else{
					$this->session->set_userdata('errors','Data Not Inserted!');
				}
				redirect($_SERVER['HTTP_REFERER']);
			}
		}
		if($id!=null)
		{
			$data['model'] = $this->common_model->getOne('booking',array('id'=>$id));
		}
		$data['content'] = 'admin/pages/booking/create_booking';
		$this->load->view('admin/layout/master',$data);
	}
	public function booking()
	{
		$data['active']='booking';
		$data['content'] = 'admin/pages/booking/booking';
		$this->load->view('admin/layout/master',$data);
	}
	public function getAllBookings()
	{
		$this->load->model('booking_pagination_model');
		$where=null;
        $data = $row = array();
        $column_order = array('booking.id','booking.sender_name','booking.sender_phone_number','booking.sender_cnic','booking.receiver_name','booking.receiver_phone_number','booking.receiver_cnic','booking.created_at');
        $column_search = array('booking.id','booking.sender_name','booking.sender_phone_number','booking.sender_cnic','booking.receiver_name','booking.receiver_phone_number','booking.receiver_cnic','booking.created_at');
        $order = array('booking.id' => 'desc');
        $memData = $this->booking_pagination_model->getRows('booking',$_POST,$column_order,$column_search,$order,$where);
        $i = $_POST['start'];
        foreach($memData as $value){
            $i++;
            $sender_name=isset($value->sender_name) ? $value->sender_name :'';
            $sender_phone_number=isset($value->sender_phone_number) ? $value->sender_phone_number :'';
            $sender_cnic=isset($value->sender_cnic) ? $value->sender_cnic:'';
            $receiver_name=isset($value->receiver_name) ? $value->receiver_name:'';
            $receiver_phone_number=isset($value->receiver_phone_number) ? $value->receiver_phone_number:'';
            $receiver_cnic=isset($value->receiver_cnic) ? $value->receiver_cnic:'';
            $total=isset($value->total) ? $value->total:'';
            $created_at=isset($value->created_at) ? date('M d,Y',strtotime($value->created_at)) :'';
            $action='';
        	$action.='<a href="'.base_url().'/admin/orders/create_booking/'.$value->id.'" class="btn btn-info btn-xs"><i class="fa fa-edit"></i></a>';
        	$action.='<a href="'.base_url().'/admin/orders/delete_booking/'.$value->id.'" class="btn btn-danger btn-xs delete_confirm"><i class="fa fa-trash"></i></a>';
            $data[] = array($i,$created_at,$sender_name,$sender_phone_number,$sender_cnic,$receiver_name,$receiver_phone_number,$receiver_cnic,$action);
        }
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->booking_pagination_model->countAll('booking',$where),
            "recordsFiltered" => $this->booking_pagination_model->countFiltered('booking',$_POST,$column_order,$column_search,$order,$where),
            "data" => $data,
        );
        echo json_encode($output);exit();
	}
	public function delete_booking($id=null)
	{
		$where=array('id'=>$id);
		$deleted=$this->common_model->delete('booking',$where);
		if($deleted)
		{
			$response['success']='Deleted Successfully';
			$response['response']=1;
	        echo json_encode($response);exit();
		}
	}
}