<?php
session_start();

if (isset($_POST['product_id'])) {
    $product_id = $_POST['product_id'];

    // Check if the item exists in the session
    if (isset($_SESSION['cart'])) {
        $updated_cart = [];

        foreach ($_SESSION['cart'] as $cartItem) {
            if ($cartItem['p_id'] != $product_id) {
                // Keep items that don't match the product_id
                $updated_cart[] = $cartItem;
            }
        }

        // Update the session variable with the updated cart
        $_SESSION['cart'] = $updated_cart;

        // You can also perform additional actions here if needed

        echo 'Item removed successfully from the session';
    } else {
        echo 'Item not found in the session';
    }
} else {
    echo 'Invalid request';
}
