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
</head>

<body>
    <div class="container">
        <!-- Header -->
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
                            <a href="./pages/products.php">
                                <strong> MEN </strong>
                            </a>
                            <ul>
                                <li>
                                    <a href="./pages/products.php">
                                        Top
                                    </a>
                                </li>
                                <li>
                                    <a href="./pages/products.php">
                                        T-Shirt
                                    </a>
                                </li>
                                <li>
                                    <a href="./pages/products.php">
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
                            <a href="./pages/products.php?sub=<?php echo $row['slug']; ?>">
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
                                    <a href="./pages/products.php?sub=<?php echo $row1['slug']; ?>"> <?php echo $row1['name']; ?> </a>
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
                        <a href="./pages/contacts.php">
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

            <div class="nav-cart">
                <a href="./pages/profile.php"><i class="bi bi-person"></i></a><a class="cart-button"><i class="bi bi-cart3"></i></a>
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
                <div><a href="./pages/cart-page.php">View Cart</a></div>
            </div>
        </div>

        <!-- Home Page Main section -->
        <main>
            <!-- carousel Section -->
            <div class="carousel" data-carousel>
                <a class="carousel-button prev" data-carousel-button="prev"><i class="bi bi-chevron-left"></i></a>
                <a class="carousel-button next" data-carousel-button="next"><i class="bi bi-chevron-right"></i></a>
                <ul data-slides>
                    <li class="slide" data-active>
                        <a href="./pages/products.php">
                            <img src="./assets/images/landing/Disney_landing_web_banner.jpg" alt="" />
                        </a>
                    </li>
                    <li class="slide">
                        <a href="./pages/products.php">
                            <img src="./assets/images/landing/Marvel_landing_web_banner.jpg" alt="" />
                        </a>
                    </li>
                    <li class="slide">
                        <a href="./pages/products.php">
                            <img src="./assets/images/landing/webbanner_mens.jpg" alt="" />
                        </a>
                    </li>
                    <li class="slide">
                        <a href="./pages/products.php">
                            <img src="./assets/images/landing/webbanner_womens.jpg" alt="" />
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Gender Category Section -->
            <div class="gender">
                <a href="./pages/products.php">
                    <img src="./assets/images/womens_5-1.jpg" alt="" />
                </a>
                <a href="./pages/products.php">
                    <img src="./assets/images/mens_2-1-1.jpg" alt="" />
                </a>
            </div>

            <!-- Featured Collection section -->
            <div class="collection">
                <a href="./pages/products.php">
                    <img src="./assets/images/10.jpg" alt="" />
                </a>
                <a href="./pages/products.php">
                    <img src="./assets/images/9.jpg" alt="" />
                </a>
                <a href="./pages/products.php">
                    <img src="./assets/images/8.jpg" alt="" />
                </a>
                <a href="./pages/products.php">
                    <img src="./assets/images/7.jpg" alt="" />
                </a>
            </div>

            <!-- Hero Offer section -->
            <div class="hero-section">
                <a href="./pages/products.php">
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
                                <a href="./pages/products.php">
                                    <img src="./assets/images/categories/mensOST.jpg" alt="" class="category-image" />
                                </a>
                            </div>
                            <div class="swiper-slide">
                                <a href="./pages/products.php">
                                    <img src="./assets/images/categories/womensOST.jpg" alt="" class="category-image" />
                                </a>
                            </div>
                            <div class="swiper-slide">
                                <a href="./pages/products.php">
                                    <img src="./assets/images/categories/mensbasic.jpg" alt="" class="category-image" />
                                </a>
                            </div>
                            <div class="swiper-slide">
                                <a href="./pages/products.php">
                                    <img src="./assets/images/categories/womensbasic.jpg" alt="" class="category-image" />
                                </a>
                            </div>
                            <div class="swiper-slide">
                                <a href="./pages/products.php">
                                    <img src="./assets/images/categories/mensbottom.jpg" alt="" class="category-image" />
                                </a>
                            </div>
                            <div class="swiper-slide">
                                <a href="./pages/products.php">
                                    <img src="./assets/images/categories/womensbottom.jpg" alt="" class="category-image" />
                                </a>
                            </div>
                            <div class="swiper-slide">
                                <a href="./pages/products.php">
                                    <img src="./assets/images/categories/menssweat.jpg" alt="" class="category-image" />
                                </a>
                            </div>
                            <div class="swiper-slide">
                                <a href="./pages/products.php">
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
                    <!-- Product Card component -->
                    <a href="./pages/product-details.php">
                        <div class="product-card">
                            <img src="./assets/images/product/Bonkerscorner_black_wide_leg_sweatpants_8660-1-768x1152.jpg" alt="" />
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
                    <a href="./pages/product-details.php">
                        <div class="product-card">
                            <img src="./assets/images/product/Bonkerscorner_blue-top_05-768x1152.jpg" alt="" />
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
                    <a href="./pages/product-details.php">
                        <div class="product-card">
                            <img src="./assets/images/product/20230725_060209000_iOS-4-768x1152.jpg" alt="" />
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
                    <a href="./pages/product-details.php">
                        <div class="product-card">
                            <img src="./assets/images/product/Bonkerscorner_green-derss_03-1-768x1152.jpg" alt="" />
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