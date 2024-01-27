<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Main extends CI_Controller
{


  //--------------------------------sales-----------------------//


  public function sales()
  {
    $data = $this->login_details();
    $data['pagename'] = 'Sales ';

    $data['from_date'] = $this->input->get('from_date');
    $data['to_date'] = $this->input->get('to_date');
    $data['search'] = $this->input->get('search');
    $data['user'] = $this->input->get('user');
    $data['all_value'] = $this->Main_model->get_all_sales(null, $data['user'], $data['search'], $data['from_date'], $data['to_date']);
    $data['all_user'] = $this->Main_model->get_customer(3, 1);

    // echo "<pre>"; print_r($data['all_value']);die();
    $this->load->view('sales', $data);
  }


  public function delete_sales()
  {

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      if ($data = $this->Main_model->delete_sales()) {
        $info = array(
          'status' => 'success',
          'message' => 'Data has been Deleted successfully!'
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

  //-------------------pos ----------------------------------------------//

  public function pos()
  {
    $data = $this->login_details();
    $data['pagename'] = 'POS';
    $data['slug'] = $this->uri->segment(3);
    $data['search'] =  $this->input->get('search');
    $data['paymode_list'] = $this->Main_model->get_customer(5, 1);
    $data['category'] = $this->Master_model->get_active_category();
    $data['customer'] = $this->Main_model->get_customer(1, 1);

    $this->load->view('pos', $data);
  }

  //-------------------/pos ----------------------------------------------//


  // public function edit_sales()
  // {
  //   $data = $this->login_details();
  //   $data['id'] = $this->input->get('id');
  //   if (!empty($data['id'])) {
  //     $data['pagename'] = 'Edit Sales';
  //     $data['product_list1'] = $this->Main_model->get_sale_items($data['id']);
  //     $data['edit_value'] = $this->Main_model->get_edit_sales($data['id']);
  //   } else {
  //     $data['pagename'] = 'Add Sales';
  //   }
  //   $data['product_list'] = $this->Master_model->get_active_products();
  //   $data['texgst'] = $this->Master_model->get_active_taxgst();
  //   $data['all_user'] = $this->Main_model->get_active_customer();
  //   // echo "<pre>";print_r($data['texgst']); die();
  //   $this->load->view('sales-edit', $data);
  // }



  public function delete_sale_item()
  {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      if ($data = $this->Main_model->delete_sale_item()) {
        $info = array(
          'status' => 'success',
          'message' => 'Data has been Deleted successfully!'
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

  public function insert_sales()
  {
    //     echo 'customer=' . $this->input->post('m_sale_customer');
    // die ;
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      if ($data = $this->Main_model->insert_sales()) {

        if ($data == 1) {
          $info = array(
            'status' => 'success',
            'message' => 'Data has been Added successfully!'
          );
        } else if ($data == 2) {
          $info = array(
            'status' => 'error',
            'message' => 'Paid Amount Should be equal to Net Amount'
          );
        } else {
          $info = array(
            'status' => 'error',
            'message' => $data,
          );
        }
      } else {
        $info = array(
          'status' => 'error',
          'message' => 'Some problem Occurred!! please try again'
        );
      }
      echo json_encode($info);
    }
  }

  // public function update_sales()
  // {

  //   if ($_SERVER["REQUEST_METHOD"] == "POST") {
  //     if ($data = $this->Main_model->insert_sales()) {

  //       if ($data == 1) {
  //         $info = array(
  //           'status' => 'success',
  //           'message' => 'Data has been Added successfully!'
  //         );
  //       } else if ($data == 2) {
  //         $info = array(
  //           'status' => 'success',
  //           'message' => 'Data Updated Successfully'
  //         );
  //       } else {
  //         $info = array(
  //           'status' => 'error',
  //           'message' => $data,
  //         );
  //       }
  //     } else {
  //       $info = array(
  //         'status' => 'error',
  //         'message' => 'Some problem Occurred!! please try again'
  //       );
  //     }
  //     echo json_encode($info);
  //   }
  // }

  // public function sales_return()
  // {
  //   $data = $this->login_details();
  //   $data['pagename'] = 'Sales Return';
  //   $this->load->view('sales-return', $data);
  // }

  //--------------------------------sales-----------------------//

  //-----------------------------purchese----------------------------//

  public function purchase()
  {
    $data = $this->login_details();
    $data['pagename'] = 'Purchase';

    $data['purtype'] = 1;
    $data['from_date'] = $this->input->get('from_date');
    $data['to_date'] = $this->input->get('to_date');
    $data['search'] = $this->input->get('search');
    $data['user'] = $this->input->get('user');
    $data['all_value'] = $this->Main_model->get_all_purchase(null, $data['user'], $data['search'], $data['from_date'], $data['to_date'], $data['purtype']);
    $data['all_user'] = $this->Main_model->get_customer(2, 1);
    // echo "<pre>";print_r($data['all_value']); die();
    $this->load->view('purchase', $data);
  }

  public function purchase_return()
  {
    $data = $this->login_details();
    $data['pagename'] = 'Purchase Return';
    $data['purtype'] = 2;
    $data['from_date'] = $this->input->get('from_date');
    $data['to_date'] = $this->input->get('to_date');
    $data['search'] = $this->input->get('search');
    $data['user'] = $this->input->get('user');
    $data['all_value'] = $this->Main_model->get_all_purchase(null, $data['user'], $data['search'], $data['from_date'], $data['to_date'], $data['purtype']);
    $data['all_user'] = $this->Main_model->get_customer(2, 1);
    $this->load->view('purchase', $data);
  }

  public function get_product_dtl()
  {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      $data = $this->Master_model->get_active_products(null, null, null, null, $this->input->post('itemid'));

      echo json_encode($data);
    }
  }

  public function get_avil_products()
  {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      $item = $this->input->post('item') ?: '';
      $cat = $this->input->post('cat') ?: '';
      $group = $this->input->post('group') ?: '';
      $search = $this->input->post('search') ?: '';
      $data = $this->Report_model->get_stock_list(null, date('Y-m-d'), $item, $cat, $search, $group);

      echo json_encode($data);
    }
  }

  public function edit_purchase($type = 1)
  {
    $data = $this->login_details();
    $data['id'] = $this->input->get('id');
    $data['purtype'] = $type;

    if (!empty($data['id'])) {
      $data['pagename'] = $type == 1 ? 'Edit Purchase' : 'Edit Return';
      $data['edit_value'] = $this->Main_model->get_all_purchase($data['id']);
    } else {
      $data['pagename'] = $type == 1 ? 'Add Purchase' : 'Add Return';
    }
    $data['product_list'] = $this->Master_model->get_active_products();
    $data['texgst'] = $this->Master_model->get_active_group(4);
    $data['all_user'] = $this->Main_model->get_customer(2, 1);

    // echo "<pre>"; print_r($data['edit_value']); die();
    $this->load->view('purchase-edit', $data);
  }


  public function insert_purchase()
  {

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      if ($data = $this->Main_model->insert_purchase()) {

        if ($data == 1) {
          $info = array(
            'status' => 'success',
            'message' => 'Data has been Added successfully!'
          );
        } else if ($data == 2) {
          $info = array(
            'status' => 'success',
            'message' => 'Data Updated Successfully'
          );
        } else {
          $info = array(
            'status' => 'error',
            'message' => $data,
          );
        }
      } else {
        $info = array(
          'status' => 'error',
          'message' => 'Some problem Occurred!! please try again'
        );
      }
      echo json_encode($info);
    }
  }


  public function delete_purchase_item()
  {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      if ($data = $this->Main_model->delete_purchase_item()) {
        $info = array(
          'status' => 'success',
          'message' => 'Data has been Deleted successfully!'
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

  public function delete_purchase()
  {

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      if ($data = $this->Main_model->delete_purchase()) {
        $info = array(
          'status' => 'success',
          'message' => 'Data has been Deleted successfully!'
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


  //-----------------------------------payment in -------------------------\\

  public function get_accounts_by_type()
  {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      $acctype = $this->input->post('actype');
      if ($acctype == 6) {
        $acctype = 5;
      }
      $data = $this->Main_model->get_customer($acctype);
      echo json_encode($data);
    }
  }

  public function payment_recieved()
  {
    $data = $this->login_details();
    $data['pagename'] = 'Payment Recieved';

    $data['search'] =  $this->input->get('search');
    $data['user'] =  $this->input->get('user');
    $data['pagetype'] = 1;
    $data['all_value'] = $this->Main_model->get_payment_list($data['pagetype'], $data['search'], $data['user']);
    $data['all_user'] = $this->Main_model->get_customer(1, 1);
    $data['all_pmode'] = $this->Main_model->get_customer(5, 1);
    // print_r($data['all_pmode']);die();
    $this->load->view('payment-in', $data);
  }

  public function payment_paid()
  {
    $data = $this->login_details();
    $data['pagename'] = 'Payment Paid';

    $data['search'] =  $this->input->get('search');
    $data['user'] =  $this->input->get('user');
    $data['pagetype'] = 2;
    $data['all_value'] = $this->Main_model->get_payment_list($data['pagetype'], $data['search'], $data['user']);
    $data['all_user'] = $this->Main_model->get_customer(2, 1);
    $data['all_pmode'] = $this->Main_model->get_customer(5, 1);
    // print_r($data['all_pmode']);die();
    $this->load->view('payment-in', $data);
  }

  public function insert_payment()
  {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      $data = $this->Main_model->insert_payment();
      if ($data == 1) {

        $info = array(
          'status' => 'success',
          'message' => 'Payment has been Added successfully!'
        );
      } else if ($data == 2) {
        $info = array(
          'status' => 'success',
          'message' => 'Payment  has been Updated successfully!'
        );
      } else {
        $info = array(
          'status' => 'error',
          'message' => 'Some problem Occurred! Please try again'
        );
      }
      echo json_encode($info);
    }
  }

  public function delete_payment()
  {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      if ($data = $this->Main_model->delete_payment()) {

        $info = array(
          'status' => 'success',
          'message' => 'Payment has been Delete successfully!'
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

  //-----------------------------------payment in -------------------------\\



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
