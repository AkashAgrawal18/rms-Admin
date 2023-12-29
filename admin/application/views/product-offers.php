<?php include("head.php"); ?>
<?php include("header.php"); ?>

<style>
    .offcanvas-end {
        width: 720px !important;
    }

    .pro-link {
        color: #000 !important;
        font-weight: bold;
    }

    td,
    th {
        vertical-align: middle !important;
    }

    .small {
        font-size: 11px;
    }
</style>

<!-- ========== Page Content ========== -->
<section class="py-1" style="background: #797979;">
    <div class="container-fluid">
        <div class="row align-items-center">

            <div class="col-xl-11 col-lg-10">
                <p class="m-0 text-white small fw-light">
                    <a href="<?php echo base_url('Dashboard'); ?>" class="text-white text-decoration-none ">Dashboard</a> >> <a href="<?php echo base_url('Main/product_offers/'.$typeid); ?>" class="text-decoration-none fw-bold"><span class="text-warning">
                            Product Offers</span></a>
                </p>
            </div>
            <!-- <div class="col-lg-1 text-end">
                <div class="dropdown">
                    <button class="btn btn-primary btn-sm dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fa-solid fa-plus"></i> Add
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                        <li><a class="dropdown-item" href="#">Add xyz</a></li>
                        <li><a class="dropdown-item" href="#">Add xyz</a></li>
                        <li><a class="dropdown-item" href="#">Add xyz</a></li>
                    </ul>
                </div>
            </div> -->
            <div class="col-xl-1 col-lg-2 text-end">
                <button  onclick="history.back()"class="btn btn-dark btn-sm rounded-pill w-100">
                    <i class="bi bi-arrow-bar-left me-1"></i><small>Back</small>
                </button>
            </div>
        </div>
    </div>
</section>

<section >
    <div class="container-fluid bg-light pt-4">
          
         <?php $form_attributes=array('method'=>'post'); ?>
             <?php echo form_open_multipart('Main/offer_add',$form_attributes) ?>


             <input type="hidden" name="o_offer_type" value="<?php echo $typeid ?>">
              <input type="hidden" name="o_offer_slug" value="<?php echo $slugname ?>">
        <div class="row">
            

            <div class="col-md-4">
                <div class="card p-2">
                    <table class="table table-bordered mt-3">
                        <tr>
                        
                            <th>Product Name</th>
                            <th>Remove</th>
                        </tr>
                        <?php

                         $checkarray = array();          
                        if (!empty($product_o_w)) {
                            foreach ($product_o_w as $row) {
                               $checkarray[] = $row->o_product_id; ?>
                        <tr>
                           
                            <td><?php echo $row->m_product_name ?></td>
                            <td>
                                <a href="<?php echo base_url('Main/remove_offer/').$row->offer_id.'/'.$row->o_offer_type?>"  class="btn btn-primary btn-sm unit-delete" data-original-title='Remove Offer' onclick='return show_confirm()'><i class="fa-solid fa-trash"></i></a>
                            </td>
                        </tr>
                         <?php } }?> 
                    </table>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card p-2">
                    <table class="table table-bordered mt-3">
                        <tr>
                            <!-- <th>S.No</th> -->
                            <th>Category</th>
                            <th>Product</th>
                            <th>Offer</th>
                        </tr>
                         <?php
                                    if(!empty($product))
                                    {

                                       foreach ($product  as $row) 
                                       {

                                        if(!in_array($row->m_product_id,  $checkarray))
                                        {
                                      
                                    echo "<tr>
                                   
                                        <td>$row->m_category_name</td>
                                      
                                        <td>$row->m_product_name</td>
                                       
                                         <td>
                                         <input type='checkbox' class='form-check-input' name='offers[]' value='".$row->m_product_id."'>
                                         
                                          </td>
                                       
                                      
                                         </tr>";
                                       }
                                     }
                                      }
                                     ?>
                       <!--  <tr>
                            <td>1</td>
                            <td>xyz</td>
                            <td>abc</td>
                            <td>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                                </div>
                            </td>
                        </tr> -->
                    </table>
                </div>
            </div>

           
        </div>
        <div class="text-end mt-2" >
          <button onclick="history.back()"class="btn btn-warning">Cancel</button>
        <?php echo form_submit(array('name'=>'submit', 'value'=>'Add Here', 'class'=>'btn btn-info pull-right')) ?>
    </div>
    </div>
</section>




<!-- ========== Page Content ========== -->
<?php include("footer.php"); ?>