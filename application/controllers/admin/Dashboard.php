<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Dashboard extends NN_Controller{
	function __construct(){
		parent::__construct();
		if(!$this->isLoggedIn())
			redirect(base_url('login'));
	}
	public function index(){
		$data['active']='dashboard';
		$data['content'] = 'admin/pages/dashboard';
		$this->load->view('admin/layout/master',$data);
	}
}