<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	
	public function index()
	{   
		$data = $this->login_details();
		$data['pagename'] = 'Dashboard';
    $data['countRow'] =  $this->Login_model->countRow_dashboard();
    $data['all_order'] =  $this->Login_model->get_all_order();
    // print_r( $data['all_order']);die();
		$this->load->view('dashboard',$data);
	}

	//==========================Details===========================//
      protected function login_details(){ 
      	 $this->require_login();
         $data['log_user_dtl'] = $this->Login_model->user_details();
         return $data;
      }
    //=========================/Details===========================//
    //======================Login Validation======================//

      protected function require_login(){

        $is_user_in = $this->session->userdata('is_user_in');

        if(isset($is_user_in) || $is_user_in == true){ return;

        } else { redirect('Login'); }

      }



      protected function ajax_login(){

        $is_user_in = $this->session->userdata('is_user_in');

        if(isset($is_user_in) || $is_user_in == true){ return true;

        } else { echo json_encode(array( 'status'=>'error', 'message'=>'You are not Logged in Now!! Please login again.')); return false; 

        }

      }

     //======================/Login Validation======================//



}
