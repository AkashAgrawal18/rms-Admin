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
  public function get_all_sales($user, $search, $from_date, $to_date)
  {

    // $this->db->select('*');

    $this->db->select('master_sales_tbl.m_sale_customer,master_sales_tbl.m_sale_spo,master_sales_tbl.m_sale_paydated,master_sales_tbl.m_sale_status,master_sales_tbl.m_sale_pstatus,master_sales_tbl.m_sale_invoiceno,master_sales_tbl.m_sale_added_on as sale_date,master_sales_tbl.m_sale_paid_amount as paid_amount,added_by.m_user_name as added_by_name');
    $this->db->select("SUM(master_sales_tbl.m_sale_qty * master_sales_tbl.m_sale_price) AS total_base_total");
    $this->db->select("SUM(master_sales_tbl.m_sale_qty * master_sales_tbl.m_sale_price * master_sales_tbl.m_sale_discount / 100) AS total_discount_amount");
    $this->db->select("SUM(master_sales_tbl.m_sale_qty * master_sales_tbl.m_sale_price - (master_sales_tbl.m_sale_qty * master_sales_tbl.m_sale_price * master_sales_tbl.m_sale_discount / 100)) AS total_net_amount");
    $this->db->select("SUM(master_sales_tbl.m_sale_qty * master_sales_tbl.m_sale_price * master_sales_tbl.m_sale_gst / 100) AS total_gst");
    $this->db->select('customer.m_user_name AS customer_name,customer.m_user_id as customer_id');
    $this->db->from('master_sales_tbl');
    $this->db->join('master_users_tbl customer', 'customer.m_user_id = master_sales_tbl.m_sale_customer', 'left');
    $this->db->join('master_users_tbl added_by', 'added_by.m_user_id = master_sales_tbl.m_sale_added_by', 'left');
    $this->db->group_by('master_sales_tbl.m_sale_spo');
    $this->db->group_by('master_sales_tbl.m_sale_invoiceno');
    if (!empty($user)) {
      $this->db->where('m_sale_customer', $user);
    }
    if ($search != NULL) {

      // $this->db->like('m_user_name',$search,'both');
      $this->db->or_like('m_sale_spo', $search, 'both');
      $this->db->or_like('m_sale_invoiceno', $search, 'both');
    }
    if (!empty($from_date) && !empty($to_date)) {
      $this->db->where('DATE_FORMAT(m_sale_added_on,"%Y-%m-%d")>=', $from_date);
      $this->db->where('DATE_FORMAT(m_sale_added_on,"%Y-%m-%d")<=', $to_date);
    }


    $query = $this->db->get();

    return $query->result();
  }

  public function get_sale_details($order_id, $uid)
  {
    $result = array();

    $this->db->select(
      'm_sale_spo, m_sale_paydated, m_sale_status, m_sale_date, m_sale_customer, 
        m_sale_pstatus, m_sale_invoiceno, m_sale_added_on as sale_date,
        m_sale_paid_amount as paid_amount, added_by.m_user_name as added_by_name,
        sum(m_sale_qty) as total_qty, sum(m_sale_total) as sub_total,
        sum(m_sale_qty * m_sale_price * m_sale_gst / 100) AS total_gst,
        sum(m_sale_qty * m_sale_price - (m_sale_qty * m_sale_price * m_sale_discount / 100)) AS total_net_amount,
        sum(m_sale_qty * m_sale_price * m_sale_discount / 100) AS total_discount_amount'
    );

    $this->db->join('master_users_tbl customer', 'customer.m_user_id = master_sales_tbl.m_sale_customer', 'left');
    $this->db->join('master_users_tbl added_by', 'added_by.m_user_id = master_sales_tbl.m_sale_added_by', 'left');

    $this->db->where('m_sale_customer', $uid);
    $this->db->where('m_sale_spo', $order_id);
    $this->db->group_by('m_sale_spo'); // Add a GROUP BY clause

    $sale_detail = $this->db->get('master_sales_tbl')->result();

    if (!empty($sale_detail)) {
      $res = array(
        "m_sale_date" => $sale_detail[0]->m_sale_date,
        "m_sale_customer" => $sale_detail[0]->m_sale_customer,
        "total_qty" => $sale_detail[0]->total_qty,
        "sub_total" => $sale_detail[0]->sub_total,
        "net_amount" => $sale_detail[0]->total_net_amount,
        "m_sale_items" => $this->get_sale_items($order_id, $uid),
        "product_payment" => $this->get_payment_product($order_id, $uid),
      );

      $result[] = $res;
    }

    return $result;
  }

  public function get_sale_items($order_id, $uid)
  {
    $this->db->select('*');
    $this->db->join('master_product', 'master_product.m_product_id = master_sales_tbl.m_sale_product', 'left');
    $this->db->join('master_users_tbl added_by', 'added_by.m_user_id = master_sales_tbl.m_sale_added_by', 'left');
    $this->db->join('master_users_tbl customer', 'customer.m_user_id = master_sales_tbl.m_sale_customer', 'left');

    $this->db->where('m_sale_customer', $uid);
    $this->db->where('m_sale_spo', $order_id);

    return $this->db->get('master_sales_tbl')->result();
  }

  public function get_payment_product($order_id, $uid)
  {
    $this->db->select('m_sale_paid_amount as paid_amount,m_sale_paydated as pay_date,m_sale_pmode as paymode');

    $this->db->join('master_users_tbl customer', 'customer.m_user_id = master_sales_tbl.m_sale_customer', 'left');

    $this->db->where('m_sale_customer', $uid);
    $this->db->where('m_sale_spo', $order_id);
    $this->db->group_by('m_sale_spo');
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

  public function get_sales_products($salesid)
  {
    $this->db->select('*');
    $this->db->join('master_product', 'master_product.m_product_id = master_sales_tbl.m_sale_product', 'left');
    $this->db->join('master_users_tbl added_by', 'added_by.m_user_id = master_sales_tbl.m_sale_added_by', 'left');
    $this->db->join('master_users_tbl updated_by', 'updated_by.m_user_id = master_sales_tbl.m_sale_updaded_by', 'left');
    $this->db->join('master_users_tbl customer', 'customer.m_user_id = master_sales_tbl.m_sale_customer', 'left');

    // $this->db->where('m_purchase_supplier', $uid);
    $this->db->where('m_sale_spo', $salesid);

    return $this->db->get('master_sales_tbl')->result();
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
      $spo = 'UT/' . date('dmy') . '/' . sprintf('%04d', ($part[2] + 1));
    } else {
      $spo = 'UT/' . date('dmy') . '/0001';
    }


    // $spo  = str_pad(rand(0, 99999), 5, '0', STR_PAD_LEFT);
    $pur_item_id = $this->input->post('pur_item_id');
    $pur_item_itemid = $this->input->post('pur_item_itemid');
    $pur_item_rate = $this->input->post('pur_item_rate');
    $pur_item_qty = $this->input->post('pur_item_qty');

    $pur_item_total = $this->input->post('pur_item_total');
    $pur_item_gst = $this->input->post('pur_item_gst');
    $pur_item_disc = $this->input->post('pur_item_disc');
    $pur_item_nettotal = $this->input->post('pur_item_nettotal');

    for ($i = 0; $i < count($pur_item_itemid); $i++) {
      if (!empty($pur_item_itemid[$i])) {
        $insert_data = array(
          "m_sale_date"    => $this->input->post('m_sale_date'),
          "m_sale_invoiceno" => $this->input->post('m_sale_invoice'),
          "m_sale_customer" => $this->input->post('m_sale_customer'),
          "m_sale_spo" => $spo,
          "m_sale_product" => $pur_item_itemid[$i],
          "m_sale_price" => $pur_item_rate[$i],
          "m_sale_qty" => $pur_item_qty[$i],
          "m_sale_total" => $pur_item_total[$i],
          "m_sale_gst" => $pur_item_gst[$i],
          "m_sale_discount" => $pur_item_disc[$i],
          // "pur_item_nettotal" => $pur_item_nettotal[$i],
          // "pur_item_purtype" => $this->input->post('m_purchase_type'),
          // "pur_item_added_on" => date('Y-m-d H:i:s'),

        );
        $insert_data['m_sale_user'] = $this->session->userdata('user_id');
        $insert_data['m_sale_added_by'] = $this->session->userdata('user_id');
        $insert_data['m_sale_added_on'] = date('Y-m-d H:i:s');
        $this->db->insert('master_sales_tbl', $insert_data);
      }
    }

    return 1;
  }



  public function update_sales()
  {


    $spo = $this->input->post('m_sop_id');

    // $pur_id = $this->input->post('m_sales_id');

    $pur_item_id = $this->input->post('pur_item_id');
    $pur_item_itemid = $this->input->post('pur_item_itemid');
    $pur_item_rate = $this->input->post('pur_item_rate');
    $pur_item_qty = $this->input->post('pur_item_qty');

    $pur_item_total = $this->input->post('pur_item_total');
    $pur_item_gst = $this->input->post('pur_item_gst');
    $pur_item_disc = $this->input->post('pur_item_disc');
    $pur_item_nettotal = $this->input->post('pur_item_nettotal');


    for ($i = 0; $i < count($pur_item_itemid); $i++) {

      // print_r($pur_item_id);

      if (!empty($pur_item_itemid[$i])) {

        $insert_data = array(


          "m_sale_date"    => $this->input->post('m_sale_date'),
          "m_sale_invoiceno" => $this->input->post('m_sale_invoice'),
          "m_sale_customer" => $this->input->post('m_sale_customer'),
          "m_sale_spo" => $spo,
          "m_sale_product" => $pur_item_itemid[$i],
          "m_sale_price" => $pur_item_rate[$i],
          "m_sale_qty" => $pur_item_qty[$i],
          "m_sale_total" => $pur_item_total[$i],
          "m_sale_gst" => $pur_item_gst[$i],
          "m_sale_discount" => $pur_item_disc[$i],
          // "pur_item_nettotal" => $pur_item_nettotal[$i],
          // "pur_item_purtype" => $this->input->post('m_purchase_type'),
          // "pur_item_added_on" => date('Y-m-d H:i:s'),

        );

        if (!empty($pur_item_id[$i])) {


          $insert_data['m_sale_updaded_by'] = $this->session->userdata('user_id');
          $insert_data['m_sale_updaded_on'] = date('Y-m-d H:i:s');

          $this->db->where('m_sale_id', $pur_item_id[$i])->update('master_sales_tbl', $insert_data);
        } else {

          $insert_data['m_sale_user'] = $this->session->userdata('user_id');
          $insert_data['m_sale_added_by'] = $this->session->userdata('user_id');
          $insert_data['m_sale_added_on'] = date('Y-m-d H:i:s');
          $this->db->insert('master_sales_tbl', $insert_data);
        }
      }
    }

    return 2;
  }




  //--------------------------------/sales-----------------------//


  //-----------------------------purchese----------------------------//

 
  public function get_all_purchase($user, $search, $from_date, $to_date, $purtype)
  {

    // $this->db->select('*');

    $this->db->select('master_purchase_tbl.m_purchase_supplier,master_purchase_tbl.m_purchase_spo,master_purchase_tbl.m_purchase_paydated,master_purchase_tbl.m_purchase_status,master_purchase_tbl.m_purchase_pstatus,master_purchase_tbl.m_purchase_invoiceno,master_purchase_tbl.m_purchase_added_on as purchase_date,master_purchase_tbl.m_purchase_paid_amount as paid_amount,added_by.m_user_name as added_by_name,,master_purchase_tbl.m_purchase_type');
    $this->db->select("SUM(master_purchase_tbl.m_purchase_qty * master_purchase_tbl.m_purchase_price) AS total_base_total");
    $this->db->select("SUM(master_purchase_tbl.m_purchase_qty * master_purchase_tbl.m_purchase_price * master_purchase_tbl.m_purchase_discount / 100) AS total_discount_amount");
    $this->db->select("SUM(master_purchase_tbl.m_purchase_qty * master_purchase_tbl.m_purchase_price - (master_purchase_tbl.m_purchase_qty * master_purchase_tbl.m_purchase_price * master_purchase_tbl.m_purchase_discount / 100)) AS total_net_amount");
    $this->db->select("SUM(master_purchase_tbl.m_purchase_qty * master_purchase_tbl.m_purchase_price * master_purchase_tbl.m_purchase_gst / 100) AS total_gst");
    $this->db->select('supplier.m_user_name AS supplier_name,supplier.m_user_id as supplier_id');
    $this->db->from('master_purchase_tbl');
    $this->db->join('master_users_tbl supplier', 'supplier.m_user_id = master_purchase_tbl.m_purchase_supplier', 'left');
    $this->db->join('master_users_tbl added_by', 'added_by.m_user_id = master_purchase_tbl.m_purchase_added_by', 'left');
    $this->db->group_by('master_purchase_tbl.m_purchase_spo');
    $this->db->group_by('master_purchase_tbl.m_purchase_invoiceno');
    if (!empty($user)) {
      $this->db->where('m_purchase_supplier', $user);
    }
    if ($search != NULL) {

      // $this->db->like('m_user_name',$search,'both');
      $this->db->or_like('m_purchase_spo', $search, 'both');
      $this->db->or_like('m_purchase_invoiceno', $search, 'both');
    }

    if (!empty($from_date) && !empty($to_date)) {
      $this->db->where('DATE_FORMAT(m_purchase_added_on,"%Y-%m-%d")>=', $from_date);
      $this->db->where('DATE_FORMAT(m_purchase_added_on,"%Y-%m-%d")<=', $to_date);
    }

    $this->db->where('m_purchase_type', $purtype);
    $query = $this->db->get();

    return $query->result();
  }

  public function get_edit_purchase($purchaseid)
  {
    $this->db->select('m_purchase_spo,m_purchase_invoiceno,m_purchase_date,m_purchase_supplier,m_purchase_type');

    $this->db->join('master_users_tbl added_by', 'added_by.m_user_id = master_purchase_tbl.m_purchase_added_by', 'left');
    $this->db->join('master_users_tbl updated_by', 'updated_by.m_user_id = master_purchase_tbl.m_purchase_updaded_by', 'left');
    $this->db->join('master_users_tbl supplier', 'supplier.m_user_id = master_purchase_tbl.m_purchase_supplier', 'left');

    // $this->db->where('m_purchase_supplier', $uid);
    $this->db->where('m_purchase_spo', $purchaseid);
    $this->db->group_by('m_purchase_spo');
    return $this->db->get('master_purchase_tbl')->row();
  }


  public function get_purchase_products($purchaseid)
  {
    $this->db->select('*');
    $this->db->join('master_product', 'master_product.m_product_id = master_purchase_tbl.m_purchase_product', 'left');
    $this->db->join('master_users_tbl added_by', 'added_by.m_user_id = master_purchase_tbl.m_purchase_added_by', 'left');
    $this->db->join('master_users_tbl updated_by', 'updated_by.m_user_id = master_purchase_tbl.m_purchase_updaded_by', 'left');
    $this->db->join('master_users_tbl supplier', 'supplier.m_user_id = master_purchase_tbl.m_purchase_supplier', 'left');

    // $this->db->where('m_purchase_supplier', $uid);
    $this->db->where('m_purchase_spo', $purchaseid);

    return $this->db->get('master_purchase_tbl')->result();
  }


  public function get_purchase_details($order_id, $uid)
  {
    $result = array();

    $this->db->select(
      'm_purchase_spo, m_purchase_paydated, m_purchase_status, m_purchase_date, m_purchase_supplier, 
        m_purchase_pstatus, m_purchase_invoiceno, m_purchase_added_on as purchase_date,
        m_purchase_paid_amount as paid_amount, added_by.m_user_name as added_by_name,
        sum(m_purchase_qty) as total_qty, sum(m_purchase_total) as sub_total,
        sum(m_purchase_qty * m_purchase_price * m_purchase_gst / 100) AS total_gst,
        sum(m_purchase_qty * m_purchase_price - (m_purchase_qty * m_purchase_price * m_purchase_discount / 100)) AS total_net_amount,
        sum(m_purchase_qty * m_purchase_price * m_purchase_discount / 100) AS total_discount_amount'
    );

    $this->db->join('master_users_tbl supplier', 'supplier.m_user_id = master_purchase_tbl.m_purchase_supplier', 'left');
    $this->db->join('master_users_tbl added_by', 'added_by.m_user_id = master_purchase_tbl.m_purchase_added_by', 'left');

    $this->db->where('m_purchase_supplier', $uid);
    $this->db->where('m_purchase_spo', $order_id);
    $this->db->group_by('m_purchase_spo'); // Add a GROUP BY clause

    $purchase_detail = $this->db->get('master_purchase_tbl')->result();

    if (!empty($purchase_detail)) {
      $res = array(
        "m_purchase_date" => $purchase_detail[0]->m_purchase_date,
        "m_purchase_supplier" => $purchase_detail[0]->m_purchase_supplier,
        "total_qty" => $purchase_detail[0]->total_qty,
        "sub_total" => $purchase_detail[0]->sub_total,
        "net_amount" => $purchase_detail[0]->total_net_amount,
        "m_purchase_items" => $this->get_purchase_items($order_id, $uid),
        "product_payment" => $this->get_paymentpurchase_product($order_id, $uid),
      );

      $result[] = $res;
    }

    return $result;
  }


  public function get_purchase_items($order_id, $uid)
  {
    $this->db->select('*');
    $this->db->join('master_product', 'master_product.m_product_id = master_purchase_tbl.m_purchase_product', 'left');
    $this->db->join('master_users_tbl added_by', 'added_by.m_user_id = master_purchase_tbl.m_purchase_added_by', 'left');
    $this->db->join('master_users_tbl supplier', 'supplier.m_user_id = master_purchase_tbl.m_purchase_supplier', 'left');

    $this->db->where('m_purchase_supplier', $uid);
    $this->db->where('m_purchase_spo', $order_id);

    return $this->db->get('master_purchase_tbl')->result();
  }

  public function get_paymentpurchase_product($order_id, $uid)
  {
    $this->db->select('m_purchase_paid_amount as paid_amount,m_purchase_paydated as pay_date,m_purchase_pmode as paymode');

    $this->db->join('master_users_tbl supplier', 'supplier.m_user_id = master_purchase_tbl.m_purchase_supplier', 'left');

    $this->db->where('m_purchase_supplier', $uid);
    $this->db->where('m_purchase_spo', $order_id);
    $this->db->group_by('m_purchase_spo');
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
    $pur_item_disc = $this->input->post('pur_item_disc');
    $pur_item_nettotal = $this->input->post('pur_item_nettotal');

    for ($i = 0; $i < count($pur_item_itemid); $i++) {
      if (!empty($pur_item_itemid[$i])) {
        $insert_data = array(
          "m_purchase_date"    => $this->input->post('m_purchase_date'),
          "m_purchase_invoiceno" => $this->input->post('m_purchase_invoice'),
          "m_purchase_supplier" => $this->input->post('m_purchase_supplier'),
          "m_purchase_spo" => $spo,
          "m_purchase_type" => 1,
          "m_purchase_product" => $pur_item_itemid[$i],
          "m_purchase_price" => $pur_item_rate[$i],
          "m_purchase_qty" => $pur_item_qty[$i],
          "m_purchase_size" => $m_purchase_size[$i],
          "m_purchase_color" => $m_purchase_color[$i],
          "m_purchase_total" => $pur_item_total[$i],
          "m_purchase_gst" => $pur_item_gst[$i],
          "m_purchase_discount" => $pur_item_disc[$i],
          // "pur_item_nettotal" => $pur_item_nettotal[$i],
          // "pur_item_purtype" => $this->input->post('m_purchase_type'),
          // "pur_item_added_on" => date('Y-m-d H:i:s'),

        );
        $insert_data['m_purchase_user'] = $this->session->userdata('user_id');
        $insert_data['m_purchase_added_by'] = $this->session->userdata('user_id');
        $insert_data['m_purchase_added_on'] = date('Y-m-d H:i:s');
        $this->db->insert('master_purchase_tbl', $insert_data);
      }
    }

    return 1;
  }


  public function update_purchase()
  {


    $spo = $this->input->post('m_sop_id');

    $pur_id = $this->input->post('m_purchase_id');

    $pur_item_id = $this->input->post('pur_item_id');
    $pur_item_itemid = $this->input->post('pur_item_itemid');
    $pur_item_rate = $this->input->post('pur_item_rate');
    $pur_item_qty = $this->input->post('pur_item_qty');
    $m_purchase_size = $this->input->post('m_purchase_size');
    $m_purchase_color = $this->input->post('m_purchase_color');
    $pur_item_total = $this->input->post('pur_item_total');
    $pur_item_gst = $this->input->post('pur_item_gst');
    $pur_item_disc = $this->input->post('pur_item_disc');
    $pur_item_nettotal = $this->input->post('pur_item_nettotal');


    for ($i = 0; $i < count($pur_item_itemid); $i++) {

      // print_r($pur_item_id);

      if (!empty($pur_item_itemid[$i])) {

        $insert_data = array(


          "m_purchase_date"    => $this->input->post('m_purchase_date'),
          "m_purchase_invoiceno" => $this->input->post('m_purchase_invoice'),
          "m_purchase_supplier" => $this->input->post('m_purchase_supplier'),
          "m_purchase_spo" => $spo,
          "m_purchase_type" => 1,
          "m_purchase_product" => $pur_item_itemid[$i],
          "m_purchase_price" => $pur_item_rate[$i],
          "m_purchase_qty" => $pur_item_qty[$i],
          "m_purchase_size" => $m_purchase_size[$i],
          "m_purchase_color" => $m_purchase_color[$i],
          "m_purchase_total" => $pur_item_total[$i],
          "m_purchase_gst" => $pur_item_gst[$i],
          "m_purchase_discount" => $pur_item_disc[$i],
          // "pur_item_nettotal" => $pur_item_nettotal[$i],
          // "pur_item_purtype" => $this->input->post('m_purchase_type'),
          // "pur_item_added_on" => date('Y-m-d H:i:s'),

        );

        if (!empty($pur_item_id[$i])) {


          $insert_data['m_purchase_updaded_by'] = $this->session->userdata('user_id');
          $insert_data['m_purchase_updaded_on'] = date('Y-m-d H:i:s');

          $this->db->where('m_purchase_id', $pur_item_id[$i])->update('master_purchase_tbl', $insert_data);
        } else {

          $insert_data['m_purchase_user'] = $this->session->userdata('user_id');
          $insert_data['m_purchase_added_by'] = $this->session->userdata('user_id');
          $insert_data['m_purchase_added_on'] = date('Y-m-d H:i:s');
          $this->db->insert('master_purchase_tbl', $insert_data);
        }
      }
    }

    return 2;
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



  public function insert_preturn()
  {

    $rdid = $this->input->post('rdid');

    if (!empty($rdid)) {

      $spo  = $this->input->post('m_sop_id');
      $pur_item_id = $this->input->post('pur_item_id');
      $pur_item_itemid = $this->input->post('pur_item_itemid');
      $pur_item_rate = $this->input->post('pur_item_rate');
      $pur_item_qty = $this->input->post('pur_item_qty');

      $pur_item_total = $this->input->post('pur_item_total');
      $pur_item_gst = $this->input->post('pur_item_gst');
      $pur_item_disc = $this->input->post('pur_item_disc');
      $pur_item_nettotal = $this->input->post('pur_item_nettotal');

      for ($i = 0; $i < count($pur_item_itemid); $i++) {
        if (!empty($pur_item_itemid[$i])) {
          $insert_data = array(
            "m_purchase_date"    => $this->input->post('m_purchase_date'),
            "m_purchase_invoiceno" => $this->input->post('m_purchase_invoice'),
            "m_purchase_supplier" => $this->input->post('m_purchase_supplier'),
            "m_purchase_spo" => $spo,
            "m_purchase_type" => 2,
            "m_purchase_product" => $pur_item_itemid[$i],
            "m_purchase_price" => $pur_item_rate[$i],
            "m_purchase_qty" => $pur_item_qty[$i],
            "m_purchase_total" => $pur_item_total[$i],
            "m_purchase_gst" => $pur_item_gst[$i],
            "m_purchase_discount" => $pur_item_disc[$i],
            // "pur_item_nettotal" => $pur_item_nettotal[$i],
            // "pur_item_purtype" => $this->input->post('m_purchase_type'),
            // "pur_item_added_on" => date('Y-m-d H:i:s'),

          );

          $insert_data['m_purchase_updaded_by'] = $this->session->userdata('user_id');
          $insert_data['m_purchase_updaded_on'] = date('Y-m-d H:i:s');
          $this->db->where('m_purchase_id', $pur_item_id[$i])->update('master_purchase_tbl', $insert_data);
        }
      }


      return 2;
    } else {




      $res = $this->db->select('m_purchase_spo')->order_by('m_purchase_id', 'desc')->where('m_purchase_type', 2)->get('master_purchase_tbl')->row();
      // $res ='UTP/201223/0001';

      if (!empty($res)) {
        $part = explode('/', $res->m_purchase_spo);
        $spo = 'UTR/' . date('dmy') . '/' . sprintf('%04d', ($part[2] + 1));
      } else {
        $spo = 'UTR/' . date('dmy') . '/0001';
      }


      // print_r($spo1); die();

      // $spo  = $this->input->post('pur_item_id')
      $pur_item_id = $this->input->post('pur_item_id');
      $pur_item_itemid = $this->input->post('pur_item_itemid');
      $pur_item_rate = $this->input->post('pur_item_rate');
      $pur_item_qty = $this->input->post('pur_item_qty');

      $pur_item_total = $this->input->post('pur_item_total');
      $pur_item_gst = $this->input->post('pur_item_gst');
      $pur_item_disc = $this->input->post('pur_item_disc');
      $pur_item_nettotal = $this->input->post('pur_item_nettotal');

      for ($i = 0; $i < count($pur_item_itemid); $i++) {
        if (!empty($pur_item_itemid[$i])) {
          $insert_data = array(
            "m_purchase_date"    => $this->input->post('m_purchase_date'),
            "m_purchase_invoiceno" => $this->input->post('m_purchase_invoice'),
            "m_purchase_supplier" => $this->input->post('m_purchase_supplier'),
            "m_purchase_spo" => $spo,
            "m_purchase_type" => 2,
            "m_purchase_product" => $pur_item_itemid[$i],
            "m_purchase_price" => $pur_item_rate[$i],
            "m_purchase_qty" => $pur_item_qty[$i],
            "m_purchase_total" => $pur_item_total[$i],
            "m_purchase_gst" => $pur_item_gst[$i],
            "m_purchase_discount" => $pur_item_disc[$i],
            // "pur_item_nettotal" => $pur_item_nettotal[$i],
            // "pur_item_purtype" => $this->input->post('m_purchase_type'),
            // "pur_item_added_on" => date('Y-m-d H:i:s'),

          );
          $insert_data['m_purchase_user'] = $this->session->userdata('user_id');
          $insert_data['m_purchase_added_by'] = $this->session->userdata('user_id');
          $insert_data['m_purchase_added_on'] = date('Y-m-d H:i:s');
          $this->db->insert('master_purchase_tbl', $insert_data);
        }
      }

      return 1;
    }
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
