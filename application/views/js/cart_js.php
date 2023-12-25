<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script type="text/javascript">
    $(document).ready(function () {
   $(document).on('click', '.add_to_cart', function () {
    var product_id = $(this).data("productid");
    var product_name = $(this).data("productname");
    var product_price = $(this).data("price");
    var quantity = $('#qty' + product_id).val();
    var color = $('#color' + product_id).val(); // Assuming you have input fields for color with id="color{product_id}"
    var size = $('#size' + product_id).val();   // Assuming you have input fields for size with id="size{product_id}"

    var c_g_total = $(".cart_g_total").html();
    var cart_g_total = parseFloat(c_g_total) + parseFloat(product_price * quantity);

    $.ajax({
        url: "<?php echo site_url('Cart/addToCart'); ?>",
        method: "POST",
        data: {
            product_id: product_id,
            product_name: product_name,
            product_price: product_price,
            product_qty: quantity,
            product_color: color,
            product_size: size
        },
        success: function (data) {
            var response = $.parseJSON(data);

            if (response.status === 'success') {
                // Update UI elements
                var c_count = parseInt($(".cart-item-count").html());
                $(".cart-item-count").html(c_count + 1);

                // Update the cart link with the new total
                var cartLink = $(".btn.px-0.ml-3");
                var newTotal = response.cart_total; // Assuming this is the new total from the server
                $(".badge", cartLink).text(newTotal);

                Swal.fire({
                    icon: 'success',
                    title: 'Product Added into Cart',
                    timer: 3000,
                });
                 setTimeout(function() {
                  location.reload();
                }, 1000);
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Something went wrong!',
                });
                 setTimeout(function() {
                  location.reload();
                }, 1000);
            }
        }
    });
});

  

  $(document).on('click', '.remove-from-cart', function () {
        var rowId = $(this).data('rowid');
         // alert('hello');
        // Make an AJAX request to remove the item from the cart
        $.ajax({
            url: "<?php echo site_url('Cart/removeFromCart'); ?>",
            method: "POST",
            data: { rowid: rowId },
            success: function (data) {
                // Handle the success response as needed
                console.log(data);

                // Reload the page or update the cart display
                location.reload();
            }
        });
    });

});

   
</script>