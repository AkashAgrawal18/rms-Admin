<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Checkout extends CI_Controller
{

    public function index()
    {   
        $data = $this->login_details();
        $data['pagename'] = 'checkout';
         $cart_items = $this->cart->contents();

        // Load a view with the cart items data
        $data['cart_items'] = $cart_items;
        $data['paymentModes'] = $this->Main_model->get_paymode();
       // echo "<pre>"; print_r($data['cart_items']);die();
        $this->load->view('checkout',$data);
    }

    public function update_profile()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $data = $this->Login_model->update_profile1();

            if ($data == 1) {
                $info = array(
                    'status' => 'success',
                    'message' => 'User Profile has been Updated successfully!'
                );
            } else {
                $info = array(
                    'status' => 'error',
                    'message' => 'Some problem occurred!! Please try again'
                );
            }

            echo json_encode($info);
        }
    }


     // public function update_profile()
     //    {
     //      if ($_SERVER["REQUEST_METHOD"] == "POST") {
     //        if ($data = $this->Login_model->update_profile1()) {
             
     //          $info = array(
     //            'status' => 'success',
     //            'message' => 'User Profile  has been Updated successfully!'
     //          );
     //        } else {
     //          $info = array(
     //            'status' => 'error',
     //            'message' => 'Some problem Occurred!! please try again'
     //          );
     //        }
     //        echo json_encode($info);
     //      }
     //    }

      public function order_insert()
        {
          if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if ($data = $this->Main_model->order_insert()) {

              $info = array(
                'status' => 'success',
                'message' => 'Order has been Added successfully!'
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
