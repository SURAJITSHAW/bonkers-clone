<header class="nav-bar">
    <!-- Side menu -->
    <div class="burger-button">
        <i class="bi bi-list"></i>
    </div>
    <div class="nav-list">
        <div class="nav-listHead">
            <div class="close-nav"><i class="bi bi-x-lg"></i></div>
        </div>
        <div>
            <ul class="side-nav">
                <li>
                    <a href="products.php">
                        <strong> MEN </strong>
                    </a>
                    <ul>
                        <li>
                            <a href="products.php">
                                Top
                            </a>
                        </li>
                        <li>
                            <a href="products.php">
                                T-Shirt
                            </a>
                        </li>
                        <li>
                            <a href="products.php">
                                Mens Jeans
                            </a>
                        </li>
                    </ul>
                </li>

            </ul>
        </div>
    </div>

    <!-- Normal Navigation -->
    <?php

    $conn = mysqli_connect("localhost", "root", "", "bonkers") or die("Connection Failed");
    $sql = "SELECT * FROM category";
    // $sql = "SELECT * FROM subcategory s JOIN category c ON s.category_id = c.category_id";
    $result = mysqli_query($conn, $sql) or die("Query Unsuccessful.");

    if (mysqli_num_rows($result) > 0) {


    ?>
        <div class="nav-links">
            <ul class="nav-menu">
                <?php
                while ($row = mysqli_fetch_assoc($result)) {
                ?>
                    <a href="products.php?sub=<?php echo $row['category_id']; ?>">
                        <li>
                            <?php
                            $id = $row['category_id'];
                            $sql1 = "SELECT * FROM subcategory WHERE category_id = {$id}";
                            $result1 = mysqli_query($conn, $sql1) or die("Query Unsuccessful.");


                            echo $row['category_name'];
                            echo mysqli_num_rows($result1) > 0 ? '<i class="bi bi-chevron-down"></i>' : '';




                            if (mysqli_num_rows($result1) > 0) {
                                echo '<ul class="drop-down">';
                                while ($row1 = mysqli_fetch_assoc($result1)) {
                            ?>

                        <li>
                            <a href="products.php?sub=<?php echo $row1['id']; ?>"> <?php echo $row1['name']; ?> </a>
                        </li>
                <?php
                                }
                                echo '</ul>';
                            }
                ?>


                </li>
                    </a>
                <?php
                }
                ?>
                <a href="contacts.php">
                    <li>CONTACT</li>
                </a>

            </ul>
        </div>
    <?php
    }
    ?>

    <div class="nav-brand">
        <a href="../index.php">
            <img src="https://assets.bonkerscorner.com/uploads/2021/03/12015638/bonkers_corner_logo-new_vertical.svg" alt="" height="25px" />
        </a>
    </div>

    <div class="nav-cart">
        <a href="profile.php"><i class="bi bi-person"></i></a><a class="cart-button"><i class="bi bi-cart3"></i></a>
    </div>
</header>

<!-- Mini Cart -->
<div class="mini-cart">
    <div class="cart-head">
        <h2>Cart</h2>
        <div class="close-cart">
            <i class="bi bi-x-lg"></i>
        </div>
    </div>
    <hr style="width: 80%; margin: 0 auto" />
    <ul class="list-cart">
        <li>
            <div class="carted-item">
                <div>
                    <img src="./assets/images/product/Bonkerscorner_happy-place-baby-tee_01-768x1152.jpg" height="100px" />
                </div>
                <div class="carted-item-details">
                    <div class="carted-item-title">
                        <p>Productg Name</p>
                        <i class="bi bi-x"></i>
                    </div>
                    <div class="minicart-product-quantity">
                        <button>-</button>
                        <p>0</p>
                        <button>+</button>
                    </div>
                    <p>499</p>
                </div>
            </div>
        </li>
    </ul>
    <div class="checkout">
        <div class="total">0</div>
        <div><a href="cart-page.php">View Cart</a></div>
    </div>
</div>