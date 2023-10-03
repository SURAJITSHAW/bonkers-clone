<?php
session_start();
$conn = mysqli_connect("localhost", "root", "", "bonkers") or die("Connection Failed");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST['add-cart'])) {
        // Validate and sanitize the input data
        $productId = intval($_POST['p_id']);
        $quantity = intval($_POST['quantity']);

        

        if (isset($_SESSION['loggedin']) && isset($_SESSION['userid'])) {
            /* if you're logged in and want to add a product in the cart: */

            // 1. Check if the product is already in the cart
            $sql_p_exist = "SELECT * FROM cart WHERE p_id = {$productId}";
            $result_exist = mysqli_query($conn, $sql_p_exist) or die("Query Unsuccessful.");

            if (mysqli_num_rows($result_exist) > 0) {
                while ($row_exist = mysqli_fetch_assoc($result_exist)) {
                    $newQuantity = $row_exist['quantity'] + $quantity;
                    $sql1 = "UPDATE `cart` SET `quantity` = {$newQuantity} WHERE `cart`.`p_id` = {$productId}";
                    $result1 = mysqli_query($conn, $sql1) or die("Query Unsuccessful.");
                }
            } else {
                // 2. If the product isn't in the cart, insert it
                $sql1 = "INSERT INTO `cart` (`user_id`, `p_id`, `quantity`) VALUES ({$_SESSION['userid']}, {$productId}, {$quantity});";
                $result1 = mysqli_query($conn, $sql1) or die("Query Unsuccessful.");
            }
        } else {
            if (isset($_SESSION['cart'])) {
                // Check if the product is already in the session cart
                $item_arr_id = array_column($_SESSION['cart'], 'p_id');

                if (in_array($productId, $item_arr_id)) {
                    echo json_encode(["success" => false, "message" => "Product is already in the cart"]);
                } else {
                    $count = count($_SESSION['cart']);
                    $item_arr = [
                        'p_id' => $productId,
                        'quantity' => $quantity
                    ];
                    $_SESSION['cart'][$count] = $item_arr;
                    echo json_encode(["success" => true, "message" => "Product added to cart successfully"]);
                }
            } else {
                // If session variable cart isn't set, create a new session cart
                $item_arr = [
                    'p_id' => $productId,
                    'quantity' => $quantity
                ];

                $_SESSION['cart'][0] = $item_arr;
                echo json_encode(["success" => true, "message" => "Product added to cart successfully"]);
            }
        }
    }
}
