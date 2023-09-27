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
    <link rel="stylesheet" href="./CSS/products.css" />
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

                        // Define your SQL query here
                        if (isset($_GET['sub'])) {
                            $subCat = $_GET['sub'];

                            $sql = "SELECT * FROM product AS p JOIN category AS c 
                    ON p.category_id = c.category_id WHERE p.sub_category_id='$subCat'";
                        } else  if (isset($_GET['cat'])) {
                            $cat = $_GET['cat'];

                            $sql = "SELECT * FROM product AS p JOIN category AS c 
                    ON p.category_id = c.category_id WHERE p.category_id='$cat'";
                        } else {
                            $sql = "SELECT * FROM 
                    product AS p JOIN category AS c 
                    ON p.category_id = c.category_id";
                        }

                        $result = mysqli_query($conn, $sql) or die("Query Unsuccessful.");

                        // Count the total number of products
                        $totalCount = mysqli_num_rows($result);

                        // Number of products to display per page
                        $productsPerPage = 8;

                        // Current page, default to 1 if "page" parameter is not set
                        $currentpage = isset($_GET['page']) ? $_GET['page'] : 1;

                        // Calculate the OFFSET for SQL query
                        $offset = ($currentpage - 1) * $productsPerPage;

                        // Modify your SQL query to retrieve a specific set of products
                        $sql .= " LIMIT $offset, $productsPerPage";

                        $result = mysqli_query($conn, $sql) or die("Query Unsuccessful.");

                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                        ?>


                                <a href="./product-details.php?id=<?php echo $row['p_id'] ?>">
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
                                                    <?php
                                                    $productPrice = $row['p_price'];
                                                    $discountPercentage = 15;

                                                    $discountAmount = $productPrice * ($discountPercentage / 100);
                                                    $discountedPrice = $productPrice - $discountAmount;

                                                    echo "₹<span>{$discountedPrice}</span>"
                                                    ?>

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
                            <?php
                            // Calculate the total number of pages
                            $totalPages = ceil($totalCount / $productsPerPage);

                            // Display "Previous" button
                            if ($currentpage > 1) {
                                echo '<li class="pagination-button"><a href="?page=' . ($currentpage - 1) . '"><i class="bi bi-arrow-left"></i></a></li>';
                            }

                            // Display page numbers
                            for ($i = 1; $i <= $totalPages; $i++) {
                                echo '<li class="page-number"><a href="?page=' . $i . '">' . $i . '</a></li>';
                            }

                            // Display "Next" button
                            if ($currentpage < $totalPages) {
                                echo '<li class="pagination-button"><a href="?page=' . ($currentpage + 1) . '"><i class="bi bi-arrow-right"></i></a></li>';
                            }
                            ?>
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

    <script src="./scripts/index.js"></script>
</body>

</html>