<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Success extends CI_Controller
{

    public function index()
    {   $data['pagename'] = 'Order Success';
        $this->load->view('success_message',$data);
    }
}
