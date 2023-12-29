<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Main extends CI_Controller
{


  public function brands()
  {
    $data = $this->login_details();
    $data['pagename'] = 'Brands';
    $this->load->view('brands', $data);
  }
  //-----------------------------------categories----------------------------------//

  public function coupons()
  {
    $data = $this->login_details();
    $data['pagename'] = 'Coupons';
    $data['search'] = '';
    $data['search'] =  $this->input->get('search');
    $data['all_value'] = $this->Main_model->get_coupons($data['search']);
    $this->load->view('coupons', $data);
  }


  public function insert_coupons()
  {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      if ($data = $this->Main_model->insert_coupons()) {

        $info = array(
          'status' => 'success',
          'message' => 'Coupons has been Added successfully!'
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

  public function update_coupons()
  {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      if ($data = $this->Main_model->update_coupons()) {

        $info = array(
          'status' => 'success',
          'message' => 'Coupons has been Updated successfully!'
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


  public function delete_coupons()
  {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      if ($data = $this->Main_model->delete_coupons()) {

        $info = array(
          'status' => 'success',
          'message' => 'Coupons has been Delete successfully!'
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


  //-----------------------------------categories----------------------------------//
  public function categories()
  {
    $data = $this->login_details();
    $data['pagename'] = 'Categories';
    $data['search'] =  $this->input->get('search');
    // $data['category'] = $this->Main_model->get_category();
    $data['all_value'] = $this->Main_model->get_categories($data['search']);
    // echo "<pre>";print_r($data['all_value']);die();
    $this->load->view('categories', $data);
  }


  public function insert_categories()
  {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      if ($data = $this->Main_model->insert_categories()) {

        $info = array(
          'status' => 'success',
          'message' => 'categories has been Added successfully!'
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

  public function update_categories()
  {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      if ($data = $this->Main_model->update_categories()) {

        $info = array(
          'status' => 'success',
          'message' => 'categories has been Updated successfully!'
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


  public function delete_categories()
  {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      if ($data = $this->Main_model->delete_categories()) {

        $info = array(
          'status' => 'success',
          'message' => 'Categories has been Delete successfully!'
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


  public function import_categories()
  {
    //$salon_id = $this->session->userdata('s_id');
    if (isset($_FILES['import_file'])) {
      require_once "Simplexlsx.class.php";
      $xlsx = new SimpleXLSX($_FILES['import_file']['tmp_name']);
      list($cols, $rows) = $xlsx->dimension();
      $i = 0;
      foreach ($xlsx->rows() as $row) {
        $i++;
        if ($i != 1) {

          $s_data = array(
            "m_category_name" => $row[1],
            "m_category_slug" => $row[2],
            "m_category_status" => 1,
            "m_pcategory_id" => 1,
            "m_category_added_on" => date('Y-m-d H:i'),

          );

          $redirt = 'Main/categories';
          $this->db->insert('master_categories', $s_data);
        }
      }
      echo "<script> alert('import Successfull'); </script>";
      redirect($redirt);
    } else {
      echo "<script> alert('Import is wrong'); </script>";
    }
  }




  //-----------------------------------categories----------------------------------//
  //-------------------------------------products--------------------------------//

  public function products()
  {
    $data = $this->login_details();
    $data['pagename'] = 'Products';
   
    $data['search'] =  $this->input->get('search');
    $data['cat'] =  $this->input->get('category');
    $data['fabric'] =  $this->input->get('fabric');
    $data['categories'] = $this->Main_model->get_active_category();
    $data['fabric_list'] = $this->Main_model->get_active_group(5);
    $data['color_list'] = $this->Main_model->get_active_group(2);
    $data['size_list'] = $this->Main_model->get_active_group(3);
    $data['unit'] = $this->Main_model->get_active_group(1);
    $data['taxgst'] = $this->Main_model->get_active_group(4);
    $data['all_value'] = $this->Main_model->get_active_products($data['cat'],$data['fabric'],$data['search']);
    // echo "<pre>";print_r($data['all_value']);die();
    $this->load->view('product_list', $data);
  }

  public function insert_product()
  {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      if ($data = $this->Main_model->insert_product()) {

        $info = array(
          'status' => 'success',
          'message' => 'Product has been Added successfully!'
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

  public function update_product()
  {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      if ($data = $this->Main_model->update_product()) {

        $info = array(
          'status' => 'success',
          'message' => 'Product has been Updated successfully!'
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


  public function delete_product()
  {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      if ($data = $this->Main_model->delete_product()) {

        $info = array(
          'status' => 'success',
          'message' => 'Product has been Delete successfully!'
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

  //-------------------------------------/products--------------------------------//
  //-------------------pos ----------------------------------------------//

  public function pos()
  {
    $data = $this->login_details();
    $data['pagename'] = 'POS';
    $data['slug'] = '';
    $data['search'] = '';
    $data['slug'] = $this->uri->segment(3);
    $data['search'] =  $this->input->get('search');
    $data['category'] = $this->Main_model->get_active_category();
    $data['customer'] = $this->User_model->get_active_customer();
    //echo "<pre>"; print_r($data['products']);die();
    $this->load->view('pos', $data);
  }

  //-------------------/pos ----------------------------------------------//
  public function cash_bank()
  {
    $data = $this->login_details();
    $data['pagename'] = 'cash & bank';
    $this->load->view('cash-bank', $data);
  }

  //-------------------banner ----------------------------------------------//

  public function banner()
  {
    $data = $this->login_details();
    $data['pagename'] = 'banners';
    $data['all_value'] = $this->Main_model->get_banners();
    $this->load->view('banner', $data);
  }

  public function insert_banner()
  {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      if ($data = $this->Main_model->insert_banner()) {

        $info = array(
          'status' => 'success',
          'message' => 'Banner has been Added successfully!'
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

  public function update_banner()
  {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      if ($data = $this->Main_model->update_banner()) {

        $info = array(
          'status' => 'success',
          'message' => 'Banner has been Updated successfully!'
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


  public function delete_banner()
  {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      if ($data = $this->Main_model->delete_banner()) {

        $info = array(
          'status' => 'success',
          'message' => 'Banner has been Delete successfully!'
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


  //-------------------banner ----------------------------------------------//

  //-------------------offer ----------------------------------------------//

  public function offer()
  {
    $data = $this->login_details();
    $data['pagename'] = 'offer';
    $data['all_value'] = $this->Main_model->offer_list();
    $this->load->view('offer', $data);
  }

  public function insert_offer()
  {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      if ($data = $this->Main_model->insert_offer()) {

        $info = array(
          'status' => 'success',
          'message' => 'Offer has been Added successfully!'
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

  public function update_offer()
  {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      if ($data = $this->Main_model->update_offer()) {

        $info = array(
          'status' => 'success',
          'message' => 'Offer has been Updated successfully!'
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


  public function delete_offer()
  {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      if ($data = $this->Main_model->delete_offer()) {

        $info = array(
          'status' => 'success',
          'message' => 'Offer has been Delete successfully!'
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



  //-------------------/offer ----------------------------------------------//

  public function product_offers()
  {
    $data = $this->login_details();
    $data['pagename'] = 'product-offers';
    $typeid = $this->uri->segment(3);
    $data['typeid'] = $typeid;
    $data['product'] = $this->Main_model->all_product('');
    $data['typename'] = $this->Main_model->get_typename($typeid);
    $data['slugname'] = $data['typename'][0]->m_offer_slug;
    $data['product_o_w'] = $this->Main_model->all_product_offer($typeid);

    $this->load->view('product-offers', $data);
  }

  public function offer_add()
  {
    $type = $this->input->post('o_offer_type');
    $data['dashboard'] = $this->Main_model->make_offer($type);
    redirect('Main/product_offers/' . $type);
  }

  public function remove_offer()
  {
    $remove = $this->uri->segment(3);
    $type = $this->uri->segment(4);
    $data['category'] = $this->Main_model->delete_product_offers($remove);
    redirect('Main/product_offers/' . $type);
  }

  //------------------------------------- master Group --------------------------------//

  public function group_list($type = 1)
  {
    $data = $this->login_details();

    switch ($type) {
      case 1: {
          $data['pagetitle'] = 'Unit';
        }
        break;
      case 2: {
          $data['pagetitle'] = 'Color';
        }
        break;
      case 3: {
          $data['pagetitle'] = 'Size';
        }
        break;
      case 4: {
          $data['pagetitle'] = 'Tax';
        }
        break;
      case 5: {
          $data['pagetitle'] = 'Fabric';
        }
        break;
      case 6: {
          $data['pagetitle'] = 'Payment Mathod';
        }
        break;
    }

    $data['type'] = $type;
    $data['search'] =  $this->input->post('search');
    $data['all_value'] = $this->Main_model->get_group_list($data['type'], $data['search']);
    $this->load->view('group_list', $data);
  }

  public function insert_group()
  {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      if ($data = $this->Main_model->insert_group()) {

        $info = array(
          'status' => 'success',
          'message' => 'Data has been Added successfully!'
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


  public function delete_group()
  {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      if ($data = $this->Main_model->delete_group()) {

        $info = array(
          'status' => 'success',
          'message' => 'Data has been Delete successfully!'
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
  //-------------------------------------/master Group--------------------------------//
  //-------------------------------------paymode--------------------------------//

  public function paymode()
  {
    $data = $this->login_details();
    $data['pagename'] = 'Paymode';
    $data['search'] = '';
    $data['search'] =  $this->input->get('search');
    $data['all_value'] = $this->Main_model->get_paymode($data['search']);
    $this->load->view('paymode', $data);
  }


  public function insert_paymode()
  {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      if ($data = $this->Main_model->insert_paymode()) {

        $info = array(
          'status' => 'success',
          'message' => 'paymode has been Added successfully!'
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

  public function update_paymode()
  {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      if ($data = $this->Main_model->update_paymode()) {

        $info = array(
          'status' => 'success',
          'message' => 'paymode has been Updated successfully!'
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


  public function delete_paymode()
  {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      if ($data = $this->Main_model->delete_paymode()) {

        $info = array(
          'status' => 'success',
          'message' => 'paymode has been Delete successfully!'
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
  //-------------------------------------/paymode--------------------------------//
  //-------------------------------------color--------------------------------//

  public function color()
  {
    $data = $this->login_details();
    $data['pagename'] = 'Color';
    $data['search'] = '';
    $data['search'] =  $this->input->get('search');
    $data['all_value'] = $this->Main_model->get_color($data['search']);
    $this->load->view('color', $data);
  }

  public function insert_color()
  {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      if ($data = $this->Main_model->insert_color()) {

        $info = array(
          'status' => 'success',
          'message' => 'Color has been Added successfully!'
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

  public function update_color()
  {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      if ($data = $this->Main_model->update_color()) {

        $info = array(
          'status' => 'success',
          'message' => 'Color has been Updated successfully!'
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


  public function delete_color()
  {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      if ($data = $this->Main_model->delete_color()) {

        $info = array(
          'status' => 'success',
          'message' => 'Color has been Delete successfully!'
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
  //-------------------------------------/color--------------------------------//
  //-------------------------------------Size--------------------------------//

  public function Size()
  {
    $data = $this->login_details();
    $data['pagename'] = 'Size';
    $data['search'] = '';
    $data['search'] =  $this->input->get('search');
    $data['all_value'] = $this->Main_model->get_size($data['search']);
    $this->load->view('size', $data);
  }

  public function insert_size()
  {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      if ($data = $this->Main_model->insert_size()) {

        $info = array(
          'status' => 'success',
          'message' => 'Size has been Added successfully!'
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

  public function update_size()
  {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      if ($data = $this->Main_model->update_size()) {

        $info = array(
          'status' => 'success',
          'message' => 'Size has been Updated successfully!'
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


  public function delete_size()
  {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      if ($data = $this->Main_model->delete_size()) {

        $info = array(
          'status' => 'success',
          'message' => 'Size has been Delete successfully!'
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
  //-------------------------------------/size--------------------------------//

  //-------------------------------------color--------------------------------//

  public function fabric()
  {
    $data = $this->login_details();
    $data['pagename'] = 'Fabric';
    $data['search'] = '';
    $data['search'] =  $this->input->get('search');
    $data['all_value'] = $this->Main_model->get_fabric($data['search']);
    $this->load->view('fabric', $data);
  }

  public function insert_fabric()
  {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      if ($data = $this->Main_model->insert_fabric()) {

        $info = array(
          'status' => 'success',
          'message' => 'Fabric has been Added successfully!'
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

  public function update_fabric()
  {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      if ($data = $this->Main_model->update_fabric()) {

        $info = array(
          'status' => 'success',
          'message' => 'Fabric has been Updated successfully!'
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


  public function delete_fabric()
  {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      if ($data = $this->Main_model->delete_fabric()) {

        $info = array(
          'status' => 'success',
          'message' => 'Fabric has been Delete successfully!'
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
  //-------------------------------------/fabric--------------------------------//

  //-------------------------------------taxgst--------------------------------//

  public function taxgst()
  {
    $data = $this->login_details();
    $data['pagename'] = 'Taxgst';
    $data['search'] = '';
    $data['search'] =  $this->input->get('search');
    $data['all_value'] = $this->Main_model->get_taxgst($data['search']);
    $this->load->view('taxgst', $data);
  }

  public function insert_taxgst()
  {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      if ($data = $this->Main_model->insert_taxgst()) {

        $info = array(
          'status' => 'success',
          'message' => 'Taxgst has been Added successfully!'
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

  public function update_taxgst()
  {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      if ($data = $this->Main_model->update_taxgst()) {

        $info = array(
          'status' => 'success',
          'message' => 'Taxgst has been Updated successfully!'
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


  public function delete_taxgst()
  {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      if ($data = $this->Main_model->delete_taxgst()) {

        $info = array(
          'status' => 'success',
          'message' => 'Taxgst has been Delete successfully!'
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
  //-------------------------------------/taxgst--------------------------------//


  //-------------------------------------unit--------------------------------//

  public function products_image()
  {
    $data = $this->login_details();
    $data['pagename'] = 'Product Image';
    // $data['search'] = '';
    $data['pid'] =  $this->uri->segment(3);
    $data['all_value'] = $this->Main_model->get_image($data['pid']);
    $this->load->view('image', $data);
  }

  public function insert_image()
  {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      if ($data = $this->Main_model->insert_image()) {

        $info = array(
          'status' => 'success',
          'message' => 'Image has been Added successfully!'
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

  public function update_image()
  {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      if ($data = $this->Main_model->update_image()) {

        $info = array(
          'status' => 'success',
          'message' => 'Image has been Updated successfully!'
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


  public function delete_image()
  {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      if ($data = $this->Main_model->delete_image()) {

        $info = array(
          'status' => 'success',
          'message' => 'Image has been Delete successfully!'
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
  //-------------------------------------/unit--------------------------------//

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
