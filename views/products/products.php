<?php 
include("../../database/connect_database/index.php");
include("../../database/query_database/products.php");

$category = getCategory();
$ingredient = getIngredient();

$filters = [];
if (isset($_GET['filter'])) {
    $filters = [
        'category' => isset($_GET['category']) ? $_GET['category'] : [],
        'ingredient' => isset($_GET['ingredient']) ? $_GET['ingredient'] : [],
        'level' => isset($_GET['level']) ? $_GET['level'] : [],
        'time_min' => isset($_GET['time_min']) ? $_GET['time_min'] : 0,
        'time_max' => isset($_GET['time_max']) ? $_GET['time_max'] : 60,
    ];
}

// Xử lý trang hiện tại (mặc định là trang 1)
$numberOfpage = isset($_GET['page']) ? intval($_GET['page']) : 1;

// Gọi hàm getProduct với filter và page
$result = getProduct($filters, $numberOfpage);
$productData = $result['products'];
$total_pages = $result['total_pages'];
?>

<!doctype html>
<html lang="en">

<head>
    <title>Food</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <link rel="stylesheet" href="../../public/css/products.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../../public/css/header.css">
    <link rel="stylesheet" href="../../public/css/style.css">
    <link rel="stylesheet" href="../../public/css/footer.css">
    <style>
        .min-max label {
            float: left;
            margin-right: 5px;
        }

        .min {
            float: left;
        }

        .max {
            float: right;
        }

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

        .wishlist-link-wished {
            color: #ff9a62 !important;
        }

        .pages a {
            margin: 0 5px;
            padding: 5px;
            border: 1px solid #ccc;
            border-radius: 5px;
            text-decoration: none;
            color: #333;
        }

        .pages a:hover {
            background-color: #f2f2f2;
        }

        .pages .page_active {
            background-color: #E37E21;
            color: #fff;
        }
    </style>
</head>

<body>
    <header>
        <?php
        include("../includes/header.php");
        ?>
    </header>

    <main class="container my-4">
        <div class="fs-3">
            <span class="fw-bold">Search results: </span>
            <span class="results_search">balls</span>
        </div>

        <div class="row my-3">
            <div class="col-12 col-md-3 py-3">
                <div class="row">
                    <div class="col-6 text-center fs-5 fw-semibold">
                        <span>Filter the food</span>
                    </div>
                    <div class="col-6">
                        <select id="sortDropdown" class="form-select form-select-md mx-auto sort" style="width: fit-content;" onchange="sortProducts(this.value)">
                            <option selected value="default" class="option">Sort</option>
                            <option value="name" class="option">Name</option>
                            <option value="rating" class="option">Rating</option>
                            <option value="time" class="option">Time</option>
                        </select>
                    </div>
                    <hr class="my-3">
                </div>

                <button class="btn btn-primary d-lg-none" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasResponsive" aria-controls="offcanvasResponsive">Filter</button>

                <div class="offcanvas-lg offcanvas-end" tabindex="-1" id="offcanvasResponsive" aria-labelledby="offcanvasResponsiveLabel">
                    <div class="offcanvas-header">
                        <h5 class="offcanvas-title" id="offcanvasResponsiveLabel">Filter</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" data-bs-target="#offcanvasResponsive" aria-label="Close"></button>
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
                                <?php
                                if ($category->num_rows > 0) {
                                    $i = 0;
                                    while ($row = $category->fetch_assoc()) {
                                        $isChecked = isset($_GET['category']) && in_array($row['category_id'], $_GET['category']);
                                        $i++;
                                        if ($i < 6) {

                                ?>
                                            <div class="col-6">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="category[]" value="<?php echo $row["category_id"]; ?>" id="category_<?php echo $row["category_id"]; ?>" <?php if ($isChecked)
                                                                                                                                                                                                                        echo 'checked'; ?>>
                                                    <label class="form-check-label text-wrap" for="category_<?php echo $row["category_id"]; ?>">
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
                                                        <input class="form-check-input" type="checkbox" name="category[]" value="<?php echo $row["category_id"]; ?>" id="category_<?php echo $row["category_id"]; ?>" <?php if ($isChecked)
                                                                                                                                                                                                                            echo 'checked'; ?>>
                                                        <label class="form-check-label text-wrap" for="category_<?php echo $row["category_id"]; ?>">
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
                                        <a class="" data-bs-toggle="collapse" href="#category" role="button" aria-expanded="false" aria-controls="collapseExample">
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
                                    <span>Ìgredient</span>
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
                                        $isChecked = isset($_GET['ingredient']) && in_array($row['ingredient_id'], $_GET['ingredient']);
                                        $i++;
                                        if ($i < 6) {

                                ?>
                                            <div class="col-6">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="ingredient[]" value="<?php echo $row["ingredient_id"]; ?>" id="ingredient_<?php echo $row["ingredient_id"]; ?>" <?php if ($isChecked)
                                                                                                                                                                                                                                echo 'checked'; ?>>
                                                    <label class="form-check-label text-wrap" for="ingredient_<?php echo $row["ingredient_id"]; ?>">
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
                                                        <input class="form-check-input" type="checkbox" name="ingredient[]" value="<?php echo $row["ingredient_id"]; ?>" id="ingredient_<?php echo $row["ingredient_id"]; ?>" <?php if ($isChecked)
                                                                                                                                                                                                                                    echo 'checked'; ?>>
                                                        <label class="form-check-label text-wrap" for="ingredient_<?php echo $row["ingredient_id"]; ?>">
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
                                        <a class="" data-bs-toggle="collapse" href="#ingredient" role="button" aria-expanded="false" aria-controls="collapseExample">
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
                                <?php
                                $levels = ['Easy', 'Medium', 'Difficult'];
                                foreach ($levels as $level) {
                                    $isChecked = isset($_GET['level']) && in_array($level, $_GET['level']);
                                ?>
                                    <div class="col-4">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="level[]" value="<?php echo $level; ?>" id="level_<?php echo strtolower($level); ?>" <?php if ($isChecked)
                                                                                                                                                                                        echo 'checked'; ?>>
                                            <label class="form-check-label" for="level_<?php echo strtolower($level); ?>">
                                                <?php echo $level; ?>
                                            </label>
                                        </div>
                                    </div>
                                <?php
                                }
                                ?>
                            </div>

                            <div class="row">
                                <div class="col-12 fs-5 fw-semibold">
                                    <span>Cooking Time</span>
                                </div>
                                <div class="col-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="time_min" value="0" id="time_min_0" <?php if (isset($_GET['time_min']) && $_GET['time_min'] == '5')
                                                                                                                                    echo 'checked'; ?>>
                                        <label class="form-check-label" for="time_min_0">
                                            5 minutes
                                        </label>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="time_min" value="5" id="time_min_5" <?php if (isset($_GET['time_min']) && $_GET['time_min'] == '15')
                                                                                                                                    echo 'checked'; ?>>
                                        <label class="form-check-label" for="time_min_5">
                                            15 minutes
                                        </label>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="time_min" value="15" id="time_min_15" <?php if (isset($_GET['time_min']) && $_GET['time_min'] == '30')
                                                                                                                                        echo 'checked'; ?>>
                                        <label class="form-check-label" for="time_min_15">
                                            30 minutes
                                        </label>
                                    </div>
                                </div>
                                <input type="hidden" name="filter" value="true">
                                <div class="col-12 my-3">
                                    <div class="row min-max justify-content-center">
                                        <div class="min col-5">
                                            <label class="fs-4">Min</label>
                                            <span id="min-value" class="fs-5"></span>
                                        </div>
                                        <div class="max col-5">
                                            <label class="fs-4">Max</label>
                                            <span id="max-value" class="fs-5"></span>
                                        </div>
                                    </div>
                                    <div class="min-max-range">
                                        <input type="range" min="0" max="30" value="<?php echo isset($_GET['time_min']) ? $_GET['time_min'] : '0'; ?>" class="range" id="min" name="time_min">
                                        <input type="range" min="31" max="60" value="<?php echo isset($_GET['time_max']) ? $_GET['time_max'] : '60'; ?>" class="range" id="max" name="time_max">
                                    </div>

                                </div>
                                <hr class="my-3">
                            </div>

                            <input type="hidden" name="filter" value="true">
                            <input type="hidden" name="sort" value="<?php echo isset($_GET['sort']) ? $_GET['sort'] : 'default'; ?>">
                            <div class="row">
                                <button type="submit" class="btn btn-primary">Filter</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>



            <div class="col-12 col-md-9">
                <?php
                $count = 0;
                while ($row = $productData->fetch_assoc()) {
                    if ($count % 4 == 0) {
                        echo '<div class="row">';
                    }
                ?>
                    <div class="col-12 col-md-6 col-xxl-3 mt-2 card_product">
                        <div class="card position-relative" style="height: 100%;">
                            <a href="../products/product_detail.php?quick_snack_id=<?php echo $row['quick_snack_id']; ?>">
                                <img src="<?php echo $row['image_address']; ?>" class="img-fluid rounded m-3" alt="..." style="width: 160px; height: 160px">
                                <div class="card-body">
                                    <h5 class="card-title">
                                        <?php echo $row['name']; ?>
                                    </h5>
                                    <h6 class="card-subtitle mb-2 text-body-secondary" style="font-size: small;">
                                        <?php echo $row['categories']; ?>
                                    </h6>
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="fw-bold">Time</div>
                                            <div><?php echo $row['time']; ?></div>
                                        </div>
                                        <div class="col-6 text-end">
                                            <div class="fw-bold">Rating</div>
                                            <span><?php echo $row['average_rating']; ?></span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                            <div class="text-end position-absolute bottom-0 end-0 me-3 pt-4">
                                <?php
                                if (isset($_COOKIE['userID'])) {
                                    $user_id = $_COOKIE['userID'];
                                    $isInWishlist = isInWishlist($row['quick_snack_id'], $conn, $user_id);
                                ?>
                                    <a href="../../models/products/products_detail.php?product_id=<?php echo $row['quick_snack_id'] ?>">
                                        <?php echo ($isInWishlist ? '<i class="fa-solid fa-bookmark wishlist-link-wished"></i>' : '<i class="far fa-bookmark wishlist-link" id="favoriteIcon"></i>') ?>
                                    </a>
                                <?php
                                } else {
                                ?>
                                    <a href="../../views/auth/SignIn.html" class="wishlist-link">Login to add to wishlist</a>
                                <?php
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                <?php
                    $count++;
                    if ($count % 4 == 0) {
                        echo '</div>';
                    }
                }
                if ($count % 4 != 0) {
                    echo '</div>';
                }
                ?>

                <div class="mx-auto">
                    <div class="pages">
                        <?php for ($i = 1; $i <= $total_pages; $i++) { ?>
                            <a href="?page=<?php echo $i; ?>&filter=true&<?php echo http_build_query($filters); ?>" <?php if ($i == $numberOfpage)
                                                                                                                        echo 'class="page_active"';
                                                                                                                    ?>><?php echo $i; ?></a>
                        <?php } ?>
                    </div>
                </div>
            </div>

        </div>



        <div class="my-5">
            <h1>Recomment</h1>
            <div class="row">
                <div class="col-12 col-md-6 col-xxl-3 my-2">
                    <div class="card">
                        <div style="width: 160px; height: 160px" class="mx-auto py-4"><img src="../../public/image/product/Bagel Bites1.jpg" class="img-fluid rounded" alt="...">
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
                        <div style="width: 160px; height: 160px" class="mx-auto py-4"><img src="../../public/image/product/Bagel Bites1.jpg" class="img-fluid rounded" alt="...">
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
                        <div style="width: 160px; height: 160px" class="mx-auto py-4"><img src="../../public/image/product/Bagel Bites1.jpg" class="img-fluid rounded" alt="...">
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
                        <div style="width: 160px; height: 160px" class="mx-auto py-4"><img src="../../public/image/product/Bagel Bites1.jpg" class="img-fluid rounded" alt="...">
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
        </div>
    </main>

    <footer>
        <?php
        include("../includes/footer.php")
        ?>
    </footer>

    <script src="https://kit.fontawesome.com/54dbfefd83.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>

    <script>
        var minSlider = document.getElementById('min');
        var maxSlider = document.getElementById('max');
        var outputMin = document.getElementById('min-value');
        var outputMax = document.getElementById('max-value');

        var defaultMin = parseInt(minSlider.min);
        var defaultMax = parseInt(maxSlider.max);
        var radioValue = <?php echo isset($_GET['time_min']) ? $_GET['time_min'] : '0'; ?>;
        document.querySelectorAll('input[name="time_min"]').forEach((radio) => {
            radio.addEventListener('change', function() {
                var radioVal = parseInt(this.value);

                if (radioVal < defaultMin) {
                    minSlider.value = defaultMin;
                    maxSlider.value = defaultMax;
                } else if (radioVal > defaultMax) {

                    minSlider.value = defaultMin;
                    maxSlider.value = radioVal;
                } else {

                    minSlider.value = radioVal;
                    maxSlider.value = defaultMax;
                }


                outputMin.innerHTML = minSlider.value;
                outputMax.innerHTML = maxSlider.value;
            });
        });


        minSlider.oninput = function() {

            outputMin.innerHTML = this.value;
        };t

        maxSlider.oninput = function() {

            outputMax.innerHTML = this.value;
        };


        if (radioValue < defaultMin) {

            minSlider.value = defaultMin;
            maxSlider.value = defaultMax;
        } else if (radioValue > defaultMax) {

            minSlider.value = defaultMin;
            maxSlider.value = radioValue;
        } else {

            minSlider.value = radioValue;
            maxSlider.value = defaultMax;
        }


        outputMin.innerHTML = minSlider.value;
        outputMax.innerHTML = maxSlider.value;



        function sortProducts(sortBy) {
            const url = new URL(window.location.href);
            url.searchParams.set('sort', sortBy);
            url.searchParams.set('page', '1'); // Chuyển trang về trang đầu tiên khi thay đổi cách sắp xếp
            window.location.href = url.toString();
        }

        // Hàm để thiết lập giá trị mặc định cho dropdown sort
        function setSortDropdownValue() {
            const urlParams = new URLSearchParams(window.location.search);
            const sortParam = urlParams.get('sort');
            if (sortParam) {
                document.querySelector('.sort').value = sortParam;
            }
        }

        // Gọi hàm setSortDropdownValue khi trang đã load
        document.addEventListener('DOMContentLoaded', setSortDropdownValue);
    </script>
</body>

</html>