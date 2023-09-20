<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <link rel="stylesheet" href="../CSS/style.css" />
    <link rel="stylesheet" href="../CSS/profile.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" />
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
                <h1>Addresses</h1>
                <h1>Account Details</h1>
                <h1>Wishlist</h1>
                <h1>Logout</h1>
            </div>
            <section>
                <div class="tabs">
                    <ul>
                        <li class="active">Dashboard</li>
                        <li>Orders</li>
                        <li>Coupons</li>
                        <li>Address</li>
                        <li>Account Details</li>
                        <li>Wishlist</li>
                        <li>Logout</li>
                    </ul>
                </div>
                <div class="tab-content">
                    <div class="content active">
                        <div>
                            <p>hello <strong>User</strong></p>
                        </div>
                    </div>
                    <div class="content">
                        <table>
                            <thead>
                                <tr>
                                    <th>Order Id</th>
                                    <th>Order Date</th>
                                    <th>Total Ammount</th>
                                </tr>
                            </thead>
                            <!-- Enter the table body here -->
                        </table>
                    </div>

                    <div class="content">
                        <div class="coupons">
                            <p>No Coupons Available</p>
                        </div>
                    </div>
                    <div class="content">
                        <div class="address">
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
                                <button type="submit" class="btn">
                                    Save
                                </button>
                            </form>
                        </div>
                    </div>
                    <div class="content">
                        <div class="account-details">
                            <h3>Account Details</h3>
                            <form action="">
                                <label for="">Name</label>
                                <br />
                                <input type="text" placeholder="Enter your Name" />
                                <br />
                                <h4>Change Password</h4>
                                <label for="">Old Password</label>
                                <br />
                                <input type="password" placeholder="Enter the Old Password" />
                                <br />
                                <label for="">New Password</label>
                                <br />
                                <input type="password" placeholder="Enter the New Password" />
                                <br />
                                <label for="">Re-enter new password</label>
                                <br />
                                <input type="password" placeholder="Re-enter the new Password" />
                                <br />
                                <button type="submit" class="btn">
                                    Save
                                </button>
                            </form>
                        </div>
                    </div>
                    <div class="content">The Wishlist is empty</div>
                    <div class="content">Log Out</div>
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

    <script src="../scripts/index.js"></script>
    <script src="../scripts/profile.js"></script>
</body>

</html>