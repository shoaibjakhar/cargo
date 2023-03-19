<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Login extends NN_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model('user_model');
	}
	public function index(){
		if($this->input->post()){
			$username=$this->input->post('email');
			$password=md5($this->input->post('password'));
			$where="(email = '$username' OR username = '$username') AND password = '$password' ";
			$data=$this->user_model->user_login('users',$where);
				if(sizeof($data) > 0){
					foreach($data[0] as $key => $value){
						$userData[$key]=$value;
					}
					unset($data[0]);
					$this->session->set_userdata($userData);
					redirect(base_url('admin/dashboard'));
				}else{
					$this->session->set_flashdata('errors','Wrong Email OR Password Try Again!');
					redirect($_SERVER['HTTP_REFERER']);
				}
		}
		$this->load->view('admin/login');
	}
	public function logout(){
		if(isset($_SESSION['__ci_last_regenerate']))
			unset($_SESSION['__ci_last_regenerate']);
		if(isset($_SESSION['FBRLH_state']))
	    	unset($_SESSION['FBRLH_state']);
			unset($_SESSION['id']);
	  		redirect(base_url('login'));
	}
	public function change_password(){
		$data['active']='dashboard';
		$this->display_view('admin/change_password',$data);
	}
	public function update_password(){
		$id=$this->current_user_id;
		$password=md5($this->input->post('password'));
		$new_password=md5($this->input->post('new_password'));
		$re_password=md5($this->input->post('re_password'));
		$where="id = '$id' AND password = '$password' ";
		if($this->user_model->user_login('users',$where))
		{
			if ($new_password==$re_password) {
				if($this->user_model->update_password('users',array('id' =>$id),array('password'=>$new_password))){
					$this->session->set_flashdata('success','password successfully changed');
					redirect($_SERVER['HTTP_REFERER']);
				}
			}
			$this->session->set_flashdata('errors','New passwords doesnot match');
			redirect($_SERVER['HTTP_REFERER']);
		}
		$this->session->set_flashdata('errors','Old password is not correct');
		redirect($_SERVER['HTTP_REFERER']);
	}
}
