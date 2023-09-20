<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <link rel="stylesheet" href="../CSS/style.css" />
    <link rel="stylesheet" href="../CSS/cart.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" />
</head>

<body>
    <div class="container">
        <!-- Header -->
        <?php
        include "navbar.php";
        ?>

        <main>
            <div class="cart-body">
                <table>
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <div class="product-details">
                                    <img src="../assets/images/product/Bonkerscorner_yellow-shorts_02-768x1152.jpg" height="200px" />
                                    <div class="product-action">
                                        <h2>Product name</h2>
                                        <br />
                                        <a>remove</a>
                                    </div>
                                </div>
                            </td>
                            <td>Price</td>
                            <td>
                                <div class="cart-product-quantity">
                                    <button>-</button>
                                    <p>0</p>
                                    <button>+</button>
                                </div>
                            </td>
                            <td>subtotal</td>
                        </tr>
                    </tbody>
                </table>
                <div class="proceed-section">
                    <div class="apply-coupon">
                        <input type="text" placeholder="Apply Coupon" />
                        <input type="submit" value="Apply" class="btn" />
                    </div>
                    <a href="./proceed.php">
                        <button class="btn">Proceed</button>
                    </a>
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

    <script src="../scripts/index.js"></script>
</body>

</html>