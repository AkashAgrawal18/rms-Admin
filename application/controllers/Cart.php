<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Cart extends CI_Controller
{

    public function index()
    {  
        $data['pagename'] = 'Shopping Cart';
        $cart_items = $this->cart->contents();

        // Load a view with the cart items data
        $data['cart_items'] = $cart_items;
           // echo '<pre>'; print_r($cart_items);die();
        
        // $data['all_size'] = $this->Main_model->getsize();
        $this->load->view('cart',$data);
    }
  
   public function addToCart() {
        $product_id = $this->input->post('product_id');
        $product_name = $this->input->post('product_name');
        $product_price = $this->input->post('product_price');
        $product_qty = $this->input->post('product_qty');
        $product_color = $this->input->post('product_color') ?? ''; // Default to empty string if not provided
        $product_size = $this->input->post('product_size') ?? '';   // Default to empty string if not provided

        // Prepare data for the cart
        $data = array(
            'id'      => $product_id,
            'qty'     => $product_qty,
            'price'   => $product_price,
            'name'    => $product_name,
            'options' => array(
                'color' => $product_color,
                'size'  => $product_size,
                // Add more options as needed
            ),
        );

        // print_r($data);die();

        // Add the item to the cart
        $this->cart->insert($data);

        // You can send a response back to the view if needed
        $response = array(
            'status'  => 'success',
            'message' => 'Product added to cart successfully',
            // You can include more data in the response if needed
        );

        echo json_encode($response);
    }

    public function removeFromCart() {
    $rowid = $this->input->post('rowid');

    // Remove the item from the cart
    $data = array(
        'rowid' => $rowid,
        'qty'   => 0, // Set quantity to 0 to remove the item
    );

    $this->cart->update($data);

    // You can send a response back to the view if needed
    $response = array(
        'status'  => 'success',
        'message' => 'Item removed from cart',
        // You can include more data in the response if needed
    );

    echo json_encode($response);
} 

public function update_cart() {
    $rowid = $this->input->post('rowId');
    $newQuantity = $this->input->post('newQuantity');
    // Remove the item from the cart
    $data = array(
        'rowid' => $rowid,
        'qty'   => $newQuantity, // Set quantity to 0 to remove the item
    );

    $this->cart->update($data);

    // You can send a response back to the view if needed
    $response = array(
        'status'  => 'success',
        'message' => 'Item Qty update from cart',
        // You can include more data in the response if needed
    );

    echo json_encode($response);
}

 public function update_colorsize() {
         $rowId = $this->input->post('rowId');
        $cartItemId = $this->input->post('cartItemId');
        $selectedSize = $this->input->post('selectedSize');
        $selectedColor = $this->input->post('selectedColor');

         $data = array(
            'rowid' => $rowId,
            'id'      => $cartItemId,
            'options' => array(
                'color' => $selectedColor,
                'size'  => $selectedSize,
                // Add more options as needed
            ),
        );

         // print_r($data); die();

        $this->cart->update($data);
   

        // Add your logic to update the cart based on the provided data
        // For example, you might update the cart in the session or database

        // Send a response back to the client (optional)
        $response = array('status' => 'success', 'message' => 'Cart updated successfully');
        echo json_encode($response);
    }


    
}
