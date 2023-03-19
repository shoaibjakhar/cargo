<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class GeneralSettings extends NN_Controller{
	function __construct(){
		parent::__construct();
		if(!$this->isLoggedIn())
			redirect(base_url('login'));
	}
	public function general_settings(){
		$data['active']='general_settings';
		$data['single']=$this->db->select('*')->order_by('id',"desc")->limit(1)->get('general_settings')->row();
		$data['content'] = 'admin/pages/general_settings/general_settings';
		$this->load->view('admin/layout/master',$data);
	}
	public function add_general_settings(){
		$formData=$this->input->post();
		$formData['user_id']=$_SESSION['id'];
		$formData['created_at']=date('Y-m-d H:i:s');
		$id=$this->input->post('id');

		if(isset($_FILES['logo'])){
			$errors= array();
			$file_name = $_FILES['logo']['name'];
			$file_tmp =$_FILES['logo']['tmp_name'];
			$file_type=$_FILES['logo']['type'];
			$fileNameCmps = explode(".", $file_name);
			$fileExtension = strtolower(end($fileNameCmps));

			move_uploaded_file($file_tmp,"assets/images/".$file_name);
			$formData['logo']=$file_name;
		}
		if($id!=null){
			if($formData['logo']){
				$update=$this->common_model->update('general_settings',array('id'=>$id),$formData);
			}
			else{
				unset($formData['logo']);
				$update=$this->common_model->update('general_settings',array('id'=>$id),$formData);
			}
			if($update){
				$this->session->set_flashdata('success','Updated Successfully!');
			}
			else{
				$this->session->set_flashdata('errors','Data Not Updated!');
			}
		}
		else{
			$saved=$this->common_model->insert('general_settings',$formData);
		 	if($saved){
				$this->session->set_flashdata('success','Data Inserted Successfully!');
			}
			else{
				$this->session->set_flashdata('errors','Data Not Inserted!');
			}

		}
		redirect($_SERVER['HTTP_REFERER']);
	}
}