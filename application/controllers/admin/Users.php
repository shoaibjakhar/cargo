<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Users extends NN_Controller{
	function __construct(){
		parent::__construct();
		$this->load->model("ajax_pagination_model");
		$this->load->model("Common_model");
		if(!$this->isLoggedIn())
			redirect(base_url('login'));
	}
	public function customers(){
		$data['active']='customers';
		// $data['allData']=$this->common_model->getAll('customers',null,array('created_on','desc'));
		$this->display_view('admin/pages/customers_list',$data);
	}
	public function pagination(){
	  $this->load->library("pagination");
	  $config = array();
	  $config["base_url"] = "#";
	  $config["total_rows"] = $this->ajax_pagination_model->count_all();
	  $config["per_page"] = 5;
	  $config["uri_segment"] = 4;
	  $config["use_page_numbers"] = TRUE;
	  $config["full_tag_open"] = '<ul class="pagination">';
	  $config["full_tag_close"] = '</ul>';
	  $config["first_tag_open"] = '<li>';
	  $config["first_tag_close"] = '</li>';
	  $config["last_tag_open"] = '<li>';
	  $config["last_tag_close"] = '</li>';
	  $config['next_link'] = '&gt;';
	  $config["next_tag_open"] = '<li>';
	  $config["next_tag_close"] = '</li>';
	  $config["prev_link"] = "&lt;";
	  $config["prev_tag_open"] = "<li>";
	  $config["prev_tag_close"] = "</li>";
	  $config["cur_tag_open"] = "<li class='active'><a href='#'>";
	  $config["cur_tag_close"] = "</a></li>";
	  $config["num_tag_open"] = "<li>";
	  $config["num_tag_close"] = "</li>";
	  $config["num_links"] = 1;
	  $this->pagination->initialize($config);
	  $page = $this->uri->segment(4);
	  $output='';
	  if($page > 0){
	     $start = ($page - 1) * $config["per_page"];
		  $output = array(
		   'pagination_link'  => $this->pagination->create_links(),
		   'country_table'   => $this->ajax_pagination_model->fetch_details($config["per_page"], $start)
		  );
	  }
	    echo json_encode($output);
	 }

	public function add_customers($id=null){
		$data['active']='customers';
		if($this->input->post()){
			$formdata=$this->input->post();
			$accountLedger['ledger_name']=isset($formdata['first_name']) ? $formdata['first_name'].' '.$formdata['last_name']:'';
			$accountLedger['opening_balance']=$formdata['opening_balance'];
			$accountLedger['dr_cr']=$formdata['dr_cr'];
			$accountLedger['account_group']='customers';
				unset($formdata['submit']);
				if(isset($formdata['id']) && !empty($formdata['id'])){
					$update=$this->common_model->update('customers',array('id'=>$formdata['id']),$formdata);
					if($update){
						$updateLedger=$this->common_model->update('account_ledger',array('customer_id'=>$formdata['id']),$accountLedger);
					if($updateLedger)						
						$this->session->set_userdata('success','Updated successfully');
					}else{
						$this->session->set_userdata('errors','Error Try again');
					}
				}else{
					$saved=$this->common_model->insert('customers',$formdata);
					if($saved){
						$accountLedger['customer_id']=$saved;
						$savedLedger=$this->common_model->insert('account_ledger',$accountLedger);
						if($savedLedger)
							$this->session->set_userdata('success','Saved successfully');
					}else{
						$this->session->set_userdata('errors','Error Try again');

					}
			}
			redirect($_SERVER['HTTP_REFERER']);
		}
		if($id!=null){
		    $data['model']=$this->common_model->getById('customers',$id);
		}
		$this->display_view('admin/pages/add_customers',$data);
	}
	public function suppliers(){
		$data['active']='suppliers';
		// $data['allData']=$this->common_model->getAll('suppliers',null,array('created_on','desc'));
		$this->display_view('admin/pages/suppliers_list',$data);
	}
	public function getLists()
	{
        $data = $row = array();
        $memData = $this->ajax_pagination_model->getRows($_POST);
        $i = $_POST['start'];
        foreach($memData as $value){
            $i++;
            $suppliers_name=isset($value->first_name) ? $value->first_name.' '.$value->last_name:'';
            $created=isset($value->created_on) ? date('M d Y',strtotime($value->created_on)):'';
            $mobile_no=isset($value->mobile_no) ? $value->mobile_no :'';
            $email=isset($value->email) ? $value->email :''; 
            $cast=isset($value->cast) ? $value->cast :''; 
            $short_address=isset($value->short_address) ? $value->short_address :'';
            $address=isset($value->address) ? $value->address :'';
            $action='<a href="'.base_url().'/admin/users/add_suppliers/'.$value->id.'" class="btn btn-info"><i class="fa fa-edit"></i></a>';
            $action.='<a href="#" class="btn btn-danger"><i class="fa fa-trash"></i></a>';
            $data[] = array($i,$suppliers_name,$created,$mobile_no,$email,$cast,$short_address,$address,$action);
        }
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->ajax_pagination_model->countAll(),
            "recordsFiltered" => $this->ajax_pagination_model->countFiltered($_POST),
            "data" => $data,
        );
        echo json_encode($output);exit();
	}
	public function add_suppliers($id=null){
		$data['active']='suppliers';
		if($this->input->post()){
			$formdata=$this->input->post();
				unset($formdata['submit']);
				$accountLedger['ledger_name']=isset($formdata['first_name']) ? $formdata['first_name'].' '.$formdata['last_name']:'';
				$accountLedger['opening_balance']=$formdata['opening_balance'];
				$accountLedger['dr_cr']=$formdata['dr_cr'];
				$accountLedger['account_group']='suppliers';
				if(isset($formdata['id']) && !empty($formdata['id'])){
					$update=$this->common_model->update('suppliers',array('id'=>$formdata['id']),$formdata);
					if($update){
						$updateLedger=$this->common_model->update('account_ledger',array('supplier_id'=>$formdata['id']),$accountLedger);
					if($updateLedger)						
						$this->session->set_userdata('success','Updated successfully');
					}else{
						$this->session->set_userdata('errors','Error Try again');
					}
				}else{
					$saved=$this->common_model->insert('suppliers',$formdata);
					if($saved){
						$accountLedger['supplier_id']=$saved;
						$savedLedger=$this->common_model->insert('account_ledger',$accountLedger);
						if($savedLedger)
							$this->session->set_userdata('success','Saved successfully');
					}else{
						$this->session->set_userdata('errors','Error Try again');

					}
			}
			redirect($_SERVER['HTTP_REFERER']);
		}
		if($id!=null){
		    $data['model']=$this->common_model->getById('suppliers',$id);
		}
		$this->display_view('admin/pages/add_suppliers',$data);
	}
	public function users_list(){
		$data['active']='users_list';
		$data['alldata']=$this->Common_model->getAll('users',null,null);
		$this->display_view('admin/pages/users_list',$data);
	}
	public function users_registration_form(){
		$data['active']='users_registration';
		$this->display_view('admin/pages/users_registration_form',$data);
	}
	public function user_registration(){
		// getting data from form
		$data=$this->input->post();
		$id=$this->input->post('id');

		if($data['confirm_password'] != $data['password']){
			$this->session->set_flashdata('errors',"Both Passwords don't match!");
			redirect($_SERVER['HTTP_REFERER']);
		}

		if(isset($_FILES['file'])){
			$file_name = $_FILES['file']['name'];
			$file_size =$_FILES['file']['size'];
			$file_tmp =$_FILES['file']['tmp_name'];
			$file_type=$_FILES['file']['type'];
			$fileNameCmps = explode(".", $file_name);
			$fileExtension = strtolower(end($fileNameCmps));

			move_uploaded_file($file_tmp,"assets/images/".$file_name);
			$data['image']=$file_name;
		}

		$check_email=$this->Common_model->getOne('users',array('email'=>$data['email']));
		
		if($check_email && $check_email->id != $id){
			$this->session->set_flashdata('errors','Email Already Exists!');
		}
		else{
			if($id){
				$update = $this->Common_model->update('users',array('id'=>$id),$data);
				if(!empty($update)){
					$this->session->set_flashdata('success','Updated Successfully!');
				}
			}
			else{
				$saved = $this->Common_model->insert('users',$data);
				if(!empty($saved)){
					$this->session->set_flashdata('success','Data Inserted Successfully!');
				}
			}
			if(empty($saved) && empty($update)){
				$this->session->set_flashdata('errors','Data not inserted!');
			}
		}
		redirect($_SERVER['HTTP_REFERER']);
	}
	public function edit_user($id=null){
		$data['active']='users_registration';
		$data['single']=$this->Common_model->getById('users',$id);
		$this->display_view('admin/pages/users_registration_form',$data);
	}
	public function delete_user($id=null){
		$id=array('id'=>$id);
		$data['active']='users_list';
		$data['value']=$this->Common_model->delete('users',$id);
		redirect($_SERVER['HTTP_REFERER']);
	}
	public function resizeImage($file_name)
   	{
		$source_path = $_SERVER['DOCUMENT_ROOT'] . '/ERP/assets/images/' . $file_name;
		$target_path = $_SERVER['DOCUMENT_ROOT'] . '/ERP/assets/images/thumb/';
		$config_manip = array(
			'image_library' => 'gd2',
			'source_image' => $source_path,
			'new_image' => $target_path,
			'maintain_ratio' => TRUE,
			'create_thumb' => TRUE,
			'thumb_marker' => '',
			'width' => 60,
			'height' => 60
		);
        $this->load->library('image_lib', $config_manip);
        $this->image_lib->resize();
		$this->image_lib->clear();
  	}

	public function download($id){
		$this->load->helper('download');
		$fileInfo = $this->Common_model->getById('users',$id);
		$file = 'assets/images/thumb/'.$fileInfo->image;
	    force_download($file, NULL);
	}

}