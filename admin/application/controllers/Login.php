<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{

  public function index()
  {
    $data['pagename'] = "Log-in";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

      $rules = array(
        array('field' => 'login_email',   'label' => 'Email',   'rules' => 'trim|required'),
        array('field' => 'login_pass', 'label' => 'Password', 'rules' => 'trim|required')
      );
      $this->form_validation->set_rules($rules); //pass the rules array here

      //by default initial load condition
      if ($this->form_validation->run() == FALSE) {
      } else {

        if ($data = $this->Login_model->validate_user()) {


          // print_r($data); die();
          $usrdata = array('is_user_in' => true, 'user_id' => $data[0]->m_admin_id, 'user_type' => $data[0]->m_admin_type, 'user_name' => $data[0]->m_admin_name);
          $this->session->set_userdata($usrdata);
          /* $this->Main_model->manage_daily_activiy(); */
          redirect('Dashboard');
        } else {
          $this->session->set_flashdata('status', '<div class="alert alert-danger"> <strong><i class="fa fa-warning"></i> &nbsp; Some Problem Occurred !...</strong> Please Try Again. </div>');
        }
      }
    }

    $this->load->view('login', $data);
  }

  public function logout()
  {
    session_destroy();
    redirect('Login', 'refresh');
  }
}
