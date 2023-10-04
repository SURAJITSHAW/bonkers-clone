<?php
session_start();

if (isset($_SESSION['userid'])) {

    $conn = mysqli_connect("localhost", "root", "", "bonkers") or die("Connection Failed");

    if (!$conn) {
        die("Database connection failed: " . mysqli_connect_error());
    }

    $userId = $_SESSION['userid'];
    $sql_fetch_cartDB = "SELECT c.*, p.* FROM cart c JOIN product p ON c.p_id = p.p_id WHERE c.user_id = $userId";
    $result = mysqli_query($conn, $sql_fetch_cartDB) or die("Query Unsuccessful.");

    $cartData = array();

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            // Add each $row to the cartData array
            $cartData[] = $row;
        }
    }

    // Close the database connection
    mysqli_close($conn);
} elseif (isset($_SESSION['cart'])) {
    // User is not logged in, fetch cart data from session
    $cartData = $_SESSION['cart'];
} else {
    // Handle the case when the user is not logged in and there is no session cart
    $cartData = array();
}

// Send cart data as JSON response
header('Content-Type: application/json');
echo json_encode($cartData);
