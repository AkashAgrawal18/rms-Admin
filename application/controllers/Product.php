
<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Product extends CI_Controller
{

      public function index($offset = 0) {
        $this->load->library('pagination');
       
        // Pagination configuration
        $config['base_url'] = site_url('Product/index');
        $config['total_rows'] = $this->Main_model->count_all_data();
        $config['per_page'] = 12; // Adjust as needed
        $config['uri_segment'] = 0;
           
        $this->pagination->initialize($config);
        
        $data['cat'] ="";
        $data['offer'] ="";
        $data['search'] ="";
        $data['fabric'] = $this->input->post('fabric');
        $data['color'] = $this->input->post('color');
        $data['size'] = $this->input->post('size');
        $data['size'] =$data['size'];
        $data['fabric'] = $data['fabric'];
        $data['color'] = $data['color'];
        $data['search'] = $this->input->post('search');
        $data['cat'] = $this->input->get('cat');
        $cname = $this->Main_model->catname($data['cat']);


        
        $data['offer'] = $this->input->get('offer');
        if(!empty($data['offer'])){
           $data['pagename'] = 'Offer Products';
        }else{
             $data['pagename'] = $cname[0]->m_category_name;
        }
        $data['all_category'] = $this->Main_model->getcategory();
        $data['all_color'] = $this->Main_model->getcolor();
        $data['all_size'] = $this->Main_model->getsize();
        $data['all_fabric'] = $this->Main_model->getfabric();
		    $data['all_product'] = $this->Main_model->getproduct($config['per_page'], $offset,$data['cat'],$data['offer'],$data['search'],$data['size'], $data['color'], $data['fabric']);
		 // echo "<pre>";print_r($data['all_product']);die();
		$this->load->view('product',$data);

    }


	// public function index()
	// {   
	// 	$data['pagename'] = 'Product';
	// 	$data['all_product'] = $this->Main_model->getproduct();
	// 	// echo "<pre>";print_r($data['all_product']);die();
	// 	$this->load->view('product',$data);
	// }

	public function product_details()
	{
		// $data['pagename'] = 'Product Details';
		$data['id'] = $this->uri->segment(3);
    $pname = $this->Main_model->productname($data['id']);
    $data['pagename'] = $pname[0]->m_product_name;
		$data['cat_slug'] = $this->uri->segment(4);
	  $data['all_category'] = $this->Main_model->getcategory();
		$data['product_details'] = $this->Main_model->getproduct_details($data['id']);
		$data['releted_product'] = $this->Main_model->getreleted_product($data['id'],$data['cat_slug']);
    $data['average_rating'] = $this->Main_model->getAverageRating($data['id']);

		$data['all_review'] = $this->Main_model->get_all_review($data['id']);
    $data['pfeatured'] = $this->Main_model->getpfeatured_details();
           // echo "<pre>";print_r($data['product_details']); die();
		$this->load->view('product_details',$data);

	}

 public function review_add()
        {
          if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if ($data = $this->Main_model->review_add()) {

               if($data== 1){
                    $info = array(
                    'status' => 'success',
                    'message' => 'Review has been Added successfully!'
                  );
                }else{
                  $info = array(
                    'status' => 'error',
                    'message' => 'Review has been Already exit!'
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

}
