<?php date_default_timezone_set('Asia/Kolkata');
class Master_model extends CI_model
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
      "m_category_image" => $m_category_image,
    );
    if (!empty($m_category_id)) {
      $data['m_category_status'] = $this->input->post('m_category_status');
      $data['m_category_updated_on'] = date('Y-m-d H:i');
      $this->db->where('m_category_id', $m_category_id)->update('master_categories', $data);
      $res = 2;
    } else {
      $data['m_category_status'] = 1;
      $data['m_category_added_on'] = date('Y-m-d H:i');
      $this->db->insert('master_categories', $data);
      $cat_id = $this->db->insert_id();
      $res = 1;
    }
    if ($this->input->post('m_addon') == 1) {
      return $cat_id;
    } else {
      return $res;
    }
  }

  public function delete_categories()
  {
    $this->db->where('m_category_id', $this->input->post('delete_id'));
    return $this->db->delete('master_categories');
  }
  //===================category ==============================//


  public function get_coupons($search)
  {

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

    if (!empty($this->input->post('coupon_id'))) {
      $this->db->where('m_coupon_id', $this->input->post('coupon_id'))->update('master_coupon_tbl', $data);
      $res = 2;
    } else {
      $data['m_coupon_added_on'] = date('Y-m-d h:i:s');
      $res = $this->db->insert('master_coupon_tbl', $data);
    }
    return $res;
  }

  public function delete_coupons()
  {
    $this->db->where('m_coupon_id', $this->input->post('delete_id'));
    return $this->db->delete('master_coupon_tbl');
  }

  //===================/coupons ==============================//

  //===================product ==============================//

  public function all_product($category = '')
  {
    $this->db->select('master_product.*,m_category_name,brand.m_group_name as m_brand_name');
    $this->db->join('master_categories', 'master_categories.m_category_id = master_product.m_product_cat_id', 'left');
    $this->db->join('master_goups_tbl brand', 'brand.m_group_id = master_product.m_product_brand', 'left');
    if ($category != '') {
      $query = $this->db->where("m_product_cat_id", $category);
    }
    $this->db->where("m_product_status", 1);
    return $this->db->get('master_product')->result();
  }


  public function get_active_products($cat = '', $brand = '', $search = '', $status = '', $item = '')
  {
    $result = array();

    if (!empty($item)) {
      $this->db->where('m_product_id', $item);
    }
    if (!empty($status)) {
      $this->db->where('m_product_status', $status);
    }
    if (!empty($cat)) {
      $this->db->where('m_product_cat_id', $cat);
    }
    if (!empty($brand)) {
      $this->db->where('m_product_brand', $brand);
    }
    if (!empty($search)) {

      $this->db->like('m_product_name', $search, 'both');
      $this->db->or_like('m_product_slug', $search, 'both');
      $this->db->or_like('m_product_barscode', $search, 'both');
    }
    $sql = $this->db->select('master_product.*,m_category_name,taxgst.m_group_name as m_tax_value,taxgst.m_group_name as m_tax_value,unit.m_group_name as m_unit_title,brand.m_group_name as m_brand_name')
      ->join('master_goups_tbl taxgst', 'taxgst.m_group_id = master_product.m_product_taxgst', 'left')
      ->join('master_categories', 'master_categories.m_category_id = master_product.m_product_cat_id', 'left')
      ->join('master_goups_tbl unit', 'unit.m_group_id = master_product.m_product_unit', 'left')
      ->join('master_goups_tbl brand', 'brand.m_group_id = master_product.m_product_brand', 'left')
      ->get('master_product')->result();

    if (!empty($sql)) {
      foreach ($sql as $key => $value) {
        $product_colors = $this->db->select('m_group_id as m_color_id,m_group_name as m_color_name')->where_in('m_group_id', explode(',', $value->m_product_color))->get('master_goups_tbl')->result();

        $product_size = $this->db->select('m_group_id as m_size_id,m_group_name as m_size_name')->where_in('m_group_id', explode(',', $value->m_product_size))->get('master_goups_tbl')->result();

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
          "m_product_updated_on" => $value->m_product_updated_on,
         
          "m_product_status" => $value->m_product_status,
          'm_product_brand' => $value->m_product_brand,
          'm_brand_name' => $value->m_brand_name ?: '',
          'product_color' => $value->m_product_color,
          'm_product_color' => $product_colors,
          'product_size' => $value->m_product_size,
          'm_product_size' => $product_size,
          'm_product_image' => $product_images,
        );

        $result[] = $res;
      }
    }

    return $result;
  }


  public function insert_product()
  {
    // Extract the selected colors, sizes, and brands

    if (!empty($this->input->post('m_product_color'))) {
      $selectedColors = implode(',', $this->input->post('m_product_color'));
    } else {
      $selectedColors = '';
    }
    if (!empty($this->input->post('m_product_size'))) {
      $selectedSizes = implode(',', $this->input->post('m_product_size'));
    } else {
      $selectedSizes = '';
    }
    // Prepare the data array
    $data = array(
      "m_product_cat_id" => $this->input->post('m_product_cat_id'),
      "m_product_name" => $this->input->post('m_product_name'),
      "m_product_slug" => $this->input->post('m_product_slug'),
      "m_product_unit" => $this->input->post('m_product_unit'),

      "m_product_barscode" => $this->input->post('m_product_barscode'),
      // "m_product_code" => $this->input->post('product_code'),
      // "m_product_purche_price" => $this->input->post('product_purchese'),
      "m_product_seles_price" => $this->input->post('m_product_seles_price'),
      "m_product_mrp" => $this->input->post('m_product_mrp'),
      "m_product_taxgst" => $this->input->post('m_product_taxgst'),
      "m_product_details" => $this->input->post('m_product_details'),
      "m_product_information" => $this->input->post('m_product_information'),
      "m_product_status" => 1,
      'm_product_color' => $selectedColors,
      'm_product_size' => $selectedSizes,
      'm_product_brand' => $this->input->post('m_product_brand'),
    );

    if (!empty($this->input->post('m_product_id'))) {
      $data['m_product_updated_on'] = date('Y-m-d H:i');
      $this->db->where('m_product_id', $this->input->post('m_product_id'))->update('master_product', $data);
      $res = 2;
    } else {
      // Add the timestamp
      $data['m_product_added_on'] = date('Y-m-d H:i');
      // Insert data into the 'master_product' table
      $this->db->insert('master_product', $data);
      $res = 1;
    }
    return $res;
  }

  public function delete_product()
  {

    $this->db->where('m_purchase_product', $this->input->post('delete_id'));
    return $this->db->delete('master_purchase_tbl');

    $this->db->where('m_wishlist_product_id', $this->input->post('delete_id'));
    return $this->db->delete('master_wishlist');

    $this->db->where('m_sale_product', $this->input->post('delete_id'));
    return $this->db->delete('master_sales_tbl');

    $this->db->where('o_product_id', $this->input->post('delete_id'));
    return $this->db->delete('product_offers');

    $this->db->where('m_product_id', $this->input->post('delete_id'));
    return $this->db->delete('master_product');
  }

  //===================/product ==============================//

  //=================== master group ==============================//
  public function get_group_list($type, $search)
  {
    $this->db->select('*');
    if ($search != NULL) {
      $this->db->like('m_group_name', $search, 'both');
    }
    $this->db->where('m_group_type', $type);
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
      "m_group_status" => $this->input->post('m_group_status') ?: 1,
    );

    if (!empty($m_group_id)) {
      $data['m_group_updatedon'] = date('Y-m-d H:i');
      $this->db->where('m_group_id', $m_group_id)->update('master_goups_tbl', $data);
      $res = 2;
    } else {
      $data['m_group_added_on'] = date('Y-m-d H:i');
      $res = $this->db->insert('master_goups_tbl', $data);
      $group_id = $this->db->insert_id();
    }
    if ($this->input->post('m_addon') == 1) {
      return $group_id;
    } else {
      return $res;
    }
  }

  public function delete_group()
  {
    $this->db->where('m_group_id', $this->input->post('delete_id'));
    return $this->db->delete('master_goups_tbl');
  }

  //===================/ master group ==============================//
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
    return $this->db->get('master_offers')->result();
  }

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
      'm_offer_type' => $this->input->post('m_offer_type'),
      'm_offer_image' => $m_offer_image,
      'm_offer_vendor' => $this->session->userdata('user_id'),
      'm_offer_slug' => $titleURL
    );
    if (!empty($this->input->post('m_offer_id'))) {
      $this->db->where('m_offer_id', $this->input->post('m_offer_id'))->update('master_offers', $data);
      $res = 2;
    } else {
      $data['m_offer_added_on'] = date('Y-m-d H:i');
      $this->db->insert('master_offers',  $data);
      $res = 1;
    }
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
    $this->db->join('master_product', 'master_product.m_product_id = product_offers.o_product_id');
    return $this->db->where("o_offer_type", $typeid)->get('product_offers')->result();
  }

  function make_offer($type)
  {

    $offer = $this->input->post('offers');
    $o_offer_slug = $this->input->post('o_offer_slug');

    for ($i = 0; $i < sizeof($offer); $i++) {
      $data[$i] = array('o_product_id' => $offer[$i], 'o_offer_type' => $type, 'o_offer_slug' => $o_offer_slug);
    }
    $insert = $this->db->insert_batch('product_offers', $data);

    $this->db->set('m_offer_hasproduct', 1)->where('m_offer_id', $type)->update('master_offers');
    return $insert;
  }

  public function delete_product_offers($remove)
  {
    return $this->db->where('offer_id', $remove)->delete('product_offers');
  }



  //===================/offer ==============================//
  //===================banners ==============================//

  public function get_banners()
  {
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

    $data = array(
      "m_slider_type" => $this->input->post('m_slider_type'),
      "m_slider_title" => $this->input->post('m_slider_title'),
      "m_slider_des" => $this->input->post('m_slider_des') ?: '',
      "m_slider_status" => $this->input->post('m_slider_status'),
      "m_slider_image" => $slider_img,
    );

    // print_r($data);
    if (!empty($this->input->post('m_slider_id'))) {
      $this->db->where('m_slider_id', $this->input->post('m_slider_id'))->update('master_slider', $data);
      $res = 2;
    } else {

      $data['m_slider_added_on'] = date('Y-m-d H:i');
      $res = $this->db->insert('master_slider', $data);
    }
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
    $this->db->join('master_accounts_tbl', 'master_accounts_tbl.m_acc_id  = master_review_tbl.m_review_user_id');
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
