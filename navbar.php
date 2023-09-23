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
                    <a href="products.php?cat=<?php echo $row['category_id']; ?>">
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
        <a href="index.php">
            <img src="https://assets.bonkerscorner.com/uploads/2021/03/12015638/bonkers_corner_logo-new_vertical.svg" alt="" height="25px" />
        </a>
    </div>

    <!-- <div class="nav-cart">
        <a href="profile.php"><i class="bi bi-person"></i></a><a class="cart-button"><i class="bi bi-cart3"></i></a>
        <span id="cart-count">0</span>
    </div> -->

    <div class="nav-cart" style="display: flex; align-items: center; background-color: #f5f5f5; padding: 10px 20px; border-radius: 20px; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); max-width: 200px;">
        <a href="profile.php" style="text-decoration: none; color: #333; font-size: 24px; margin: 0 10px;"><i class="bi bi-person"></i></a>
        <a class="cart-button" style="text-decoration: none; color: #333; font-size: 24px; margin: 0 10px;"><i class="bi bi-cart3"></i></a>


        <?php

        if (isset($_SESSION['cart'])) {
            $count = count($_SESSION['cart']);
            echo '<span id="cart-count" style="background-color: #ff6347; color: #fff; font-size: 14px; padding: 4px 10px; border-radius: 50%;">' . $count . '</span>';
        } else {
            echo '<span id="cart-count" style="background-color: #ff6347; color: #fff; font-size: 14px; padding: 4px 10px; border-radius: 50%;">0</span>';
        }
        ?>

    </div>


</header>

<!-- Mini Cart -->



<!-- Your HTML and PHP code before the mini-cart -->

<div class="mini-cart">
    <div class="cart-head">
        <h2>Cart</h2>
        <div class="close-cart">
            <i class="bi bi-x-lg"></i>
        </div>
    </div>
    <hr style="width: 80%; margin: 0 auto;" />

    <?php
    if (isset($_SESSION['cart'])) {
        $product_id = array_column($_SESSION['cart'], 'p_id');
        $sql = "SELECT * FROM product WHERE p_id IN (" . implode(",", $product_id) . ")";
        $result = mysqli_query($conn, $sql) or die("Query Unsuccessful.");

        if (mysqli_num_rows($result) > 0) {
            $total = 0;
            echo '<ul class="list-cart">';
            while ($row = mysqli_fetch_assoc($result)) {
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

                <li data-product-id="<?php echo $row['p_id']; ?>" style=" margin: 5px; padding: 10px; border-bottom: #333;">
                    <div class="carted-item">
                        <div>
                            <img src="<?php echo '../../bonkerscorner.com/uploads/' . $row['p_img']; ?>" height="100px" />
                        </div>
                        <div class="carted-item-details">
                            <div class="carted-item-title">
                                <p><?php echo $row['p_name']; ?></p>
                                <!-- Add an "X" button with a click event -->
                                <i style="cursor: pointer;" class="bi bi-x" onclick="removeCartItem(<?php echo $row['p_id']; ?>)"></i>

                            </div>
                            <div class="quantity" style="display: flex; align-items: center; margin-top: 5px; margin-bottom: -20px;">
                                <div class="rey-qtyField cartBtnQty-controls" style="display: flex; align-items: center;">
                                    <span class="cartBtnQty-control --minus" style="cursor: pointer; padding: 8px; background-color: #f0f0f0; border-radius: 4px;" onclick="decrementQuantity(<?php echo $row['p_id']; ?>)">
                                        -
                                    </span>

                                    <input readonly type="number" id="quantity_<?php echo $row['p_id']; ?>" class="input-text qty text --select-text" step="1" min="1" max="100" name="quantity" value="<?php echo $quantity; ?>" title="Qty" size="4" style="margin: 0 10px; padding: 6px; border: 1px solid #ccc; border-radius: 4px; text-align: center;" inputmode="numeric" />

                                    <span class="cartBtnQty-control --plus" style="cursor: pointer; padding: 8px; background-color: #f0f0f0; border-radius: 4px;" onclick="incrementQuantity(<?php echo $row['p_id']; ?>)">
                                        +
                                    </span>
                                </div>
                            </div>
                            <div class="showcase-pricing">
                                <p class="actual-price">₹<span><?php echo $row['p_price'] ?></span></p>
                                <p class="discounted-price">
                                    <?php
                                    $productPrice = $row['p_price'];
                                    $discountPercentage = 15;

                                    $discountAmount = $productPrice * ($discountPercentage / 100);
                                    $discountedPrice = $productPrice - $discountAmount;

                                    echo "₹<span>{$discountedPrice}</span>"
                                    ?>
                                </p>
                                <p style="color: red; font-weight: bolder" id="temp_total_<?php echo $row['p_id']; ?>">
                                    <?php
                                    $temp_total = $quantity * $discountedPrice;
                                    echo '₹' .
                                        $quantity * $discountedPrice; ?>
                                </p>
                            </div>
                        </div>
                    </div>
                </li>

    <?php
                $temp_total = $quantity * $discountedPrice;
                $total += $temp_total;
            }
            echo '</ul>';
        }
    } else {
        echo '<h2>Cart is empty</h2>';
    }
    ?>

    <div class="checkout">
        <div id="total" style="font-weight: bolder"><?php echo '₹' . $total; ?></div>
        <div><a href="cart-page.php">View Cart</a></div>
    </div>
</div>

<script>
    function removeCartItem(productId) {
        // Send an AJAX request to remove the item from the session
        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'remove_item.php', true);
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4 && xhr.status == 200) {
                // Item removed successfully from the session
                // You can add any additional handling here if needed

                // Remove the item from the mini-cart display
                var cartItem = document.querySelector('li[data-product-id="' + productId + '"]');
                if (cartItem) {
                    cartItem.remove();
                }

                // Update the total
                updateTotal();
            }
        };
        xhr.send('product_id=' + productId);
    }

    function updateSession(productId, quantity) {
        // Send an AJAX request to a PHP script to update the session
        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'update_session.php', true);
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4 && xhr.status == 200) {
                // Session updated successfully
                // You can add any additional handling here if needed
            }
        };
        xhr.send('product_id=' + productId + '&quantity=' + quantity);
    }

    function updateTotal() {
        var total = 0;

        <?php foreach ($_SESSION['cart'] as $cartItem) : ?>
            var productId = <?php echo $cartItem['p_id']; ?>;
            var quantity = parseInt(document.getElementById('quantity_' + productId).value);
            var price = parseFloat(window['discountedPrice_' + productId]); // Access the discounted price using the variable name

            var tempTotal = quantity * price;
            total += tempTotal;

            document.getElementById('temp_total_' + productId).textContent = '₹' + tempTotal.toFixed(2);
        <?php endforeach; ?>

        document.getElementById('total').textContent = '₹' + total.toFixed(2);
    }


    function incrementQuantity(productId) {
        var quantityInput = document.getElementById('quantity_' + productId);
        var currentValue = parseInt(quantityInput.value);
        var maxValue = parseInt(quantityInput.getAttribute('max'));

        if (currentValue < maxValue) {
            quantityInput.value = currentValue + 1;
            updateTotal();

            // Call the updateSession function to update the session variable
            updateSession(productId, currentValue + 1);
        }
    }

    function decrementQuantity(productId) {
        var quantityInput = document.getElementById('quantity_' + productId);
        var currentValue = parseInt(quantityInput.value);
        var minValue = parseInt(quantityInput.getAttribute('min'));

        if (currentValue > minValue) {
            quantityInput.value = currentValue - 1;
            updateTotal();

            // Call the updateSession function to update the session variable
            updateSession(productId, currentValue - 1);
        }
    }


    // Call updateTotal initially to calculate the total
    updateTotal();
</script>