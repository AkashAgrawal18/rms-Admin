<?php date_default_timezone_set('Asia/Kolkata');
class Main_model extends CI_model
{

  //-------------------user-----------------------------------//
  public function get_active_user()
  {
    $this->db->select('*');
    $this->db->order_by('m_acc_id');
    $this->db->where('m_acc_type', 1);
    $this->db->where('m_acc_status', 1);
    $res = $this->db->get('master_accounts_tbl')->result();
    return $res;
  }
  //-------------------user-----------------------------------//

  //--------------------------------customer-----------------------//
  public function check_accnt($mobile_id, $type, $addby)
  {
    return $this->db->select('m_acc_mobile,m_acc_id,m_acc_type')
      ->where('m_acc_mobile', $mobile_id)->where('m_acc_type', $type)->where('m_acc_added_by', $addby)->get('master_accounts_tbl')->row();
  }


  public function get_customer($type, $status = '', $search = '')
  {
    $this->db->select('*');

    $this->db->where('m_acc_type', $type);

    if (!empty($status)) {
      $this->db->where('m_acc_status', $status);
    }
    if (!empty($search)) {
      $this->db->where("(m_acc_name LIKE '%$search%' OR m_acc_mobile LIKE '%$search%' OR m_acc_email LIKE '%$search%')");
    }
    $this->db->order_by('m_acc_id', 'desc');
    $res = $this->db->get('master_accounts_tbl')->result();
    return $res;
  }

  public function insert_customer()
  {

    if (!empty($_FILES['m_acc_image']['name'])) {
      $config['file_name'] = $_FILES['m_acc_image']['name'];
      $config['upload_path'] = 'uploads/user';
      $config['allowed_types'] = 'jpg|jpeg|png';
      $config['remove_spaces'] = TRUE;
      $config['file_name'] = $_FILES['m_acc_image']['name'];
      //Load upload library and initialize configuration
      $this->load->library('upload', $config);
      $this->upload->initialize($config);
      if ($this->upload->do_upload('m_acc_image')) {
        $uploadData = $this->upload->data();
        if (!empty($update_data['m_acc_image'])) {
          if (file_exists($config['m_acc_image'] . $update_data['m_acc_image'])) {
            unlink($config['upload_path'] . $update_data['m_acc_image']); /* deleting Image */
          }
        }
        $m_acc_image = $uploadData['file_name'];
      }
    } else {
      $m_acc_image = '';
    }
    $check = $this->check_accnt($this->input->post('m_acc_mobile'), $this->input->post('m_acc_type'), $this->session->userdata('user_id'));
    if (empty($check)) {
      $data = array(

        "m_acc_name" => $this->input->post('m_acc_name'),
        "m_acc_mobile" => $this->input->post('m_acc_mobile'),
        "m_acc_email" => $this->input->post('m_acc_email'),
        "m_acc_address" => $this->input->post('m_acc_address') ?: '',
        "m_acc_credit_limit" => $this->input->post('m_acc_credit_limit') ?: '',
        "m_acc_credit_period" => $this->input->post('m_acc_credit_period') ?: '',
        "m_acc_open_balance" => $this->input->post('m_acc_open_balance'),
        "m_acc_type" => $this->input->post('m_acc_type'),
        "m_acc_bankacc" => $this->input->post('m_acc_bankacc'),
        "m_acc_bankname" => $this->input->post('m_acc_bankname'),
        "m_acc_gst_no" => $this->input->post('m_acc_gst_no'),
        "m_acc_image" => $m_acc_image,
      );
      $cust_id = $this->input->post('m_acc_id');
      if (!empty($cust_id)) {
        $data['m_acc_updated_by'] = $this->session->userdata('user_id');
        $data['m_acc_status'] = $this->input->post('m_acc_status');
        $data['m_acc_updated_on'] = date('Y-m-d H:i');
        $this->db->where('m_acc_id', $cust_id)->update('master_accounts_tbl', $data);
        $res = 2;
      } else {
        $data['m_acc_status'] = 1;
        $data['m_acc_added_on'] = date('Y-m-d H:i');
        $data['m_acc_added_by'] = $this->session->userdata('user_id');
        $this->db->insert('master_accounts_tbl', $data);
        $cust_id = $this->db->insert_id();
        $res = 1;
      }
      if ($this->input->post('m_addon') == 1) {
        return $cust_id;
      } else {
        return $res;
      }
    }
    return 'multi';
  }

  public function delete_customer()
  {
    $this->db->where('m_acc_id', $this->input->post('delete_id'));
    return $this->db->delete('master_accounts_tbl');
  }

  //--------------------------------/customer-----------------------//

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

      // $this->db->like('m_acc_name',$search,'both');
      $this->db->or_like('m_sale_spo', $search, 'both');
      // $this->db->or_like('m_sale_invoiceno', $search, 'both');
    }
    if (!empty($from_date)) {
      $this->db->where('DATE_FORMAT(m_sale_added_on,"%Y-%m-%d")>=', $from_date);
    }
    if (!empty($to_date)) {
      $this->db->where('DATE_FORMAT(m_sale_added_on,"%Y-%m-%d")<=', $to_date);
    }

    $this->db->select('m_sale_spo,sum(m_sale_qty) as total_qty,sum(m_sale_total) as sub_total,m_sale_date,sum(m_sale_gst) as total_tax,m_sale_discount,m_sale_shipping,m_sale_coupon,m_sale_ispartial,m_sale_pstatus,m_sale_pmode,m_sale_payamt,m_sale_pmode2,m_sale_payamt2,m_sale_status,m_sale_added_on,m_sale_user,m_sale_customer,m_acc_name,m_acc_mobile,m_acc_address,m_acc_email,pmode1.m_group_name as pmodename1,pmode2.m_group_name as pmodename2');
    $this->db->join(' master_accounts_tbl mct', 'mct.m_acc_id = master_sales_tbl.m_sale_customer', 'left');
    $this->db->join('master_goups_tbl pmode1', 'pmode1.m_group_id = master_sales_tbl.m_sale_pmode', 'left');
    $this->db->join('master_goups_tbl pmode2', 'pmode2.m_group_id = master_sales_tbl.m_sale_pmode2', 'left');
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
          "m_acc_name" => $skey->m_acc_name,
          "m_acc_mobile" => $skey->m_acc_mobile,
          "m_acc_address" => $skey->m_acc_address,
          "m_acc_email" => $skey->m_acc_email,
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
    $this->db->select('m_sale_spo,m_sale_qty,m_sale_price,m_sale_total,m_sale_date,m_sale_product,m_sale_size,m_sale_price,m_sale_gst,m_sale_color,m_product_name,color.m_group_name as m_color_name,size.m_group_name as m_size_name,unit.m_group_name as m_unit_title,m_category_name,fabric.m_group_name as m_fabric_name');
    $this->db->join('master_product mit', 'mit.m_product_id = master_sales_tbl.m_sale_product', 'left')
      ->join('master_goups_tbl as color', 'color.m_group_id  = master_sales_tbl.m_sale_color', 'left')
      ->join('master_goups_tbl as size', 'size.m_group_id  = master_sales_tbl.m_sale_size', 'left')
      ->join('master_categories as cate', 'cate.m_category_id  = mit.m_product_cat_id', 'left')
      ->join('master_goups_tbl unit', 'unit.m_group_id = mit.m_product_unit', 'left')
      ->join('master_goups_tbl fabric', 'fabric.m_group_id = mit.m_product_fabric', 'left');

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

    $this->db->join('master_accounts_tbl added_by', 'added_by.m_acc_id = master_sales_tbl.m_sale_added_by', 'left');
    $this->db->join('master_accounts_tbl updated_by', 'updated_by.m_acc_id = master_sales_tbl.m_sale_updaded_by', 'left');
    $this->db->join('master_accounts_tbl customer', 'customer.m_acc_id = master_sales_tbl.m_sale_customer', 'left');

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


  public function get_all_purchase($pur_id = '', $user = '', $search = '', $from_date = '', $to_date = '', $pur_type = '')
  {
    if (!empty($pur_id)) {
      $this->db->where('m_purchase_spo', $pur_id);
    }
    if (!empty($user)) {
      $this->db->where('m_purchase_supplier', $user);
    }
    if ($search != NULL) {
      // $this->db->like('m_acc_name',$search,'both');
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

    $this->db->select('m_purchase_spo,sum(m_purchase_qty) as total_qty,sum(m_purchase_total) as item_sub_total,sum(m_purchase_netamt) as item_net_total,m_purchase_type,m_purchase_invoiceno,m_purchase_date,sum(m_purchase_gstamt) as total_tax,sum(m_purchase_disamt) as total_disc,m_purchase_shipping,m_purchase_status,m_purchase_added_on,m_purchase_user,m_purchase_supplier,m_purchase_note,m_purchase_terms,m_acc_name,m_acc_mobile,m_acc_email,m_acc_address');
    $this->db->join('master_accounts_tbl mct', 'mct.m_acc_id = master_purchase_tbl.m_purchase_supplier', 'left');

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
          "m_acc_name" => $skey->m_acc_name,
          "m_acc_mobile" => $skey->m_acc_mobile,
          "m_acc_email" => $skey->m_acc_email,
          "m_acc_address" => $skey->m_acc_address,

          "m_purchase_items" => $this->get_purchase_item($skey->m_purchase_spo, $skey->m_purchase_supplier),

        );

        $result[] = $res;
      }
    }
    return $result;
  }

  public function get_purchase_item($pur_id, $supplier)
  {
    $this->db->select('m_purchase_id,m_purchase_qty,m_purchase_spo,m_purchase_product,m_purchase_price,m_purchase_date,m_purchase_total,m_purchase_type,colour.m_group_name as m_color_name,size.m_group_name as m_size_name,fabric.m_group_name as m_fabric_name,m_product_id,m_product_name,m_product_cat_id,m_category_name,m_product_unit,m_product_size,m_product_color,m_product_fabric,m_purchase_color,m_purchase_size,unit.m_group_name as m_unit_title,taxgst.m_group_name as m_tax_value,m_purchase_dis,m_purchase_gst,m_purchase_disamt,m_purchase_gstamt,m_purchase_netamt')
      ->join('master_product', 'master_product.m_product_id = master_purchase_tbl.m_purchase_product', 'left')
      ->join('master_goups_tbl taxgst', 'taxgst.m_group_id = master_product.m_product_taxgst', 'left')
      ->join('master_categories', 'master_categories.m_category_id = master_product.m_product_cat_id', 'left')
      ->join('master_goups_tbl unit', 'unit.m_group_id = master_product.m_product_unit', 'left')
      ->join('master_goups_tbl fabric', 'fabric.m_group_id = master_product.m_product_fabric', 'left')
      ->join('master_goups_tbl size', 'size.m_group_id = master_purchase_tbl.m_purchase_size', 'left')
      ->join('master_goups_tbl colour', 'colour.m_group_id = master_purchase_tbl.m_purchase_color', 'left');

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

        if (!empty($pur_item_id[$i])) {
          $insert_data['m_purchase_updaded_by'] = $this->session->userdata('user_id');
          $insert_data['m_purchase_updaded_on'] = date('Y-m-d H:i');

          $this->db->where('m_purchase_id', $pur_item_id[$i])->update('master_purchase_tbl', $insert_data);
          $res = 2;
        } else {
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
      $this->db->like('m_acc_name', $search, 'both');
    }
    if (!empty($user)) {
      $this->db->where('m_payment_user', $user);
    }
    $this->db->join('master_paymode_tbl', 'master_paymode_tbl.m_pmode_id = master_payment_tbl.m_payment_pmode', 'left');
    $this->db->join('master_accounts_tbl customer', 'customer.m_acc_id = master_payment_tbl.m_payment_user', 'left');
    // $this->db->join('master_accounts_tbl supplier', 'supplier.m_acc_id = master_payment_tbl.m_payment_user', 'left');

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
      $this->db->like('m_acc_name', $search, 'both');
    }
    if (!empty($user)) {
      $this->db->where('m_payment_user', $user);
    }
    $this->db->join('master_paymode_tbl', 'master_paymode_tbl.m_pmode_id = master_payment_tbl.m_payment_pmode', 'left');

    $this->db->join('master_accounts_tbl supplier', 'supplier.m_acc_id = master_payment_tbl.m_payment_user', 'left');

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
