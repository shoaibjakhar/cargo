<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class NN_Controller extends CI_Controller{
	public $current_user_id=null;
	public $current_user=null;
	public function __construct(){
		parent::__construct();
		$this->load->helper('urlencode_helper');
		if($this->session->userdata('id')){
			$this->current_user_id=$this->session->userdata('id');
			$this->current_user = $this->common_model->getOne('users',array('id'=>$this->current_user_id));
		}
	}
	public function isLoggedIn(){
		$userID = $this->session->userdata('id');
		if($userID != null && $userID > 0){
			return true;
		}else{
			return false;
		}
	}
	public function showFlash(){
		  $error = $this->session->userdata('errors');
		  $success = $this->session->userdata('success');
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