<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Drivers extends NN_Controller{
	function __construct(){
		parent::__construct();
		if(!$this->isLoggedIn())
			redirect(base_url('login'));
	}
	public function drivers_list()
	{
		$data['active']='drivers_list';
		$data['allData']=$this->common_model->getAll('drivers',null,array('id','desc'));
		$data['content'] = 'admin/pages/drivers/drivers_list';
		$this->load->view('admin/layout/master',$data);
	}
	public function add_drivers($id=null)
	{
		$data['active']='add_drivers';
		if($this->input->post())
		{
			$formData = $this->input->post();
			$id = isset($formData['id']) ? $formData['id']:'';
			$formData['user_id']=$this->current_user_id;
			if($id)
			{
				$update=$this->common_model->update('drivers',array('id'=>$id),$formData);
				if($update)
				{
					$this->session->set_userdata('success','Updated Successfully!');
				}
				else
				{
					$this->session->set_userdata('errors','Data Not Updated!');
				}
				redirect(base_url('admin/drivers/add_drivers'));
			}
			else
			{
				$saved=$this->common_model->insert('drivers',$formData);
			 	if($saved){
					$this->session->set_userdata('success','New supplier created successfully!');
				}
				else{
					$this->session->set_userdata('errors','Data Not Inserted!');
				}
				redirect($_SERVER['HTTP_REFERER']);
			}
		}
		if($id!=null)
		{
			$data['model'] = $this->common_model->getOne('drivers',array('id'=>$id));
		}
		$data['allData'] = $this->common_model->getAll('drivers',null,array('id','desc'));
		$data['content'] = 'admin/pages/drivers/add_driver';
		$this->load->view('admin/layout/master',$data);
	}
	public function delete_driver($id=null)
	{
		$id=array('id'=>$id);
		$deleted=$this->common_model->delete('drivers',$id);
		if($deleted)
		{
			$response['success']='Deleted Successfully';
			$response['response']=1;
	        echo json_encode($response);exit();
		}
	}
}
?>