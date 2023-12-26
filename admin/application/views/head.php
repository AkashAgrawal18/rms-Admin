<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    
    <?php $hp_name = get_settings('m_app_name'); ?>

    <title><?php echo (!empty($pagename)) ? $hp_name . " | " . $pagename : $hp_name; ?></title>

     <meta name="description" content="<?php echo $hp_name; ?>" />

    <meta name="keywords" content="<?php echo $hp_name; ?>" />

    <meta name="author" content="<?php echo $hp_name; ?>">


    <?php

        $img_title = get_settings('m_app_icon');

        if (!empty($img_title)) {
          if (file_exists('uploads/logo/'.$img_title)) {
            $fvg_img = base_url('uploads/logo/').$img_title;
          } else {
            $fvg_img  = base_url('assets/imgs/logo2.png');
          }
        } else {
          $fvg_img  = base_url('assets/imgs/logo2.png');
        }
        ?>


    <!-- <title>Billing Software:<?php echo $pagename;  ?></title> -->
    <!--bootstrap-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous" />

    <!-- favicon -->
    <link rel="icon" href="<?php echo $fvg_img;?>" />

    <!-- icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <!-- fontawesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/fontawesome.min.css" integrity="sha512-siarrzI1u3pCqFG2LEzi87McrBmq6Tp7juVsdmGY1Dr8Saw+ZBAzDzrGwX3vgxX1NkioYNCFOVC0GpDPss10zQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- owl -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.css" integrity="sha512-UTNP5BXLIptsaj5WdKFrkFov94lDx+eBvbKyoe1YAfjeRPC+gT5kyZ10kOHCfNZqEui1sxmqvodNUx3KbuYI/A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.css" integrity="sha512-OTcub78R3msOCtY3Tc6FzeDJ8N9qvQn1Ph49ou13xgA9VsH9+LRxoFU6EqLhW4+PKRfU+/HReXmSZXHEkpYoOA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!--custom css-->
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/style.css" />
    

<style>
   .fade-scale {
        transform: scale(0);
        opacity: 0;
        -webkit-transition: all .25s linear;
        -o-transition: all .25s linear;
        transition: all .25s linear;
    }

    .fade-scale.show {
        opacity: 1;
        transform: scale(1);
    }
</style>
    
</head>

<body>