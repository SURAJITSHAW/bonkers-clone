<?php
session_start();
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <link rel="stylesheet" href="./CSS/style.css" />
    <link rel="stylesheet" href="./CSS/product-details.css" />

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" />
</head>

<body>
    <div class="container">
        <!-- Header -->
        <?php
        include "navbar.php";
        ?>

        <!-- Main Section -->
        <script>
            let openCart = document.querySelector(".cart-button");
            let container = document.querySelector(".container");
            let closeCart = document.querySelector(".close-cart");

            openCart.addEventListener("click", () => {
                container.classList.add("active-cart");
            })

            closeCart.addEventListener("click", () => {
                container.classList.remove("active-cart")
            })


            // Automatically trigger the click event when the page loads
            document.addEventListener("DOMContentLoaded", () => {
                openCart.click();
            });
        </script>

        <?php
        if (isset($_GET['id'])) {
            $productId = $_GET['id'];
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }
            $sql = "SELECT * FROM product WHERE p_id = $productId";

            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();


        ?>
                <main>
                    <div class="showcase-section">
                        <div class="products-show">
                            <div style="
                                --swiper-navigation-color: #fff;
                                --swiper-pagination-color: #fff;
                            " class="swiper mySwiper2">
                                <div class="swiper-wrapper">
                                    <div class="swiper-slide">
                                        <img src="<?php echo '../../bonkerscorner.com/uploads/' . $row['p_img']; ?>" />
                                    </div>
                                    <div class="swiper-slide">
                                        <img src="../assets/images/Product-details/Bonkerscorner_sage-green-bodysuit_01.jpg" />
                                    </div>
                                    <div class="swiper-slide">
                                        <img src="../assets/images/Product-details/Bonkerscorner_sage-green-bodysuit_03.jpg" />
                                    </div>
                                    <div class="swiper-slide">
                                        <img src="../assets/images/Product-details/Bonkerscorner_sage-green-bodysuit_04.jpg" />
                                    </div>
                                    <div class="swiper-slide">
                                        <img src="../assets/images/Product-details/Bonkerscorner_sage-green-bodysuit_05.jpg" />
                                    </div>
                                    <div class="swiper-slide">
                                        <img src="../assets/images/Product-details/Bonkerscorner_sage-green-bodysuit_06.jpg" />
                                    </div>
                                </div>
                                <!-- <div class="swiper-button-next"></div>
                                <div class="swiper-button-prev"></div> -->
                            </div>

                            <!-- <div thumbsSlider="" class="swiper mySwiper">
                                <div class="swiper-wrapper">
                                    <div class="swiper-slide">
                                        <img src="../assets/images/Product-details/Bonkerscorner_sage-green-bodysuit_02.jpg" />
                                    </div>
                                    <div class="swiper-slide">
                                        <img src="../assets/images/Product-details/Bonkerscorner_sage-green-bodysuit_01.jpg" />
                                    </div>
                                    <div class="swiper-slide">
                                        <img src="../assets/images/Product-details/Bonkerscorner_sage-green-bodysuit_03.jpg" />
                                    </div>
                                    <div class="swiper-slide">
                                        <img src="../assets/images/Product-details/Bonkerscorner_sage-green-bodysuit_04.jpg" />
                                    </div>
                                    <div class="swiper-slide">
                                        <img src="../assets/images/Product-details/Bonkerscorner_sage-green-bodysuit_05.jpg" />
                                    </div>
                                    <div class="swiper-slide">
                                        <img src="../assets/images/Product-details/Bonkerscorner_sage-green-bodysuit_06.jpg" />
                                    </div>
                                </div>
                            </div> -->


                        </div>
                        <div class="product-selection">
                            <h1><?php echo $row['p_name'] ?></h1>
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
                            </div>







                            <!-- <div class="quantity" style="display: flex; align-items: center;">

                                <div class="rey-qtyField cartBtnQty-controls" style="display: flex; align-items: center;">

                                    <span class="cartBtnQty-control --minus" style="cursor: pointer; padding: 8px; background-color: #f0f0f0; border-radius: 4px;">
                                        <svg class="rey-icon rey-icon-reycore-icon-minus" aria-hidden="true" role="img" style="width: 20px; height: 20px; fill: #333;">
                                            <use href="https://www.bonkerscorner.com/wp-content/plugins/rey-core/assets/images/icon-sprite.svg#reycore-icon-minus" xlink:href="https://www.bonkerscorner.com/wp-content/plugins/rey-core/assets/images/icon-sprite.svg#reycore-icon-minus"></use>
                                        </svg>
                                    </span>

                                    <input type="number" id="quantity_650d2bef84a81" class="input-text qty text --select-text" step="1" min="1" max="100" name="quantity" value="1" title="Qty" size="4" style="margin: 0 10px; padding: 6px; border: 1px solid #ccc; border-radius: 4px; text-align: center;" inputmode="numeric" />

                                    <span class="cartBtnQty-control --plus" style="cursor: pointer; padding: 8px; background-color: #f0f0f0; border-radius: 4px;">
                                        <svg class="rey-icon rey-icon-reycore-icon-plus" aria-hidden="true" role="img" style="width: 20px; height: 20px; fill: #333;">
                                            <use href="https://www.bonkerscorner.com/wp-content/plugins/rey-core/assets/images/icon-sprite.svg#reycore-icon-plus" xlink:href="https://www.bonkerscorner.com/wp-content/plugins/rey-core/assets/images/icon-sprite.svg#reycore-icon-plus"></use>
                                        </svg>
                                    </span>
                                </div>

                            </div> -->


                            <form id="add-to-cart-form" data-product-id="<?php echo $row['p_id']; ?>">
                                <div class="quantity" style="display: flex; align-items: center; margin: 10px;">
                                    <div class="rey-qtyField cartBtnQty-controls" style="display: flex; align-items: center;">
                                        <span class="cartBtnQty-control --minus" style="cursor: pointer; padding: 8px; background-color: #f0f0f0; border-radius: 4px;" onclick="decrementQuantityPD()">
                                            -
                                        </span>

                                        <input readonly type="number" id="quantity_650d2bef84a81" class="input-text qty text --select-text" step="1" min="1" max="100" name="quantity" value="1" title="Qty" size="4" style="margin: 0 10px; padding: 6px; border: 1px solid #ccc; border-radius: 4px; text-align: center;" inputmode="numeric" />

                                        <span class="cartBtnQty-control --plus" style="cursor: pointer; padding: 8px; background-color: #f0f0f0; border-radius: 4px;" onclick="incrementQuantityPD()">
                                            +
                                        </span>
                                    </div>
                                </div>

                                <button name="add-cart" type="submit" class="single_add_to_cart_button button alt btn">
                                    <span class="single_add_to_cart_button-text"><span class="__text">Add to cart</span></span>
                                </button>

                                <input type="hidden" name="p_id" value="<?php echo $row['p_id']; ?>">

                                <?php if (isset($_SESSION['loggedin']) && isset($_SESSION['userid'])) { ?>
                                    <button class="btn">
                                        <i class="bi bi-heart"></i> Wishlist
                                    </button>
                                <?php } ?>
                            </form>


                            <script>
                                function incrementQuantityPD() {
                                    var quantityInput = document.getElementById('quantity_650d2bef84a81');
                                    var currentValue = parseInt(quantityInput.value);
                                    var maxValue = parseInt(quantityInput.getAttribute('max'));

                                    if (currentValue < maxValue) {
                                        quantityInput.value = currentValue + 1;
                                    }
                                }

                                function decrementQuantityPD() {
                                    var quantityInput = document.getElementById('quantity_650d2bef84a81');
                                    var currentValue = parseInt(quantityInput.value);
                                    var minValue = parseInt(quantityInput.getAttribute('min'));

                                    if (currentValue > minValue) {
                                        quantityInput.value = currentValue - 1;
                                    }
                                }
                            </script>





                            <!-- <label for="">Size:</label>
                                <select name="" id="">
                                    <option value="xs">XS</option>
                                    <option value="s">S</option>
                                    <option value="m">M</option>
                                    <option value="l">L</option>
                                    <option value="xl">XL</option>
                                    <option value="xxl">XXL</option>
                                </select>
                                <div class="quantity-selector">
                                    <button class="quantyi-dec">-</button>
                                    <p class="quantity">0</p>
                                    <button class="quantity-inc">+</button>
                                </div>



                                <button class="btn">Add to Cart</button> -->










                        </div>
                    </div>
                    <hr />
                    <div class="product-description">
                        <div class="desc-section">
                            <h2 class="desc-title">Description</h2>
                            <div class="desc-body">
                                <p><strong>PRODUCT DETAILS</strong></p>
                                <?php echo $row['p_desc'] ?>
                            </div>
                        </div>
                        <div class="desc-section">
                            <h2 class="desc-title">Information</h2>
                            <div class="desc-body">
                                <p><strong>Shipping </strong><br />We currently offer 5% discount on all pre-paid orders and free shipping on COD orders over ₹1499.</p>
                                <p><strong>Sizing </strong><br />Fits true to size. Do you need size advice? Please refer to our size chart.</p>
                                <p><strong>Return &amp; exchange </strong><br />For any returns and exchange please read our <a href="/faq/" target="_blank" rel="noopener">FAQs Page</a>.<br />No Returns/Exchange on Tank tops and Baby tees.</p>
                                <p><strong>Assistance </strong><br />Contact us at <a href="/cdn-cgi/l/email-protection#523b3c343d12303d3c39372021313d203c37207c313d3f"><strong><span class="__cf_email__" data-cfemail="f39a9d959cb3919c9d98968180909c819d9681dd909c9e">info@bonkerscorner.com</span></strong></a>.</p>
                            </div>
                        </div>
                        <div class="desc-section">
                            <h2 class="desc-title">Specification</h2>
                            <div class="desc-body">
                                <table class="woocommerce-product-attributes shop_attributes">
                                    <tr class="woocommerce-product-attributes-item woocommerce-product-attributes-item--weight">
                                        <th class="woocommerce-product-attributes-item__label">Weight</th>
                                        <td class="woocommerce-product-attributes-item__value">240 g</td>
                                    </tr>
                                    <tr class="woocommerce-product-attributes-item woocommerce-product-attributes-item--attribute_pa_size">
                                        <th class="woocommerce-product-attributes-item__label">Size</th>
                                        <td class="woocommerce-product-attributes-item__value">
                                            <p>XXS, XS, S, M, L, XL, XXL, 3XL, 4XL, 5XL</p>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
    </div>
    </div>

<?php
            } else {
                echo "No product found with the specified ID.";
            }

            $conn->close();
        } else {
            echo "Product ID not provided in the URL.";
        }

?>
<!-- <div class="featured-products">
    <h3>You may also like</h3>
    <div class="recomended-section">
        <a href="./product-details.php">
            <div class="product-card">
                <img src="../assets/images/product/Bonkerscorner_gray-Faded-Effect-joggers_06-768x1152.jpg" alt="" />
                <div class="product-data">
                    <p class="category-details">Bottoms</p>
                    <p class="product-name">Blck Pant</p>
                    <div class="product-price">
                        <p class="original-price">
                            ₹<span>1499</span>
                        </p>
                        <p class="discounted-price">
                            ₹<span>799</span>
                        </p>
                    </div>
                    <div class="product-action">
                        <button class="btn-add-to-cart">
                            View Product</button><button class="btn-heart">
                            <i class="bi bi-heart"></i>
                        </button>
                    </div>
                </div>
            </div>
        </a>
    </div>
</div> -->
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

<script>
    function updateMiniCart() {
        // Send an AJAX request to fetch cart data
        const xhr = new XMLHttpRequest();
        xhr.open("GET", "update_mini_cart.php", true);

        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                console.log(xhr);
                // Parse the JSON response and update the mini-cart
                const cartData = JSON.parse(xhr.responseText);
                console.log(cartData);
                // Update your mini-cart HTML with the new cartData

                // Get the <ul> element where you want to replace the content
                const cartList = document.querySelector('.list-cart');

                // Remove existing <li> elements
                cartList.innerHTML = '';

                // Generate and append new <li> elements based on cartData
                cartData.forEach(item => {
                    const li = document.createElement('li');
                    li.setAttribute('data-product-id', item.p_id);
                    li.style.margin = '5px';
                    li.style.padding = '10px';
                    // li.style.borderBottom = '1px solid #333';
                    let temp_price = (item.quantity * (item.p_price - (item.p_price * (15 / 100)))).toFixed(2);
                    let discountedPrice = (item.p_price - (item.p_price * (15 / 100))).toFixed(2);


                    // Create the inner content of each <li> element
                    li.innerHTML = `
                            <div class="carted-item">
                                <div>
                                    <img src="../../bonkerscorner.com/uploads/${item.p_img}" height="100px" />
                                </div>
                                <div class="carted-item-details">
                                    <div class="carted-item-title">
                                        <p>${item.p_name}</p>
                                        <!-- Add an "X" button with a click event -->
                                        <i style="cursor: pointer;" class="bi bi-x" data-pID="${item.p_id}"></i>
                                    </div>
                                    <div class="quantity" style="display: flex; align-items: center; margin-top: 5px; margin-bottom: -20px;">
                                        <div class="rey-qtyField cartBtnQty-controls" style="display: flex; align-items: center;">
                                            <!-- Add quantity input and controls here -->
                                            <span class="cartBtnQty-control --minus" style="cursor: pointer; padding: 8px; background-color: #f0f0f0; border-radius: 4px;" onclick="decrementQuantityLogIn(${item.p_id})">
                                                -
                                            </span>

                                            <input readonly type="number" id="quantity_${item.p_id}" class="input-text qty text --select-text" step="1" min="1" max="100" name="quantity" value="${item.quantity}" title="Qty" size="4" style="margin: 0 10px; padding: 6px; border: 1px solid #ccc; border-radius: 4px; text-align: center;" inputmode="numeric" />

                                            <span class="cartBtnQty-control --plus" style="cursor: pointer; padding: 8px; background-color: #f0f0f0; border-radius: 4px;" onclick="incrementQuantityLogIn(${item.p_id})">
                                                +
                                            </span>
                                        </div>
                                    </div>
                                    <div class="showcase-pricing">
                                        <p class="actual-price" id="actual_price_${item.p_id}">₹${item.p_price}</p>
                                        <p class="discounted-price">₹${discountedPrice}</p>
                                        <p style="color: red; font-weight: bolder" id="temp_total_${item.p_id}">₹${temp_price}</p>
                                    </div>
                                </div>
                            </div>
                        `;

                    // Append the new <li> element to the <ul>
                    cartList.appendChild(li);
                });
            }
        };
        // Call updateTotal initially to calculate the total
        <?php if (isset($_SESSION['loggedin']) && isset($_SESSION['userid'])) : ?>
            updateTotalLogIn();
        <?php else : ?>
            updateTotal();
        <?php endif; ?>

        xhr.send();
    }

    const addToCartForm = document.getElementById("add-to-cart-form");

    addToCartForm.addEventListener("submit", function(e) {
        e.preventDefault(); // Prevent the default form submission

        const productId = addToCartForm.querySelector("input[name='p_id']").value;
        const quantity = addToCartForm.querySelector("input[name='quantity']").value;

        console.log(productId, quantity);

        // Send an AJAX request to the PHP script to add the product to the cart
        const xhr = new XMLHttpRequest();
        xhr.open("POST", "add_to_cart.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4) {
                if (xhr.status === 200) {
                    // Handle the response from the server (e.g., show a success message)
                    console.log(xhr);
                    // const response = JSON.parse(xhr.responseText);
                    // if (response.success) {
                    //     alert("Product added to cart successfully!");
                    // } else {
                    //     alert("Failed to add product to cart.");
                    // }
                } else {
                    alert("Failed to connect to the server.");
                }
            }
        };

        const data = `add-cart=1&p_id=${productId}&quantity=${quantity}`;
        xhr.send(data);
        updateMiniCart();
    });
</script>

<script>
    // Add a click event listener to all elements with the class 'bi-x'
    document.querySelectorAll('.bi-x').forEach(function(element) {
        element.addEventListener('click', function() {
            var p_id = this.getAttribute('data-pID');

            // Send p_id to a PHP script using AJAX
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "processClick.php", true);
            xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    // Handle the response from the PHP script if needed

                    // Remove the item from the mini-cart display
                    var cartItem = document.querySelector('li[data-product-id="' + p_id + '"]');
                    if (cartItem) {
                        cartItem.remove();
                        updateTotalLogIn();
                    }

                    console.log(xhr.responseText);
                }
            };
            xhr.send("p_id=" + p_id);
        });
    });

    function updateTotalLogIn() {
        // Send an AJAX request to get the updated total
        var xhr = new XMLHttpRequest();
        xhr.open("GET", "getUpdatedTotal.php", true);
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                console.log(xhr.responseText);
                var response = JSON.parse(xhr.responseText);
                var totalLogIn = response.total;
                var totalLogInF = totalLogIn.total;
                console.log(totalLogInF);

                // Update the total displayed on the page
                if (totalLogInF == null) {
                    document.getElementById('total').innerHTML = '₹ 0.00';
                } else {
                    document.getElementById('total').innerHTML = '₹' + totalLogInF;

                }
            }
        };
        xhr.send();
    }

    function updateItemTotal(productId, newQuantity) {
        // Send an AJAX request to update the quantity in the cart table
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "updateQuantity.php", true);
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

        // Prepare the data to send to the server
        var data = "p_id=" + productId + "&quantity=" + newQuantity;

        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                // Handle the response from the PHP script if needed
                console.log(xhr.responseText);
                // Update the total and temp_total for the corresponding item
                updateTotalLogIn();
                updateItemTempTotal(productId, newQuantity);
            }
        };

        // Send the request
        xhr.send(data);
    }

    function incrementQuantityLogIn(productId) {
        var quantityInput = document.getElementById('quantity_' + productId);
        var currentValue = parseInt(quantityInput.value);
        var maxValue = parseInt(quantityInput.getAttribute('max'));

        if (currentValue < maxValue) {
            quantityInput.value = currentValue + 1;
            updateItemTotal(productId, currentValue + 1);
        }
    }

    function decrementQuantityLogIn(productId) {
        var quantityInput = document.getElementById('quantity_' + productId);
        var currentValue = parseInt(quantityInput.value);
        var minValue = parseInt(quantityInput.getAttribute('min'));

        if (currentValue > minValue) {
            quantityInput.value = currentValue - 1;
            updateItemTotal(productId, currentValue - 1);
        }
    }

    function updateItemTempTotal(productId, newQuantity) {
        // Calculate the new temp_total for the item
        var productPriceBefroe = document.getElementById('actual_price_' + productId).textContent;
        var productPrice = parseFloat(productPriceBefroe.replace(/[^\d.]/g, ''));
        console.log(productPrice);
        var discountedPrice = productPrice - (productPrice * 0.15);
        console.log(discountedPrice);
        var tempTotal = newQuantity * discountedPrice;
        console.log(tempTotal);

        // Update the temp_total on the page
        document.getElementById('temp_total_' + productId).textContent = '₹' + tempTotal.toFixed(2);
    }




    // While not logged in basically everything handles in session

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
    <?php if (isset($_SESSION['loggedin']) && isset($_SESSION['userid'])) : ?>
        updateTotalLogIn();
    <?php else : ?>
        updateTotal();
    <?php endif; ?>
</script>


<script src="./scripts/index.js"></script>

<script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>

<script>
    var swiper = new Swiper(".mySwiper", {
        spaceBetween: 10,
        slidesPerView: 4,
        freeMode: true,
        watchSlidesProgress: true,
    });
    var swiper2 = new Swiper(".mySwiper2", {
        spaceBetween: 10,
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },
        thumbs: {
            swiper: swiper,
        },
    });
</script>
</body>

</html>