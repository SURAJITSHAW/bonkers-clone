<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["p_id"]) && isset($_POST["quantity"])) {
    $p_id = $_POST["p_id"];
    $quantity = $_POST["quantity"];

    // Perform the database update here
    // You should connect to your database before executing this query
    // $conn = new mysqli("localhost", "username", "password", "database_name");
    $conn = mysqli_connect("localhost", "root", "", "bonkers") or die("Connection Failed");
    $update_sql = "UPDATE cart SET quantity = $quantity WHERE p_id = $p_id AND user_id = {$_SESSION['userid']}";

    $result = mysqli_query($conn, $update_sql);
    
    // Check if the update was successful
    if ($result) {
        echo "Quantity updated successfully";
    } else {
        echo "Error updating quantity: " . mysqli_error($conn);
    }
    
    // Close the database connection if opened
    // $conn->close();
} else {
    // Handle invalid requests
    echo "Invalid request.";
}
