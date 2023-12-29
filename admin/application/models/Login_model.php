<?php date_default_timezone_set('Asia/Kolkata');
class Login_model extends CI_model{
	
	public function validate_user(){
	$pass = $this->input->post('login_pass');

	$this->db->select('m_user_id,m_user_type,m_user_design');

	$this->db->where('m_user_loginid',$this->input->post('login_email'));

	$this->db->where('m_user_password',$pass);
	$this->db->where('m_user_login_allow',1);
	$this->db->where('m_user_status',1);
	$sql=$this->db->get('master_users_tbl');

	

	if($sql->num_rows() == 1){ return $sql->result(); }else{ return false; }

}

		

public function user_details(){

	// $this->db->select('m_admin_id, m_admin_name, m_admin_img');

	$this->db->where('m_user_id',$this->session->userdata('user_id'));

	return $this->db->get('master_users_tbl')->result();

}

		

public function get_user_profile_details(){

	// $this->db->select('m_admin_id, m_admin_name, m_admin_login_id, m_admin_email, m_admin_pass, m_admin_contact, m_admin_img');

	$this->db->where('m_user_id',$this->session->userdata('user_id'));

	return $this->db->get('master_users_tbl')->result();

}

//===========================/Login===========================//

  public function countRow_dashboard()
	{

	
		
		$product = $this->db->get('master_product')->num_rows();
		$pcategory = $this->db->get('master_categories')->num_rows();
		$customer = $this->db->where('m_user_type',3)->get('master_users_tbl')->num_rows();
		$inactive_customer = $this->db->where('m_user_type',3)->where('m_user_status',2)->get('master_users_tbl')->num_rows();
		$enqueries = $this->db->get('master_contact_tbl')->num_rows();
		$order = $this->db->group_by('m_sale_spo')->get('master_sales_tbl')->num_rows();
    $poffer = $this->db->get('product_offers')->num_rows();
     // $totalsales = $this->db->get('product_offers')->num_rows();
		
		$data = array(
			'product' => $product,
			'pcategory' => $pcategory,
			'customer' => $customer,
			'inactive_customer' => $inactive_customer,
			'enqueries' => $enqueries,
			'order' => $order,
			'poffer' => $poffer,
			
		);

		return $data ;
	}



					public function get_all_order() {  
				    // Select specific columns from tables
				    $this->db->select('master_sales_tbl.m_sale_customer,master_sales_tbl.m_sale_spo,master_sales_tbl.m_sale_paydated,master_sales_tbl.m_sale_status,master_sales_tbl.m_sale_pstatus,master_sales_tbl.m_sale_invoiceno,master_sales_tbl.m_sale_added_on as sale_date,master_sales_tbl.m_sale_payamt as paid_amount,added_by.m_user_name as added_by_name,master_sales_tbl.m_sale_date');

				    // Calculate and select the total base total
				    $this->db->select("SUM(master_sales_tbl.m_sale_qty * master_sales_tbl.m_sale_price) AS total_base_total");

				    // Calculate and select the total discount amount
				    $this->db->select("SUM(master_sales_tbl.m_sale_qty * master_sales_tbl.m_sale_price * master_sales_tbl.m_sale_discount / 100) AS total_discount_amount");

				    // Calculate and select the total net amount
				    $this->db->select("SUM(master_sales_tbl.m_sale_qty * master_sales_tbl.m_sale_price - (master_sales_tbl.m_sale_qty * master_sales_tbl.m_sale_price * master_sales_tbl.m_sale_discount / 100)) AS total_net_amount");

				    // Calculate and select the total GST amount
				    $this->db->select("SUM(master_sales_tbl.m_sale_qty * master_sales_tbl.m_sale_price * master_sales_tbl.m_sale_gst / 100) AS total_gst");

				    // Select additional customer information
				    $this->db->select('customer.m_user_name AS customer_name,customer.m_user_id as customer_id,customer.m_user_mobile as customer_mobile');

				    // Specify the main table
				    $this->db->from('master_sales_tbl');

				    // Join the customer table
				    $this->db->join('master_users_tbl customer', 'customer.m_user_id = master_sales_tbl.m_sale_customer', 'left');

				    // Join the added_by user table
				    $this->db->join('master_users_tbl added_by', 'added_by.m_user_id = master_sales_tbl.m_sale_added_by', 'left');

				    // Group the results by sales person and invoice number
				    $this->db->group_by('master_sales_tbl.m_sale_spo');
				    $this->db->group_by('master_sales_tbl.m_sale_invoiceno');

				    // Uncommented code for additional filtering (user, search, date range) is provided but currently disabled

				    // Get the query results
				    $query = $this->db->get();

				    // Return the results
				    return $query->result();
				}



  }