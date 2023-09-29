<?php
$conn = mysqli_connect("localhost", "root", "", "bonkers") or die("Connection Failed");
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["p_id"])) {
    $p_id = $_POST["p_id"];
    
    // Perform your database operations or any other processing here based on $p_id.
    $del = "delete from cart where p_id = {$p_id}";
    $result = mysqli_query($conn, $del) or die("Couldn't delete cart from database");
    if (!$result) {
        die("Error: " . mysqli_error($conn)); // Handle any query errors
    }

    
    // Send a response back to the JavaScript code if needed
    echo "Item with p_id " . $p_id . " deleted successfully.";
    
} else {
    // Handle invalid requests
    echo "Invalid request.";
}
