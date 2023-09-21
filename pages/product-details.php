<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <link rel="stylesheet" href="../CSS/style.css" />
    <link rel="stylesheet" href="../CSS/product-details.css" />

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

                            <label for="">Size:</label>
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
                            <button class="btn">Add to Cart</button>
                            <button class="btn">
                                <i class="bi bi-heart"></i> Wishlist
                            </button>
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
<div class="featured-products">
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