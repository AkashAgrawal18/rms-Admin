<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contact extends CI_Controller {

	public function index()
	{   
		$data['pagename'] = 'Contact Us';
		$this->load->view('contact',$data);
	}

	 public function insert_contact()
        {
          if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if ($data = $this->Main_model->insert_contact()) {

              $info = array(
                'status' => 'success',
                'message' => 'Request has been Send successfully!'
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

}

