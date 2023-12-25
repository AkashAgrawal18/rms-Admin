<!DOCTYPE html>
<html lang="en">

<head>
     <meta name="viewport" content="user-scalable=no, initial-scale=1, maximum-scale=1, minimum-scale=1, width=device-width, height=device-height, target-densitydpi=device-dpi" />
    <meta name="HandheldFriendly" content="true">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="format-detection" content="telephone-no">
    <meta name="geo.region" content="IN" />

     <?php $hp_name = get_settings('m_app_name'); ?>

 

  <meta name="description" content="<?php echo $hp_name; ?>" />

  <meta name="keywords" content="<?php echo $hp_name; ?>" />

  <meta name="author" content="<?php echo $hp_name; ?>">

  <title><?php echo (!empty($pagename)) ? $hp_name . " | " . $pagename : $hp_name; ?></title>

  <?php

  $img_title = get_settings('m_app_icon');

  if (!empty($img_title)) {

    if (file_exists('admin/uploads/logo/' . $img_title)) {

      $fav_img = base_url('admin/uploads/logo/') . $img_title;
    } else {

      $fav_img  = base_url('assets/img/favicon.ico');
    }
  } else {

    $fav_img  = base_url('assets/img/favicon.ico');
  }

  ?>
    <!-- <title>Fashion Lane</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">
 -->
    <!-- Favicon -->
    <link href="<?php echo $fav_img ?>" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">  

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="<?php echo base_url() ?>assets/lib/animate/animate.min.css" rel="stylesheet">
    <link href="<?php echo base_url() ?>assets/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="<?php echo base_url() ?>assets/css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- <link href="<?php echo base_url() ?>assets/css/bootstrap-grid.css" rel="stylesheet"> -->