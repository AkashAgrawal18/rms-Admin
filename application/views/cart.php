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

                        $productgst =  $this->db->select('*')->where('m_product_id', $item['id'])->join('master_taxgst', 'master_taxgst.m_taxgst_id =master_product.m_product_taxgst', 'left')->join('master_fabric_tbl', 'master_fabric_tbl.m_fabric_id =master_product.m_product_fabric', 'left')->get('master_product')->result();

                        $image =  $this->db->where('m_image_product_id', $item['id'])->where('m_image_status', 1)->get('master_image_tbl')->result();

                        if (!empty($image[0]->m_image_product_img)) {
                            $product_img = base_url('admin/uploads/product/' . $image[0]->m_image_product_img);
                        } else {
                            $product_img = base_url('admin/uploads/default.jpg');
                        }
                        // Your existing PHP code for each item

                        // Use data attributes to store necessary information for each item
                        $data_attributes = 'data-rowid="' . $item['rowid'] . '" data-product-price="' . $item['price'] . '"';
                    ?>
                        <tr>
                            <td class="align-middle">
                                <input type="hidden" id='pgst' value="<?php echo $productgst[0]->m_tax_value; ?>">
                                <img src="<?php echo $product_img; ?>" alt="" style="width: 50px;">
                            </td>
                            <td class="align-middle">
                                <?php echo $item['name']; ?> <br>
                                <div class="row">
                                    <div class="col-3">
                                    <!-- <p class="sm">Qty : 1</p> -->
                                    </div>
                                    <div class="col-3">
                                        <p class="sm"><?php echo $productgst[0]->m_fabric_name ?> </p> 
                                    </div>
                                    <div class="col-3">
                                        <p class="sm"> Size - S </p> 
                                    </div>
                                    <div class="col-3">
                                        <p style="height: 20px;width: 20px;background-color: red;"></p>
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
        <!-- <div class="col-lg-4">

            <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Cart Summary</span></h5>
            <div class="bg-light p-30 mb-5">
                <div class="border-bottom pb-2">
                    <div class="d-flex justify-content-between">
                        <h6>Subtotal</h6>
                        <h6>₹1000</h6>
                    </div>
                    <div class="d-flex justify-content-between">
                        <h6 class="font-weight-medium">Shipping</h6>
                        <h6 class="font-weight-medium">₹10</h6>
                    </div>
                    <div class="d-flex justify-content-between">
                        <h6 class="font-weight-medium">GST</h6>
                        <h6 class="font-weight-medium">₹10</h6>
                    </div>

                    <form class="py-2" action="">
                        <div class="input-group">
                            <input type="text" class="form-control border-1" placeholder="Coupon Code">
                            <div class="input-group-append">
                                <button class="btn btn-primary">Apply Coupon</button>
                            </div>
                        </div>
                    </form>
                    <div class="d-flex justify-content-between">
                        <h6 class="font-weight-medium">Coupon</h6>
                        <h6 class="font-weight-medium">₹10</h6>
                    </div>
                </div>
                <div class="pt-2">
                    <div class="d-flex justify-content-between ">
                        <h5>Total</h5>
                        <h5>₹1030</h5>
                    </div>
                    <a href="<?php echo base_url('Checkout') ?>"><button class="btn btn-block btn-primary font-weight-bold my-3 py-3">Proceed To Checkout</button></a>
                </div>
            </div>
        </div> -->
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

                    <form class="py-2" action="">
                        <div class="input-group">
                            <input type="text" class="form-control border-1" placeholder="Coupon Code">
                            <div class="input-group-append">
                                <button class="btn btn-primary">Apply Coupon</button>
                            </div>
                        </div>
                    </form>
                    <div class="d-flex justify-content-between">
                        <h6 class="font-weight-medium">Coupon</h6>
                        <h6 id="coupon">₹0.00</h6>
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
        $('.btn-plus, .btn-minus').on('click', function() {
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
            var couponValue = 0;
            $('#coupon').text('₹' + couponValue.toFixed(2));

            // Calculate the total
            var total = subtotal + shipping + gst - couponValue;
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
    });
</script>