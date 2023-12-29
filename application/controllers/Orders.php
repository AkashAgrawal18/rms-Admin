<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Orders extends CI_Controller {

	public function index()
	{  
		$data = $this->login_details();
		$data['pagename'] = "My Order";
		$data['all_value'] = $this->Main_model->get_all_orders();
		// echo "<pre>"; print_r($data['all_value']);die();
		$this->load->view('my_order',$data);
	}
	public function order_details()
	{  
		$data = $this->login_details();
		$data['pagename'] = "Order Details";
		$data['orderid'] = $this->input->get('orderid');

		$data['order_datails'] = $this->Main_model->order_datails($data['orderid']);
		$data['total_product'] = $this->Main_model->sale_prodct($data['orderid']);

		     // echo "<pre>"; print_r($data['order_datails']);die();
		$this->load->view('order_details',$data);
	}
	public function Track_order()
	{   
        $data = $this->login_details();
		$data['pagename'] = "Track Order";
		$this->load->view('track_order',$data);
	}



	//==========================Details===========================//
      protected function login_details(){ 
      	 $this->require_login();
         $data['log_customer_dtl'] = $this->Login_model->customer_details();
         return $data;
      }
    //=========================/Details===========================//
    //======================Login Validation======================//

      protected function require_login(){

        $is_customer_in = $this->session->userdata('is_customer_in');

        if(isset($is_customer_in) || $is_customer_in == true){ return;

        } else { redirect('Register'); }

      }



      protected function ajax_login(){

        $is_customer_in = $this->session->userdata('is_customer_in');

        if(isset($is_customer_in) || $is_customer_in == true){ return true;

        } else { echo json_encode(array( 'status'=>'error', 'message'=>'You are not Logged in Now!! Please login again.')); return false; 

        }

      }

     //======================/Login Validation======================//
}

