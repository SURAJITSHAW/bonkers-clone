<?php
session_start();

// Check if the user is logged in
if (isset($_SESSION['loggedin']) && isset($_SESSION['userid'])) {
    // Get the product ID from the AJAX POST request
    if (isset($_POST['p_id'])) {
        $productId = $_POST['p_id'];

        $conn = mysqli_connect("localhost", "root", "", "bonkers") or die("Connection Failed");
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $userId = $_SESSION['userid'];

        // Check if the product already exists in the wishlist
        $checkQuery = "SELECT * FROM wishlist WHERE user_id = {$userId} AND p_id = {$productId}";
        $checkResult = $conn->query($checkQuery);

        if ($checkResult->num_rows > 0) {
            // Product already exists in the wishlist
            echo "Product already exists in the wishlist.";
        } else {
            // Insert the product into the wishlist table (replace 'wishlist' with your actual table name)
            $insertQuery = "INSERT INTO wishlist (user_id, p_id) VALUES ({$userId}, {$productId})";
            if ($conn->query($insertQuery) === TRUE) {
                // Wishlist insertion successful
                echo "Product added to wishlist successfully!";
            } else {
                // Wishlist insertion failed
                echo "Failed to add product to wishlist: " . $conn->error;
            }
        }

        $conn->close();
    } else {
        // Invalid request, product ID is missing
        echo "Invalid request: Product ID is missing.";
    }
} else {
    // User is not logged in, handle as needed
    echo "User is not logged in. Please log in to add to the wishlist.";
}
