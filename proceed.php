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
                    <h3>Address</h3>
                    <form action="">
                        <label for="">Name</label>
                        <br />
                        <input type="text" placeholder="Enter your Name" />
                        <br />
                        <label for="">Street Address</label>
                        <br />
                        <input type="text" placeholder="House/Flat no." />
                        <br />
                        <input type="text" placeholder="Land Mark or Local area" />
                        <br />
                        <label for="">City</label>
                        <br />
                        <input type="text" placeholder="Enter your City" />
                        <br />
                        <label for="">State</label>
                        <br />
                        <input type="text" placeholder="Enter your State" />
                        <br />
                        <label for="">Pin Code</label>
                        <br />
                        <input type="number" placeholder="Enter the Area Pin" />
                        <br />
                        <button type="submit" class="btn">Save</button>
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
                    <!-- <button class="btn">Proceed</button> -->
                    <form action="https://www.example.com/payment/success/" method="POST">
                        <script src="https://checkout.razorpay.com/v1/checkout.js" data-key="rzp_test_OAKDF8SXGdouLQ" // Enter the Test API Key ID generated from Dashboard → Settings → API Keys data-amount="<?php echo $totalRounded * 100; ?>" // Amount is in currency subunits. Hence, 29935 refers to 29935 paise or ₹299.35. data-currency="INR" // You can accept international payments by changing the currency code. Contact our Support Team to enable International for your account data-order_id="order_CgmcjRh9ti2lP7" // Replace with the order_id generated by you in the backend. data-buttontext="Pay with Razorpay" data-name="Acme Corp" data-description="A Wild Sheep Chase is the third novel by Japanese author Haruki Murakami" data-image="https://example.com/your_logo.jpg" data-prefill.name="Gaurav Kumar" data-prefill.email="gaurav.kumar@example.com" data-theme.color="#F37254"></script>
                        <input type="hidden" custom="Hidden Element" name="hidden" />
                    </form>
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
</body>

</html>