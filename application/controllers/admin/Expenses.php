<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Expenses extends NN_Controller{
	function __construct(){
		parent::__construct();
		if(!$this->isLoggedIn())
			redirect(base_url('login'));
	}
	public function expenses_head_list($id=null)
	{
		$data['active']='expenses_head_list';
		$data['allData']=$this->common_model->getAll('expenses_head',null,array('id','desc'));
		if($id!=null)
		{
			$data['model'] = $this->common_model->getOne('expenses_head',array('id'=>$id));
		}
		$data['content'] = 'admin/pages/expenses/expenses_head_list';
		$this->load->view('admin/layout/master',$data);
	}
	public function add_expense_head()
	{
		$data['active']='add_expense_head';
		if($this->input->post())
		{
			$formData = $this->input->post();
			$id = isset($formData['id']) ? $formData['id']:'';
			$formData['user_id']=$this->current_user_id;
			if($id)
			{
				$update=$this->common_model->update('expenses_head',array('id'=>$id),$formData);
				if($update)
				{
					$this->session->set_userdata('success','Updated Successfully!');
				}
				else
				{
					$this->session->set_userdata('errors','Data Not Updated!');
				}
				redirect(base_url('admin/expenses/expenses_head_list'));
			}
			else
			{
				$checkname = $this->common_model->getOne('expenses_head',array('name'=>$formData['name']));
				if(!empty($checkname))
				{
					$this->session->set_userdata('errors','This is already exist try other one');
					redirect($_SERVER['HTTP_REFERER']);
				}
				$saved=$this->common_model->insert('expenses_head',$formData);
			 	if($saved){
					$this->session->set_userdata('success','Created successfully!');
				}
				else{
					$this->session->set_userdata('errors','Data Not Inserted!');
				}
				redirect($_SERVER['HTTP_REFERER']);
			}
		}
	}
	public function get_expenses_head()
	{
		$this->load->model('expenses_pagination_model');
		$where=null;
        $data = $row = array();
        $column_order = array('expenses_head.id','expenses_head.name','expenses_head.description','expenses_head.created_at');
        $column_search = array('expenses_head.id','expenses_head.name','expenses_head.description','expenses_head.created_at');
        $order = array('expenses_head.id' => 'desc');
        $memData = $this->expenses_pagination_model->getRows('expenses_head',$_POST,$column_order,$column_search,$order,$where);
        $i = $_POST['start'];
        foreach($memData as $value){
            $i++;
            $name=isset($value->name) ? $value->name :'';
            $description=isset($value->description) ? $value->description :'';
            $created_at=isset($value->created_at) ? date('M d,Y',strtotime($value->created_at)) :'';
            $action='';
        	$action.='<a href="'.base_url().'admin/expenses/expenses_head_list/'.$value->id.'" class="btn btn-info btn-xs"><i class="fa fa-edit"></i></a>';
        	$action.='<a href="'.base_url().'admin/expenses/delete_expense_head/'.$value->id.'" class="btn btn-danger btn-xs delete_confirm"><i class="fa fa-trash"></i></a>';
            $data[] = array($i,$created_at,$name,$description,$action);
        }
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->expenses_pagination_model->countAll('expenses_head',$where),
            "recordsFiltered" => $this->expenses_pagination_model->countFiltered('expenses_head',$_POST,$column_order,$column_search,$order,$where),
            "data" => $data,
        );
        echo json_encode($output);exit();
	}
	public function delete_expense_head($id=null)
	{
		$id=array('id'=>$id);
		$deleted=$this->common_model->delete('expenses_head',$id);
		if($deleted)
		{
			$response['success']='Deleted Successfully';
			$response['response']=1;
	        echo json_encode($response);exit();
		}
	}
	public function expenses_list($id=null)
	{
		$data['active']='expenses_list';
		$data['expenses_head'] = $this->common_model->getAll('expenses_head',null,array('id','desc'));
		$data['allData']=$this->common_model->getAll('expenses',null,array('id','desc'));
		if($id!=null)
		{
			$data['model'] = $this->common_model->getOne('expenses',array('id'=>$id));
		}
		$data['content'] = 'admin/pages/expenses/expenses_list';
		$this->load->view('admin/layout/master',$data);
	}
	public function add_expense()
	{
		$data['active']='add_expense';
		if($this->input->post())
		{
			$formData = $this->input->post();
			$id = isset($formData['id']) ? $formData['id']:'';
			$formData['user_id']=$this->current_user_id;
			if($id)
			{
				$update=$this->common_model->update('expenses',array('id'=>$id),$formData);
				if($update)
				{
					$this->session->set_userdata('success','Updated Successfully!');
				}
				else
				{
					$this->session->set_userdata('errors','Data Not Updated!');
				}
				redirect(base_url('admin/expenses/expenses_list'));
			}
			else
			{
				$checkname = $this->common_model->getOne('expenses',array('name'=>$formData['name']));
				if(!empty($checkname))
				{
					$this->session->set_userdata('errors','This is already exist try other one');
					redirect($_SERVER['HTTP_REFERER']);
				}
				$saved=$this->common_model->insert('expenses',$formData);
			 	if($saved){
					$this->session->set_userdata('success','Created successfully!');
				}
				else{
					$this->session->set_userdata('errors','Data Not Inserted!');
				}
				redirect($_SERVER['HTTP_REFERER']);
			}
		}
	}
	public function get_expenses()
	{
		$this->load->model('expenses_pagination_model');
		$where=null;
        $data = $row = array();
        $column_order = array('expenses.id','expenses.name','expenses.description','expenses.amount','expenses.created_at');
        $column_search = array('expenses.id','expenses.name','expenses.description','expenses.amount','expenses.created_at');
        $order = array('expenses.id' => 'desc');
        $memData = $this->expenses_pagination_model->getRows('expenses',$_POST,$column_order,$column_search,$order,$where);
        $i = $_POST['start'];
        foreach($memData as $value){
            $i++;
            $head_name=isset($value->expense_head_id) ? getExpensesHead($value->expense_head_id) :'';
            $name=isset($value->name) ? $value->name :'';
            $amount=isset($value->amount) ? $value->amount :0;
            $description=isset($value->description) ? $value->description :'';
            $created_at=isset($value->created_at) ? date('M d,Y',strtotime($value->created_at)) :'';
            $action='';
        	$action.='<a href="'.base_url().'admin/expenses/expenses_list/'.$value->id.'" class="btn btn-info btn-xs"><i class="fa fa-edit"></i></a>';
        	$action.='<a href="'.base_url().'admin/expenses/delete_expense/'.$value->id.'" class="btn btn-danger btn-xs delete_confirm"><i class="fa fa-trash"></i></a>';
            $data[] = array($i,$created_at,$head_name,$name,$amount,$description,$action);
        }
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->expenses_pagination_model->countAll('expenses',$where),
            "recordsFiltered" => $this->expenses_pagination_model->countFiltered('expenses',$_POST,$column_order,$column_search,$order,$where),
            "data" => $data,
        );
        echo json_encode($output);exit();
	}
	public function delete_expense($id=null)
	{
		$id=array('id'=>$id);
		$deleted=$this->common_model->delete('expenses',$id);
		if($deleted)
		{
			$response['success']='Deleted Successfully';
			$response['response']=1;
	        echo json_encode($response);exit();
		}
	}
}
?>