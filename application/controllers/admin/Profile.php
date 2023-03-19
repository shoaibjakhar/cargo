<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Profile extends NN_Controller{
	function __construct(){
		parent::__construct();
		$this->load->model("ajax_pagination_model");
		$this->load->model("Common_model");
		if(!$this->isLoggedIn())
			redirect(base_url('login'));
	}
	public function profile(){
		$id=$this->current_user_id;
		$data['sub_title']='Profile';
		$data['active']='profile';
		$data['value']=$this->Common_model->getById('users',$id);
		$data['content'] = 'admin/pages/profile/profile';
		$this->load->view('admin/layout/master',$data);
	}
	public function edit_profile(){
		$id=$this->current_user_id;
		$data['active']='profile';
		$data['value']=$this->Common_model->getById('users',$id);
		$data['content'] = 'admin/pages/profile/edit_profile';
		$this->load->view('admin/layout/master',$data);
	}
	public function update_password(){
		// getting data from form
		$formData=$this->input->post();
		$old_password = md5($formData['old_password']);
		$id=$this->input->post('id');

		$check_password=$this->Common_model->getOne('users',array('password'=>$old_password));
		if(empty($check_password->id)){
			$this->session->set_flashdata('errors',"Wrong! Old Password!");
			redirect($_SERVER['HTTP_REFERER']);
		}
		if($formData['new_password'] != $formData['confirm_password']){
			$this->session->set_flashdata('errors',"Both Passwords don't match!");
			redirect($_SERVER['HTTP_REFERER']);
		}
		if($id){
			$data['password']=md5($formData['new_password']);
			$update = $this->Common_model->update('users',array('id'=>$id),$data);
			if(!empty($update)){
				$this->session->set_flashdata('success','Updated! Successfully!');
			}else{
				$this->session->set_flashdata('errors','Error! error Occured!');
			}
		}
		redirect($_SERVER['HTTP_REFERER']);
	}
}