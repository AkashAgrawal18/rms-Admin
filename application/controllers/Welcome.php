<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function index()
	{   
		$data['pagename'] = 'Home';
		$data['all_category'] = $this->Main_model->getcategory();
		 $data['product_featured'] = $this->Main_model->getproduct_featured();
	     $data['product_recent'] = $this->Main_model->getproduct_recent();
		  // echo "<pre>";print_r($data['product_recent']);
		$this->load->view('index',$data);
	}
	
}
