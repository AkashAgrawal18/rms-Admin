<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	
	public function index()
	{   
		$data = $this->login_details();
		$data['pagename'] = 'Dashboard';
		$this->load->view('dashboard',$data);
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
