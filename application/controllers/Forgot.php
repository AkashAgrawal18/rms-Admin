<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Forgot extends CI_Controller {

	public function index()
	{   
		$data['pagename'] = 'Forgot Password';
		$this->load->view('forgot-password',$data);
	}

	 public function get_mobile()
         {

           $mobile_id = $this->input->post('cust_mobile');
           $customer_mobile= $this->Login_model->get_fmobile($mobile_id);
           // print_r($customer_mobile);die();
           if ($customer_mobile==0) {
              $info = array(
                  'status' => 'success',
                  'message' => 'Not Register Phone Number!!'
                );
               
           }else{
              $info = array(
                  'status' => 'error',
                  'message' => 'Register Phone Number'
                );
           }

            echo json_encode($info);

         }

	 public function forgot_pass()
        {
          if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if ($data = $this->Login_model->forgot_pass()) {
            
            if($data == 1) {
              $info = array(
                'status' => 'success',
                'message' => 'Password has been Updated successfully!'
              );


            } else if ($data == 2) {
                $info = array(
                  'status' => 'success',
                  'message' => 'Wrong Phone Number!!'
                );
              }
            } else {
              $info = array(
                  'status' => 'success',
                  'message' => 'Wrong User Name!!'
                );
            }
            echo json_encode($info);
          }


        }



}

