<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Report extends CI_Controller
{

    //==========================Stock List===========================//
  
    public function stock_ledger()
    {
        $data = $this->login_details();
        $data['pagename'] = "Stock Ledger";
        $data['item_id'] = $this->input->post('item_id');
        $data['cat_id'] = $this->input->post('cat_id');
        $data['from_date'] = $this->input->post('from_date');
        $data['to_date'] = $this->input->post('to_date') ?: date('Y-m-d');
        $data['all_items'] = $this->Main_model->all_product($data['cat_id']);
        $data['all_cate'] = $this->Main_model->get_active_category();
        $data['all_value'] = $this->Report_model->get_stock_list($data['from_date'],$data['to_date'], $data['item_id'],$data['cat_id']);
        // echo '<pre>'; print_r( $data['all_value'] ); die ;
        $this->load->view('stock_ledger', $data);
    }

    // public function get_lotwise_item()
    // {
    //     $data['item_id'] = $this->input->post('item_id');
    //     $data['from_date'] = '';
    //     $data['to_date'] = date('Y-m-d');

    //     $all_value = $this->Report_model->get_lotwise_item($data['from_date'], $data['to_date'], $data['item_id']);
    //     echo json_encode($all_value);
    //     //  echo '<pre>'; print_r($data['all_value']); die ;
    // }

    // public function lotwise_sales_list()
    // {
    //     $all_value = $this->Report_model->lotwise_sales_list($this->input->post('lotno'), $this->input->post('item_id'));
    //     echo json_encode($all_value);
    // }
    //==========================Stock List===========================//

    //==========================Details===========================//
    protected function login_details()
    {
        $this->require_login();
        $data['log_user_dtl'] = $this->Login_model->user_details();
        return $data;
    }
    //=========================/Details===========================//
    //======================Login Validation======================//

    protected function require_login()
    {

        $is_user_in = $this->session->userdata('is_user_in');

        if (isset($is_user_in) || $is_user_in == true) {
            return;
        } else {
            redirect('Login');
        }
    }

    protected function ajax_login()
    {

        $is_user_in = $this->session->userdata('is_user_in');

        if (isset($is_user_in) || $is_user_in == true) {
            return true;
        } else {
            echo json_encode(array('status' => 'error', 'message' => 'You are not Logged in Now!! Please login again.'));
            return false;
        }
    }
    //======================/Login Validation======================//

}
