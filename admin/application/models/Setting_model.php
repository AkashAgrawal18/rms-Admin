<?php date_default_timezone_set('Asia/Kolkata');
class Setting_model extends CI_model {
//============================User============================//

//===========================Profile==========================//
public function update_profile(){
  $update_data = array(
    "m_user_name"    => $this->input->post('m_user_name'),
    
    "m_user_email"   => $this->input->post('m_user_email'),
    "m_user_loginid"=> $this->input->post('m_user_email'),
    "m_user_password"    => $this->input->post('m_user_pass'),
    "m_user_mobile" => $this->input->post('m_user_mobile'),
    "m_user_image"     => $this->input->post('pre_m_admin_img'),

    // "m_admin_address"     => $this->input->post('m_admin_address'),
    // "m_admin_state"     => $this->input->post('m_admin_state'),
    // "m_admin_city"     => $this->input->post('m_admin_city'),
    // "m_admin_pincode"     => $this->input->post('m_admin_pincode'),
  );

    if(!empty($_FILES['m_user_image']['name'])){

       $name1 = $_FILES['m_user_image']['name'];
        $fileNameParts = explode(".", $name1); // explode file name to two part
        $fileExtension = end($fileNameParts); // give extension
        $fileExtension = strtolower($fileExtension);
        $encripted_pic_name = md5(microtime().$name1) . '.' . $fileExtension;
        $config['file_name'] = $encripted_pic_name;  
        $config['upload_path'] = 'uploads/user';
        $config['allowed_types'] = 'jpg|jpeg|png';
        $config['remove_spaces'] = TRUE;
        $config['file_name'] = $_FILES['m_user_image']['name'];
        //Load upload library and initialize configuration
        $this->load->library('upload',$config);
        $this->upload->initialize($config);

        if($this->upload->do_upload('m_user_image')){
          $uploadData = $this->upload->data();
          
          if (!empty($update_data['m_user_image'])) { 
            if(file_exists($config['upload_path'].$update_data['m_user_image'])){
            unlink($config['upload_path'].$update_data['m_user_image']); /* deleting Image */
          } }

          $update_data['m_user_image'] = $uploadData['file_name'];

        }
      }

      $this->db->where('m_user_id', $this->session->userdata('user_id'));
      return $this->db->update('master_users_tbl',$update_data);
    }



public function get_application_settings(){
  $res =$this->db->get('application_settings')->result();
  return $res;
}

public function update_application(){
    

   $data = array(
      "m_app_name" => $this->input->post('m_app_name'),
      // "m_app_title" => $this->input->post('m_app_title'),
      "m_app_email" => $this->input->post('m_app_email'),
      "m_app_mobile" => $this->input->post('m_app_contact'),
      "m_app_alt_mobile" => $this->input->post('m_app_al_contact'),
      "m_app_address" => $this->input->post('m_app_address'),
    
    );
    // print_r($data);
    $this->db->where('m_app_id',1);
    $this->db->update('application_settings', $data);
    return true;
  }
 
  

  public function update_social(){

   $data = array(
      
      "m_app_fb" => $this->input->post('facebook'),
      "m_app_insta" => $this->input->post('instagram'),
      "m_app_youtube" => $this->input->post('youtube'),
      "m_app_linkedin" => $this->input->post('linkedIn'),
      "m_app_twitter" => $this->input->post('twitter'),
      
    );
    // print_r($data);
    $this->db->where('m_app_id',1);
    $this->db->update('application_settings', $data);
    return true;
  }





public function update_logo(){


     // color logo 

    if(!empty($_FILES['m_app_logo']['name'])){

      $name1 = $_FILES['m_app_logo']['name'];
      $fileNameParts = explode(".", $name1); // explode file name to two part
      $fileExtension = end($fileNameParts); // give extension
      $fileExtension = strtolower($fileExtension);
      $encripted_pic_name = md5(microtime().$name1) . '.' . $fileExtension;
      $config['file_name'] = $encripted_pic_name;
      $config['file_name'] = $_FILES['m_app_logo']['name'];
      $config['upload_path'] = 'uploads/logo';
      $config['allowed_types'] = 'jpg|jpeg|png';
      $config['remove_spaces'] = TRUE;
      $config['file_name'] = $_FILES['m_app_logo']['name'];
      //Load upload library and initialize configuration
      $this->load->library('upload',$config);
      $this->upload->initialize($config);
      if($this->upload->do_upload('m_app_logo')){
        $uploadData = $this->upload->data();  
        if (!empty($update_data['m_app_logo'])) { 
          if(file_exists($config['m_app_logo'].$update_data['m_app_logo'])){
          unlink($config['upload_path'].$update_data['m_app_logo']); /* deleting Image */
          } 
        }
        $m_app_logo = $uploadData['file_name'];
      }
    }
    else{
      $m_app_logo =$this->input->post('applogo');
    }


    // icon logo

    if(!empty($_FILES['m_app_icon']['name'])){
      $name1 = $_FILES['m_app_icon']['name'];
      $fileNameParts = explode(".", $name1); // explode file name to two part
      $fileExtension = end($fileNameParts); // give extension
      $fileExtension = strtolower($fileExtension);
      $encripted_pic_name = md5(microtime().$name1) . '.' . $fileExtension;
      $config['file_name'] = $encripted_pic_name;
      $config['file_name'] = $_FILES['m_app_icon']['name'];
      $config['upload_path'] = 'uploads/logo';
      $config['allowed_types'] = 'jpg|jpeg|png';
      $config['remove_spaces'] = TRUE;
      $config['file_name'] = $_FILES['m_app_icon']['name'];
      //Load upload library and initialize configuration
      $this->load->library('upload',$config);
      $this->upload->initialize($config);
      if($this->upload->do_upload('m_app_icon')){
        $uploadData = $this->upload->data();  
        if (!empty($update_data['m_app_icon'])) { 
          if(file_exists($config['m_app_icon'].$update_data['m_app_icon'])){
          unlink($config['upload_path'].$update_data['m_app_icon']); /* deleting Image */
          } 
        }
        $m_app_icon = $uploadData['file_name'];
      }
    }
    else{
      $m_app_icon =$this->input->post('appfavicon');
    }


       // black logo

    if(!empty($_FILES['m_app_black_logo']['name'])){
      $name1 = $_FILES['m_app_black_logo']['name'];
      $fileNameParts = explode(".", $name1); // explode file name to two part
      $fileExtension = end($fileNameParts); // give extension
      $fileExtension = strtolower($fileExtension);
      $encripted_pic_name = md5(microtime().$name1) . '.' . $fileExtension;
      $config['file_name'] = $encripted_pic_name;
      $config['file_name'] = $_FILES['m_app_black_logo']['name'];
      $config['upload_path'] = 'uploads/logo';
      $config['allowed_types'] = 'jpg|jpeg|png';
      $config['remove_spaces'] = TRUE;
      $config['file_name'] = $_FILES['m_app_black_logo']['name'];
      //Load upload library and initialize configuration
      $this->load->library('upload',$config);
      $this->upload->initialize($config);
      if($this->upload->do_upload('m_app_black_logo')){
        $uploadData = $this->upload->data();  
        if (!empty($update_data['m_app_black_logo'])) { 
          if(file_exists($config['m_app_black_logo'].$update_data['m_app_black_logo'])){
          unlink($config['upload_path'].$update_data['m_app_black_logo']); /* deleting Image */
          } 
        }
        $m_app_black_logo = $uploadData['file_name'];
      }
    }
    else{
      $m_app_black_logo =$this->input->post('app_black_logo');
    }


    // white logo

    if(!empty($_FILES['m_app_white_logo']['name'])){
      $name1 = $_FILES['m_app_white_logo']['name'];
      $fileNameParts = explode(".", $name1); // explode file name to two part
      $fileExtension = end($fileNameParts); // give extension
      $fileExtension = strtolower($fileExtension);
      $encripted_pic_name = md5(microtime().$name1) . '.' . $fileExtension;
      $config['file_name'] = $encripted_pic_name;
      $config['file_name'] = $_FILES['m_app_white_logo']['name'];
      $config['upload_path'] = 'uploads/logo';
      $config['allowed_types'] = 'jpg|jpeg|png';
      $config['remove_spaces'] = TRUE;
      $config['file_name'] = $_FILES['m_app_white_logo']['name'];
      //Load upload library and initialize configuration
      $this->load->library('upload',$config);
      $this->upload->initialize($config);
      if($this->upload->do_upload('m_app_white_logo')){
        $uploadData = $this->upload->data();  
        if (!empty($update_data['m_app_white_logo'])) { 
          if(file_exists($config['m_app_white_logo'].$update_data['m_app_white_logo'])){
          unlink($config['upload_path'].$update_data['m_app_white_logo']); /* deleting Image */
          } 
        }
        $m_app_white_logo = $uploadData['file_name'];
      }
    }
    else{
      $m_app_white_logo =$this->input->post('app_white_logo');
    }

   $data = array(
      
      "m_app_logo" => $m_app_logo,
      "m_app_icon" =>$m_app_icon,
      "m_app_black_logo" => $m_app_black_logo,
      "m_app_white_logo" => $m_app_white_logo,
    );
    
    // print_r($data);
    $this->db->where('m_app_id',1);
    $this->db->update('application_settings', $data);
    return true;
  }
//===========================/User============================//
} ?>