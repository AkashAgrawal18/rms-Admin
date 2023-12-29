<?php date_default_timezone_set('Asia/Kolkata');
class User_model extends CI_model
{

  //-------------------user-----------------------------------//
  public function get_active_user()
  {
    $this->db->select('*');
    $this->db->order_by('m_user_id');
    $this->db->where('m_user_type', 1);
    $this->db->where('m_user_status', 1);
    $res = $this->db->get('master_users_tbl')->result();
    return $res;
  }
  //-------------------user-----------------------------------//

  //--------------------------------customer-----------------------//
  public function getcustmobileById($mobile_id)
  {

    //print_r($id);die();
    $user_mobile = $this->db->select('m_user_mobile,m_user_id,m_user_type')
      ->where('m_user_mobile', $mobile_id)->where('m_user_type', 3)->get('master_users_tbl')->result();

    // print_r($user_mobile); die(); 
    return $user_mobile;
  }


  public function get_customer($status, $search)
  {
    $this->db->select('*');

    // $this->db->select_sum('m_user_open_balance', 'total_balance');
    $this->db->order_by('m_user_id');
    $this->db->where('m_user_type', 3);
    if (!empty($status)) {
      $this->db->where('m_user_status', $status);
    }
    if ($search != NULL) {

      $this->db->like('m_user_name', $search, 'both');
      $this->db->or_like('m_user_mobile', $search, 'both');
      $this->db->or_like('m_user_email', $search, 'both');

      // $this->db->or_like('address',$search_key,'both');

    }
    $res = $this->db->get('master_users_tbl')->result();
    return $res;
  }

  public function get_active_customer()
  {
    $this->db->select('*');
    $this->db->order_by('m_user_id');
    $this->db->where('m_user_type', 3);
    $this->db->where('m_user_status', 1);
    $res = $this->db->get('master_users_tbl')->result();
    return $res;
  }



  public function insert_customer()
  {

    if (!empty($_FILES['cust_image']['name'])) {
      $config['file_name'] = $_FILES['cust_image']['name'];
      $config['upload_path'] = 'uploads/user';
      $config['allowed_types'] = 'jpg|jpeg|png';
      $config['remove_spaces'] = TRUE;
      $config['file_name'] = $_FILES['cust_image']['name'];
      //Load upload library and initialize configuration
      $this->load->library('upload', $config);
      $this->upload->initialize($config);
      if ($this->upload->do_upload('cust_image')) {
        $uploadData = $this->upload->data();
        if (!empty($update_data['cust_image'])) {
          if (file_exists($config['cust_image'] . $update_data['cust_image'])) {
            unlink($config['upload_path'] . $update_data['cust_image']); /* deleting Image */
          }
        }
        $cust_image = $uploadData['file_name'];
      }
    } else {
      $cust_image = '';
    }

    $data = array(

      "m_user_name" => $this->input->post('cust_name'),
      "m_user_mobile" => $this->input->post('cust_mobile'),
      "m_user_email" => $this->input->post('cust_email'),
      "m_user_status" => $this->input->post('cust_status'),
      // "m_user_city" => $this->input->post('m_user_city'),
      // "m_user_state" => $this->input->post('m_user_state'),
      "m_user_address" => $this->input->post('Billing_address'),
      "m_user_saddress" => $this->input->post('shipping_address'),
      "m_user_credit_limit" => $this->input->post('credit_limit'),
      "m_user_credit_period" => $this->input->post('cust_credit_period'),
      "m_user_open_balance" => $this->input->post('cust_open_balance'),
      "m_user_text_num" => $this->input->post('cust_text_num'),
      "m_user_type" => $this->input->post('m_user_type'),
      "m_user_design" => 3,  //customer design
      "m_user_login_allow" => 1,
      "m_user_loginid" => $this->input->post('cust_email'),
      "m_user_password" => $this->input->post('cust_pass'),
      "m_user_image" => $cust_image,


    );

    $data['m_user_added_on'] = date('Y-m-d H:i');
    $data['m_user_added_by'] = $this->session->userdata('user_id');
    $res = $this->db->insert('master_users_tbl', $data);
    return $res;
  }

  public function update_customer()
  {

    if (!empty($_FILES['cust_image']['name'])) {
      $config['file_name'] = $_FILES['cust_image']['name'];
      $config['upload_path'] = 'uploads/user';
      $config['allowed_types'] = 'jpg|jpeg|png';
      $config['remove_spaces'] = TRUE;
      $config['file_name'] = $_FILES['cust_image']['name'];
      //Load upload library and initialize configuration
      $this->load->library('upload', $config);
      $this->upload->initialize($config);
      if ($this->upload->do_upload('cust_image')) {
        $uploadData = $this->upload->data();
        if (!empty($update_data['cust_image'])) {
          if (file_exists($config['cust_image'] . $update_data['cust_image'])) {
            unlink($config['upload_path'] . $update_data['cust_image']); /* deleting Image */
          }
        }
        $cust_image = $uploadData['file_name'];
      }
    } else {
      $cust_image = $this->input->post('cust_image1');
    }

    $cust_id = $this->input->post('cust_id');

    $data = array(

      "m_user_name" => $this->input->post('cust_name'),
      "m_user_mobile" => $this->input->post('cust_mobile'),
      "m_user_email" => $this->input->post('cust_email'),
      "m_user_status" => $this->input->post('cust_status'),
      // "m_user_city" => $this->input->post('m_user_city'),
      // "m_user_state" => $this->input->post('m_user_state'),
      "m_user_address" => $this->input->post('Billing_address'),
      "m_user_saddress" => $this->input->post('shipping_address'),
      "m_user_credit_limit" => $this->input->post('credit_limit'),
      "m_user_credit_period" => $this->input->post('cust_credit_period'),
      "m_user_open_balance" => $this->input->post('cust_open_balance'),
      "m_user_text_num" => $this->input->post('cust_text_num'),
      "m_user_type" => $this->input->post('m_user_type'),
      "m_user_design" => 3,  //customer design
      "m_user_login_allow" => 1,
      "m_user_loginid" => $this->input->post('cust_email'),
      "m_user_password" => $this->input->post('cust_pass'),
      "m_user_image" => $cust_image,

    );
    $data['m_user_updated_by'] = $this->session->userdata('user_id');
    $data['m_user_updated_on'] = date('Y-m-d H:i');
    $res = $this->db->where('m_user_id', $cust_id)->update('master_users_tbl', $data);
    return $res;
  }

  public function delete_customer()
  {
    $this->db->where('m_user_id', $this->input->post('delete_id'));
    return $this->db->delete('master_users_tbl');
  }



  //pos page add customer 
  public function insert_newcustomer()
  {

    if (!empty($_FILES['cust_image']['name'])) {
      $config['file_name'] = $_FILES['cust_image']['name'];
      $config['upload_path'] = 'uploads/user';
      $config['allowed_types'] = 'jpg|jpeg|png';
      $config['remove_spaces'] = TRUE;
      $config['file_name'] = $_FILES['cust_image']['name'];
      //Load upload library and initialize configuration
      $this->load->library('upload', $config);
      $this->upload->initialize($config);
      if ($this->upload->do_upload('cust_image')) {
        $uploadData = $this->upload->data();
        if (!empty($update_data['cust_image'])) {
          if (file_exists($config['cust_image'] . $update_data['cust_image'])) {
            unlink($config['upload_path'] . $update_data['cust_image']); /* deleting Image */
          }
        }
        $cust_image = $uploadData['file_name'];
      }
    } else {
      $cust_image = '';
    }

    $data = array(

      "m_user_name" => $this->input->post('cust_name'),
      "m_user_mobile" => $this->input->post('cust_mobile'),
      "m_user_email" => $this->input->post('cust_email'),
      "m_user_status" => $this->input->post('cust_status'),
      // "m_user_city" => $this->input->post('m_user_city'),
      // "m_user_state" => $this->input->post('m_user_state'),
      "m_user_address" => $this->input->post('Billing_address'),
      "m_user_saddress" => $this->input->post('shipping_address'),
      "m_user_credit_limit" => $this->input->post('credit_limit'),
      "m_user_credit_period" => $this->input->post('cust_credit_period'),
      "m_user_open_balance" => $this->input->post('cust_open_balance'),
      "m_user_text_num" => $this->input->post('cust_text_num'),
      "m_user_type" => $this->input->post('m_user_type'),
      "m_user_design" => 3,  //customer design
      "m_user_login_allow" => 1,
      "m_user_loginid" => $this->input->post('cust_email'),
      "m_user_password" => $this->input->post('cust_pass'),
      "m_user_image" => $cust_image,


    );

    $data['m_user_added_on'] = date('Y-m-d H:i');
    $data['m_user_added_by'] = $this->session->userdata('user_id');
    $res = $this->db->insert('master_users_tbl', $data);
    return $res;
  }


  //--------------------------------/customer-----------------------//

  //--------------------------------Supplier-----------------------//

  public function getsuppmobileById($mobile_id)
  {

    //print_r($id);die();
    $user_mobile = $this->db->select('m_user_mobile,m_user_id,m_user_type')
      ->where('m_user_mobile', $mobile_id)->where('m_user_type', 4)->get('master_users_tbl')->result();

    // print_r($user_mobile); die(); 
    return $user_mobile;
  }




  public function get_supplier($status, $search)
  {
    $this->db->select('*');

    // $this->db->select_sum('m_user_open_balance', 'total_balance');
    $this->db->order_by('m_user_id');
    $this->db->where('m_user_type', 4);

    if (!empty($status)) {
      $this->db->where('m_user_status', $status);
    }
    if ($search != NULL) {

      $this->db->like('m_user_name', $search, 'both');
      $this->db->or_like('m_user_mobile', $search, 'both');
      $this->db->or_like('m_user_email', $search, 'both');
    }
    $res = $this->db->get('master_users_tbl')->result();
    return $res;
  }

  public function get_active_supplier()
  {
    $this->db->select('*');
    $this->db->order_by('m_user_id');
    $this->db->where('m_user_type', 4);
    $this->db->where('m_user_status', 1);
    $res = $this->db->get('master_users_tbl')->result();
    return $res;
  }



  public function insert_supplier()
  {

    if (!empty($_FILES['suppl_image']['name'])) {
      $config['file_name'] = $_FILES['suppl_image']['name'];
      $config['upload_path'] = 'uploads/user';
      $config['allowed_types'] = 'jpg|jpeg|png';
      $config['remove_spaces'] = TRUE;
      $config['file_name'] = $_FILES['suppl_image']['name'];
      //Load upload library and initialize configuration
      $this->load->library('upload', $config);
      $this->upload->initialize($config);
      if ($this->upload->do_upload('suppl_image')) {
        $uploadData = $this->upload->data();
        if (!empty($update_data['suppl_image'])) {
          if (file_exists($config['suppl_image'] . $update_data['suppl_image'])) {
            unlink($config['upload_path'] . $update_data['suppl_image']); /* deleting Image */
          }
        }
        $suppl_image = $uploadData['file_name'];
      }
    } else {
      $suppl_image = '';
    }

    $data = array(

      "m_user_name" => $this->input->post('suppl_name'),
      "m_user_mobile" => $this->input->post('suppl_mobile'),
      "m_user_email" => $this->input->post('suppl_email'),
      "m_user_status" => $this->input->post('suppl_status'),
      // "m_user_city" => $this->input->post('m_user_city'),
      // "m_user_state" => $this->input->post('m_user_state'),
      "m_user_address" => $this->input->post('Billing_address'),
      "m_user_saddress" => $this->input->post('shipping_address'),
      "m_user_credit_limit" => $this->input->post('credit_limit'),
      "m_user_credit_period" => $this->input->post('suppl_credit_period'),
      "m_user_open_balance" => $this->input->post('suppl_open_balance'),
      "m_user_text_num" => $this->input->post('suppl_text_num'),
      "m_user_type" => $this->input->post('m_user_type'),
      "m_user_design" => 4,  //supplier design
      "m_user_login_allow" => 1,
      "m_user_loginid" => $this->input->post('suppl_email'),
      "m_user_password" => $this->input->post('suppl_pass'),
      "m_user_image" => $suppl_image,

    );
    $data['m_user_added_by'] = $this->session->userdata('user_id');
    $data['m_user_added_on'] = date('Y-m-d H:i');
    $res = $this->db->insert('master_users_tbl', $data);
    return $res;
  }

  public function update_supplier()
  {

    if (!empty($_FILES['suppl_image']['name'])) {
      $config['file_name'] = $_FILES['suppl_image']['name'];
      $config['upload_path'] = 'uploads/user';
      $config['allowed_types'] = 'jpg|jpeg|png';
      $config['remove_spaces'] = TRUE;
      $config['file_name'] = $_FILES['suppl_image']['name'];
      //Load upload library and initialize configuration
      $this->load->library('upload', $config);
      $this->upload->initialize($config);
      if ($this->upload->do_upload('suppl_image')) {
        $uploadData = $this->upload->data();
        if (!empty($update_data['suppl_image'])) {
          if (file_exists($config['suppl_image'] . $update_data['suppl_image'])) {
            unlink($config['upload_path'] . $update_data['suppl_image']); /* deleting Image */
          }
        }
        $suppl_image = $uploadData['file_name'];
      }
    } else {
      $suppl_image = $this->input->post('suppl_image1');
    }

    $suppl_id = $this->input->post('suppl_id');

    $data = array(

      "m_user_name" => $this->input->post('suppl_name'),
      "m_user_mobile" => $this->input->post('suppl_mobile'),
      "m_user_email" => $this->input->post('suppl_email'),
      "m_user_status" => $this->input->post('suppl_status'),
      // "m_user_city" => $this->input->post('m_user_city'),
      // "m_user_state" => $this->input->post('m_user_state'),
      "m_user_address" => $this->input->post('Billing_address'),
      "m_user_saddress" => $this->input->post('shipping_address'),
      "m_user_credit_limit" => $this->input->post('credit_limit'),
      "m_user_credit_period" => $this->input->post('suppl_credit_period'),
      "m_user_open_balance" => $this->input->post('suppl_open_balance'),
      "m_user_text_num" => $this->input->post('suppl_text_num'),
      "m_user_type" => $this->input->post('m_user_type'),
      "m_user_design" => 4,  //supplier design
      "m_user_login_allow" => 1,
      "m_user_loginid" => $this->input->post('suppl_email'),
      "m_user_password" => $this->input->post('suppl_pass'),
      "m_user_image" => $suppl_image,

    );
    $data['m_user_updated_by'] = $this->session->userdata('user_id');
    $data['m_user_updated_on'] = date('Y-m-d H:i');
    $res = $this->db->where('m_user_id', $suppl_id)->update('master_users_tbl', $data);
    return $res;
  }

  public function delete_supplier()
  {
    $this->db->where('m_user_id', $this->input->post('delete_id'));
    return $this->db->delete('master_users_tbl');
  }

  //--------------------------------sales-----------------------//

  public function get_all_sales($order_id = '', $user = '', $search = '', $from_date = '', $to_date = '')
  {
    if (!empty($order_id)) {
      $this->db->where('m_sale_spo', $order_id);
    }
    if (!empty($user)) {
      $this->db->where('m_sale_customer', $user);
    }
    if ($search != NULL) {

      // $this->db->like('m_user_name',$search,'both');
      $this->db->or_like('m_sale_spo', $search, 'both');
      // $this->db->or_like('m_sale_invoiceno', $search, 'both');
    }
    if (!empty($from_date)) {
      $this->db->where('DATE_FORMAT(m_sale_added_on,"%Y-%m-%d")>=', $from_date);
    }
    if (!empty($to_date)) {
      $this->db->where('DATE_FORMAT(m_sale_added_on,"%Y-%m-%d")<=', $to_date);
    }

    $this->db->select('m_sale_spo,sum(m_sale_qty) as total_qty,sum(m_sale_total) as sub_total,m_sale_date,sum(m_sale_gst) as total_tax,m_sale_discount,m_sale_shipping,m_sale_coupon,m_sale_ispartial,m_sale_pstatus,m_sale_pmode,m_sale_payamt,m_sale_pmode2,m_sale_payamt2,m_sale_status,m_sale_added_on,m_sale_user,m_sale_customer,m_user_name,m_user_mobile,m_user_address,m_user_saddress,m_user_email,pmode1.m_pmode_name as pmodename1,pmode2.m_pmode_name as pmodename2');
    $this->db->join(' master_users_tbl mct', 'mct.m_user_id = master_sales_tbl.m_sale_customer', 'left');
    $this->db->join('master_paymode_tbl pmode1', 'pmode1.m_pmode_id = master_sales_tbl.m_sale_pmode', 'left');
    $this->db->join('master_paymode_tbl pmode2', 'pmode2.m_pmode_id = master_sales_tbl.m_sale_pmode2', 'left');
    $this->db->group_by('m_sale_spo');
    $sale_list = $this->db->get('master_sales_tbl')->result();

    if (!empty($sale_list)) {
      foreach ($sale_list as $skey) {

        $res = (object)array(
          "m_sale_spo" => $skey->m_sale_spo,
          "total_qty" => $skey->total_qty,
          "sub_total" => $skey->sub_total,
          "m_sale_date" => $skey->m_sale_date,
          "total_tax" => $skey->total_tax,
          "m_sale_discount" => $skey->m_sale_discount,
          "m_sale_shipping" => $skey->m_sale_shipping,
          "m_sale_nettotal" => ($skey->sub_total + $skey->total_tax + $skey->m_sale_shipping -  $skey->m_sale_discount),
          "m_sale_coupon" => $skey->m_sale_coupon,
          "m_sale_ispartial" => $skey->m_sale_ispartial,
          "m_sale_pstatus" => $skey->m_sale_pstatus,
          "m_sale_pmode" => $skey->m_sale_pmode,
          "m_sale_payamt" => $skey->m_sale_payamt,
          "m_sale_pmode2" => $skey->m_sale_pmode2,
          "m_sale_payamt2" => $skey->m_sale_payamt2,
          "m_sale_status" => $skey->m_sale_status,
          "m_sale_added_on" => $skey->m_sale_added_on,
          "m_sale_user" => $skey->m_sale_user,
          "m_sale_customer" => $skey->m_sale_customer,
          "m_user_name" => $skey->m_user_name,
          "m_user_mobile" => $skey->m_user_mobile,
          "m_user_address" => $skey->m_user_address,
          "m_user_saddress" => $skey->m_user_saddress,
          "m_user_email" => $skey->m_user_email,
          "pmodename1" => $skey->pmodename1,
          "pmodename2" => $skey->pmodename2,
          "m_sale_items" => $this->get_sale_items($skey->m_sale_spo, $skey->m_sale_customer),

        );

        $result[] = $res;
      }
    }
    return $result;
  }

  public function get_sale_items($order_id, $uid = '')
  {
    $this->db->select('m_sale_spo,m_sale_qty,m_sale_price,m_sale_total,m_sale_date,m_sale_product,m_sale_size,m_sale_price,m_sale_gst,m_sale_color,m_product_name,m_color_name,m_size_name,m_unit_title,m_category_name,m_fabric_name');
    $this->db->join('master_product mit', 'mit.m_product_id = master_sales_tbl.m_sale_product', 'left')
      ->join('master_color_tbl as color', 'color.m_color_id  = master_sales_tbl.m_sale_color', 'left')
      ->join('master_size_tbl as size', 'size.m_size_id  = master_sales_tbl.m_sale_size', 'left')
      ->join('master_unit as unit', 'unit.m_unit_id = mit.m_product_unit', 'left')
      ->join('master_categories as cate', 'cate.m_category_id  = mit.m_product_cat_id', 'left')
      ->join('master_fabric_tbl as fabric', 'fabric.m_fabric_id  = mit.m_product_fabric', 'left');

    if (!empty($uid)) {
      $this->db->where('m_sale_customer', $uid);
    }

    $this->db->where('m_sale_spo', $order_id);

    return $this->db->get('master_sales_tbl')->result();
  }


  public function delete_sales()
  {
    $this->db->where('m_sale_spo', $this->input->post('delete_id'));
    $this->db->delete('master_sales_tbl');
    return true;
  }

  public function get_edit_sales($salesid)
  {
    $this->db->select('m_sale_spo,m_sale_invoiceno,m_sale_date,m_sale_customer');

    $this->db->join('master_users_tbl added_by', 'added_by.m_user_id = master_sales_tbl.m_sale_added_by', 'left');
    $this->db->join('master_users_tbl updated_by', 'updated_by.m_user_id = master_sales_tbl.m_sale_updaded_by', 'left');
    $this->db->join('master_users_tbl customer', 'customer.m_user_id = master_sales_tbl.m_sale_customer', 'left');

    // $this->db->where('m_purchase_supplier', $uid);
    $this->db->where('m_sale_spo', $salesid);
    $this->db->group_by('m_sale_spo');
    return $this->db->get('master_sales_tbl')->row();
  }

  public function delete_sale_item()
  {
    $this->db->where('m_sale_id', $this->input->post('delete_id'));
    $this->db->delete('master_sales_tbl');
    return true;
  }



  public function insert_sales()
  {

    $res = $this->db->select('m_sale_spo')->order_by('m_sale_id', 'desc')->get('master_sales_tbl')->row();
    // $res ='UT/2023/0100';

    if (!empty($res)) {
      $part = explode('/', $res->m_sale_spo);
      $spo = 'ORD/' . date('dmy') . '/' . sprintf('%04d', ($part[2] + 1));
    } else {
      $spo = 'ORD/' . date('dmy') . '/0001';
    }


    // $spo  = str_pad(rand(0, 99999), 5, '0', STR_PAD_LEFT);
    $m_sale_id = $this->input->post('m_sale_id');

    $m_sale_product = $this->input->post('m_sale_product');
    $m_sale_price = $this->input->post('m_sale_price');
    $m_sale_qty = $this->input->post('m_sale_qty');

    $m_sale_total = $this->input->post('m_sale_total');
    $m_sale_gst = $this->input->post('m_sale_gst');

    $m_sale_color = $this->input->post('m_sale_color');
    $m_sale_size = $this->input->post('m_sale_size');

    $m_sale_nettotal = $this->input->post('m_sale_nettotal');
    $m_sale_payamt = $this->input->post('m_sale_payamt');
    $m_sale_payamt2 = $this->input->post('m_sale_payamt2');

    $baldif = ($m_sale_nettotal - $m_sale_payamt - $m_sale_payamt2);
    //  echo $m_sale_nettotal .'-' ;
    //  echo $m_sale_payamt .'-' ;
    //  echo $m_sale_payamt .'-' ;
    //  echo $baldif ; die ;
    if ($baldif >= 1) {
      return 2;
    }

    foreach ($m_sale_product as $cua => $key) {
      if (!empty($key)) {
        $insert_data = array(
          "m_sale_date"    => date('Y-m-d'),
          // "m_sale_invoiceno" => $this->input->post('m_sale_invoice'),
          "m_sale_customer" => $this->input->post('m_sale_customer'),
          "m_sale_spo" => $spo,
          "m_sale_product" => $key,
          "m_sale_price" => $m_sale_price[$cua],
          "m_sale_qty" => $m_sale_qty[$cua],
          "m_sale_total" => $m_sale_total[$cua],
          "m_sale_gst" => $m_sale_gst[$cua],
          "m_sale_color" => $m_sale_color[$cua],
          "m_sale_size" => $m_sale_size[$cua],
          "m_sale_discount" => $this->input->post('m_sale_discount'),
          "m_sale_shipping" => $this->input->post('m_sale_shipping'),
          "m_sale_ispartial" => $this->input->post('m_sale_ispartial') ?: 0,
          "m_sale_pmode" => $this->input->post('m_sale_pmode'),
          "m_sale_payamt" => $m_sale_payamt,
          "m_sale_pmode2" => $this->input->post('m_sale_pmode2') ?: 0,
          "m_sale_payamt2" => $m_sale_payamt2 ?: 0,
          "m_sale_pstatus" => 1,

        );

        $insert_data['m_sale_status'] = 1;
        $insert_data['m_sale_user'] = $this->session->userdata('user_id');
        $insert_data['m_sale_added_by'] = $this->session->userdata('user_id');
        $insert_data['m_sale_added_on'] = date('Y-m-d H:i');

        // echo '<pre>'; print_r($insert_data); 

        $res = $this->db->insert('master_sales_tbl', $insert_data);
        // echo $res;
      }
    }
    // die ;
    return 1;
  }

  //--------------------------------/sales-----------------------//


  //-----------------------------purchese----------------------------//

  public function get_active_products($cat = '', $item = '')
  {
    $result = array();

    if (!empty($cat)) {
      $this->db->where('m_product_cat_id', $cat);
    }
    if (!empty($item)) {
      $this->db->where('m_product_id', $item);
    }
    $sql = $this->db->join('master_taxgst', 'master_taxgst.m_taxgst_id = master_product.m_product_taxgst', 'left')->join('master_categories', 'master_categories.m_category_id = master_product.m_product_cat_id', 'left')->join('master_unit', 'master_unit.m_unit_id = master_product.m_product_unit', 'left')->join('master_fabric_tbl', 'master_fabric_tbl.m_fabric_id = master_product.m_product_fabric', 'left')->where('m_product_status', 1)->get('master_product')->result();

    if (!empty($sql)) {
      foreach ($sql as $key => $value) {
        $product_colors = $this->db->select('m_color_id,m_color_name')->where_in('m_color_id', explode(',', $value->m_product_color))->get('master_color_tbl')->result();

        $product_size = $this->db->select('m_size_id,m_size_name')->where_in('m_size_id', explode(',', $value->m_product_size))->get('master_size_tbl')->result();

        $product_images = $this->db->select('m_image_id,m_image_product_img')->where('m_image_product_id', $value->m_product_id)->get('master_image_tbl')->result();

        $res = (object) array(
          "m_product_id" => $value->m_product_id,
          "m_product_name" => $value->m_product_name,
          "m_product_slug" => $value->m_product_slug,
          "m_product_cat_id" => $value->m_product_cat_id,
          "m_category_name" => $value->m_category_name,
          "m_product_taxgst" => $value->m_product_taxgst,
          "m_tax_value" => $value->m_tax_value,
          "m_product_unit" => $value->m_product_unit,
          "m_unit_title" => $value->m_unit_title,
          "m_product_barscode" => $value->m_product_barscode,
          "m_product_purche_price" => $value->m_product_purche_price,
          "m_product_seles_price" => $value->m_product_seles_price,
          "m_product_mrp" => $value->m_product_mrp,
          "m_product_details" => $value->m_product_details,
          "m_product_information" => $value->m_product_information,
          "m_product_des" => $value->m_product_des,
          "m_product_status" => $value->m_product_status,
          'm_product_fabric' => $value->m_product_fabric,
          'm_fabric_name' => $value->m_fabric_name,
          'm_product_color' => $product_colors,
          'm_product_size' => $product_size,
          'm_product_image' => $product_images,
        );

        $result[] = $res;
      }
    }

    return $result;
  }

  public function get_all_purchase($pur_id = '', $user = '', $search = '', $from_date = '', $to_date = '', $pur_type='')
  {
    if (!empty($pur_id)) {
      $this->db->where('m_purchase_spo', $pur_id);
    }
    if (!empty($user)) {
      $this->db->where('m_purchase_supplier', $user);
    }
    if ($search != NULL) {
      // $this->db->like('m_user_name',$search,'both');
      $this->db->like('m_purchase_spo', $search, 'both');
      $this->db->or_like('m_purchase_invoiceno', $search, 'both');
    }

    if (!empty($from_date)) {
      $this->db->where('DATE_FORMAT(m_purchase_added_on,"%Y-%m-%d")>=', $from_date);
    }
    if (!empty($to_date)) {
      $this->db->where('DATE_FORMAT(m_purchase_added_on,"%Y-%m-%d")<=', $to_date);
    }
    if (!empty($pur_type)) {
      $this->db->where('m_purchase_type', $pur_type);
    }

    $this->db->select('m_purchase_spo,sum(m_purchase_qty) as total_qty,sum(m_purchase_total) as item_sub_total,sum(m_purchase_netamt) as item_net_total,m_purchase_type,m_purchase_invoiceno,m_purchase_date,sum(m_purchase_gstamt) as total_tax,sum(m_purchase_disamt) as total_disc,m_purchase_shipping,m_purchase_status,m_purchase_added_on,m_purchase_user,m_purchase_supplier,m_purchase_note,m_purchase_terms,m_user_name,m_user_mobile,m_user_email,m_user_address,m_user_saddress');
    $this->db->join('master_users_tbl mct', 'mct.m_user_id = master_purchase_tbl.m_purchase_supplier', 'left');

    $this->db->group_by('m_purchase_spo');
    $purchase_list = $this->db->get('master_purchase_tbl')->result();

    if (!empty($purchase_list)) {
      foreach ($purchase_list as $skey) {

        $res = (object) array(
          "m_purchase_spo" => $skey->m_purchase_spo,
          "total_qty" => $skey->total_qty,
          "item_sub_total" => $skey->item_sub_total,
          "item_net_total" => $skey->item_net_total,
          "m_purchase_type" => $skey->m_purchase_type,
          "m_purchase_invoiceno" => $skey->m_purchase_invoiceno,
          "m_purchase_date" => $skey->m_purchase_date,
          "total_tax" => $skey->total_tax,
          "total_disc" => $skey->total_disc,
          "m_purchase_shipping" => $skey->m_purchase_shipping,
          "m_purchase_nettotal" => ($skey->item_sub_total + $skey->total_tax + $skey->m_purchase_shipping - $skey->total_disc),
          "m_purchase_status" => $skey->m_purchase_status,
          "m_purchase_added_on" => $skey->m_purchase_added_on,
          "m_purchase_user" => $skey->m_purchase_user,
          "m_purchase_supplier" => $skey->m_purchase_supplier,
          "m_purchase_terms" => $skey->m_purchase_terms,
          "m_purchase_note" => $skey->m_purchase_note,
          "m_user_name" => $skey->m_user_name,
          "m_user_mobile" => $skey->m_user_mobile,
          "m_user_email" => $skey->m_user_email,
          "m_user_address" => $skey->m_user_address,
          "m_user_saddress" => $skey->m_user_saddress,
        
          "m_purchase_items" => $this->get_purchase_item($skey->m_purchase_spo, $skey->m_purchase_supplier),

        );

        $result[] = $res;
      }
    }
    return $result;
  }

  public function get_purchase_item($pur_id,$supplier)
    {
        $this->db->select('m_purchase_id,m_purchase_qty,m_purchase_spo,m_purchase_product,m_purchase_price,m_purchase_date,m_purchase_total,m_purchase_type,m_color_name,m_size_name,m_fabric_name,m_product_name,m_category_name,m_unit_title,m_purchase_dis,m_purchase_gst,m_purchase_disamt,m_purchase_gstamt,m_purchase_netamt,m_product_color,m_product_size,m_purchase_size,m_purchase_color')
            ->join('master_product', 'master_product.m_product_id = master_purchase_tbl.m_purchase_product', 'left')
           ->join('master_categories', 'master_categories.m_category_id = master_product.m_product_cat_id', 'left')
            ->join('master_unit', 'master_unit.m_unit_id = master_product.m_product_unit', 'left')
            ->join('master_fabric_tbl', 'master_fabric_tbl.m_fabric_id = master_product.m_product_fabric', 'left')
            ->join('master_size_tbl', 'master_size_tbl.m_size_id = master_purchase_tbl.m_purchase_size', 'left')
            ->join('master_color_tbl', 'master_color_tbl.m_color_id = master_purchase_tbl.m_purchase_color', 'left');

        if (!empty($pur_id)) {
            $this->db->where('m_purchase_spo', $pur_id);
        }
        if (!empty($supplier)) {
            $this->db->where('m_purchase_supplier', $supplier);
        }
     
        return $this->db->get('master_purchase_tbl')->result();
    }



  public function insert_purchase()
  {

    $res = $this->db->select('m_purchase_spo')->order_by('m_purchase_id', 'desc')->where('m_purchase_type', 1)->get('master_purchase_tbl')->row();
    // $res ='UTP/201223/0001';

    if (!empty($res)) {
      $part = explode('/', $res->m_purchase_spo);
      $spo = 'UTP/' . date('dmy') . '/' . sprintf('%04d', ($part[2] + 1));
    } else {
      $spo = 'UTP/' . date('dmy') . '/0001';
    }

    // $spo  = str_pad(rand(0, 99999), 5, '0', STR_PAD_LEFT);
    $pur_item_id = $this->input->post('pur_item_id');
    $pur_item_itemid = $this->input->post('pur_item_itemid');
    $pur_item_rate = $this->input->post('pur_item_rate');
    $pur_item_qty = $this->input->post('pur_item_qty');
    $m_purchase_size = $this->input->post('m_purchase_size');
    $m_purchase_color = $this->input->post('m_purchase_color');

    $pur_item_total = $this->input->post('pur_item_total');
    $pur_item_gst = $this->input->post('pur_item_gst');
    $pur_item_gstamt = $this->input->post('pur_item_gstamt');
    $pur_item_disc = $this->input->post('pur_item_disc');
    $pur_item_discamt = $this->input->post('pur_item_discamt');
    $pur_item_nettotal = $this->input->post('pur_item_nettotal');

    for ($i = 0; $i < count($pur_item_itemid); $i++) {
      if (!empty($pur_item_itemid[$i])) {
        $insert_data = array(
          "m_purchase_date"    => $this->input->post('m_purchase_date'),
          "m_purchase_invoiceno" => $this->input->post('m_purchase_invoice'),
          "m_purchase_supplier" => $this->input->post('m_purchase_supplier'),
          "m_purchase_shipping" => $this->input->post('m_purchase_shipping'),
          "m_purchase_terms" => $this->input->post('m_purchase_terms'),
          "m_purchase_note" => $this->input->post('m_purchase_note'),
          "m_purchase_type" => $this->input->post('m_purchase_type'),
          "m_purchase_product" => $pur_item_itemid[$i],
          "m_purchase_price" => $pur_item_rate[$i],
          "m_purchase_qty" => $pur_item_qty[$i],
          "m_purchase_size" => $m_purchase_size[$i],
          "m_purchase_color" => $m_purchase_color[$i],
          "m_purchase_total" => $pur_item_total[$i],
          "m_purchase_gst" => $pur_item_gst[$i],
          "m_purchase_dis" => $pur_item_disc[$i],
          "m_purchase_gstamt" => $pur_item_gstamt[$i],
          "m_purchase_disamt" => $pur_item_discamt[$i],
          "m_purchase_netamt" => $pur_item_nettotal[$i],
        
        );

        if(!empty($pur_item_id[$i])){
          $insert_data['m_purchase_updaded_by'] = $this->session->userdata('user_id');
          $insert_data['m_purchase_updaded_on'] = date('Y-m-d H:i');

          $this->db->where('m_purchase_id', $pur_item_id[$i])->update('master_purchase_tbl', $insert_data);
          $res = 2;
        }else {
          $insert_data['m_purchase_spo'] = $spo;
          $insert_data['m_purchase_status'] = 1;
          $insert_data['m_purchase_user'] = $this->session->userdata('user_id');
          $insert_data['m_purchase_added_by'] = $this->session->userdata('user_id');
          $insert_data['m_purchase_added_on'] = date('Y-m-d H:i');
          $res = $this->db->insert('master_purchase_tbl', $insert_data);
        }
     

        // echo '<pre>'; print_r($insert_data); 

    
      //  echo '<pre>'; print_r($res); 
      }
    }
    // die;
    return $res;
  }


  public function delete_purchase_item()
  {
    $this->db->where('m_purchase_id', $this->input->post('delete_id'));
    $this->db->delete('master_purchase_tbl');
    return true;
  }

  public function delete_purchase()
  {
    $this->db->where('m_purchase_spo', $this->input->post('delete_id'));
    $this->db->delete('master_purchase_tbl');
    return true;
  }


  //-----------------------------/purchese----------------------------//

  //------------------------------payment in---------------------------//
  public function get_payment_in($search, $user)
  {
    $this->db->select('*');
    if ($search != NULL) {
      $this->db->like('m_pmode_name', $search, 'both');
      $this->db->like('m_user_name', $search, 'both');
    }
    if (!empty($user)) {
      $this->db->where('m_payment_user', $user);
    }
    $this->db->join('master_paymode_tbl', 'master_paymode_tbl.m_pmode_id = master_payment_tbl.m_payment_pmode', 'left');
    $this->db->join('master_users_tbl customer', 'customer.m_user_id = master_payment_tbl.m_payment_user', 'left');
    // $this->db->join('master_users_tbl supplier', 'supplier.m_user_id = master_payment_tbl.m_payment_user', 'left');

    $this->db->where('m_payment_type', 1);
    $res = $this->db->get('master_payment_tbl')->result();
    return $res;
  }





  public function insert_payment_in()
  {
    $data = array(
      "m_payment_type" => 1,
      "m_payment_user" => $this->input->post('m_payment_user'),
      "m_payment_pmode" => $this->input->post('m_payment_pmode'),
      "m_payment_transno" => $this->input->post('m_payment_transno'),
      "m_payment_amount" => $this->input->post('m_payment_amount'),
      "m_payment_date" => $this->input->post('m_payment_date'),
    );

    $data['m_payment_added_on'] = date('Y-m-d H:i');
    $res = $this->db->insert('master_payment_tbl', $data);
    return $res;
  }

  public function update_payment_in()
  {
    $data = array(
      "m_payment_type" => 1,
      "m_payment_user" => $this->input->post('m_payment_user'),
      "m_payment_pmode" => $this->input->post('m_payment_pmode'),
      "m_payment_transno" => $this->input->post('m_payment_transno'),
      "m_payment_amount" => $this->input->post('m_payment_amount'),
      "m_payment_date" => $this->input->post('m_payment_date'),
    );

    $data['m_payment_updated_on'] = date('Y-m-d H:i');
    $res = $this->db->where('m_payment_id', $this->input->post('m_payment_id'))->update('master_payment_tbl', $data);
    return $res;
  }

  public function delete_payment_in()
  {
    $this->db->where('m_payment_id', $this->input->post('delete_id'));
    return $this->db->delete('master_payment_tbl');
  }
  //-----------------------------/payment in----------------------------//

  //------------------------------payment out---------------------------//
  public function get_payment_out($search, $user)
  {
    $this->db->select('*');
    if ($search != NULL) {
      $this->db->like('m_pmode_name', $search, 'both');
      $this->db->like('m_user_name', $search, 'both');
    }
    if (!empty($user)) {
      $this->db->where('m_payment_user', $user);
    }
    $this->db->join('master_paymode_tbl', 'master_paymode_tbl.m_pmode_id = master_payment_tbl.m_payment_pmode', 'left');

    $this->db->join('master_users_tbl supplier', 'supplier.m_user_id = master_payment_tbl.m_payment_user', 'left');

    $this->db->where('m_payment_type', 2);
    $res = $this->db->get('master_payment_tbl')->result();
    return $res;
  }





  public function insert_payment_out()
  {
    $data = array(
      "m_payment_type" => 2,
      "m_payment_user" => $this->input->post('m_payment_user'),
      "m_payment_pmode" => $this->input->post('m_payment_pmode'),
      "m_payment_transno" => $this->input->post('m_payment_transno'),
      "m_payment_amount" => $this->input->post('m_payment_amount'),
      "m_payment_date" => $this->input->post('m_payment_date'),
    );

    $data['m_payment_added_on'] = date('Y-m-d H:i');
    $res = $this->db->insert('master_payment_tbl', $data);
    return $res;
  }

  public function update_payment_out()
  {
    $data = array(
      "m_payment_type" => 2,
      "m_payment_user" => $this->input->post('m_payment_user'),
      "m_payment_pmode" => $this->input->post('m_payment_pmode'),
      "m_payment_transno" => $this->input->post('m_payment_transno'),
      "m_payment_amount" => $this->input->post('m_payment_amount'),
      "m_payment_date" => $this->input->post('m_payment_date'),
    );

    $data['m_payment_updated_on'] = date('Y-m-d H:i');
    $res = $this->db->where('m_payment_id', $this->input->post('m_payment_id'))->update('master_payment_tbl', $data);
    return $res;
  }

  public function delete_payment_out()
  {
    $this->db->where('m_payment_id', $this->input->post('delete_id'));
    return $this->db->delete('master_payment_tbl');
  }
  //-----------------------------/payment in----------------------------//


}
