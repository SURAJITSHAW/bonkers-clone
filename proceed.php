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
    <link rel="stylesheet" href="./CSS/proceed.css" />
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

        <!-- Main section of the page -->
        <main>
            <div class="proceed-container">
                <div class="proceed-address">
                    <?php
                    if (isset($_POST['save_user_add_p']) && $_POST['save_user_add_p'] != null) {
                        $house = $_POST['house'];
                        $landmark = $_POST['landmark'];
                        $city = $_POST['city'];
                        $state  = $_POST['state'];
                        $pin = $_POST['pin'];
                        ////////////////////////////////////////////////////////////////
                        $add = 'House/Flat no: ' . $house . ', Landmark: near ' . $landmark . ', City: ' . $city . ', State: ' . $state . ', Pin: ' . $pin;
                    

                        $conn = mysqli_connect("localhost", "root", "", "bonkers") or die("Connection Failed");
                        $sql_up_user = "UPDATE users SET address='{$add}' WHERE user_id={$_SESSION['userid']}";
                        $result = mysqli_query($conn, $sql_up_user) or die("query failed");
                        if ($result) {
                            echo '<script>window.location.href = "profile.php";</script>';
                            exit; // Always exit after a header redirect to prevent further script execution
                        }
                    }

                    ?>
                    <h3>Address</h3>
                    <form method="POST" action="">
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
                        <button name="save_user_add_p" type="submit" class="btn" value="btn">
                            Save
                        </button>
                    </form>
                </div>
                <div class="proceed-payment">
                    <table>
                        <thead>
                            <tr>
                                <th>Product</th>
                                <th>Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (isset($_SESSION['loggedin']) && isset($_SESSION['userid'])) {
                                $sql_fetch_cartDB = "select * from cart c join product p on c.p_id=p.p_id where user_id={$_SESSION['userid']}";
                                $result = mysqli_query($conn, $sql_fetch_cartDB) or die("Query Unsuccessful.");

                                if (mysqli_num_rows($result) > 0) {
                                    $total = 0;
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        echo '<tr>';
                                        $productPrice = (float)$row['p_price'];
                                        $quantity = (int)$row['quantity'];
                                        $discountedPrice = $productPrice - ($productPrice * (15 / 100));
                                        $temp_total = $quantity * $discountedPrice;
                            ?>
                                        <td><?php echo $row['p_name'] . " <small>x</small> " . $quantity; ?></td>
                                        <td><?php echo $temp_total; ?></td>

                                        <?php
                                        $total += $temp_total;
                                        echo '</tr>';
                                    }
                                }
                            } else {

                                if (isset($_SESSION['cart'])) {
                                    $conn = mysqli_connect("localhost", "root", "", "bonkers") or die("Connection Failed");
                                    $product_id = array_column($_SESSION['cart'], 'p_id');

                                    if (!empty($product_id)) {
                                        $sql = 'SELECT * FROM product WHERE p_id IN (' . implode(",", $product_id) . ')';
                                        $result = mysqli_query($conn, $sql) or die("Query Unsuccessful.");
                                    } else {
                                        // Handle the case when $product_id is empty
                                        echo '<h2>Cart is empty</h2>';
                                    }

                                    if (mysqli_num_rows($result) > 0) {
                                        $total = 0;
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            echo '<tr>';
                                            $product_id = $row['p_id'];
                                            $quantity = 0; // Default quantity
                                            $discountedPriceVarName = 'discountedPrice_' . $row['p_id']; // Create a unique variable name for each product
                                            $discountedPrice = $row['p_price'] - ($row['p_price'] * 15 / 100);

                                            // Store the discounted price in a JavaScript variable with a unique name
                                            echo "<script>var {$discountedPriceVarName} = {$discountedPrice};</script>";

                                            // Check if the product ID exists in the session
                                            foreach ($_SESSION['cart'] as $cartItem) {
                                                if ($cartItem['p_id'] == $product_id) {
                                                    $quantity = $cartItem['quantity'];
                                                    break; // Found the product in the session, no need to continue searching
                                                }
                                            }
                                        ?>
                                            <td><?php echo $row['p_name'] . " <small>x</small> " . $quantity; ?></td>


                                            <?php
                                            $productPrice = $row['p_price'];
                                            $discountPercentage = 15;

                                            $discountAmount = $productPrice * ($discountPercentage / 100);
                                            $discountedPrice = $productPrice - $discountAmount;
                                            $price = $discountedPrice * $quantity;

                                            echo "<td>{$price}</td>"
                                            ?>


                            <?php
                                            $temp_total = $quantity * $discountedPrice;
                                            $total += $temp_total;
                                            echo "</tr>";
                                        }
                                    } else {
                                        echo '<h2>Cart is empty</h2>';
                                    }
                                } else {
                                    echo '<h2>Cart is empty</h2>';
                                }
                            }
                            ?>

                            <tr>
                                <td>Shipping Charge</td>
                                <td>50</td>
                            </tr>
                            <tr>
                                <td>Offer Discount</td>
                                <td>0</td>
                            </tr>
                            <?php
                            // Calculate CGST and SGST amounts
                            $cgstAmount = ($total * 6) / 100;
                            $sgstAmount = ($total * 6) / 100;

                            // Total GST amount (sum of CGST and SGST)
                            $totalGstAmount = $cgstAmount + $sgstAmount;
                            ?>
                            <tr>
                                <td>CGST</td>
                                <td><?php
                                    $cgst = number_format($cgstAmount, 2);
                                    echo $cgst;
                                    ?></td>
                            </tr>
                            <tr>
                                <td>SGST</td>
                                <td><?php $sgst = number_format($sgstAmount, 2);
                                    echo $sgst;  ?></td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Total</th>
                                <th><?php
                                    $total += $totalGstAmount;
                                    $total += 50;
                                    $totalRounded = number_format($total, 2);
                                    echo $totalRounded; ?></th>
                            </tr>
                        </tfoot>
                    </table>
                    <button data-amount="<?php $floatValue = (float) str_replace(',', '', $totalRounded);
                                            $paisaValue = (int) ($floatValue * 100);
                                            echo $paisaValue; ?>" data-user="<?php echo $_SESSION['userid']; ?>" class="btn buynow">
                        Pay
                    </button>




                </div>
            </div>
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    <script>
        $(".buynow").click(function() {

            var amount = $(this).attr('data-amount');
            var userID = $(this).attr('data-user');


            var options = {
                "key": "rzp_test_WBMQb7K0Ics3Yj", // Enter the Key ID generated from the Dashboard
                "amount": amount, // Amount is in currency subunits. Default currency is INR. Hence, 50000 refers to 50000 paise
                "name": "Bonkers Corner",
                "description": "productname",
                "image": "./assets/bonkers-corner_logo.svg",
                "handler": function(response) {
                    var paymentid = response.razorpay_payment_id;

                    $.ajax({
                        url: "payment-process.php",
                        type: "POST",
                        data: {
                            user_id: userID,
                            payment_id: paymentid,
                            total_paid: amount
                        },
                        success: function(finalresponse) {
                            if (finalresponse == 'done') {
                                window.location.href = "success.php";
                            } else {
                                alert('Please check console.log to find error');
                                console.log(finalresponse);
                            }
                        }
                    })

                },
                "theme": {
                    "color": "#3399cc"
                }
            };
            var rzp1 = new Razorpay(options);
            rzp1.open();
            e.preventDefault();
        });
    </script>
</body>

</html>