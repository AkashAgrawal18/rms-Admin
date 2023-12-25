<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Failure extends CI_Controller
{

    public function index()
    {
        $this->load->view('failure_message');
    }
}
