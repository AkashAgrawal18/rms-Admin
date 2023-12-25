<?php

class Main_model extends CI_model
{
	public function getcategory()
	{
		$this->db->select('*');
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

	public function productname($id)
	{
		$this->db->select('m_product_name');
		$this->db->where('m_product_id',$id);
		$res =$this->db->get('master_product')->result();
		return $res;

	}


	public function getcolor()
	{
		$this->db->select('*');
		$this->db->where('m_color_status',1);
		$res =$this->db->get('master_color_tbl')->result();
		return $res;

	}
	public function getsize()
	{
		$this->db->select('*');
		$this->db->where('m_size_status',1);
		$res =$this->db->get('master_size_tbl')->result();
		return $res;

	}
	public function getfabric()
	{
		$this->db->select('*');
		$this->db->where('m_fabric_status',1);
		$res =$this->db->get('master_fabric_tbl')->result();
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

	

	 public function getproduct_featured()
     {
       $this->db->select('*');
       $this->db->where('m_offer_status',1);
        $this->db->where('m_offer_id',1);
        $this->db->limit(4);
       $this->db->join('master_product', 'master_product.m_product_id = product_offers.o_product_id', 'left');
        $this->db->join('master_categories', 'master_categories.m_category_id = master_product.m_product_cat_id', 'left');
       
       $this->db->join('master_offers', 'master_offers.m_offer_id = product_offers.o_offer_type', 'left');
       $res = $this->db->get('product_offers')->result();
       return $res;
     }

	public function getproduct_recent()
	{
	   $this->db->select('*');
       $this->db->where('m_offer_status',1);
        $this->db->where('m_offer_id',4);
        $this->db->limit(4);
       $this->db->join('master_product', 'master_product.m_product_id = product_offers.o_product_id', 'left');
        $this->db->join('master_categories', 'master_categories.m_category_id = master_product.m_product_cat_id', 'left');
       
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
       
       $this->db->join('master_offers', 'master_offers.m_offer_id = product_offers.o_offer_type', 'left');
       $res = $this->db->get('product_offers')->result();
       return $res;

	}

	public function getproduct_details($id)
	{
		$this->db->select('*');
		$this->db->where('m_product_status',1);
        $this->db->where('m_product_id',$id);
        $this->db->join('master_categories', 'master_categories.m_category_id = master_product.m_product_cat_id', 'left');

		$res =$this->db->get('master_product')->result();
		return $res;

	}

	public function getreleted_product($id,$cat_slug)
	{
		$this->db->select('*');
		// $this->db->where('m_product_id',1);
        $this->db->where('m_product_status',1);
        $this->db->where('m_product_id !=',$id);
        $this->db->where('m_category_slug',$cat_slug);
        $this->db->join('master_categories', 'master_categories.m_category_id = master_product.m_product_cat_id', 'left');
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

  public function order_datails($orderid)
	{ 
		 $this->db->select('*');
		 $this->db->where('m_sale_spo', $orderid);
		 $this->db->join('master_users_tbl customer', 'customer.m_user_id = master_sales_tbl.m_sale_customer', 'left')->join('master_product product' , 'product.m_product_id = master_sales_tbl.m_sale_product', 'left')->join('master_image_tbl', 'master_image_tbl.m_image_product_id = product.m_product_id', 'left');
		$res = $this->db->get('master_sales_tbl')->result();

		return $res;
	}

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


	//---------------------------review  --------------------------------//
   
	
}
?>