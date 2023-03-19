<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Customers extends NN_Controller{
	function __construct(){
		parent::__construct();
		if(!$this->isLoggedIn())
			redirect(base_url('login'));
	}
	public function customers_list()
	{
		$data['active']='customers_list';
		$data['allData']=$this->common_model->getAll('customers',null,array('id','desc'));
		$data['content'] = 'admin/pages/customers/customers_list';
		$this->load->view('admin/layout/master',$data);
	}
	public function add_customers($id=null)
	{
		$data['active']='add_customers';
		if($this->input->post())
		{
			$formData = $this->input->post();
			$id = isset($formData['id']) ? $formData['id']:'';
			$formData['user_id']=$this->current_user_id;
			if($id)
			{
				unset($formData['opening_balance']);
				$update=$this->common_model->update('customers',array('id'=>$id),$formData);
				if($update)
				{
					$this->session->set_userdata('success','Updated Successfully!');
				}
				else
				{
					$this->session->set_userdata('errors','Data Not Updated!');
				}
				redirect(base_url('admin/customers/add_customers'));
			}
			else
			{
				// $checkEmail = $this->common_model->getOne('customers',array('email'=>$formData['email']));
				// if(!empty($checkEmail))
				// {
				// 	$this->session->set_userdata('errors','This is email already exist try other one');
				// 	redirect($_SERVER['HTTP_REFERER']);
				// }
				$saved=$this->common_model->insert('customers',$formData);
			 	if($saved){
					$this->session->set_userdata('success','New customer created successfully!');
				}
				else{
					$this->session->set_userdata('errors','Data Not Inserted!');
				}
				redirect($_SERVER['HTTP_REFERER']);
			}
		}
		if($id!=null)
		{
			$data['model'] = $this->common_model->getOne('customers',array('id'=>$id));
		}
		$data['allData'] = $this->common_model->getAll('customers',null,array('id','desc'));
		$data['content'] = 'admin/pages/customers/customers';
		$this->load->view('admin/layout/master',$data);
	}
	public function delete_customer($id=null)
	{
		$id=array('id'=>$id);
		$deleted=$this->common_model->delete('customers',$id);
		if($deleted)
		{
			$response['success']='Deleted Successfully';
			$response['response']=1;
	        echo json_encode($response);exit();
		}
	}
}
?>