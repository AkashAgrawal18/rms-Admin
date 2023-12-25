<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Wishlist extends CI_Controller
{

    public function index()
    {   
        $data = $this->login_details();
        $data['pagename'] = 'Wishlist';
        $data['all_value'] = $this->Main_model->get_wishlist();
        // echo "<pre>";print_r($data['all_value']);die();
        $this->load->view('wishlist',$data);
    }


     public function insert_wish_list(){
        if($data = $this->Main_model->insert_wish_list()){
          $info = array( 'status'=>'success',
            'message'=>'Wishlist added successfully!'
          );
          }
          else{ $info = array( 'status'=>'fail',
              'message'=>'Some problem Occurred!! please try again'
            );
          } echo json_encode($info);
    }

   public function delete_wishlist()
        {
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                if ($data = $this->Main_model->delete_wishlist()) {

                    $info = array(
                        'status' => 'success',
                        'message' => 'Wishlist has been Deleted successfully!'
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

    
    //==========================Details===========================//
      protected function login_details(){ 
         $this->require_login();
         $data['log_customer_dtl'] = $this->Login_model->customer_details();
         return $data;
      }
    //=========================/Details===========================//
    //======================Login Validation======================//

      protected function require_login(){

        $is_customer_in = $this->session->userdata('is_customer_in');

        if(isset($is_customer_in) || $is_customer_in == true){ return;

        } else { redirect('Register'); }

      }



      protected function ajax_login(){

        $is_customer_in = $this->session->userdata('is_customer_in');

        if(isset($is_customer_in) || $is_customer_in == true){ return true;

        } else { echo json_encode(array( 'status'=>'error', 'message'=>'You are not Logged in Now!! Please login again.')); return false; 

        }

      }

     //======================/Login Validation======================//
}
