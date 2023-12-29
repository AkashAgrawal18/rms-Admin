<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function index()
	{   
		$data['pagename'] = 'Home';
		$data['all_category'] = $this->Main_model->getcategory();
		 $data['product_featured'] = $this->Main_model->getproduct_featured(2);
	     $data['product_recent'] = $this->Main_model->getproduct_recent(2);
		 $data['active_offer'] = $this->Main_model->get_active_type(1);
		 $data['slider_main'] = $this->Main_model->get_slider(1);
		 $data['slider_card'] = $this->Main_model->get_slider(2);
		  // echo "<pre>";print_r($data['product_recent']);
		$this->load->view('index',$data);
	}
	
}
