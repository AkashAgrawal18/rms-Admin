<?php

class Main_model extends CI_model
{
	public function getcategory()
	{
		$this->db->select('master_categories.*,(select count(m_product_id) as total_product from master_product where m_product_cat_id = m_category_id) as total_product');
		$this->db->where('m_category_status',1);
		$res =$this->db->get('master_categories')->result();
		return $res;

	}

	public function catname($cat)
	{
		$this->db->select('m_category_name');
		$this->db->where('m_category_id',$cat);
		$res =$this->db->get('master_categories')->result();
		return $res;

	}
	public function get_slider($type)
	{
	return $this->db->where('m_slider_type', $type)->where('m_slider_status', 1)->get('master_slider')->result();

	}

	public function productname($id)
	{
		$this->db->select('m_product_name');
		$this->db->where('m_product_id',$id);
		$res =$this->db->get('master_product')->result();
		return $res;

	}



	public function getproduct($limit, $offset,$cat,$offer,$search,$size,$color,$fabric)
	{

		// print_r($color);
		$this->db->select('*');
		 $this->db->limit($limit, $offset);
	    $this->db->where('m_product_status',1);
	     if($cat){
	     $this->db->where('m_product_cat_id',$cat);
	     }
	     if($search){
         $this->db->like('m_product_name', $search);
	     }
	      if($offer){
	     $this->db->where('o_offer_slug',$offer);
	      $this->db->join('product_offers', 'product_offers.o_product_id = master_product.m_product_id', 'left');
	     }
     if($size) {
            // Use FIND_IN_SET to match the size ID in the comma-separated list
            $this->db->where("FIND_IN_SET($size, m_product_size) >", 0);
        }

      if($color) {
            // Use FIND_IN_SET to match the size ID in the comma-separated list
            $this->db->where("FIND_IN_SET($color, m_product_color) >", 0);
        }
       if($fabric) {
            // Use FIND_IN_SET to match the size ID in the comma-separated list
            $this->db->where("FIND_IN_SET($fabric, m_product_fabric) >", 0);
        }
	    $this->db->join('master_size_tbl', 'master_size_tbl.m_size_id = master_product.m_product_size', 'left');
	     $this->db->join('master_color_tbl', 'master_color_tbl.m_color_id = master_product.m_product_color', 'left');
	      $this->db->join('master_fabric_tbl', 'master_fabric_tbl.m_fabric_id = master_product.m_product_fabric', 'left'); 
        $this->db->join('master_categories', 'master_categories.m_category_id = master_product.m_product_cat_id', 'left');
       
		$res =$this->db->get('master_product')->result();
		return $res;

	}

	 public function count_all_data() {
        return $this->db->where('m_product_status',1)->count_all('master_product'); // Replace 'your_table' with your actual table name
    }



    public function get_active_type($type)
    {
      $this->db->select('*');
      $this->db->order_by('m_offer_id','desc');
      $this->db->where('m_offer_status',1);
       $this->db->where('m_offer_type',$type);
       $this->db->limit(2);
      
      $res = $this->db->get('master_offers')->result();
      return $res;
    }
	

    public function getproduct_featured($type)
    {
      $this->db->select('*');
      $this->db->where('m_offer_status',1);
       $this->db->where('m_offer_type',$type);
       $this->db->where('m_offer_id',1);
       $this->db->limit(4);
      $this->db->join('master_product', 'master_product.m_product_id = product_offers.o_product_id', 'left');
       $this->db->join('master_categories', 'master_categories.m_category_id = master_product.m_product_cat_id', 'left');
       $this->db->join('master_size_tbl', 'master_size_tbl.m_size_id = master_product.m_product_size', 'left');
      $this->db->join('master_color_tbl', 'master_color_tbl.m_color_id = master_product.m_product_color', 'left');
      
      $this->db->join('master_offers', 'master_offers.m_offer_id = product_offers.o_offer_type', 'left');
      $res = $this->db->get('product_offers')->result();
      return $res;
    }

 public function getproduct_recent($type)
 {
    $this->db->select('*');
      $this->db->where('m_offer_status',1);
       $this->db->where('m_offer_type',$type);
       $this->db->where('m_offer_id',2);
       $this->db->limit(4);
      $this->db->join('master_product', 'master_product.m_product_id = product_offers.o_product_id', 'left');
       $this->db->join('master_categories', 'master_categories.m_category_id = master_product.m_product_cat_id', 'left');
        $this->db->join('master_color_tbl', 'master_color_tbl.m_color_id  = master_product.m_product_color', 'left');
      $this->db->join('master_size_tbl', 'master_size_tbl.m_size_id = master_product.m_product_size', 'left');
      
      $this->db->join('master_offers', 'master_offers.m_offer_id = product_offers.o_offer_type', 'left');
      $res = $this->db->get('product_offers')->result();
      return $res;

 }


	public function getpfeatured_details()
	{
	    $this->db->select('*');
       $this->db->where('m_offer_status',1);
        $this->db->where('m_offer_id',1);
        $this->db->limit(3);
       $this->db->join('master_product', 'master_product.m_product_id = product_offers.o_product_id', 'left');
        $this->db->join('master_categories', 'master_categories.m_category_id = master_product.m_product_cat_id', 'left');
        $this->db->join('master_color_tbl', 'master_color_tbl.m_color_id  = master_product.m_product_color', 'left');
       $this->db->join('master_size_tbl', 'master_size_tbl.m_size_id = master_product.m_product_size', 'left');
       $this->db->join('master_offers', 'master_offers.m_offer_id = product_offers.o_offer_type', 'left');
       $res = $this->db->get('product_offers')->result();
       return $res;

	}

	// public function getproduct_details($id)
	// {
	// 	$this->db->select('*');
	// 	$this->db->where('m_product_status',1);
    //     $this->db->where('m_product_id',$id);
    //     $this->db->join('master_categories', 'master_categories.m_category_id = master_product.m_product_cat_id', 'left');

	// 	$res =$this->db->get('master_product')->result();
	// 	return $res;

	// }

	public function getproduct_details($id='',$cat='')
   {
    $result = array();

    if(!empty($cat)){
      $this->db->where('m_category_slug',$cat);
    }
    if(!empty($id)){
      $this->db->where('m_product_id',$id);
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

	public function getreleted_product($id,$cat_slug)
	{
		$this->db->select('*');
		// $this->db->where('m_product_id',1);
        $this->db->where('m_product_status',1);
        $this->db->where('m_product_id !=',$id);
        $this->db->where('m_category_slug',$cat_slug);
        $this->db->join('master_categories', 'master_categories.m_category_id = master_product.m_product_cat_id', 'left');
         $this->db->join('master_color_tbl', 'master_color_tbl.m_color_id  = master_product.m_product_color', 'left');
       $this->db->join('master_size_tbl', 'master_size_tbl.m_size_id = master_product.m_product_size', 'left');
        // $this->db->join('master_image_tbl', 'master_image_tbl.m_image_product_id = master_product.m_product_id', 'left');
		$res =$this->db->get('master_product')->result();
		return $res;

	}

	//---------------------------order --------------------------------//
   public function get_all_orders()
  {  

  	$this->db->select('*');
  	$this->db->group_by('m_sale_spo');
  	$this->db->where('m_sale_customer',$this->session->userdata('m_customer_id'));
     $this->db->join('master_users_tbl customer', 'customer.m_user_id = master_sales_tbl.m_sale_customer', 'left');
      
    $this->db->order_by('m_sale_id', 'desc');

    $res = $this->db->get('master_sales_tbl')->result();
    return $res;
  }

  // public function order_datails($orderid)
	// { 


		//  $this->db->select('*');
		//  $this->db->group_by('m_sale_spo');
		//  $this->db->where('m_sale_spo', $orderid);
		//  $this->db->join('master_users_tbl customer', 'customer.m_user_id = master_sales_tbl.m_sale_customer', 'left')->join('master_product product' , 'product.m_product_id = master_sales_tbl.m_sale_product', 'left')->join('master_image_tbl', 'master_image_tbl.m_image_product_id = product.m_product_id', 'left');
		// $res = $this->db->get('master_sales_tbl')->result();

		// return $res;
	// }


	public function order_datails($order_id)
  {
    if (!empty($order_id)) {
      $this->db->where('m_sale_spo', $order_id);
    }
    if (!empty($user)) {
      $this->db->where('m_sale_customer', $this->session->userdata('m_customer_id'));
    }
    

    $this->db->select('m_sale_spo,sum(m_sale_qty) as total_qty,sum(m_sale_total) as sub_total,m_sale_date,sum(m_sale_gst) as total_tax,m_sale_discount,m_sale_shipping,m_sale_coupon,m_sale_ispartial,m_sale_pstatus,m_sale_pmode,m_sale_payamt,m_sale_pmode2,m_sale_payamt2,m_sale_status,m_sale_added_on,m_sale_user,m_sale_customer,m_user_name,m_user_mobile,m_user_address,m_user_saddress,pmode1.m_pmode_name as pmodename1,pmode2.m_pmode_name as pmodename2');
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
          // "m_user_email" => $skey->m_user_email,
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
    $this->db->select('m_sale_spo,m_sale_qty,m_sale_price,m_sale_total,m_sale_date,m_sale_product,m_sale_size,m_sale_price,m_sale_gst,m_sale_color,m_product_name,m_color_name,m_size_name,m_unit_title,m_category_name,m_fabric_name,m_product_id');
    $this->db->join('master_product mit', 'mit.m_product_id = master_sales_tbl.m_sale_product', 'left')
      ->join('master_color_tbl as color', 'color.m_color_id  = master_sales_tbl.m_sale_color', 'left')
      ->join('master_size_tbl as size', 'size.m_size_id  = master_sales_tbl.m_sale_size', 'left')
      ->join('master_unit as unit', 'unit.m_unit_id = mit.m_product_unit', 'left')
      ->join('master_categories as cate', 'cate.m_category_id  = mit.m_product_cat_id', 'left')
      ->join('master_fabric_tbl as fabric', 'fabric.m_fabric_id  = mit.m_product_fabric', 'left');
      // ->join('master_image_tbl as image', 'image.m_image_product_id  = mit.m_product_id', 'left');

    
      $this->db->where('m_sale_customer', $uid);
  

    $this->db->where('m_sale_spo', $order_id);


    return $this->db->get('master_sales_tbl')->result();
  }

  //  public function get_sale_items($orderid,$user)
	//  { 
	// 	$this->db->select('*');

	// 	$this->db->where('m_sale_spo', $orderid);
	// 	$this->db->where('m_sale_customer', $user); 
	// 	$res = $this->db->get('master_sales_tbl')->result();

	// 	return $res;
	// }


	 public function sale_prodct($orderid)
	{ 
		$this->db->select('*');
		$this->db->where('m_sale_spo', $orderid);
		 
		$res = $this->db->get('master_sales_tbl')->num_rows();

		return $res;
	}



	//---------------------------/order --------------------------------//
	//---------------------------wishlist --------------------------------//
	 public function get_wishlist()
	 {
	 	  $this->db->select('*');
		  $this->db->where('m_wishlist_user_id', $this->session->userdata('m_customer_id'));
		  $this->db->join('master_users_tbl customer', 'customer.m_user_id = master_wishlist.m_wishlist_user_id', 'left')->join('master_product product' , 'product.m_product_id = master_wishlist.m_wishlist_product_id', 'left');
		  $res = $this->db->get('master_wishlist')->result();

		  return $res;
	 }

      public function insert_wish_list(){
	      $wish_id = $this->input->post('wish_id');
	      if($wish_id==0){
	         $userData = array(
	            "m_wishlist_product_id" => $this->input->post('prod_id'),
	            "m_wishlist_user_id" => $this->input->post('uid'),
	            "m_wishlist_modified" => date('Y-m-d'),
	         );
	         $this->db->insert("master_wishlist", $userData);
	      }
	      else{
	         $this->db->where('m_wishlist_product_id',$this->input->post('prod_id'));
	         $this->db->where('m_wishlist_user_id',$this->input->post('uid'));
	         $this->db->delete("master_wishlist");
	      }
	      return true;
	   }




	   public function delete_wishlist()
	   {  
	   	$this->db->select('*');
	      $this->db->where('m_wishlist_id',$this->input->post('delete_id'));
	      $this->db->where('m_wishlist_user_id',$this->session->userdata('m_customer_id'));
	      return $this->db->delete('master_wishlist');
	   }

	//---------------------------/wishlist --------------------------------//
	//---------------------------contact --------------------------------//
	   public function insert_contact()
	   { 

	   	$data = array(

	      "m_contact_name" => $this->input->post('name'),
				"m_contact_email" => $this->input->post('email'),
				"m_contact_mobile" => $this->input->post('mobile'),
				"m_contact_subject" => $this->input->post('subject'),
			   "m_contact_msg" => $this->input->post('message'),
				"m_contact_status" => 1,
			 );


	      $data['m_contact_added_on'] = date('Y-m-d h:i:s');
	      $res = $this->db->insert('master_contact_tbl', $data);
	      return $res;
     
      }

	//---------------------------/contact --------------------------------//
	//---------------------------review  --------------------------------//
     public function get_all_review($id,$user='')
	 {
	 	  $this->db->select('*');
	 	  if(!empty($user)){
      $this->db->where('m_review_user_id',$user);
	 	  }
		  $this->db->where('m_review_produ_id',$id)->join('master_users_tbl', 'master_users_tbl.m_user_id = master_review_tbl.m_review_user_id', 'left')->join('master_product', 'master_product.m_product_id  = master_review_tbl.m_review_produ_id', 'left');
                   
		  $res = $this->db->get('master_review_tbl')->result();

		  return $res;
	 } 


	 public function review_add()
	   { 
      $this->db->select('*');
	   	$this->db->where('m_review_produ_id',$this->input->post('product'));
	   	$this->db->where('m_review_user_id',$this->input->post('user'));
	   	$check = $this->db->get('master_review_tbl')->num_rows();
     
      if($check==0){

     
	   	$data = array(

	      "m_review_produ_id" => $this->input->post('product'),
				"m_review_user_id" => $this->input->post('user'),
				"m_review_rating" => $this->input->post('selected_star'),
				"m_review_des" => $this->input->post('review_msg'),
			 
				
			 );


	      $data['m_review_added_on'] = date('Y-m-d h:i:s');
	       $this->db->insert('master_review_tbl', $data);
	      return 1;
	    }else{

	    	return 2;

	    }
     
      }

      public function getAverageRating($id) {
        $this->db->select_avg('m_review_rating', 'average_rating');
        $this->db->where('m_review_produ_id', $id);
        $query = $this->db->get('master_review_tbl');

        $result = $query->row();

        return $result->average_rating;
    }

    public function getAverageRatinguser($user) {
        $this->db->select_avg('m_review_rating', 'average_rating');
        $this->db->where('m_review_user_id', $user);
        $query = $this->db->get('master_review_tbl');

        $result = $query->row();

        return $result->average_rating;
    }


    public function getproduct_color_size($id)
   {
     $result = array();

    
 
       $this->db->where('m_product_id',$id);
    
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



    public function order_insert()
	  {
				   $res = $this->db->select('m_sale_spo')->order_by('m_sale_id', 'desc')->get('master_sales_tbl')->row();

				if (!empty($res)) {
				    // If there are existing records, increment the sales order number
				    $part = explode('/', $res->m_sale_spo);
				    $spo = 'ORD/' . date('dmy') . '/' . sprintf('%04d', ($part[2] + 1));
				} else {
				    // If no records exist, start with 0001
				    $spo = 'ORD/' . date('dmy') . '/0001';
				}




				

				// Get cart items
				$cart_items = $this->cart->contents();

				// print_r($cart_items); die();

				$insert_data = array();

				foreach ($cart_items as $key => $item) {

             $gst =  $this->db->select('*')->where('m_product_id', $item['id'])->join('master_taxgst', 'master_taxgst.m_taxgst_id =master_product.m_product_taxgst', 'left')->get('master_product')->result();

				    // Get item-specific values
				    $m_sale_product = $item['id'];
				    $m_sale_price = $item['price'];
				    $m_sale_qty = $item['qty'];
				    $m_sale_total = $item['subtotal'];
				    $m_sale_gst = $item['price'] * $gst[0]->m_tax_value/100; // Assuming there's a 'gst' field in your cart item
				    $m_sale_color = $item['options']['color']; // Assuming there's a 'color' field in your cart item
				    $m_sale_size = $item['options']['size'] ; // Assuming there's a 'size' field in your cart item

				    // Prepare data for insertion
				    $insert_data[] = array(
				        "m_sale_date" => date('Y-m-d'),
				        "m_sale_spo" => $spo,
				        "m_sale_product" => $m_sale_product,
				        "m_sale_price" => $m_sale_price,
				        "m_sale_qty" => $m_sale_qty,
				        "m_sale_total" => $m_sale_total,
				        "m_sale_gst" => $m_sale_gst,
				        "m_sale_color" => $m_sale_color,
				        "m_sale_size" => $m_sale_size,
				        "m_sale_discount" => $this->input->post('m_sale_discount'),
				        "m_sale_pmode" => $this->input->post('m_sale_pmode'),
				        "m_sale_payamt" => $this->input->post('m_sale_payamt'),
				        "m_sale_shipping" => $this->input->post('m_sale_shipping'),
				        "m_sale_status" => 1,
				        "m_sale_customer" => $this->session->userdata('m_customer_id'),
				        "m_sale_added_by" => $this->session->userdata('m_customer_id'),
				        "m_sale_added_on" => date('Y-m-d H:i')
				    );
				}


				// print_r($insert_data);die();

				// Insert data into the database using insert_batch
			 	$this->db->insert_batch('master_sales_tbl', $insert_data);

			// 	// Clear the cart after inserting data
			 	 $this->cart->destroy();
          
       	$updatedata = array(

	      "m_user_address" => $this->input->post('m_user_address'),
				"m_user_country" => $this->input->post('m_user_country'),
				"m_user_state" => $this->input->post('m_user_state'),
			   "m_user_city" => $this->input->post('m_user_city'),
				"m_user_pincode" => $this->input->post('m_user_pincode'),
				
			 );


	      $updatedata['m_user_updated_on'] = date('Y-m-d h:i:s');
	      $this->db->where('m_user_id',$this->session->userdata('m_customer_id'))->update('master_users_tbl', $updatedata);
 
      
			 	 $email = $this->input->post('user_email');
			 	 $name = $this->input->post('user_name');
			 	 $address = $this->input->post('m_user_address');
	       $subject = "Order has been successfully";
	       // $purchasedate = date('Y-m-d');
	       $msg = "Order has been successfully";
	       $status = 1;
	       $res = $this->sendMail($email, $subject, $msg, $spo, $status,$address,$name);

         // print_r($res);die();
			 	 return $res;
		}




   public function sendMail($email, $subject, $msg, $spo, $status,$address,$name)
  {


    // Load PHPMailer library
    $this->load->library('phpmailer_lib');

    // PHPMailer object
    $mail = $this->phpmailer_lib->load();

    $mail->isSMTP();
       $mail->Host     = 'smtp.hostinger.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'contact@fashionlane.in';
        $mail->Password = 'jdfd@#$5DeTR#';
        $mail->SMTPSecure = 'ssl';
        $mail->Port     = 465;

        $mail->setfrom('contact@fashionlane.in', 'Logixhunt');
        $mail->addReplyTo($email);

    // SMTP configuration
    // $mail->isSMTP(true);
    // $mail->Host     = 'smtp.hostinger.com';
    // $mail->SMTPAuth = true;
    // $mail->Username = 'support@fintrack.co.in';
    // $mail->Password = 'TR@fintrack23';
    // $mail->SMTPSecure = 'ssl';
    // $mail->Port     = 465;

    // $mail->setfrom('support@fintrack.co.in', 'Fintrack');
    // $mail->addreplyto('info@example.com', 'CodexWorld');

    // Add a recipient
    $mail->addAddress($email);

    // Add cc or bcc 
    // $mail->addcc('cc@example.com');
    // $mail->addbcc('bcc@example.com');

    // Email subject
    $mail->Subject = $subject;

    // Set email format to HTML
    $mail->isHTML(true);

    // Email body content

    $data['content'] = $msg;
    $data['orderno'] = $spo;
    $data['pdate'] = date('d-m-Y');
    $data['saddress'] = $address;
    $data['status'] = $status;
    $data['name'] = $name;
    $mailContent = $this->load->view('mail/status-mail', $data, TRUE);
    $mail->Body = $mailContent;

    // Send email
    if (!$mail->send()) {
      // echo 'Message could not be sent.';
      // echo 'Mailer Error: ' . $mail->ErrorInfo;
      // return false;
    } else {
      // echo 'Message has been sent';
      return true;
    }
    }

  

	//---------------------------review  --------------------------------//
   
	
}
?>