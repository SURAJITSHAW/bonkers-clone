<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <link rel="stylesheet" href="../CSS/style.css" />
    <link rel="stylesheet" href="../CSS/products.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" />
</head>

<body>
    <div class="container">
        <!-- Header -->
        <?php
        include "navbar.php";
        ?>

        <main>
            <div class="products-page">
                <aside class="products-filter">
                    <p>Filter</p>
                    <input type="range" class="filter-range" />
                    <button class="filter-button">Filter</button>
                </aside>
                <section>
                    <div class="product-sorting">
                        <div class="section-heading">
                            <h1>Products</h1>
                        </div>
                        <div class="product-sorting-actions">
                            <div class="product-showing">
                                Showing Products
                            </div>
                            <div class="product-sorting-selection">
                                <label for="">Sort By: </label>
                                <select placeholder="Sort By">
                                    <option value="">Relevance</option>
                                    <option value="">
                                        Price low to high
                                    </option>
                                    <option value="">
                                        Price high to low
                                    </option>
                                    <option value="">Newest first</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="product-listing">


                        <?php

                        if (isset($_GET['sub'])) {
                            $subCat = $_GET['sub'];

                            $sql = "SELECT * FROM product AS p JOIN category AS c 
                            ON p.category_id = c.category_id WHERE p.sub_category_id='$subCat'";
                        } else {
                            $sql = "SELECT * FROM 
                            product AS p JOIN category AS c 
                            ON p.category_id = c.category_id";
                        }

                        $result = mysqli_query($conn, $sql) or die("Query Unsuccessful.");

                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                        ?>


                                <a href="./product-details.php">
                                    <div class="product-card">
                                        <img src="<?php echo '../../bonkerscorner.com/uploads/' . $row['p_img']; ?>" alt="" />
                                        <div class="product-data">
                                            <p class="category-details"><?php echo $row['category_name']; ?></p>
                                            <p class="product-name"><?php echo $row['p_name']; ?></p>
                                            <div class="product-price">
                                                <p class="original-price">
                                                    ₹<span><?php echo $row['p_price']; ?></span>
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




                        <?php
                            }
                        }
                        ?>







                    </div>
                    <div class="products-pagination">
                        <ul>
                            <li class="pagination-button">
                                <i class="bi bi-arrow-left"></i>
                            </li>
                            <li class="page-number">1</li>
                            <li class="page-number">2</li>
                            <li class="page-number">3</li>
                            <li class="page-number">4</li>
                            <li class="page-number">5</li>
                            <li class="page-number">6</li>
                            <li class="pagination-button">
                                <i class="bi bi-arrow-right"></i>
                            </li>
                        </ul>
                    </div>
                </section>
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