<?php
session_start();
// if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
//     header('location: login.php');
//     exit;
// }

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <!-- Css links -->
    <link rel="stylesheet" href="./CSS/style.css" />
    <link rel="stylesheet" href="./CSS/index.css" />

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />

    <!-- bootstrap link -->
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

        <main>
            <!-- carousel Section -->
            <div class="carousel" data-carousel>
                <a class="carousel-button prev" data-carousel-button="prev"><i class="bi bi-chevron-left"></i></a>
                <a class="carousel-button next" data-carousel-button="next"><i class="bi bi-chevron-right"></i></a>
                <ul data-slides>



                    <li class="slide" data-active>
                        <a href="www.google.com">
                            <img src="./assets/images/landing/Disney_landing_web_banner.jpg" alt="" />
                        </a>
                    </li>



                    <li class="slide">
                        <a href="products.php?cat=16">
                            <img src="./assets/images/landing/Marvel_landing_web_banner.jpg" alt="" />
                        </a>
                    </li>
                    <li class="slide">
                        <a href="products.php?cat=10">
                            <img src="./assets/images/landing/webbanner_mens.jpg" alt="" />
                        </a>
                    </li>
                    <li class="slide">
                        <a href="products.php">
                            <img src="./assets/images/landing/webbanner_womens.jpg" alt="" />
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Gender Category Section -->
            <div class="gender">
                <a href="products.php?cat=12">
                    <img src="./assets/images/womens_5-1.jpg" alt="" />
                </a>
                <a href="products.php?cat=10">
                    <img src="./assets/images/mens_2-1-1.jpg" alt="" />
                </a>
            </div>

            <!-- Featured Collection section -->
            <div class="collection">
                <a href="products.php">
                    <img src="./assets/images/10.jpg" alt="" />
                </a>
                <a href="products.php?cat=15">
                    <img src="./assets/images/9.jpg" alt="" />
                </a>
                <a href="products.php?sub=28">
                    <img src="./assets/images/8.jpg" alt="" />
                </a>
                <a href="products.php?cat=16">
                    <img src="./assets/images/7.jpg" alt="" />
                </a>
            </div>

            <!-- Hero Offer section -->
            <div class="hero-section">
                <a href="products.php">
                    <img src="./assets/images/offergif-1.gif" alt="" />
                </a>
            </div>

            <!-- Category section -->
            <div class="categories">
                <div class="section-title">Categories</div>
                <div class="category-sliders">
                    <div class="swiper mySwiper">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide">
                                <a href="products.php">
                                    <img src="./assets/images/categories/mensOST.jpg" alt="" class="category-image" />
                                </a>
                            </div>
                            <div class="swiper-slide">
                                <a href="products.php">
                                    <img src="./assets/images/categories/womensOST.jpg" alt="" class="category-image" />
                                </a>
                            </div>
                            <div class="swiper-slide">
                                <a href="products.php">
                                    <img src="./assets/images/categories/mensbasic.jpg" alt="" class="category-image" />
                                </a>
                            </div>
                            <div class="swiper-slide">
                                <a href="products.php">
                                    <img src="./assets/images/categories/womensbasic.jpg" alt="" class="category-image" />
                                </a>
                            </div>
                            <div class="swiper-slide">
                                <a href="products.php">
                                    <img src="./assets/images/categories/mensbottom.jpg" alt="" class="category-image" />
                                </a>
                            </div>
                            <div class="swiper-slide">
                                <a href="products.php">
                                    <img src="./assets/images/categories/womensbottom.jpg" alt="" class="category-image" />
                                </a>
                            </div>
                            <div class="swiper-slide">
                                <a href="products.php">
                                    <img src="./assets/images/categories/menssweat.jpg" alt="" class="category-image" />
                                </a>
                            </div>
                            <div class="swiper-slide">
                                <a href="products.php">
                                    <img src="./assets/images/categories/womenssweat.jpg" alt="" class="category-image" />
                                </a>
                            </div>
                        </div>
                        <div class="swiper-pagination"></div>
                    </div>
                </div>
            </div>

            <!-- New Arrival section -->
            <div class="new-arrival">
                <div class="section-title">Best Sellers</div>
                <div class="product-showcase">
                    <?php
                    $conn = mysqli_connect("localhost", "root", "", "bonkers") or die("Connection Failed");
                    $sql = "SELECT * FROM product LIMIT 4";
                    $result = mysqli_query($conn, $sql) or die("Query Execution Failed");

                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_array($result)) {
                    ?>
                            <!-- Product Card component -->
                            <a href="product-details.php?id=<?php echo $row['p_id']; ?>">
                                <div class="product-card">
                                    <img src=<?php echo "../bonkerscorner.com/uploads/" . $row['p_img']; ?> alt="" />
                                    <div class="product-data">
                                        <p class="category-details">Best Seller</p>
                                        <p class="product-name"><?php echo $row['p_name'] ?></p>
                                        <div class="product-price">
                                            <p class="original-price">
                                                ₹<span><?php echo $row['p_price'] ?></span>
                                            </p>
                                            <p class="discounted-price">
                                                ₹<span><?php echo $row['p_price'] * .85; ?></span>
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
                    <?php
                        }
                    }
                    ?>
                </div>
            </div>

            <!-- Best Seller section -->
            <div class="best-seller">
                <div class="Section-title"></div>
            </div>
            <!-- Features section -->
            <div class="features">
                <div class="feature">
                    <img src="./assets/images/feature/shipping_under_48.jpg" class="feature-image" />
                    <div class="feature-title">
                        <p>SHIPPING WITHIN 48 HOURS</p>
                    </div>
                    <div class="feature-details">
                        <p>
                            Your order will be shipped within 48 hours from
                            the time since order is placed!
                        </p>
                    </div>
                </div>
                <div class="feature">
                    <img src="./assets/images/feature/free_delivery.jpg" class="feature-image" />
                    <div class="feature-title">
                        <p>5% OFF || FREE DELIVERY</p>
                    </div>
                    <div class="feature-details">
                        <p>
                            5% OFF on Pre-paid orders. Free delivery on COD
                            orders above ₹1499.
                        </p>
                    </div>
                </div>
                <div class="feature">
                    <img src="./assets/images/feature/1592433.jpg" class="feature-image" />
                    <div class="feature-title">
                        <p>MADE IN INDIA</p>
                    </div>
                    <div class="feature-details">
                        <p>
                            Our products are 100% made in India. From raw
                            fabric to the final product!
                        </p>
                    </div>
                </div>
            </div>
        </main>

        <!-- Footer section -->
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

    <!-- Scripts -->
    <script src="./scripts/index.js"></script>
    <script src="./scripts/home.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
    <script>
        var swiper = new Swiper(".mySwiper", {
            slidesPerView: 4,
            spaceBetween: 10,
            freeMode: true,
            autopaly: {
                delay: 250,
                disableOnInteraction: false,
            },
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },
        });
    </script>
</body>

</html>