<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Query extends CI_Controller {

	public function queries()
	{  
	  $data = $this->login_details(); 
		$data['pagename'] ="Queries";
    $data['all_value'] = $this->Master_model->get_contactus();
		$this->load->view('queries',$data);
	}

     public function update_query_status()
    {
      if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if ($data = $this->Master_model->update_query_status()) {

          $info = array(
            'status' => 'success',
            'message' => 'Queries has been Updated successfully!'
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

         public function delete_query()
        {
          if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if ($data = $this->Master_model->delete_query()) {

              $info = array(
                'status' => 'success',
                'message' => 'Queries has been Deleted successfully!'
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

    public function review()
	{   
		$data = $this->login_details();
		$data['pagename'] ="review";
     $data['all_value'] = $this->Master_model->get_all_review();
     // echo "<pre>";print_r($data['all_value']);die();
		$this->load->view('review',$data);
	}

  public function delete_review()
        {
          if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if ($data = $this->Master_model->delete_review()) {

              $info = array(
                'status' => 'success',
                'message' => 'Review has been Deleted successfully!'
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