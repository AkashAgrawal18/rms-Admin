<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

 public function index(){ 
  $data['pagename'] = "Log-in";

  if($_SERVER["REQUEST_METHOD"] == "POST"){

    $rules = array(
      array('field'=>'login_email',   'label'=>'Email',   'rules'=>'trim|required'), 
      array('field'=>'login_pass', 'label'=>'Password','rules'=>'trim|required')
    ); 
    $this->form_validation->set_rules($rules); //pass the rules array here

     //by default initial load condition
    if ($this->form_validation->run() == FALSE) { }else{

      if($data = $this->Login_model->validate_user()){


       // print_r($data); die();
        $usrdata=array('is_user_in' => true, 'user_id' => $data[0]->m_admin_id,'user_type'=>$data[0]->m_admin_type,'user_name'=>$data[0]->m_admin_name);
        $this->session->set_userdata($usrdata);
         /* $this->User_model->manage_daily_activiy(); */     redirect('Dashboard');
      }else{ 
        $this->session->set_flashdata('status','<div class="alert alert-danger"> <strong><i class="fa fa-warning"></i> &nbsp; Some Problem Occurred !...</strong> Please Try Again. </div>');
      }

    }

  }

  $this->load->view('login', $data); 
}

 
   // public function forget_password()
   //      {   
   //        //$data = $this->login_details();
   //        $data['pagename'] = "Forget Password";
   //        // $data['user_value'] =  $this->Main_model->get_active_user(); 
   //        $this->load->view('forget_pass',$data);
   //      }


   //    public function forget_pass()
   //      {
   //        if ($_SERVER["REQUEST_METHOD"] == "POST") {
   //          if ($data = $this->Login_model->forget_pass()) {
            
   //          if($data == 1) {
   //            $info = array(
   //              'status' => 'success',
   //              'message' => 'Password has been Updated successfully!'
   //            );


   //          } else if ($data == 2) {
   //              $info = array(
   //                'status' => 'success',
   //                'message' => 'Wrong User Name!!'
   //              );
   //            }
   //          } else {
   //            $info = array(
   //                'status' => 'success',
   //                'message' => 'Wrong User Name!!'
   //              );
   //          }
   //          echo json_encode($info);
   //        }


   //      }





}
