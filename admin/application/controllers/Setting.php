<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Setting extends CI_Controller {

	
	public function product_card()
	{   
		$data = $this->login_details();
		$data['pagename'] = 'Product cards';
		$this->load->view('product-card',$data);
	}

//-----------------------------------------application setting  ----------------------------------------//
  public function front_setting()
	{   
		$data = $this->login_details();
		$data['pagename'] = 'Application Setting';
     $data['app_details'] = $this->Setting_model->get_application_settings();
    // echo "<pre>"; print_r($data['app_details']);die();
		$this->load->view('front-setting',$data);
	}

    public function update_application(){
     if ($this->ajax_login() === false) { return; }
      if($_SERVER["REQUEST_METHOD"] == "POST"){
        if($data = $this->Setting_model->update_application()){
          $info = array( 'status'=>'success',
            'message'=>'Application Settings has been update successfully!'
          );
        }else{ $info = array( 'status'=>'error',
            'message'=>'Some problem Occurred!! please try again'
          );
        } echo json_encode($info);
      }
    }


    public function update_social(){
     if ($this->ajax_login() === false) { return; }
      if($_SERVER["REQUEST_METHOD"] == "POST"){
        if($data = $this->Setting_model->update_social()){
          $info = array( 'status'=>'success',
            'message'=>'Application Settings has been update successfully!'
          );
        }else{ $info = array( 'status'=>'error',
            'message'=>'Some problem Occurred!! please try again'
          );
        } echo json_encode($info);
      }
    }

    public function update_logo(){
     if ($this->ajax_login() === false) { return; }
      if($_SERVER["REQUEST_METHOD"] == "POST"){
        if($data = $this->Setting_model->update_logo()){
          $info = array( 'status'=>'success',
            'message'=>'Application Settings has been update successfully!'
          );
        }else{ $info = array( 'status'=>'error',
            'message'=>'Some problem Occurred!! please try again'
          );
        } echo json_encode($info);
      }
    }
//-----------------------------------------/application setting  ----------------------------------------//

//------------------------------------------profile ----------------------------------------//

  public function profile()
	{   
		$data = $this->login_details();
		$data['pagename'] = 'Profile';
		$data['user_dtl'] = $this->Login_model->user_details();
		$this->load->view('profile',$data);
	}


	public function update_profile(){ 
    if ($this->ajax_login() === false) { return; }
      if($_SERVER["REQUEST_METHOD"] == "POST"){
        $_POST["kh_userid"] = $this->session->userdata('user_id');
        if($data = $this->Setting_model->update_profile()){
          $info = array( 'status'=>'success',
            'message'=>'Profile has been Updated successfully!'
          );
        }else{ $info = array( 'status'=>'fail',
            'message'=>'Some problem Occurred!! please try again'
          );
        } echo json_encode($info);
      }
    }

//------------------------------------------/profile ----------------------------------------//

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