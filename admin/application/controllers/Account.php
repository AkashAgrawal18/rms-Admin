<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Account extends CI_Controller {

 //--------------------------------customer-----------------------//
 public function customer()
 {
   $data = $this->login_details();
   $data['pagename'] = 'Customers List';
   $data['pagtype'] = 1;
   $data['search'] = $this->input->get('search');
   $data['status'] = $this->input->get('status');
   $data['all_value'] = $this->Main_model->get_customer($data['pagtype'], $data['status'], $data['search']);
   // echo "<pre>"; print_r($data['all_value']);die();
   $this->load->view('customer', $data);
 }

 public function supplier()
 {
   $data = $this->login_details();
   $data['pagename'] = 'Suppliers List';
   $data['pagtype'] = 2;
   $data['search'] = $this->input->get('search');
   $data['status'] = $this->input->get('status');
   $data['all_value'] = $this->Main_model->get_customer($data['pagtype'], $data['status'], $data['search']);
   $this->load->view('customer', $data);
 }

 public function expense_acc()
 {
   $data = $this->login_details();
   $data['pagename'] = 'Expenses List';
   $data['pagtype'] = 3;
   $data['search'] = $this->input->get('search');
   $data['status'] = $this->input->get('status');
   $data['all_value'] = $this->Main_model->get_customer($data['pagtype'], $data['status'], $data['search']);
   $this->load->view('customer', $data);
 }
 public function cash_bank_acc()
 {
   $data = $this->login_details();
   $data['pagename'] = 'Bank Accounts List';
   $data['pagtype'] = 5;
   $data['search'] = $this->input->get('search');
   $data['status'] = $this->input->get('status');
   $data['all_value'] = $this->Main_model->get_customer($data['pagtype'], $data['status'], $data['search']);
   $this->load->view('customer', $data);
 }

 public function insert_customer()
 {
   if ($_SERVER["REQUEST_METHOD"] == "POST") {
     $data = $this->Main_model->insert_customer();
      if ($data == 2) {
       $info = array(
         'status' => 'success',
         'message' => 'Data has been Updated successfully!'
       );
     } else if ($data == 'multi') {

       $info = array(
         'status' => 'error',
         'message' => 'Mobile Number Can Not Be Same',

       );
     } else if ($data != '') {

       $info = array(
         'status' => 'success',
         'message' => 'Data has been Added successfully!',
         'cust_id' => $data,
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

 public function delete_customer()
 {
   if ($_SERVER["REQUEST_METHOD"] == "POST") {
     if ($data = $this->Main_model->delete_customer()) {

       $info = array(
         'status' => 'success',
         'message' => 'Data has been Delete successfully!'
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

 public function import_customer()
 {
   //$salon_id = $this->session->userdata('s_id');
   if (isset($_FILES['import_file'])) {
     require_once "Simplexlsx.class.php";
     $xlsx = new SimpleXLSX($_FILES['import_file']['tmp_name']);
     list($cols, $rows) = $xlsx->dimension();
     $i = 0;
     foreach ($xlsx->rows() as $row) {
       $i++;
       if ($i != 1) {

         $s_data = array(
           "m_acc_name" => $row[1],
           "m_acc_mobile" => $row[2],
           "m_acc_email" => $row[3],
           "m_acc_status" => 1,
           // "m_acc_city" => $city_id,
           // "m_acc_state" => $state_id,
           "m_acc_address" => $row[4],
           "m_acc_type" => 3,
           "m_acc_login_allow" => 1,
           // "m_acc_loginid" => $row[3],
           // "m_acc_password" => $row[9],
           "m_acc_added_by" => $this->session->userdata('user_id'),
           "m_acc_added_on" => date('Y-m-d H:i'),

         );

         $redirt = 'Account/customer';
         $this->db->insert('master_accounts_tbl', $s_data);
       }
     }
     echo "<script> alert('import Successfull'); </script>";
     redirect($redirt);
   } else {
     echo "<script> alert('Import is wrong'); </script>";
   }
 }


 //--------------------------------customer-----------------------//


	
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