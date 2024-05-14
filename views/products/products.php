<?php
<<<<<<< Updated upstream
// include ("../../database/query_database/products_function.php");
include("../../database/query_database/products.php");
$category = getCategory();
$ingredient = getIngredient();
$product_bottom = getProductBottomTable();
$product_right = getProductRightTable();
$i = 0;
=======
include ("../../database/query_database/products.php");
$category = getCategory();
$ingredient = getIngredient();
// $productData = getProduct();

>>>>>>> Stashed changes
?>

<!doctype html>
<html lang="en">

<head>
    <title>Products</title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!-- Bootstrap CSS v5.2.1 -->
<<<<<<< Updated upstream
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
    <link rel="stylesheet" href="../../public/css/products.css">
    <link rel="stylesheet" href="../../public/css/header.css">
</head>

<body>
    <?php
    include("../includes/header.php");
    ?>
    <main>
        
        <div class="container">
            <h2 class="my-5 ">
                <!-- The result for
                <span class="search_result">"russian salad"</span> Search result -->
            </h2>
        </div>
        <div class="container">
            <div class="row">
                <!--Left table-->
                <div class="col-lg-4">
                    <div class="d-flex my-2">
                        <h3>
                            Filter the Food
                        </h3>
                        <button type="button" class="btn btn-danger dropdown-toggle ms-auto" data-bs-toggle="dropdown" aria-expanded="false">Sort</button>
                        <ul name="sort" id="" class="dropdown-menu">
                            <li><a class="dropdown-item " href="">Sort</a></li>
                            <li><a class="dropdown-item " href="">Name</a></li>
                        </ul>
                    </div>
                    <form action="" method="GET">
                        <table id="table" class="">
                            <tr class="border_top">
                                <th>
                                    Category
                                </th>
                            </tr>
                            <tr>
=======
   
    <link rel="stylesheet" href="../../public/css/products.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../../public/css/header.css"> 
     <link rel="stylesheet" href="../../public/css/style.css">
    <link rel="stylesheet" href="../../public/css/footer.css">
    <style>
        .min-max label {
            /* font-size: 14px; */
            float: left;
            margin-right: 5px;
            /* line-height: 1.6; */
        }

        .min {
            float: left;
        }

        .max {
            float: right;
        }

        /* .min-max {
                width: 90%;
                max-width: 250px;
                margin: 0 auto;
                padding: 25px 0px 15px 0px;
            } */

        .min-max span {
            text-align: center;
            display: inline-block;
            width: 50px;
            border: 1px solid #dedede;
        }

        .min-max-range {
            padding: 30px 0px 20px 0px;
        }

        .range {
            -webkit-appearance: none;
            appearance: none;
            width: 50%;
            height: 10px;
            max-width: 400px;
            background-color: #dedede;
            outline: none;
            float: left;
        }

        #min {
            border-top-left-radius: 50px;
            border-bottom-left-radius: 50px;
        }

        #max {
            border-top-right-radius: 50px;
            border-bottom-right-radius: 50px;
        }

        .range::-webkit-slider-thumb {
            -webkit-appearance: none;
            appearance: none;
            background-color: #0070BF;
            height: 20px;
            width: 20px;
            border-radius: 50%;
            cursor: pointer;
        }

        .range::moz-range-thumb {
            -webkit-appearance: none;
            appearance: none;
            background-color: #0070BF;
            height: 10px;
            width: 10px;
            border-radius: 50%;
            cursor: pointer;
        }

        .wishlist-link {
            color: #ff9a62 !important;
        }

        .wishlist-link.wished {
            color: #ff9a62 !important;
        }
    </style>
</head>

<body>
    <header>
        <?php
        include ("../includes/header.php");
        ?>
    </header>

    <main class="container my-4">
        <div class="fs-3">
            <span class="fw-bold">Search results: </span>
            <span class="results_search">balls</span>
            
        </div>

        <div class="row my-3">
            <div class="col-12 col-md-4 py-3">
                <div class="row">
                    <div class="col-6 text-center fs-5 fw-semibold">
                        <span>Filter the food</span>
                    </div>
                    <div class="col-6">
                        <select class="form-select form-select-md mx-auto" style="width: fit-content;">
                            <option selected>Sort</option>
                            <option value="name">Name</option>
                            <option value="rating">Rating</option>
                            <option value="time">Time</option>
                        </select>
                    </div>
                    <hr class="my-3">
                </div>

                <button class="btn btn-primary d-lg-none" type="button" data-bs-toggle="offcanvas"
                    data-bs-target="#offcanvasResponsive" aria-controls="offcanvasResponsive">Filter</button>

                <div class="offcanvas-lg offcanvas-end" tabindex="-1" id="offcanvasResponsive"
                    aria-labelledby="offcanvasResponsiveLabel">
                    <div class="offcanvas-header">
                        <h5 class="offcanvas-title" id="offcanvasResponsiveLabel">Filter</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="offcanvas"
                            data-bs-target="#offcanvasResponsive" aria-label="Close"></button>
                    </div>

                    <div class="offcanvas-body">
                        <form action="">
                            <div class="row">
                                <div class="col-12 fs-5 fw-semibold">
                                    <span>Category</span>
                                </div>
                                <div class="col-6 ">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked">
                                        <label class="form-check-label" for="flexCheckChecked">
                                            All
                                        </label>
                                    </div>
                                </div>
>>>>>>> Stashed changes
                                <?php
                                if ($category->num_rows > 0) {
                                    $i = 0;
                                    while ($row = $category->fetch_assoc()) {
                                        $i++;
<<<<<<< Updated upstream
                                        if ($i > 3) {
                                            $i = 1;
                                            echo "</tr><tr>";
                                        }
                                ?>
                                        <td>
                                            <input type="checkbox" name="search" value="<?php echo $row["category_id"]; ?>">
                                            <?php echo $row["category_name"]; ?>
                                        </td>
                                <?php
                                    }
                                }
                                ?>
                            <tr class="border_top">
                                <th>
                                    Level
                                </th>
                            </tr>
                            <tr class="border_bottom">
                                <td>
                                    <input type="radio" name="level" id="easy" value="easy">
                                    Easy
                                </td>
                                <td>
                                    <input type="radio" name="level" id="medium" value="medium">
                                    Medium
                                </td>
                                <td>
                                    <input type="radio" name="level" id="difficult" value="difficult">
                                    Difficult
                                </td>
                            </tr>
                            <tr class="border_top">
                                <th>
                                    Cooking time
                                </th>
                            </tr>
                            <tr>
                                <td colspan="3" class="text-center">
                                    <input type="range" class="form-range" name="cooking_time" id="cooking_time" value="45" min="5" max="45" step="5">
                                    <br>
                                    <span id="cooking_time_output">
                                        Up to 45 minutes
                                        <script>
                                            document.getElementById("cooking_time").addEventListener("change", cookingTimeChange);

                                            function cookingTimeChange() {
                                                document.getElementById("cooking_time_output").innerHTML = "Up to " + document.getElementById("cooking_time").value + " minutes";
                                            }
                                        </script>
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="3" class="text-center">
                                    <input type="submit" value="Filter" id="submit" class="btn my-2">
                                </td>
                            </tr>
                        </table>
                    </form>
                </div>
                <!--Right table-->
                <?php
                if ($product_right->num_rows > 0) {
                    $i = 3;
                    while ($row = $product_right->fetch_assoc()) {
                        $i++;
                        if ($i > 3) {
                            $i = 1;
                            echo "<div class=\"col-lg-2\">";
                        }
                ?>
                        <div class="container mb-4 product_tab">
                        <img src="<?php echo getImage($row["quick_snack_id"])["address_img"]?>" alt="" class="product_image pt-3"><br>
                        <span class="product_category"><?php echo $row["category_name"] ?></span>
                        <h5 class="product_name mt-1 mb-0"><?php echo $row["name"] ?></h5>
                        <div style="text-align: left;">
                            <span class="product_time"><?php echo $row["time"]; ?></span>
                            <span class="product_rating"><?php echo $row["avg_rating"]; ?></span>
                        </div>
                        <span class="product_icon mb-3">Icon</span>
                    </div>
                <?php
                        if ($i == 3) {
                            echo "</div>";
                        }
                    }
                }
                ?>
            </div>
        </div>
        </div>

        <!--Bottom Table-->
        <div class="container">
            <h3>
                Recommended QuickFoods
            </h3>
            <div class="row">
                <?php
                if ($product_bottom->num_rows > 0) {
                    $i = 0;
                    while ($row = $product_bottom->fetch_assoc()) {
                        $i++;
                        if ($i > 4) {
                            break;
                        }
                ?>
                        <div class="col-xxl-3">
                            <div class="container product_tab bottom_table_tab">
                                <img src="<?php echo getImage($row["quick_snack_id"])["address_img"] ?>" alt="" class="product_image pt-3"><br>
                                <span class="product_category"><?php echo $row["category_name"] ?></span>
                                <h5 class="product_name mt-1 mb-0"><?php echo $row["name"] ?></h5>
                                <div style="text-align: left;">
                                    <span class="product_time"><?php echo $row["time"] ?></span>
                                    <span class="product_rating"><?php echo $row["avg_rating"] ?></span>
                                </div>
                                <span class="product_icon mb-3">Icon</span>
                            </div>
                        </div>
                <?php
                    }
                }
                ?>
                <div class="text-center my-5">
                    <button type="button" class="btn" id="load_more">Load more</button>
                </div>
            </div>
    </main>
    <?php include("../includes/footer.php") ?>
    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
    <script>
=======
                                        if ($i < 6) {
                                            // $i = 1;
                                
                                            ?>
                                            <div class="col-6">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox"
                                                        value="<?php echo $row["category_id"]; ?>" id="flexCheckChecked">
                                                    <label class="form-check-label text-wrap" for="flexCheckChecked">
                                                        <?php echo $row["category_name"]; ?>
                                                    </label>
                                                </div>
                                            </div>
                                            <?php
                                        } else {
                                            ?>
                                            <div class="col-6">
                                                <div class="collapse" id="category">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox"
                                                            value="<?php echo $row["category_id"]; ?>" id="flexCheckChecked">
                                                        <label class="form-check-label text-wrap" for="flexCheckChecked">
                                                            <?php echo $row["category_name"]; ?>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php
                                        }
                                    }
                                    ?>
                                    <div class="col-12 text-center">
                                        <a class="" data-bs-toggle="collapse" href="#category" role="button"
                                            aria-expanded="false" aria-controls="collapseExample">
                                            See more
                                        </a>
                                    </div>
                                    <?php
                                }
                                ?>
                                <hr class="my-3">
                            </div>

                            <div class="row">
                                <div class="col-12 fs-5 fw-semibold">
                                    <span>Category</span>
                                </div>
                                <div class="col-6 ">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked">
                                        <label class="form-check-label" for="flexCheckChecked">
                                            All
                                        </label>
                                    </div>
                                </div>
                                <?php
                                if ($ingredient->num_rows > 0) {
                                    $i = 0;
                                    while ($row = $ingredient->fetch_assoc()) {
                                        $i++;
                                        if ($i < 6) {

                                            ?>
                                            <div class="col-6 ">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox"
                                                        value="<?php echo $row["ingredient_id"]; ?>" id="flexCheckChecked">
                                                    <label class="form-check-label text-wrap" for="flexCheckChecked">
                                                        <?php echo $row["ingredient_name"]; ?>
                                                    </label>
                                                </div>
                                            </div>
                                            <?php
                                        } else {
                                            ?>
                                            <div class="col-6 ">
                                                <div class="collapse" id="ingredient">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox"
                                                            value="<?php echo $row["ingredient_id"]; ?>" id="flexCheckChecked">
                                                        <label class="form-check-label text-wrap" for="flexCheckChecked">
                                                            <?php echo $row["ingredient_name"]; ?>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php
                                        }
                                    }
                                    ?>
                                    <div class="col-12 text-center">
                                        <a class="" data-bs-toggle="collapse" href="#ingredient" role="button"
                                            aria-expanded="false" aria-controls="collapseExample">
                                            See more
                                        </a>
                                    </div>
                                    <?php
                                }
                                ?>

                                <hr class="my-3">
                            </div>

                            <div class="row">
                                <div class="col-12 fs-5 fw-semibold">
                                    <span>Level</span>
                                </div>
                                <div class="col-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked">
                                        <label class="form-check-label" for="flexCheckChecked">
                                            Easy
                                        </label>
                                    </div>
                                </div>
                                <div class="col-4 ">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked">
                                        <label class="form-check-label text-wrap" for="flexCheckChecked">
                                            Medium
                                        </label>
                                    </div>
                                </div>
                                <div class="col-4 ">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked">
                                        <label class="form-check-label text-wrap" for="flexCheckChecked">
                                            Difficult
                                        </label>
                                    </div>
                                </div>
                                <hr class="my-3">
                            </div>

                            <div class="row">
                                <div class="col-12 fs-5 fw-semibold">
                                    <span>Cooking Time</span>
                                </div>
                                <div class="col-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked">
                                        <label class="form-check-label" for="flexCheckChecked">
                                            Easy
                                        </label>
                                    </div>
                                </div>
                                <div class="col-4 ">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked">
                                        <label class="form-check-label text-wrap" for="flexCheckChecked">
                                            Medium
                                        </label>
                                    </div>
                                </div>
                                <div class="col-4 ">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked">
                                        <label class="form-check-label text-wrap" for="flexCheckChecked">
                                            Difficult
                                        </label>
                                    </div>
                                </div>
                                <div class="col-12 my-3">
                                    <div class=" row min-max justify-content-center">
                                        <div class="min col-5">
                                            <label class="fs-4">Min</label><span id="min-value" class="fs-5"></span>
                                        </div>
                                        <div class="max col-5">
                                            <label class="fs-4">Max</label><span id="max-value" class="fs-5"></span>
                                        </div>
                                    </div>

                                    <div class="min-max-range">
                                        <input type="range" min="0" max="30" value="0" class="range" id="min">
                                        <input type="range" min="31" max="60" value="60" class="range" id="max">
                                    </div>
                                </div>
                                <hr class="my-3">
                            </div>

                            <div class="row">
                                <input type="submit" value="Filter">
                            </div>

                        </form>
                    </div>

                </div>
            </div>


            <div class="col-12 col-md-8">

                <?php

                $productsPerPage = 12;
                $current_page = isset($_GET['page']) ? $_GET['page'] : 1;


                $offset = ($current_page - 1) * $productsPerPage;


                $productData = getProductWithPagination($offset, $productsPerPage);


                $totalProducts = getTotalProducts();


                $totalPages = ceil($totalProducts / $productsPerPage);

                ?>
                <div class="row">
                    <?php $count = 0; ?>
                    <?php while ($row = $productData->fetch_assoc()) { ?>
                        <?php if ($count % 4 == 0 && $count > 0) { ?>
                        </div>
                    <?php } ?>
                    <?php if ($count % 4 == 0) { ?>
                        <div class="row">

                        <?php } ?>
                        <div class="col-12 col-md-6 col-xxl-3 mt-2 card_product">
                            <div class="card position-relative" style="height: 100%;">
                                <a
                                    href="../products/product_detail.php?quick_snack_id=<?php echo $row['quick_snack_id']; ?>">

                                    <img src="<?php echo $row['image_address']; ?>" class="img-fluid rounded m-3" alt="..."
                                        style="width: 160px; height: 160px">

                                    <div class="card-body">
                                        <h5 class="card-title">
                                            <?php echo $row['name']; ?>
                                        </h5>
                                        <h6 class="card-subtitle mb-2 text-body-secondary" style="font-size:small">
                                            <?php echo $row['categories']; ?>
                                        </h6>
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="fw-bold">
                                                    Time
                                                </div>
                                                <div>
                                                    <?php echo $row['time']; ?>
                                                </div>
                                            </div>
                                            <div class="col-6 text-end">
                                                <div class="fw-bold">
                                                    Rating
                                                </div>
                                                <span>
                                                    <?php echo $row['average_rating']; ?>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="text-end position-absolute bottom-0 end-0 me-3 pt-4">
                                            <?php
                                            if (isset($_COOKIE['userID'])) {
                                                $user_id = $_COOKIE['userID'];
                                                $isInWishlist = isInWishlist($detailRow['quick_snack_id'], $conn, $user_id);

                                                ?>
                                                <a
                                                    href="../../models/products/products_detail.php?product_id=<?php echo $detailRow['quick_snack_id'] ?>">
                                                    <?php ($isInWishlist ? '<i class="fa-solid fa-bookmark wishlist-link.wished"></i>' : '<i class="far fa-bookmark wishlist-link" id="favoriteIcon"></i>') ?>"
                                                </a>
                                                <?php
                                            } else {
                                                ?>
                                                <a href="../../views//auth/SignIn.html" class="wishlist-link">Login to add to
                                                    wishlist</a>
                                                <?php
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <?php $count++; ?>
                    <?php } ?>
                </div>

                <!-- Pagination -->
            </div>
            <div class="row mt-4">
                <div class="d-flex justify-content-center">
                    <ul class="pagination">
                        <li class="page-item <?php echo ($current_page == 1) ? 'disabled' : ''; ?>">
                            <a class="page-link" href="?page=<?php echo ($current_page - 1); ?>" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                            </a>
                        </li>
                        <?php for ($page = 1; $page <= $totalPages; $page++) { ?>
                            <li class="page-item <?php echo ($current_page == $page) ? 'active' : ''; ?>">
                                <a class="page-link" href="?page=<?php echo $page; ?>">
                                    <?php echo $page; ?>
                                </a>
                            </li>
                        <?php } ?>
                        <li class="page-item <?php echo ($current_page == $totalPages) ? 'disabled' : ''; ?>">
                            <a class="page-link" href="?page=<?php echo ($current_page + 1); ?>" aria-label="Next">
                                <span aria-hidden="true">&raquo;</span>
                            </a>
                        </li>
                    </ul>

                </div>

            </div>
        </div>

        <div class="my-5">
            <h1>Recomment</h1>
            <div class="row">
                <div class="col-12 col-md-6 col-xxl-3 my-2">
                    <div class="card">
                        <div style="width: 160px; height: 160px" class="mx-auto py-4"><img
                                src="../../public/image/product/Bagel Bites1.jpg" class="img-fluid rounded" alt="...">
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">Sản phẩm</h5>
                            <h6 class="card-subtitle mb-2 text-body-secondary" style="font-size:small">Card subtitle
                            </h6>
                            <div class="row">
                                <div class="col-6">
                                    <span>Time</span>
                                </div>
                                <div class="col-6 text-end">
                                    <span>Rating</span>
                                </div>
                            </div>

                            <div class="text-end"><a href="#">Add</a></div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-xxl-3 mt-2">
                    <div class="card">
                        <div style="width: 160px; height: 160px" class="mx-auto py-4"><img
                                src="../../public/image/product/Bagel Bites1.jpg" class="img-fluid rounded" alt="...">
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">Sản phẩm</h5>
                            <h6 class="card-subtitle mb-2 text-body-secondary" style="font-size:small">Card subtitle
                            </h6>
                            <div class="row">
                                <div class="col-6">
                                    <span>Time</span>
                                </div>
                                <div class="col-6 text-end">
                                    <span>Rating</span>
                                </div>
                            </div>

                            <div class="text-end"><a href="#">Add</a></div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-xxl-3 mt-2">
                    <div class="card">
                        <div style="width: 160px; height: 160px" class="mx-auto py-4"><img
                                src="../../public/image/product/Bagel Bites1.jpg" class="img-fluid rounded" alt="...">
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">Sản phẩm</h5>
                            <h6 class="card-subtitle mb-2 text-body-secondary" style="font-size:small">Card subtitle
                            </h6>
                            <div class="row">
                                <div class="col-6">
                                    <span>Time</span>
                                </div>
                                <div class="col-6 text-end">
                                    <span>Rating</span>
                                </div>
                            </div>

                            <div class="text-end"><a href="#">Add</a></div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-xxl-3 mt-2">
                    <div class="card">
                        <div style="width: 160px; height: 160px" class="mx-auto py-4"><img
                                src="../../public/image/product/Bagel Bites1.jpg" class="img-fluid rounded" alt="...">
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">Sản phẩm</h5>
                            <h6 class="card-subtitle mb-2 text-body-secondary" style="font-size:small">Card subtitle
                            </h6>
                            <div class="row">
                                <div class="col-6">
                                    <span>Time</span>
                                </div>
                                <div class="col-6 text-end">
                                    <span>Rating</span>
                                </div>
                            </div>

                            <div class="text-end"><a href="#">Add</a></div>
                        </div>
                    </div>
                </div>
            </div>

    </main>

    <header>
        <?php
        include ("../includes/footer.php")
            ?>
    </header>

    <script src="https://kit.fontawesome.com/54dbfefd83.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
        crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
        crossorigin="anonymous"></script>

    <script>
        var minSlider = document.getElementById('min');
        var maxSlider = document.getElementById('max');

        var outputMin = document.getElementById('min-value');
        var outputMax = document.getElementById('max-value');

        outputMin.innerHTML = minSlider.value;
        outputMax.innerHTML = maxSlider.value;

        minSlider.oninput = function () {
            outputMin.innerHTML = this.value;
        }

        maxSlider.oninput = function () {
            outputMax.innerHTML = this.value;
        }
>>>>>>> Stashed changes
    </script>
</body>

</html>