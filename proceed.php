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
                            <tr>
                                <td>T-Shirt</td>
                                <td>449</td>
                            </tr>
                            <tr>
                                <td>Shipping Charge</td>
                                <td>50</td>
                            </tr>
                            <tr>
                                <td>Offer Discount</td>
                                <td>0</td>
                            </tr>
                            <tr>
                                <td>CGST</td>
                                <td>81</td>
                            </tr>
                            <tr>
                                <td>SGST</td>
                                <td>81</td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Total</th>
                                <th>661</th>
                            </tr>
                        </tfoot>
                    </table>
                    <button class="btn">Proceed</button>
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