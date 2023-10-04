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
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <link rel="stylesheet" href="./CSS/style.css" />
    <link rel="stylesheet" href="./CSS/profile.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" />
    <style>
        .showcase-pricing {
            margin: 30px 0;
            display: flex;
            gap: 40px;
        }

        .actual-price {
            color: gray;
            text-decoration: line-through;
        }

        .discounted-price {
            font-weight: bold;
        }
    </style>
</head>

<body>
    <div class="container">
        <!-- Header -->
        <?php
        include "navbar.php";
        ?>

        <main>
            <div class="page-title">
                <h1 class="active">My Account</h1>
                <h1>Orders</h1>
                <h1>Coupons</h1>
                <h1>Details</h1>
                <h1>Wishlist</h1>
                <h1>Logout</h1>
            </div>
            <section>
                <div class="tabs">
                    <ul>
                        <li class="active">Dashboard</li>
                        <li>Orders</li>
                        <li>Coupons</li>
                        <li>User Details</li>
                        <li>Wishlist</li>
                        <li>Logout</li>
                    </ul>
                </div>
                <div class="tab-content">
                    <div class="content active">
                        <?php
                        $conn = mysqli_connect("localhost", "root", "", "bonkers") or die("Connection Failed");
                        $sql = "select * from users where user_id=" . $_SESSION['userid'];
                        $result = mysqli_query($conn, $sql) or die("Query Unsuccessful.");


                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                        ?>
                                <div>
                                    <p style="margin: 20px;">Hello <strong><?php echo $row['user_name']; ?></strong>👋👋</p>
                                    <p style="margin: 20px;">Email: <strong><?php echo $row['email']; ?></strong></p>
                                    <?php
                                    // SQL query to get total amount and total orders
                                    $sql = "SELECT COUNT(*) AS total_orders, SUM(amount) AS total_amount FROM orders WHERE user_id=" . $_SESSION['userid'];
                                    $result = mysqli_query($conn, $sql);

                                    if ($result) {
                                        // Fetch the results
                                        $row = mysqli_fetch_assoc($result);

                                        // Store the values in PHP variables
                                        $totalOrders = $row['total_orders'];
                                        $totalAmount = $row['total_amount'];

                                        // Close the database connection
                                        mysqli_close($conn);
                                    } else {
                                        echo "Query failed: " . mysqli_error($conn);
                                    }
                                    ?>
                                    <div style="display: flex; flex-direction: row;">
                                        <div style="width: 300px; padding: 20px; background-color: #FFE4B5; border: 1px solid #ccc; margin: 20px;">
                                            <h2 style="color: #FF6600;">📦<?php echo $totalOrders; ?></h2>
                                            <p style="font-size: 18px; color: #666;">Orders has been placeed by you.</p>
                                        </div>

                                        <div style="width: 300px; padding: 20px; background-color: #007BFF; color: #fff; margin: 20px;">
                                            <h2>₹<?php
                                                    $formattedValue = number_format($totalAmount / 100, 2);
                                                    echo $formattedValue; ?></h2>
                                            <p>You had spent in the past.</p>
                                        </div>
                                    </div>

                                    <a href="logout.php" style="width: 10%; margin: 20px; background-color: #dc3545; color: #fff; border-color: #dc3545; padding: 10px; border-radius: 5px;">Log Out</a>
                                </div>
                        <?php
                            }
                        } ?>
                    </div>
                    <div class="content">
                        <table>
                            <thead>
                                <tr>
                                    <th style="border-bottom: 1px solid black;">Order Id</th>
                                    <th style="border-bottom: 1px solid black;">Order Date</th>
                                    <th style="border-bottom: 1px solid black;">Total Amount</th>
                                </tr>
                            </thead>

                            <!-- Enter the table body here -->
                            <?php
                            $conn = mysqli_connect("localhost", "root", "", "bonkers") or die("Connection Failed");
                            $sql = "select * from orders";
                            $result = mysqli_query($conn, $sql) or die("Query Unsuccessful.");


                            if (mysqli_num_rows($result) > 0) {
                                $id = 1;
                                while ($row = mysqli_fetch_assoc($result)) {
                            ?>

                                    <tbody>
                                        <tr>
                                            <th><?php echo $id ?></th>
                                            <th><?php
                                                $dateTime = new DateTime($row['added_date']);
                                                $formattedDate = $dateTime->format(" jS F Y");
                                                echo $formattedDate; ?></th>
                                            <th><?php
                                                $formattedValue = number_format($row['amount'] / 100, 2);
                                                echo $formattedValue; ?></th>
                                        </tr>
                                    </tbody>

                            <?php
                                    $id++;
                                }
                            }
                            ?>
                        </table>
                    </div>

                    <div class="content">
                        <div class="coupons">
                            <p>No Coupons Available</p>
                        </div>
                    </div>
                    <?php
                    if (isset($_POST['save_user_add']) && $_POST['save_user_add'] != null) {
                        $house = $_POST['house'];
                        $landmark = $_POST['landmark'];
                        $city = $_POST['city'];
                        $state  = $_POST['state'];
                        $pin = $_POST['pin'];
                        ////////////////////////////////////////////////////////////////
                        $add = 'House/Flat no: ' . $house . ', Landmark: near ' . $landmark . ', City: ' . $city . ', State: ' . $state . ', Pin: ' . $pin;
                        $name = $_POST['name'];
                        $email = $_POST['email'];

                        $conn = mysqli_connect("localhost", "root", "", "bonkers") or die("Connection Failed");
                        $sql_up_user = "UPDATE users SET address='{$add}', user_name='{$name}', email='{$email}' WHERE user_id={$_SESSION['userid']}";
                        $result = mysqli_query($conn, $sql_up_user) or die("query failed");
                        if ($result) {
                            echo '<script>window.location.href = "profile.php";</script>';
                            exit; // Always exit after a header redirect to prevent further script execution
                        }
                    }

                    ?>

                    <div class="content">
                        <div class="address">
                            <h3>Edit User Details</h3>
                            <form method="POST" action="">
                                <label for="">Name</label>
                                <br />
                                <input required name="name" type="text" placeholder="Enter your Name" />
                                <label for="">Email</label>
                                <br />
                                <input required name="email" type="email" placeholder="Enter your Email" />
                                <br />
                                <label for="">Street Address</label>
                                <br />
                                <input required name="house" type="text" placeholder="House/Flat no." />
                                <br />
                                <input required name="landmark" type="text" placeholder="Land Mark or Local area" />
                                <br />
                                <label for="">City</label>
                                <br />
                                <input required name="city" type="text" placeholder="Enter your City" />
                                <br />
                                <label for="">State</label>
                                <br />
                                <input required name="state" type="text" placeholder="Enter your State" />
                                <br />
                                <label for="">Pin Code</label>
                                <br />
                                <input required name="pin" type="number" placeholder="Enter the Area Pin" />
                                <br />
                                <button name="save_user_add" type="submit" class="btn" value="btn">
                                    Save
                                </button>
                            </form>
                        </div>
                    </div>
                    <div class="content">The Wishlist is empty</div>
                    <a href="logout.php" class="content btn" style="width: 10%;">Log Out</a>
                </div>
            </section>
        </main>

        <footer class="footer">
            <div class="main-footer">
                <div class="footer-brand">
                    <h2>BONKERS</h2>
                </div>
                <div class="footer-links">
                    <ul>
                        <strong>SHOP</strong>
                        <ul>
                            <li>Demo link</li>
                            <li>Demo link</li>
                            <li>Demo link</li>
                            <li>Demo link</li>
                            <li>Demo link</li>
                        </ul>
                    </ul>
                    <ul>
                        <strong>TRENDING</strong>
                        <ul>
                            <li>Demo link</li>
                            <li>Demo link</li>
                            <li>Demo link</li>
                            <li>Demo link</li>
                            <li>Demo link</li>
                        </ul>
                    </ul>
                    <ul>
                        <strong>HELP</strong>
                        <ul>
                            <li>Demo link</li>
                            <li>Demo link</li>
                            <li>Demo link</li>
                            <li>Demo link</li>
                            <li>Demo link</li>
                        </ul>
                    </ul>
                </div>
            </div>
            <hr class="footer-break" />
            <div class="sub-footer">
                <div class="footer-credits">
                    <p>Copyright</p>
                    <p>Secure Payment</p>
                </div>
            </div>
        </footer>
    </div>

    <script src="./scripts/index.js"></script>
    <script src="./scripts/profile.js"></script>
</body>

</html>