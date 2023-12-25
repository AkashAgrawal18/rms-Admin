<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Profile extends CI_Controller
{

    public function index()
    {    
         $data = $this->login_details();
         $data['pagename'] = 'Profile';
         $this->load->view('profile',$data);
    }

     public function update_profile()
        {
          if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if ($data = $this->Login_model->update_profile()) {

              $info = array(
                'status' => 'success',
                'message' => 'User Profile  has been Updated successfully!'
              );
            } else {
              $info = array(
                'status' => 'error',
                'message' => 'Some problem Occurred!! please try again'
              );
            }
            echo json_encode($info);
          }
        }


    public function edit_profile()
    {   
        $data['pagename'] = 'Profile';
        $this->load->view('edit_profile',$data);
    }

    //==========================Details===========================//
      protected function login_details(){ 
         $this->require_login();
         $data['log_customer_dtl'] = $this->Login_model->customer_details();
          // echo "<pre>";print_r($data['log_customer_dtl']);die();
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
