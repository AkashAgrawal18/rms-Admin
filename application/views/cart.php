<?php include("head.php"); ?>
<?php include("header.php"); ?>

<style>
    .sm {
        font-size: 14px !important;
        font-weight: bold;
    }

    /*.color {
        height: 20px;
        width: 40px;
        background-color: red;
    }*/
    .form-control {
        padding: 0.375rem 0.5rem !important;
        font-size: 0.8rem !important;
        background-color: #f1f1f1 !important;
        border-radius: 5px !important;
        color: #000 !important;
    }
    .btn-sm{
        padding: 0.15rem 0.5rem !important;
    }
</style>

<!-- Breadcrumb Start -->
<div class="container-fluid">
    <div class="row px-xl-5">
        <div class="col-12">
            <nav class="breadcrumb bg-light mb-30">
                <a class="breadcrumb-item text-dark" href="#">Home</a>
                <a class="breadcrumb-item text-dark" href="#">Shop</a>
                <span class="breadcrumb-item active">Shopping Cart</span>
            </nav>
        </div>
    </div>
</div>
<!-- Breadcrumb End -->


<!-- Cart Start -->
<div class="container-fluid">
    <div class="row px-xl-5">
        <div class="col-lg-8 table-responsive mb-5">
            <table class="table table-light table-borderless table-hover text-center mb-0">
                <thead class="thead-dark">
                    <tr>
                        <th>Image</th>
                        <th>Products</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                        <th>Remove</th>
                    </tr>
                </thead>

                <tbody class="align-middle">
                    <?php foreach ($cart_items as $item) :

                        $product_detail = $this->Main_model->getproduct_details($item['id']);
                        
                        $color_id = $item['options']['color'];
                        $size_id = $item['options']['size'];
                        
                        $color_name = $this->Main_model->get_color_name($color_id)->m_color_name;

                        if (!empty($product_detail[0]->m_product_image[0]->m_image_product_img)) {
                            $product_img = base_url('admin/uploads/product/' . $product_detail[0]->m_product_image[0]->m_image_product_img);
                        } else {
                            $product_img = base_url('admin/uploads/default.jpg');
                        }
                        // Your existing PHP code for each item

                        // Use data attributes to store necessary information for each item
                        $data_attributes = 'data-rowid="' . $item['rowid'] . '" data-product-price="' . $item['price'] . '"';

                        // echo'<pre>'; print_r($allproduct);die();
                    ?>
                        <tr>
                            <td class="align-middle">
                                <input type="hidden" id='pgst' value="<?php echo $product_detail[0]->m_tax_value; ?>">
                                <img src="<?php echo $product_img; ?>" alt="" style="width: 50px;">
                            </td>
                            <td class="align-middle">
                            <?php echo $item['name']; ?> <br>
                            <div class="container">
                                <div class="row">
                                    <div class="col-4">
                                        <p class="sm"><?php echo $product_detail[0]->m_fabric_name; ?> </p>
                                    </div>
                                    <div class="col-4 w-100">
                                        <!-- Select for Size -->
                                        <select class="form-select form-control" aria-label="Size" id="selectSize<?php echo $item['rowid']; ?><?php echo $item['id']; ?>" onchange="updateCart('<?php echo $item['rowid']; ?>', '<?php echo $item['id']; ?>')">
                                            <option selected>Select Size</option>
                                            <?php foreach ($product_detail[0]->m_product_size as $size): ?>
                                                <option value="<?php echo $size->m_size_id; ?>" <?php if($size->m_size_id == $size_id) echo 'selected'; ?>><?php echo $size->m_size_name; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="col-4">
                                        <!-- Select for Color -->
                                        <select class="form-select form-control" aria-label="Color" id="selectColor<?php echo $item['rowid']; ?><?php echo $item['id']; ?>" style="background-color: <?php echo $color_name; ?>!important;color:#838383 !important;" onchange="updateCart('<?php echo $item['rowid']; ?>', '<?php echo $item['id']; ?>')">
                                            <option selected>Select Color</option>
                                            <?php foreach ($product_detail[0]->m_product_color as $color): ?>
                                                <option value="<?php echo $color->m_color_id; ?>" <?php if($color->m_color_id ==$color_id) echo 'selected'; ?> style="background-color: <?php echo $color->m_color_name; ?>; color: <?php echo $color->m_color_name; ?>;"><?php echo $color->m_color_name; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </td>

                            <td class="align-middle">₹<?php echo $item['price']; ?></td>
                            <td class="align-middle">
                                <div class="input-group quantity mx-auto" style="width: 100px;">
                                    <div class="input-group-btn">
                                        <button class="btn btn-sm btn-primary btn-minus" <?php echo $data_attributes; ?>>
                                            <i class="fa fa-minus"></i>
                                        </button>
                                    </div>
                                    <input type="text" class="form-control form-control-sm bg-secondary border-0 text-center quantity-input" value="<?php echo $item['qty']; ?>" <?php echo $data_attributes; ?>>
                                    <div class="input-group-btn">
                                        <button class="btn btn-sm btn-primary btn-plus" <?php echo $data_attributes; ?>>
                                            <i class="fa fa-plus"></i>
                                        </button>
                                    </div>
                                </div>
                            </td>
                            <td id="subtotal-<?php echo $item['rowid']; ?>" class="align-middle subtotal">₹<?php echo $item['subtotal']; ?></td>


                            <td class="align-middle">
                                <button class="btn btn-sm btn-danger remove-from-cart" data-rowid="<?php echo $item['rowid']; ?>">
                                    <i class="fa fa-times"></i>
                                </button>
                            </td>


                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
       
        <div class="col-lg-4">
            <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Cart Summary</span></h5>
            <div class="bg-light p-30 mb-5">
                <div class="border-bottom pb-2">
                    <div class="d-flex justify-content-between">
                        <h6 id="dynamic-subtotal">Subtotal</h6>
                        <h6 id="subtotal">₹0.00</h6>
                    </div>
                    <div class="d-flex justify-content-between">
                        <h6 class="font-weight-medium">Shipping</h6>
                        <h6 id="shipping">₹0.00</h6>
                    </div>
                    <div class="d-flex justify-content-between">
                        <h6 class="font-weight-medium">GST</h6>
                        <h6 id="gst">₹0.00</h6>
                    </div>

              
                </div>
                <div class="pt-2">
                    <div class="d-flex justify-content-between ">
                        <h5>Total</h5>
                        <h5 id="total">₹0.00</h5>
                    </div>
                    <a href="<?php echo base_url('Checkout') ?>"><button class="btn btn-block btn-primary font-weight-bold my-3 py-3">Proceed To Checkout</button></a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Cart End -->




<?php include("footer.php"); ?>
<?php include("script.php"); ?>
<?php $this->view('js/cart_js'); ?>
<script>
    $(document).ready(function() {
        // Handle click events for plus and minus buttons
        $('.btn-plus').on('click','.btn-minus', function() {
            // Get necessary data attributes
            var rowId = $(this).data('rowid');
            var productPrice = parseFloat($(this).data('product-price')); // Parse as float for accurate calculations

            // Find the input element for the corresponding row
            var quantityInput = $('.quantity-input[data-rowid="' + rowId + '"]');

            // Get the current quantity value
            var currentQuantity = parseInt(quantityInput.val());

            // Update quantity based on the button clicked
            if ($(this).hasClass('btn-plus')) {
                currentQuantity++;
            } else if ($(this).hasClass('btn-minus') && currentQuantity > 1) {
                currentQuantity--;
            }

            // Update the input field with the new quantity
            quantityInput.val(currentQuantity);

            // Calculate and update the subtotal
            var newSubtotal = productPrice * currentQuantity;
            $('#subtotal-' + rowId).text('₹' + newSubtotal);

            // Update the total
            updateCartSummary();

            updateCartOnServer(rowId, currentQuantity);
        });


        function updateCartSummary() {
            var subtotal = 0;
            $('.subtotal').each(function() {
                subtotal += parseFloat($(this).text().replace('₹', ''));
            });

            var shipping = 0; // Replace with your shipping cost

            // Assuming the GST percentage is stored in a hidden input with id 'pgst'
            var gstPercentage = parseFloat($('#pgst').val());
            var gst = (gstPercentage / 100) * subtotal;

            // Update the HTML elements with new values
            $('#dynamic-subtotal').text('Subtotal');
            $('#subtotal').text('₹' + subtotal.toFixed(2));
            $('#shipping').text('₹' + shipping.toFixed(2));
            $('#gst').text('₹' + gst.toFixed(2));

            // Assuming the Coupon value is stored in a hidden input with id 'coupon'
            // var couponValue = parseFloat($('#coupon').val());
            // var couponValue = 0;
            // $('#coupon').text('₹' + couponValue.toFixed(2));
            // var total = subtotal + shipping + gst - couponValue;
            // Calculate the total
            var total = subtotal + shipping + gst;
            $('#total').text('₹' + total.toFixed(2));
        }

        // Call the updateCartSummary function whenever the quantity changes
        $('.quantity-input').on('change', function() {
            updateCartSummary();
        });

        // Call the updateCartSummary function on page load
        updateCartSummary();


        // Function to update the total
        // function updateTotal() {
        //     var subtotal = 0;
        //     $('.subtotal').each(function () {
        //         subtotal += parseFloat($(this).text().replace('₹', ''));
        //     });

        //     // Assuming Shipping, GST, and other calculations
        //     var shipping = 0; // Replace with your shipping cost
        //     var gstPercentage = ; // Replace with your GST percentage

        //     var gst = (gstPercentage / 100) * subtotal;
        //     var total = subtotal + shipping + gst;

        //     // Update the HTML elements with new values
        //     $('#subtotal').text('₹' + subtotal.toFixed(2));
        //     $('#shipping').text('₹' + shipping.toFixed(2));
        //     $('#gst').text('₹' + gst.toFixed(2));
        //     $('#total').text('₹' + total.toFixed(2));
        // }

        function updateCartOnServer(rowId, newQuantity) {
        // Make an AJAX request to update the cart on the server
        $.ajax({
            url: '<?php echo base_Url('Cart/update_cart')?>', // Replace with the actual URL for updating the cart
            method: 'POST',
            data: {
                rowId: rowId,
                newQuantity: newQuantity
            },
            success: function (response) {
                // Handle the server response if needed
                console.log(response);
            },
            error: function (error) {
                // Handle errors if the request fails
                console.error('Error updating cart:', error);
            }
        });
    }
    });


    function updateCart(rowId,cartItemId) {
          // alert(rowId);
        // Get selected size and color values
        var selectedSize = document.getElementById("selectSize<?php echo $item['rowid']; ?><?php echo $item['id']; ?>").value;
        var selectedColor = document.getElementById("selectColor<?php echo $item['rowid']; ?><?php echo $item['id']; ?>").value;
         

        $.ajax({
            type: "POST",
            url: "<?php echo base_url('Cart/update_colorsize'); ?>",
            data: {
                rowId: rowId,
                cartItemId: cartItemId,
                selectedSize: selectedSize,
                selectedColor: selectedColor
            },
            success: function(response) {

                console.log("Success:", response);
                location.reload();
            },
            error: function(error) {
                console.log("Error:", error);
            }
        });
        
    }

</script>

