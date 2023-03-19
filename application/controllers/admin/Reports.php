<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Reports extends NN_Controller
{
	function __construct()
	{
		parent::__construct();
		if(!$this->isLoggedIn())
			redirect(base_url('login'));
	}
	public function cash_book()
	{
		$data['active']='cash_book';
		$data['allData']=$this->common_model->getAll('riders',null,array('id','desc'));
		$data['content'] = 'admin/pages/reports/cash_book';
		$this->load->view('admin/layout/master',$data);
	}
	public function getCashBook()
	{
		$this->load->model('reports_pagination_model');
		$where=array();
        $data = $row = array();
        $column_order = array('transactions.id','transactions.customer_id','transactions.rider_id','customers.customer_name','transactions.bility_no','transactions.credit','transactions.debit','transactions.created_at');
        $column_search = array('transactions.id','transactions.customer_id','transactions.rider_id','customers.customer_name','transactions.bility_no','transactions.credit','transactions.debit','transactions.created_at');
        $order = array('transactions.id' => 'desc');
        $memData = $this->reports_pagination_model->getRows('transactions',$_POST,$column_order,$column_search,$order,$where);
        $i = $_POST['start'];
        foreach($memData as $value){
            $i++;
            $customer_name=isset($value->customer_name) ? $value->customer_name :'';
            $bility_no=isset($value->bility_no) ? $value->bility_no:'';
            $credit=isset($value->credit) ? $value->credit:'';
            $debit=isset($value->debit) ? $value->debit:'';
            $created_at=isset($value->created_at) ? date('M d,Y',strtotime($value->created_at)):'';

            $data[] = array($i,$created_at,$customer_name,$bility_no,$credit,$debit);
        }
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->reports_pagination_model->countAll('transactions',$where),
            "recordsFiltered" => $this->reports_pagination_model->countFiltered('transactions',$_POST,$column_order,$column_search,$order,$where),
            "data" => $data,
        );
        echo json_encode($output);exit();
	}
}
?>