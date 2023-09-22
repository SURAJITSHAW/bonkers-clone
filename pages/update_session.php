<?php
session_start();

if (isset($_POST['product_id']) && isset($_POST['quantity'])) {
    $productId = $_POST['product_id'];
    $quantity = $_POST['quantity'];

    // Find the product in the session and update its quantity
    foreach ($_SESSION['cart'] as &$cartItem) {
        if ($cartItem['p_id'] == $productId) {
            $cartItem['quantity'] = $quantity;
            break;
        }
    }
}

// Return a response (you can customize this as needed)
echo 'Session updated successfully';
