<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Terms_conditions extends CI_Controller {

	public function index()
	{   
		$data['pagename'] = 'Terms & Condition';
		$this->load->view('terms_conditions',$data);
	}
	
}
