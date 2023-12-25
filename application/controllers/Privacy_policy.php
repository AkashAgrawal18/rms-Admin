<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Privacy_policy extends CI_Controller {

	public function index()
	{   
		$data['pagename'] = 'Privacy Policy';
		$this->load->view('privacy_policy',$data);
	}
	
}
