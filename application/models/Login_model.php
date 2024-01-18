<?php

class Login_model extends CI_model
{  


   public function validate_user()
    {
	     $pass = $this->input->post('login_pass');
			$this->db->select('m_acc_id,m_acc_type,m_acc_name,m_acc_mobile');
			// $this->db->where('m_register_name', $this->input->post('m_register_name'));
			$this->db->where('m_acc_mobile',$this->input->post('login_mobile'));
			$this->db->where('m_acc_password',$pass);
			$this->db->where('m_acc_status', 1);
			$this->db->where('m_acc_type', 3);
			$sql = $this->db->get('master_accounts_tbl');
          // print_r($sql); die();
			if ($sql->num_rows()!== 0) {
				 return $sql->row();

              // print_r($sql->row()); die();
			} else {
				return false;
			}

     }

    // coustomer add validation
	public function insert_user()
      {
         $data = array(

            "m_acc_name" => $this->input->post('name'),
            "m_acc_mobile" => $this->input->post('mobile'),
            "m_acc_email" => $this->input->post('email'),
            "m_acc_password" => $this->input->post('password'),
            "m_acc_loginid" => $this->input->post('email'),
            "m_acc_type" => 3,
            "m_acc_status" => 1,
            "m_acc_added_on" =>date('Y-m-d H:i'),
            
          );
           

         $this->db->insert('master_accounts_tbl',$data);


         $email = $this->input->post('email');
         $subject = "Register has been Added successfully";
           
         $msg = "Order has been successfully";
         $res = $this->sendMail($email, $subject, $msg);
         return $res;
      }


      public function update_profile()
      {

               if(!empty($_FILES['m_acc_image']['name'])){
               $config['file_name'] = $_FILES['m_acc_image']['name'];
               $config['upload_path'] = 'admin/uploads/user';
               $config['allowed_types'] = 'jpg|jpeg|png';
               $config['remove_spaces'] = TRUE;
               $config['file_name'] = $_FILES['m_acc_image']['name'];
               //Load upload library and initialize configuration
               $this->load->library('upload',$config);
               $this->upload->initialize($config);
               if($this->upload->do_upload('m_acc_image')){
                 $uploadData = $this->upload->data();  
                 if (!empty($update_data['m_acc_image'])) { 
                   if(file_exists($config['m_acc_image'].$update_data['m_acc_image'])){
                   unlink($config['upload_path'].$update_data['m_acc_image']); /* deleting Image */
                   } 
                 }
                 $m_acc_image = $uploadData['file_name'];
               }
             }
             else{
               $m_acc_image = $this->input->post('pre_m_admin_img');
             }
          $data = array(

             "m_acc_name" => $this->input->post('m_acc_name'),
             "m_acc_email" => $this->input->post('m_acc_email'),
             "m_acc_address" => $this->input->post('m_acc_addess'),
             "m_acc_image" => $m_acc_image,
             "m_acc_type" => 3,
             "m_acc_status" => 1,
            "m_acc_updated_on" =>date('Y-m-d H:i'),
            
          );
           

         return  $this->db->where('m_acc_id',$this->input->post('m_acc_id'))->update('master_accounts_tbl',$data);
      }

       public function update_profile1()
      {

              
          $data = array(

             "m_acc_name" => $this->input->post('m_acc_name'),
             "m_acc_email" => $this->input->post('m_acc_email'),
              "m_acc_mobile" => $this->input->post('m_acc_mobile'),
             "m_acc_type" => 3,
             "m_acc_status" => 1,
            "m_acc_updated_on" =>date('Y-m-d H:i'),
            
          );
           

         return  $this->db->where('m_acc_id',$this->input->post('m_acc_id'))->update('master_accounts_tbl',$data);
      }


     public function getmobileById($mobile_id)  
    {

     //print_r($id);die();
       $user_mobile = $this->db->select('m_acc_mobile,m_acc_id,m_acc_type')
       ->where('m_acc_mobile',$mobile_id)->where('m_acc_type',3)->get('master_accounts_tbl')->result();

          // print_r($user_mobile); die(); 
         return $user_mobile;
    }

     public function getemailById($email_id)  
    {

     //print_r($id);die();
       $user_email = $this->db->select('m_acc_email,m_acc_id,m_acc_type')
       ->where('m_acc_email',$email_id)->where('m_acc_type',3)->get('master_accounts_tbl')->result();
           
        return $user_email;
    }

    public function customer_details(){

	// $this->db->select('m_admin_id, m_admin_name, m_admin_img');

	$this->db->where('m_acc_id',$this->session->userdata('m_customer_id'));

	return $this->db->get('master_accounts_tbl')->result();

}



    public function forgot_pass()
         {

           $cust_id = $this->input->post('login_mobile');
           $cust_pass = $this->input->post('login_pass');
           $query = $this->db->select('*')->where('m_acc_mobile',$cust_id)->get('master_accounts_tbl')->row();
           $uname = $query->m_acc_mobile;

           // print_r($uname); 

           if($cust_id == $uname){

            $s_data  = array(

                        //'m_acc_loginid' => $user_id,
                        'm_acc_password' => $cust_pass,
                      );

              $this->db->where('m_acc_mobile',$cust_id)->update('master_accounts_tbl',$s_data);
            return 1;

           }else{

            return 2;
           }

         }

      public function get_fmobile($mobile_id)  
      {

      //print_r($id);die();
       $user_mobile = $this->db->select('m_acc_mobile,m_acc_id,m_acc_type')
       ->where('m_acc_mobile',$mobile_id)->where('m_acc_type',3)->get('master_accounts_tbl')->num_rows();
           // print_r($user_mobile); die();
           
        return $user_mobile;
      }


    public function sendMail($email, $subject, $msg)
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
    $mailContent = $this->load->view('mail/welcome-mail', $data, TRUE);
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

  


	
}
?>