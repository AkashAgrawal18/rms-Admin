<?php date_default_timezone_set('Asia/Kolkata');
class Main_model extends CI_model
{
  //----------active category-----------//
  public function get_active_category()
  {
    $this->db->select('*');
    $this->db->where('m_category_status', 1);
    $res = $this->db->get('master_categories')->result();
    return $res;
  }

  public function get_categories($search, $cat_id = '')
  {
    if (!empty($cat_id)) {
      $this->db->where('main_cat.m_category_id', $cat_id);
    }
    if ($search != NULL) {
      $this->db->like('main_cat.m_category_name', $search, 'both');
    }
    return $this->db->get('master_categories main_cat')->result();
  }

  public function insert_categories()
  {

    if (!empty($_FILES['m_category_image']['name'])) {
      $config['file_name'] = $_FILES['m_category_image']['name'];
      $config['upload_path'] = 'uploads/categories';
      $config['allowed_types'] = 'jpg|jpeg|png';
      $config['remove_spaces'] = TRUE;
      $config['file_name'] = $_FILES['m_category_image']['name'];
      //Load upload library and initialize configuration
      $this->load->library('upload', $config);
      $this->upload->initialize($config);
      if ($this->upload->do_upload('m_category_image')) {
        $uploadData = $this->upload->data();
        if (!empty($update_data['m_category_image'])) {
          if (file_exists($config['m_category_image'] . $update_data['m_category_image'])) {
            unlink($config['upload_path'] . $update_data['m_category_image']); /* deleting Image */
          }
        }
        $m_category_image = $uploadData['file_name'];
      }
    } else {
      $m_category_image = $this->input->post('m_category_image1');
    }
    $m_category_id = $this->input->post('m_category_id');

    $data = array(
      // "m_pcategory_id" => $this->input->post('parent_cat'),
      "m_category_name" => $this->input->post('m_category_name'),
      "m_category_slug" => $this->input->post('m_category_slug'),
      "m_category_status" => $this->input->post('m_category_status') ?: 1,
      "m_category_image" => $m_category_image,
    );
    if (!empty($m_category_id)) {
      $data['m_category_updated_on'] = date('Y-m-d H:i');
      $res = $this->db->where('m_category_id', $m_category_id)->update('master_categories', $data);
    } else {
      $data['m_category_added_on'] = date('Y-m-d H:i');
      $res = $this->db->insert('master_categories', $data);
    }

    return $res;
  }

  public function delete_categories()
  {
    $this->db->where('m_category_id', $this->input->post('delete_id'));
    return $this->db->delete('master_categories');
  }
  //===================category ==============================//


  public function get_coupons($search)
  {
    $this->db->select('*');
    if ($search != NULL) {

      $this->db->like('m_coupon_title', $search, 'both');
    }


    $res = $this->db->get('master_coupon_tbl')->result();
    return $res;
  }

  public function insert_coupons()
  {



    $data = array(

      "m_coupon_title" => $this->input->post('coupon_title'),
      "m_coupon_code" => $this->input->post('coupon_code'),
      "m_coupon_discount_type" => $this->input->post('dis_type'),
      "m_coupon_discount" => $this->input->post('dis_percentage'),
      "m_coupon_min_amount" => $this->input->post('min_amount'),
      "m_coupon_detail" => $this->input->post('coupon_details'),
      "m_coupon_start" => $this->input->post('start_date'),
      "m_coupon_end" => $this->input->post('end_date'),
      "m_coupon_status" => 1,

    );

    $data['m_coupon_added_on'] = date('Y-m-d h:i:s');
    $res = $this->db->insert('master_coupon_tbl', $data);
    return $res;
  }

  public function update_coupons()
  {


    $coupon_id = $this->input->post('coupon_id');

    $data = array(

      "m_coupon_title" => $this->input->post('coupon_title'),
      "m_coupon_code" => $this->input->post('coupon_code'),
      "m_coupon_discount_type" => $this->input->post('dis_type'),
      "m_coupon_discount" => $this->input->post('dis_percentage'),
      "m_coupon_min_amount" => $this->input->post('min_amount'),
      "m_coupon_detail" => $this->input->post('coupon_details'),
      "m_coupon_start" => $this->input->post('start_date'),
      "m_coupon_end" => $this->input->post('end_date'),
      "m_coupon_status" => $this->input->post('coupon_status'),

    );



    $res = $this->db->where('m_coupon_id', $coupon_id)->update('master_coupon_tbl', $data);
    return $res;
  }

  public function delete_coupons()
  {
    $this->db->where('m_coupon_id', $this->input->post('delete_id'));
    return $this->db->delete('master_coupon_tbl');
  }

  //===================/coupons ==============================//

  //===================product ==============================//

  public function get_product($search, $cat)
  {
    $this->db->select('*');
    if (!empty($cat)) {
      $this->db->where('m_product_cat_id', $cat);
    }
    if ($search != NULL) {

      $this->db->like('m_product_name', $search, 'both');
      $this->db->or_like('m_product_slug', $search, 'both');


      // $this->db->or_like('address',$search_key,'both');

    }
    // $this->db->join('master_image_tbl', 'master_image_tbl.m_image_product_id = master_product.m_product_id', 'left');

    $this->db->join('master_categories', 'master_categories.m_category_id = master_product.m_product_cat_id', 'left');

    $res = $this->db->get('master_product')->result();
    return $res;
  }

  public function all_product($category)
  {
    $this->db->select('*');
    $this->db->join('master_categories', 'master_categories.m_category_id = master_product.m_product_cat_id', 'left');


    if ($category != '') {
      $query = $this->db->where("m_product_cat_id", $category);
    }
    // $this->db->where("o_product_id !=",$m_product_id);
    $sql = $this->db->get('master_product')->result();
    return  $sql;
  }


  public function get_active_products()
  {
    $this->db->select('*');

    $this->db->where('m_product_status', 1);
    // $this->db->join('master_image_tbl', 'master_image_tbl.m_image_product_id = master_product.m_product_id', 'left');
    $this->db->join('master_categories', 'master_categories.m_category_id = master_product.m_product_cat_id', 'left');
    $res = $this->db->get('master_product')->result();
    return $res;
  }


  public function insert_product()
  {
    // Extract the selected colors, sizes, and fabrics
    $selectedColors = $this->input->post('colors');
    $selectedSizes = $this->input->post('sizes');

    // Prepare the data array
    $data = array(
      "m_product_cat_id" => $this->input->post('category'),
      "m_product_name" => $this->input->post('product_name'),
      "m_product_slug" => $this->input->post('product_slug'),
      "m_product_unit" => $this->input->post('product_unit'),
      // "m_product_quantity" => $this->input->post('product_quantity'),
      // "m_product_openstock" => $this->input->post('open_stock'),
      // "m_product_expiry" => $this->input->post('expiry_date'),
      "m_product_barscode" => $this->input->post('product_barcode'),
      // "m_product_code" => $this->input->post('product_code'),
      // "m_product_purche_price" => $this->input->post('product_purchese'),
      "m_product_seles_price" => $this->input->post('product_sales'),
      "m_product_mrp" => $this->input->post('product_mrp'),
      "m_product_taxgst" => $this->input->post('product_tax'),
      "m_product_details" => $this->input->post('m_product_details'),
      "m_product_information" => $this->input->post('m_product_information'),
      "m_product_des" => $this->input->post('m_product_des'),
      "m_product_status" => 1,
      'm_product_color' => implode(',', $selectedColors),
      'm_product_size' => implode(',', $selectedSizes),
      'm_product_fabric' => $this->input->post('fabrics'),
    );

    // Add the timestamp
    $data['m_product_added_on'] = date('Y-m-d H:i');

    // Insert data into the 'master_product' table
    $res = $this->db->insert('master_product', $data);

    return $res;
  }

  public function update_product()
  {


    $selectedColors = $this->input->post('colors');
    $selectedSizes = $this->input->post('sizes');

    // Prepare the data array
    $data = array(
      "m_product_cat_id" => $this->input->post('category'),
      "m_product_name" => $this->input->post('product_name'),
      "m_product_slug" => $this->input->post('product_slug'),
      "m_product_unit" => $this->input->post('product_unit'),
      // "m_product_quantity" => $this->input->post('product_quantity'),
      // "m_product_openstock" => $this->input->post('open_stock'),
      // "m_product_expiry" => $this->input->post('expiry_date'),
      "m_product_barscode" => $this->input->post('product_barcode'),
      // "m_product_code" => $this->input->post('product_code'),
      // "m_product_purche_price" => $this->input->post('product_purchese'),
      "m_product_seles_price" => $this->input->post('product_sales'),
      "m_product_mrp" => $this->input->post('product_mrp'),
      "m_product_taxgst" => $this->input->post('product_tax'),
      "m_product_details" => $this->input->post('m_product_details'),
      "m_product_information" => $this->input->post('m_product_information'),
      "m_product_des" => $this->input->post('m_product_des'),
      "m_product_status" => 1,
      'm_product_color' => implode(',', $selectedColors),
      'm_product_size' => implode(',', $selectedSizes),
      'm_product_fabric' => $this->input->post('fabrics'),
    );


    $data['m_product_updated_on'] = date('Y-m-d H:i');
    $res = $this->db->where('m_product_id', $this->input->post('product_id'))->update('master_product', $data);
    return $res;
  }

  public function delete_product()
  {
    $this->db->where('m_product_id', $this->input->post('delete_id'));
    return $this->db->delete('master_product');
  }

  //===================/product ==============================//

  //=================== master group ==============================//
  public function get_group_list($type,$search)
  {
    $this->db->select('*');
    if ($search != NULL) {
      $this->db->like('m_group_name', $search, 'both');
    }
    $this->db->where('m_group_type',$type);
    return $this->db->get('master_goups_tbl')->result();
    
  }


  public function get_active_group($type)
  {
    $this->db->select('*');
    $this->db->where('m_group_type', $type);
    $this->db->where('m_group_status', 1);
    return $this->db->get('master_goups_tbl')->result();
  }

  public function get_group_dtl($group_id)
  {
    $this->db->select('*');
    $this->db->where('m_group_id', $group_id);
    return $this->db->get('master_goups_tbl')->result();
    
  }


  public function insert_group()
  {
   $m_group_id = $this->input->post('m_group_id');

    $data = array(
      "m_group_name" => $this->input->post('m_group_name'),
      "m_group_type" => $this->input->post('m_group_type'),
      "m_group_status" => $this->input->post('m_group_status') ?:1,
    );

    if(!empty($m_group_id)){
      $data['m_group_updatedon'] = date('Y-m-d H:i');
      $res = $this->db->where('m_group_id',$m_group_id)->update('master_goups_tbl', $data);
    }else {
      $data['m_group_added_on'] = date('Y-m-d H:i');
      $res = $this->db->insert('master_goups_tbl', $data);
    }
   
    return $res;
  }

  public function delete_group()
  {
    $this->db->where('m_group_id', $this->input->post('delete_id'));
    return $this->db->delete('master_goups_tbl');
  }

  //===================/ master group ==============================//


  //===================Expense Categories ==============================//
  public function get_expense_categories($search)
  {
    $this->db->select('*');
    if ($search != NULL) {
      $this->db->like('m_expcat_title', $search, 'both');
    }
    $res = $this->db->get('master_expense_category')->result();
    return $res;
  }


  public function get_active_expcat()
  {
    $this->db->select('*');
    $this->db->where('m_expcat_status', 1);
    $res = $this->db->get('master_expense_category')->result();
    return $res;
  }


  public function insert_expense_categories()
  {
    $data = array(
      "m_expcat_title" => $this->input->post('m_expcat_title'),
      "m_expcat_des" => $this->input->post('m_expcat_des'),
      "m_expcat_status" => $this->input->post('m_expcat_status'),
    );

    $data['m_expcat_added_on'] = date('Y-m-d H:i');
    $res = $this->db->insert('master_expense_category', $data);
    return $res;
  }

  public function update_expense_categories()
  {
    $data = array(
      "m_expcat_title" => $this->input->post('m_expcat_title'),
      "m_expcat_des" => $this->input->post('m_expcat_des'),
      "m_expcat_status" => $this->input->post('m_expcat_status'),
    );

    $res = $this->db->where('m_expcat_id', $this->input->post('m_expcat_id'))->update('master_expense_category', $data);
    return $res;
  }

  public function delete_expense_categories()
  {
    $this->db->where('m_expcat_id', $this->input->post('delete_id'));
    return $this->db->delete('master_expense_category');
  }

  //===================/Expense Categories ==============================//
  //===================/Expense  ==============================//

  public function get_expense($search, $user_exp)
  {
    $this->db->select('*');
    if ($search != NULL) {
      $this->db->like('m_expcat_title', $search, 'both');
    }
    if ($user_exp) {
      $this->db->where('m_expense_user_id', $user_exp);
    }
    $this->db->join('master_expense_category', 'master_expense_category.m_expcat_id = master_expense.m_expense_cat_id', 'left');
    $this->db->join('master_users_tbl', 'master_users_tbl.m_user_id = master_expense.m_expense_user_id', 'left');
    $res = $this->db->get('master_expense')->result();
    return $res;
  }




  public function insert_expense()
  {

    if (!empty($_FILES['m_expense_image']['name'])) {
      $config['file_name'] = $_FILES['m_expense_image']['name'];
      $config['upload_path'] = 'uploads/expense_doc';
      $config['allowed_types'] = 'jpg|jpeg|png';
      $config['remove_spaces'] = TRUE;
      $config['file_name'] = $_FILES['m_expense_image']['name'];
      //Load upload library and initialize configuration
      $this->load->library('upload', $config);
      $this->upload->initialize($config);
      if ($this->upload->do_upload('m_expense_image')) {
        $uploadData = $this->upload->data();
        if (!empty($update_data['m_expense_image'])) {
          if (file_exists($config['m_expense_image'] . $update_data['m_expense_image'])) {
            unlink($config['upload_path'] . $update_data['m_expense_image']); /* deleting Image */
          }
        }
        $m_expense_image = $uploadData['file_name'];
      }
    } else {
      $m_expense_image = '';
    }
    $data = array(
      "m_expense_cat_id" => $this->input->post('m_expense_cat_id'),
      "m_expense_user_id" => $this->input->post('m_expense_user_id'),
      "m_expense_amount" => $this->input->post('m_expense_amount'),
      "m_expense_note " => $this->input->post('m_expense_note'),
      "m_expense_date" => $this->input->post('m_expense_date'),
      "m_expense_image" => $m_expense_image,

    );

    $data['m_expense_added_on'] = date('Y-m-d H:i');
    $res = $this->db->insert('master_expense', $data);
    return $res;
  }

  public function update_expense()
  {

    if (!empty($_FILES['m_expense_image']['name'])) {
      $config['file_name'] = $_FILES['m_expense_image']['name'];
      $config['upload_path'] = 'uploads/expense_doc';
      $config['allowed_types'] = 'jpg|jpeg|png';
      $config['remove_spaces'] = TRUE;
      $config['file_name'] = $_FILES['m_expense_image']['name'];
      //Load upload library and initialize configuration
      $this->load->library('upload', $config);
      $this->upload->initialize($config);
      if ($this->upload->do_upload('m_expense_image')) {
        $uploadData = $this->upload->data();
        if (!empty($update_data['m_expense_image'])) {
          if (file_exists($config['m_expense_image'] . $update_data['m_expense_image'])) {
            unlink($config['upload_path'] . $update_data['m_expense_image']); /* deleting Image */
          }
        }
        $m_expense_image = $uploadData['file_name'];
      }
    } else {
      $m_expense_image = $this->input->post('m_expense_image1');
    }



    $data = array(
      "m_expense_cat_id" => $this->input->post('m_expense_cat_id'),
      "m_expense_user_id" => $this->input->post('m_expense_user_id'),
      "m_expense_amount" => $this->input->post('m_expense_amount'),
      "m_expense_note " => $this->input->post('m_expense_note'),
      "m_expense_date" => $this->input->post('m_expense_date'),
      "m_expense_image" => $m_expense_image,

    );

    $res = $this->db->where('m_expense_id', $this->input->post('m_expense_id'))->update('master_expense', $data);
    return $res;
  }

  public function delete_expense()
  {
    $this->db->where('m_expense_id', $this->input->post('delete_id'));
    return $this->db->delete('master_expense');
  }


  //===================/expense ==============================//


  //===================product image ==============================//
  public function get_image($pid)
  {
    $this->db->select('*');
    $this->db->where('m_image_product_id', $pid);
    $res = $this->db->get('master_image_tbl')->result();
    return $res;
  }




  public function insert_image()
  {

    if (!empty($_FILES['m_pimage']['name'])) {
      $config['file_name'] = $_FILES['m_pimage']['name'];
      $config['upload_path'] = 'uploads/product';
      $config['allowed_types'] = 'jpg|jpeg|png';
      $config['remove_spaces'] = TRUE;
      $config['file_name'] = $_FILES['m_pimage']['name'];
      //Load upload library and initialize configuration
      $this->load->library('upload', $config);
      $this->upload->initialize($config);
      if ($this->upload->do_upload('m_pimage')) {
        $uploadData = $this->upload->data();
        if (!empty($update_data['m_pimage'])) {
          if (file_exists($config['m_pimage'] . $update_data['m_pimage'])) {
            unlink($config['upload_path'] . $update_data['m_pimage']); /* deleting Image */
          }
        }
        $product_img = $uploadData['file_name'];
      }
    } else {
      $product_img = '';
    }




    $data = array(
      "m_image_product_id" => $this->input->post('product_id'),
      "m_image_status" => $this->input->post('image_status'),
      "m_image_product_img" => $product_img,
    );

    //print_r($data);

    $data['m_image_product_added_on'] = date('Y-m-d H:i');
    $res = $this->db->insert('master_image_tbl', $data);
    return $res;
  }

  public function update_image()
  {
    if (!empty($_FILES['m_pimage']['name'])) {
      $config['file_name'] = $_FILES['m_pimage']['name'];
      $config['upload_path'] = 'uploads/product';
      $config['allowed_types'] = 'jpg|jpeg|png';
      $config['remove_spaces'] = TRUE;
      $config['file_name'] = $_FILES['m_pimage']['name'];
      //Load upload library and initialize configuration
      $this->load->library('upload', $config);
      $this->upload->initialize($config);
      if ($this->upload->do_upload('m_pimage')) {
        $uploadData = $this->upload->data();
        if (!empty($update_data['m_pimage'])) {
          if (file_exists($config['m_pimage'] . $update_data['m_pimage'])) {
            unlink($config['upload_path'] . $update_data['m_pimage']); /* deleting Image */
          }
        }
        $product_img = $uploadData['file_name'];
      }
    } else {
      $product_img = $this->input->post('pimage');
    }

    $data = array(
      "m_image_product_id" => $this->input->post('product_id'),
      "m_image_status" => $this->input->post('image_status'),
      "m_image_product_img" => $product_img,
    );

    $res = $this->db->where('m_image_id', $this->input->post('image_id'))->update('master_image_tbl', $data);
    return $res;
  }

  public function delete_image()
  {
    $this->db->where('m_image_id', $this->input->post('delete_id'));
    return $this->db->delete('master_image_tbl');
  }

  //===================/product image ==============================//
  //===================offer==============================//

  //************************** offers **************************//




  public function offer_list()
  {
    $this->db->select('*');
    // if (!empty($from_date)) {
    //   $this->db->where('DATE_FORMAT(m_offer_added_on,"%Y-%m-%d")>=', $from_date);
    // }
    // if (!empty($to_date)) {
    //   $this->db->where('DATE_FORMAT(m_offer_added_on,"%Y-%m-%d")<=', $to_date);
    // }

    $sql = $this->db->get('master_offers')->result();
    return $sql;
  }

  // public function offers_edit($id1)
  // {
  //   // $sql = $this->db->join('master_categories_tbl', 'master_categories_tbl.m_category_id = coupon_tbl.m_coupon_category');
  //   $sql = $this->db->where('m_offer_id', $id1)->get('master_offers');
  //   $result = $sql->result();
  //   return $result;
  // }

  public function insert_offer()
  {
    if (!empty($_FILES['m_offer_image']['name'])) {
      $name1 = $_FILES['m_offer_image']['name'];
      $fileNameParts = explode(".", $name1); // explode file name to two part
      $fileExtension = end($fileNameParts); // give extension
      $fileExtension = strtolower($fileExtension);
      $encripted_pic_name = md5(microtime() . $name1) . '.' . $fileExtension;
      $config['file_name'] = $encripted_pic_name;
      $config['upload_path'] = 'uploads/offer';
      $config['allowed_types'] = 'jpg|jpeg|png';
      $config['remove_spaces'] = false;
      //Load upload library and initialize configuration
      $this->load->library('upload', $config);
      $this->upload->initialize($config);
      if ($this->upload->do_upload('m_offer_image')) {
        $m_offer_image = $config['file_name'];
      } else {
        $m_offer_image = '';
      }
    } else {
      $m_offer_image = '';
    }

    $titleURL = strtolower(url_title(strip_tags($this->input->post('m_offer_title'))));
    if (isUrlExists('master_offers', 'm_offer_slug', $titleURL)) {
      $titleURL = $titleURL . '-' . time();
    }

    $data = array(

      'm_offer_maintitle' => $this->input->post('m_offer_maintitle'),
      'm_offer_title' => $this->input->post('m_offer_title'),
      'm_offer_status' => $this->input->post('m_offer_status'),
      'm_offer_priority' => $this->input->post('m_offer_priority'),
      'm_offer_image' => $m_offer_image,
      'm_offer_vendor' => $this->session->userdata('user_id'),
      'm_offer_slug' => $titleURL

    );



    $data['m_offer_added_on'] = date('Y-m-d H:i');
    $res = $this->db->insert('master_offers',  $data);



    return $res;
  }


  public function update_offer()
  {
    if (!empty($_FILES['m_offer_image']['name'])) {
      $name1 = $_FILES['m_offer_image']['name'];
      $fileNameParts = explode(".", $name1); // explode file name to two part
      $fileExtension = end($fileNameParts); // give extension
      $fileExtension = strtolower($fileExtension);
      $encripted_pic_name = md5(microtime() . $name1) . '.' . $fileExtension;
      $config['file_name'] = $encripted_pic_name;
      $config['upload_path'] = 'uploads/offer';
      $config['allowed_types'] = 'jpg|jpeg|png';
      $config['remove_spaces'] = false;
      //Load upload library and initialize configuration
      $this->load->library('upload', $config);
      $this->upload->initialize($config);
      if ($this->upload->do_upload('m_offer_image')) {
        $m_offer_image = $config['file_name'];
      } else {
        $m_offer_image = $this->input->post('m_offer_images');
      }
    } else {
      $m_offer_image = $this->input->post('m_offer_images');
    }

    $titleURL = strtolower(url_title(strip_tags($this->input->post('m_offer_title'))));
    if (isUrlExists('master_offers', 'm_offer_slug', $titleURL)) {
      $titleURL = $titleURL . '-' . time();
    }

    $data = array(

      'm_offer_maintitle' => $this->input->post('m_offer_maintitle'),
      'm_offer_title' => $this->input->post('m_offer_title'),
      'm_offer_status' => $this->input->post('m_offer_status'),
      'm_offer_priority' => $this->input->post('m_offer_priority'),
      'm_offer_image' => $m_offer_image,
      'm_offer_vendor' => $this->session->userdata('user_id'),
      'm_offer_slug' => $titleURL

    );



    $res = $this->db->where('m_offer_id', $this->input->post('m_offer_id'))->update('master_offers', $data);



    return $res;
  }






  public function delete_offer()
  {
    $this->db->where('m_offer_id', $this->input->post('delete_id'));
    return $this->db->delete('master_offers');
  }

  public function get_typename($typeid)
  {

    $sql = $this->db->where("m_offer_id", $typeid)->get('master_offers');
    $result = $sql->result();
    return $result;
  }

  public function all_product_offer($typeid)
  {

    $this->db->select('*');
    $this->db->from('product_offers');
    $this->db->join('master_product', 'master_product.m_product_id   = product_offers.o_product_id');
    $query = $this->db->where("o_offer_type", $typeid);

    //  $user_type=$this->session->userdata('user_type');
    // $user=$this->session->userdata('user_id');
    //  if($user_type == 2)
    // {

    //     $sql=$this->db->where('p_vendor_id',$user);
    // }
    // $this->db->join('sub_category', 'sub_category.s_category_id  = product_tbl.p_category_id');
    $query = $this->db->get();
    $result = $query->result();
    return $result;
  }

  function make_offer($type)
  {

    $offer = $this->input->post('offers');
    $o_offer_slug = $this->input->post('o_offer_slug');

    for ($i = 0; $i < sizeof($offer); $i++) {
      $data[$i] = array('o_product_id' => $offer[$i], 'o_offer_type' => $type, 'o_offer_slug' => $o_offer_slug);
    }


    $insert = $this->db->insert_batch('product_offers', $data);

    $this->db->set('m_offer_hasproduct', 1);
    $this->db->where('m_offer_id', $type);
    $this->db->update('master_offers');
    return $insert;
  }

  public function delete_product_offers($remove)
  {
    $sql = $this->db->where('offer_id', $remove)->delete('product_offers');
  }



  //===================/offer ==============================//
  //===================banners ==============================//

  public function get_banners()
  {
    $this->db->select('*');
    $res = $this->db->get('master_slider')->result();
    return $res;
  }




  public function insert_banner()
  {

    if (!empty($_FILES['m_slider_image']['name'])) {
      $config['file_name'] = $_FILES['m_slider_image']['name'];
      $config['upload_path'] = 'uploads/slider';
      $config['allowed_types'] = 'jpg|jpeg|png';
      $config['remove_spaces'] = TRUE;
      $config['file_name'] = $_FILES['m_slider_image']['name'];
      //Load upload library and initialize configuration
      $this->load->library('upload', $config);
      $this->upload->initialize($config);
      if ($this->upload->do_upload('m_slider_image')) {
        $uploadData = $this->upload->data();
        if (!empty($update_data['m_slider_image'])) {
          if (file_exists($config['m_slider_image'] . $update_data['m_slider_image'])) {
            unlink($config['upload_path'] . $update_data['m_slider_image']); /* deleting Image */
          }
        }
        $slider_img = $uploadData['file_name'];
      }
    } else {
      $slider_img = '';
    }


    if ($this->input->post('m_slider_type') == 1) {

      $data = array(
        "m_slider_type" => $this->input->post('m_slider_type'),
        "m_slider_title" => $this->input->post('m_slider_title'),
        "m_slider_status" => $this->input->post('m_slider_status'),
        "m_slider_image" => $slider_img,
      );
    } else {
      $data = array(
        "m_slider_type" => $this->input->post('m_slider_type'),
        "m_slider_title" => $this->input->post('m_slider_title'),
        "m_slider_des" => $this->input->post('m_slider_des'),
        "m_slider_status" => $this->input->post('m_slider_status'),
        "m_slider_image" => $slider_img,
      );
    }


    // print_r($data);

    $data['m_slider_added_on'] = date('Y-m-d H:i');
    $res = $this->db->insert('master_slider', $data);
    return $res;
  }

  public function update_banner()
  {
    if (!empty($_FILES['m_slider_image']['name'])) {
      $config['file_name'] = $_FILES['m_slider_image']['name'];
      $config['upload_path'] = 'uploads/slider';
      $config['allowed_types'] = 'jpg|jpeg|png';
      $config['remove_spaces'] = TRUE;
      $config['file_name'] = $_FILES['m_slider_image']['name'];
      //Load upload library and initialize configuration
      $this->load->library('upload', $config);
      $this->upload->initialize($config);
      if ($this->upload->do_upload('m_slider_image')) {
        $uploadData = $this->upload->data();
        if (!empty($update_data['m_slider_image'])) {
          if (file_exists($config['m_slider_image'] . $update_data['m_slider_image'])) {
            unlink($config['upload_path'] . $update_data['m_slider_image']); /* deleting Image */
          }
        }
        $slider_img = $uploadData['file_name'];
      }
    } else {
      $slider_img = $this->input->post('m_slider_image1');
    }


    if ($this->input->post('m_slider_type') == 1) {

      $data = array(
        "m_slider_type" => $this->input->post('m_slider_type'),
        "m_slider_title" => $this->input->post('m_slider_title'),
        "m_slider_status" => $this->input->post('m_slider_status'),
        "m_slider_image" => $slider_img,
      );
    } else {
      $data = array(
        "m_slider_type" => $this->input->post('m_slider_type'),
        "m_slider_title" => $this->input->post('m_slider_title'),
        "m_slider_des" => $this->input->post('m_slider_des'),
        "m_slider_status" => $this->input->post('m_slider_status'),
        "m_slider_image" => $slider_img,
      );
    }

    // print_r($data);

    $res = $this->db->where('m_slider_id', $this->input->post('m_slider_id'))->update('master_slider', $data);
    return $res;
  }

  public function delete_banner()
  {
    $this->db->where('m_slider_id', $this->input->post('delete_id'));
    return $this->db->delete('master_slider');
  }



  //===================/banners ==============================//
  //===================queries ==============================//


  public function get_contactus()
  {
    $this->db->select('*');
    $res = $this->db->get('master_contact_tbl')->result();
    return $res;
  }


  public function update_query_status()
  {
    $data = array(
      "m_contact_status" => $this->input->post('feed_status'),
    );

    $this->db->where('m_contact_id', $this->input->post('feed_id'))->update('master_contact_tbl', $data);
    return true;
  }


  public function delete_query()
  {
    $this->db->where('m_contact_id', $this->input->post('delete_id'));
    return $this->db->delete('master_contact_tbl');
  }

  //===================/queries ==============================//
  //===================review ==============================//
  public function get_all_review()
  {
    $this->db->select('*');
    $this->db->join('master_users_tbl', 'master_users_tbl.m_user_id  = master_review_tbl.m_review_user_id');
    $this->db->join('master_product', 'master_product.m_product_id   = master_review_tbl.m_review_produ_id');
    $res = $this->db->get('master_review_tbl')->result();
    return $res;
  }

  public function delete_review()
  {
    $this->db->where('m_review_id', $this->input->post('delete_id'));
    return $this->db->delete('master_review_tbl');
  }

  //===================/review ==============================//

}
