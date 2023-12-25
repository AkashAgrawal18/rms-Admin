<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Offer extends CI_Controller {

	public function index()
	{
		$this->load->view('offer');
	}

}

