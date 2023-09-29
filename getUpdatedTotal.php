<?php
session_start();

header("Content-Type: application/json");

if (isset($_SESSION['userid'])) {
    $conn = mysqli_connect("localhost", "root", "", "bonkers") or die("Connection Failed");
    // Query to calculate the updated total based on the user's cart
    $sql = "SELECT SUM(quantity * (p_price - (p_price * 0.15))) AS total FROM cart c JOIN product p ON c.p_id = p.p_id WHERE user_id = {$_SESSION['userid']}";
    $result = mysqli_query($conn, $sql) or die("Error getting total price");

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $total = $row['total'];
        echo json_encode(['total' => $row]);
    } else {
        echo json_encode(['total' => 0]);
    }
} else {
    echo json_encode(['total' => 0]);
}
