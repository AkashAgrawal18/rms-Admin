<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Register extends CI_Controller {

	public function index()
	{ 
		$data['pagename'] = 'Register';

          if($_SERVER["REQUEST_METHOD"] == "POST"){

		    $rules = array(
		      array('field'=>'login_mobile',   'label'=>'Phone Number',   'rules'=>'trim|required'), 
		      array('field'=>'login_pass', 'label'=>'Password','rules'=>'trim|required')
		    ); 
		    $this->form_validation->set_rules($rules); //pass the rules array here

		     //by default initial load condition
		    if ($this->form_validation->run() == FALSE) { }else{

		      if($data = $this->Login_model->validate_user()){


		       // print_r($data); die();
		        $usrdata=array('is_customer_in' => true, 'm_customer_id' => $data->m_user_id,'m_customer_type'=>$data->m_user_type,'m_customer_name'=>$data->m_user_name,'m_customer_mobile'=>$data->m_user_mobile);
		       // $usrdata=array('is_user_in' => true, 'user_id' => $data[0]->m_user_id,'user_type'=>$data[0]->m_user_type,'user_design'=>$data[0]->m_user_design_id);

		        $this->session->set_userdata($usrdata);
		         /* $this->User_model->manage_daily_activiy(); */     redirect('Dashboard');
		      }else{ 
		        $this->session->set_flashdata('status','<div class="alert alert-danger"> <strong><i class="fa fa-warning"></i> &nbsp; Some Problem Occurred !...</strong> Please Try Again. </div>');
		      }

		    }

		  }

        $this->load->view('register',$data);
	}

	 public function get_mobile()
         {

           $mobile_id = $this->input->post('cust_mobile');
           $customer_mobile= $this->Login_model->getmobileById($mobile_id);
           if ($customer_mobile) {
               echo json_encode([
                            'status'=>true,
                            'message'=>'Mobile already exits'
               ]);
           }else{
              echo json_encode([
                            'status'=>false,
                            'message'=>'Mobile not exits'
               ]);
           }
         }

         public function get_email()
         {

           $email_id = $this->input->post('cust_email');
           $customer_email = $this->Login_model->getemailById($email_id);
           if ($customer_email) {
               echo json_encode([
                            'status'=>true,
                            'message'=>'Email already exits'
               ]);
           }else{
              echo json_encode([
                            'status'=>false,
                            'message'=>'Email not exits'
               ]);
           }
         }

	public function insert_user()
        {
          if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $data = $this->Login_model->insert_user();
             if($data ==1){

              $info = array(
                'status' => 'success',
                'message' => 'Register has been Added successfully!'
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


        public function logout(){ 
        	session_destroy(); 
        	redirect('Register','refresh'); 
        }

}

