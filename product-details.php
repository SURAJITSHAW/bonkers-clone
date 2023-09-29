<?php
session_start();
        // if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
        //     header('location: login.php');
        //     exit;
        // }
        $conn = mysqli_connect("localhost", "root", "", "bonkers") or die("Connection Failed");

if (isset($_POST['add-cart'])) {

    if(isset($_SESSION['loggedin']) && isset($_SESSION['userid'])) {
        $p_id = $_POST['p_id'];
        $quantity = $_POST['quantity'];
        /* if youre logged in and want to add a product in the cart: */

        //    1. if the product is already in the cart -> just add the quantity
        
        $sql_p_exist = "select * from cart where p_id={$p_id}";
        $result_exist = mysqli_query($conn, $sql_p_exist) or die("Query Unsuccessful.");

        if (mysqli_num_rows($result_exist) > 0) {
            while ($row_exist = mysqli_fetch_assoc($result_exist)) {
                $newQuantity = $row_exist['quantity'] +  $quantity;
                $sql1 = "UPDATE `cart` SET `quantity` = {$newQuantity} WHERE `cart`.`p_id` ={$p_id}";
                $result1 = mysqli_query($conn, $sql1) or die("Query Unsuccessful.");
            }
        }
        //    2. or the product isn't in the cart -> insert it
        else {
                $sql1 = "INSERT INTO `cart` (`user_id`, `p_id`, `quantity`) VALUES ({$_SESSION['userid']}, {$p_id}, {$quantity});";
                $result1 = mysqli_query($conn, $sql1) or die("Query Unsuccessful.");
  

        }




    } else {
        if (isset($_SESSION['cart'])) {

            $item_arr_id = array_column($_SESSION['cart'], 'p_id');

            if (in_array($_POST['p_id'], $item_arr_id)) {
                echo "<script>
                alert('Product is already in the cart')
            </script>";
                echo "<script>
                document.referrer
            </script>";
            } else {
                $count = count($_SESSION['cart']);
                $item_arr = array(
                    'p_id' => $_POST['p_id'],
                    'quantity' => $_POST['quantity']
                );
                $_SESSION['cart'][$count] = $item_arr;
            }
        }
        // If session variable cart isn't set
        else {
            $item_arr = array(
                'p_id' => $_POST['p_id'],
                'quantity' => $_POST['quantity']
            );

            $_SESSION['cart'][0] = $item_arr;
        }
    }

}

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


                            <form action="" method="post">
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

                                <button class="btn">
                                    <i class="bi bi-heart"></i> Wishlist
                                </button>
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