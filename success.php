<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
  header('location: login.php');
  exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <title>Success</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>

  <div class="container mt-3">

    <?php
    $conn = mysqli_connect("localhost", "root", "", "bonkers") or die("Connection Failed");
    $sql = "DELETE FROM cart WHERE user_id=" . $_SESSION['userid'];
    mysqli_query($conn, $sql);
    ?>
    <h2>Payment has been successful</h2>

    <div class="alert alert-success">
      <strong>Please note your payment id!</strong><?php echo $_SESSION['paymentid']; ?>
    </div>

    <!-- "Continue Shopping" button -->
    <a href="index.php" class="btn btn-primary">Continue Shopping</a>
  </div>

</body>

</html>