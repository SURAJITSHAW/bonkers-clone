<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
    header('location: login.php');
    exit;
}

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
                            <form id="sort-form" method="GET">
                                <div class="product-sorting-selection">
                                    <label for="">Sort By: </label>
                                    <select name="sort" id="sort-select">
                                        <option value="relevance" <?php if (isset($_GET['sort']) && $_GET['sort'] === 'relevance') echo 'selected'; ?>>Relevance</option>
                                        <option value="price-low-to-high" <?php if (isset($_GET['sort']) && $_GET['sort'] === 'price-low-to-high') echo 'selected'; ?>>Price Low to High</option>
                                        <option value="price-high-to-low" <?php if (isset($_GET['sort']) && $_GET['sort'] === 'price-high-to-low') echo 'selected'; ?>>Price High to Low</option>
                                        <option value="newest-first" <?php if (isset($_GET['sort']) && $_GET['sort'] === 'newest-first') echo 'selected'; ?>>Newest First</option>
                                    </select>
                                </div>
                            </form>

                            <script>
                                // JavaScript code to handle sorting without changing the URL
                                document.getElementById("sort-select").addEventListener("change", function() {
                                    const selectedSort = document.getElementById("sort-select").value;
                                    const currentURL = window.location.href;
                                    const newURL = updateQueryStringParameter(currentURL, "sort", selectedSort);
                                    window.location.href = newURL;
                                });

                                // Function to update the query string parameter in the URL
                                function updateQueryStringParameter(uri, key, value) {
                                    const re = new RegExp("([?&])" + key + "=.*?(&|$)", "i");
                                    const separator = uri.indexOf("?") !== -1 ? "&" : "?";
                                    if (uri.match(re)) {
                                        return uri.replace(re, "$1" + key + "=" + value + "$2");
                                    } else {
                                        return uri + separator + key + "=" + value;
                                    }
                                }
                            </script>
                        </div>
                    </div>
                    <?php
                    // Number of products to display per page
                    $productsPerPage = 8;

                    // Current page, default to 1 if "page" parameter is not set
                    $currentpage = isset($_GET['page']) ? $_GET['page'] : 1;

                    // Default sorting option
                    $defaultSort = "relevance";

                    // Get the selected sorting option from the form (if submitted)
                    if (isset($_GET['sort'])) {
                        $sortOption = $_GET['sort'];
                    } else {
                        $sortOption = $defaultSort;
                    }

                    // Define your SQL query for product retrieval based on sorting option
                    if (isset($_GET['sub'])) {
                        $subCat = $_GET['sub'];

                        $sql = "SELECT * FROM product AS p JOIN category AS c 
                                ON p.category_id = c.category_id WHERE p.sub_category_id='$subCat'";
                    } else if (isset($_GET['cat'])) {
                        $cat = $_GET['cat'];

                        $sql = "SELECT * FROM product AS p JOIN category AS c 
                                ON p.category_id = c.category_id WHERE p.category_id='$cat'";
                    } else {
                        $sql = "SELECT * FROM 
                                product AS p JOIN category AS c 
                                ON p.category_id = c.category_id";
                    }

                    // Handle sorting based on the selected option
                    switch ($sortOption) {
                        case "price-low-to-high":
                            $sql .= " ORDER BY p.p_price ASC";
                            break;
                        case "price-high-to-low":
                            $sql .= " ORDER BY p.p_price DESC";
                            break;
                        case "newest-first":
                            $sql .= " ORDER BY p.p_id DESC";
                            break;
                        default:
                            // For "relevance" or unknown options, no specific sorting is applied
                            break;
                    }

                    // Count the total number of products
                    $resultCount = mysqli_query($conn, $sql);
                    $totalCount = mysqli_num_rows($resultCount);

                    // Calculate the OFFSET for SQL query
                    $offset = ($currentpage - 1) * $productsPerPage;

                    // Modify your SQL query to retrieve a specific set of products
                    $sql .= " LIMIT $offset, $productsPerPage";

                    $result = mysqli_query($conn, $sql) or die("Query Unsuccessful.");
                    ?>


                    <div class="product-listing">
                        <?php


                        // Your product listing code

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




                    <!-- Your HTML code for pagination -->
                    <div class="products-pagination">
                        <ul>
                            <?php
                            // Calculate the total number of pages
                            $totalPages = ceil($totalCount / $productsPerPage);

                            // Display "Previous" button
                            if ($currentpage > 1) {
                                echo '<li class="pagination-button"><a href="?page=' . ($currentpage - 1) . '&sort=' . $sortOption . '"><i class="bi bi-arrow-left"></i></a></li>';
                            }

                            // Display page numbers
                            for ($i = 1; $i <= $totalPages; $i++) {
                                echo '<li class="page-number"><a href="?page=' . $i . '&sort=' . $sortOption . '">' . $i . '</a></li>';
                            }

                            // Display "Next" button
                            if ($currentpage < $totalPages) {
                                echo '<li class="pagination-button"><a href="?page=' . ($currentpage + 1) . '&sort=' . $sortOption . '"><i class="bi bi-arrow-right"></i></a></li>';
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