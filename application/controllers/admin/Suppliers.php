<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Suppliers extends NN_Controller{
	function __construct(){
		parent::__construct();
		if(!$this->isLoggedIn())
			redirect(base_url('login'));
	}
	public function suppliers_list()
	{
		$data['active']='suppliers_list';
		$data['allData']=$this->common_model->getAll('suppliers',null,array('id','desc'));
		$data['content'] = 'admin/pages/suppliers/suppliers_list';
		$this->load->view('admin/layout/master',$data);
	}
	public function add_suppliers($id=null)
	{
		$data['active']='add_suppliers';
		if($this->input->post())
		{
			$formData = $this->input->post();
			$id = isset($formData['id']) ? $formData['id']:'';
			$formData['user_id']=$this->current_user_id;
			if($id)
			{
				unset($formData['opening_balance']);
				$update=$this->common_model->update('suppliers',array('id'=>$id),$formData);
				if($update)
				{
					$this->session->set_userdata('success','Updated Successfully!');
				}
				else
				{
					$this->session->set_userdata('errors','Data Not Updated!');
				}
				redirect(base_url('admin/suppliers/add_suppliers'));
			}
			else
			{
				// $checkEmail = $this->common_model->getOne('suppliers',array('email'=>$formData['email']));
				// if(!empty($checkEmail))
				// {
				// 	$this->session->set_userdata('errors','This is email already exist try other one');
				// 	redirect($_SERVER['HTTP_REFERER']);
				// }
				$saved=$this->common_model->insert('suppliers',$formData);
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
			$data['model'] = $this->common_model->getOne('suppliers',array('id'=>$id));
		}
		$data['allData'] = $this->common_model->getAll('suppliers',null,array('id','desc'));
		$data['content'] = 'admin/pages/suppliers/add_supplier';
		$this->load->view('admin/layout/master',$data);
	}
	public function delete_supplier($id=null)
	{
		$id=array('id'=>$id);
		$deleted=$this->common_model->delete('suppliers',$id);
		if($deleted)
		{
			$response['success']='Deleted Successfully';
			$response['response']=1;
	        echo json_encode($response);exit();
		}
	}
	public function getSuppliersDetail($id=null)
	{
		if($id!=null)
		{
			$response['detail'] = getSuppliers($id);
	        echo json_encode($response);exit();
		}
	}
}
?>