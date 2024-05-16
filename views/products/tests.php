<?php
include("../../database/connect_database/index.php");

function getCategory()
{
    global $conn;
    $smtc = $conn->prepare("SELECT * FROM category");
    $smtc->execute();
    $result = $smtc->get_result();
    return $result;
}

function getIngredient()
{
    global $conn;
    $smtc = $conn->prepare("SELECT * FROM ingredients");
    $smtc->execute();
    $result = $smtc->get_result();
    return $result;
}

function getProduct($filters, $page, $search = null)
{
    global $conn;

    $results_per_page = 12;
    $start_index = ($page - 1) * $results_per_page;

    $query = "SELECT 
        qs.quick_snack_id,
        qs.name,
        qs.level,
        qs.time,
        qs.yield,
        qs.created_at,
        qs.user_id,
        MAX(iqs.address_img) AS image_address,
        GROUP_CONCAT(DISTINCT c.category_name ORDER BY c.category_id SEPARATOR ', ') AS categories,
        ROUND(AVG(r.rating), 1) AS average_rating
    FROM 
        quick_snack qs
    LEFT JOIN 
        image_quick_snack iqs ON qs.quick_snack_id = iqs.quick_snack_id
    LEFT JOIN 
        category_to_quick_snack ctqs ON qs.quick_snack_id = ctqs.quick_snack_id
    LEFT JOIN 
        category c ON ctqs.category_id = c.category_id
    LEFT JOIN 
        review r ON qs.quick_snack_id = r.quick_snack_id";

    $conditions = [];

    // Thêm điều kiện tìm kiếm
    if (!empty($search)) {
        $conditions[] = "qs.name LIKE '%" . $conn->real_escape_string($search) . "%'";
    }

    // Thêm các điều kiện lọc khác
    if (!empty($filters['category'])) {
        $categoryIds = implode(',', $filters['category']);
        $conditions[] = "qs.quick_snack_id IN (
            SELECT quick_snack_id FROM category_to_quick_snack
            WHERE category_id IN ($categoryIds)
            GROUP BY quick_snack_id
            HAVING COUNT(*) = " . count($filters['category']) . "
        )";
    }

    // Thêm điều kiện lọc theo thành phần (ingredient)
    if (!empty($filters['ingredient'])) {
        $ingredientIds = implode(',', $filters['ingredient']);
        $conditions[] = "qs.quick_snack_id IN (
            SELECT quick_snack_id FROM ingredient_to_quick_snack
            WHERE ingredient_id IN ($ingredientIds)
            GROUP BY quick_snack_id
            HAVING COUNT(*) = " . count($filters['ingredient']) . "
        )";
    }

    // Thêm điều kiện lọc theo mức độ (level)
    if (!empty($filters['level'])) {
        $levels = implode("','", $filters['level']);
        $conditions[] = "qs.level IN ('$levels')";
    }

    // Thêm điều kiện lọc theo thời gian nấu (time)
    if (!empty($filters['time_min']) && !empty($filters['time_max'])) {
        $timeMin = $filters['time_min'];
        $timeMax = $filters['time_max'];
        $conditions[] = "qs.time BETWEEN '$timeMin' AND '$timeMax'";
    }

    // Xử lý các điều kiện lọc
    if (!empty($conditions)) {
        $query .= " WHERE " . implode(' AND ', $conditions);
    }

    // Thêm phần GROUP BY
    $query .= " GROUP BY 
        qs.quick_snack_id,
        qs.name,
        qs.level,
        qs.time,
        qs.yield,
        qs.created_at,
        qs.user_id";

    // Xử lý sắp xếp (sorting)
    $sort = isset($_GET['sort']) ? $_GET['sort'] : 'default';
    switch ($sort) {
        case 'name':
            $query .= " ORDER BY qs.name";
            break;
        case 'rating':
            $query .= " ORDER BY average_rating DESC";
            break;
        case 'time':
            $query .= " ORDER BY qs.time";
            break;
        default:
            // Sắp xếp mặc định (bạn có thể thay đổi theo ý muốn)
            $query .= " ORDER BY qs.quick_snack_id";
            break;
    }

    // Thêm LIMIT vào câu truy vấn để lấy sản phẩm của trang hiện tại
    $query .= " LIMIT $start_index, $results_per_page";

    // Thực hiện truy vấn để đếm tổng số sản phẩm
    $countQuery = "SELECT COUNT(*) AS total FROM ($query) AS result";
    $countResult = $conn->query($countQuery);
    $totalCount = $countResult->fetch_assoc()['total'];

    // Tính số trang dựa trên tổng số sản phẩm và số sản phẩm trên mỗi trang
    $total_pages = ceil($totalCount / $results_per_page);

    $stmt = $conn->prepare($query);
    $stmt->execute();
    $result = $stmt->get_result();

    return ['products' => $result, 'total_pages' => $total_pages, 'current_sort' => $sort];
}



function isInWishlist($quick_snack_id, $conn, $user_id)
{
    $query = "SELECT qs.user_id, qsuc.quick_snack_id, qsuc.user_category_id
    FROM quick_snack qs
    JOIN quick_snack_to_user_category qsuc ON qs.quick_snack_id = qsuc.quick_snack_id
    JOIN user_category uc ON qsuc.user_category_id = uc.user_category_id
    WHERE uc.user_id = ?
    AND qs.quick_snack_id = ?;
    ";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("si", $user_id, $quick_snack_id);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->num_rows > 0;
}

$category_id = isset($_GET['categoryId']) ? intval($_GET['categoryId']) : null;

$search = isset($_GET['search']) ? htmlspecialchars($_GET['search']) : null;

$filters = [];

if (isset($_GET['filter'])) {
    $filters = [
        'category' => isset($_GET['category']) ? $_GET['category'] : [],
        'ingredient' => isset($_GET['ingredient']) ? $_GET['ingredient'] : [],
        'level' => isset($_GET['level']) ? $_GET['level'] : [],
        'time_min' => isset($_GET['time_min']) ? $_GET['time_min'] : 0,
        'time_max' => isset($_GET['time_max']) ? $_GET['time_max'] : 60,
    ];

    // Xử lý khi checkbox "All" được chọn
    if (in_array('all', $filters['category'])) {
        $filters['category'] = [];
    }

    if (in_array('all', $filters['ingredient'])) {
        $filters['ingredient'] = [];
    }
}

if ($category_id !== null) {
    $filters['category'] = [$category_id];
}


// Xử lý trang hiện tại (mặc định là trang 1)
$numberOfpage = isset($_GET['page']) ? intval($_GET['page']) : 1;

$result = getProduct($filters, $numberOfpage, $search);
$productData = $result['products'];
$total_pages = $result['total_pages'];


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Products</title>
    <link rel="stylesheet" href="../../public/css/products.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../public/css/header.css">
    <link rel="stylesheet" href="../../public/css/style.css">
    <link rel="stylesheet" href="../../public/css/footer.css">
    <style>
        .pagination {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }

        .pagination a {
            margin: 0 5px;
            padding: 5px;
            border: 1px solid #ccc;
            border-radius: 5px;
            text-decoration: none;
            color: #333;
        }

        .pagination a:hover {
            background-color: #f2f2f2;
        }

        .pagination .active {
            background-color: #E37E21;
            color: #fff;
        }

        .sort-selected::after {
            content: " \25BC";
            /* Dấu mũi tên hướng xuống */
        }
    </style>


</head>

<body>

    <div class="col-6">
        <select id="sortDropdown" class="form-select form-select-md mx-auto sort" style="width: fit-content;" onchange="sortProducts(this.value)">
            <option selected value="default" class="option">Sort</option>
            <option value="name" class="option">Name</option>
            <option value="rating" class="option">Rating</option>
            <option value="time" class="option">Time</option>
        </select>
    </div>

    <script>
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



    <form method="get" action="">
        <!-- Phần lọc sản phẩm -->
        <div class="row">
            <!-- Danh mục -->
            <div class="col-12 fs-5 fw-semibold">
                <span>Category</span>
            </div>
            <div class="col-6">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="category[]" value="all" id="category-all" onchange="toggleCategory(this)">
                    <label class="form-check-label" for="checkboxAll">
                        All
                    </label>
                </div>
            </div>
            <?php
            $category = getCategory();
            if ($category->num_rows > 0) {
                while ($row = $category->fetch_assoc()) {
                    $isChecked = isset($_GET['category']) && in_array($row['category_id'], $_GET['category']);
                    if ($category_id !== null && $row['category_id'] === $category_id) {
                        $isChecked = true; // Check this checkbox if its ID matches categoryId
                    }
            ?>
                    <div class="col-6">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="category[]" value="<?php echo $row["category_id"]; ?>" onchange="toggleCategory(this)">
                            <label class="form-check-label text-wrap" for="category_<?php echo $row["category_id"]; ?>">
                                <?php echo $row["category_name"]; ?>
                            </label>
                        </div>
                    </div>
            <?php                }
            }
            ?>
        </div>
        <!-- Thành phần -->
        <div class="row">
            <div class="col-12 fs-5 fw-semibold">
                <span>Ingredient</span>
            </div>
            <div class="col-6">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="ingredient[]" value="all" id="ingredient-all" onchange="toggleIngredient(this)">
                    <label class="form-check-label" for="checkboxAllIngredients">
                        All
                    </label>
                </div>
            </div>
            <?php
            $ingredient = getIngredient();
            if ($ingredient->num_rows > 0) {
                while ($row = $ingredient->fetch_assoc()) {
                    $isChecked = isset($_GET['ingredient']) && in_array($row['ingredient_id'], $_GET['ingredient']);
            ?>
                    <div class="col-6">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="ingredient[]" value="<?php echo $row["ingredient_id"]; ?>" onchange="toggleIngredient(this)" <?php if ($isChecked)
                                                                                                                                                                                    echo 'checked'; ?>>
                            <label class="form-check-label text-wrap" for="ingredient_<?php echo $row["ingredient_id"]; ?>">
                                <?php echo $row["ingredient_name"]; ?>
                            </label>
                        </div>
                    </div>
            <?php
                }
            }
            ?>
        </div>
        <!-- Mức độ khó khăn -->
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

        <!-- Thời gian nấu nướng -->
        <div class="row">
            <div class="col-12 fs-5 fw-semibold">
                <span>Cooking Time</span>
            </div>
            <div class="col-4">
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="time_min" value="0" id="time_min_0" <?php if (isset($_GET['time_min']) && $_GET['time_min'] == '0')
                                                                                                                echo 'checked'; ?>>
                    <label class="form-check-label" for="time_min_0">
                        0 minutes
                    </label>
                </div>
            </div>
            <div class="col-4">
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="time_min" value="5" id="time_min_5" <?php if (isset($_GET['time_min']) && $_GET['time_min'] == '5')
                                                                                                                echo 'checked'; ?>>
                    <label class="form-check-label" for="time_min_5">
                        5 minutes
                    </label>
                </div>
            </div>
            <div class="col-4">
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="time_min" value="15" id="time_min_15" <?php if (isset($_GET['time_min']) && $_GET['time_min'] == '15')
                                                                                                                    echo 'checked'; ?>>
                    <label class="form-check-label" for="time_min_15">
                        15 minutes
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
        </div>

        <input type="hidden" name="filter" value="true">
        <input type="hidden" name="sort" value="<?php echo isset($_GET['sort']) ? $_GET['sort'] : 'default'; ?>">

        <div class="row">
            <button type="submit" class="btn btn-primary">Filter</button>
        </div>

    </form>

    <!-- Hiển thị sản phẩm -->
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
                                <!-- Hiển thị tất cả các danh mục của sản phẩm -->
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
    </div>




    <!-- Hiển thị phân trang -->
    <div class="mx-auto">
                    <div class="pages">
                        <?php for ($i = 1; $i <= $total_pages; $i++) { ?>
                            <a href="?page=<?php echo $i; ?>&filter=true&<?php echo http_build_query($filters); ?>" <?php if ($i == $numberOfpage)
                                                                                                                        echo 'class="page_active"';
                                                                                                                    ?>><?php echo $i; ?></a>
                        <?php } ?>
                    </div>
                </div>


    <script src="https://kit.fontawesome.com/54dbfefd83.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>
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
        };

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

        function toggleCategory(allCheckbox) {
            var checkboxes = document.querySelectorAll('input[name="category[]"]');
            if (allCheckbox.value === 'all') {
                checkboxes.forEach(function(checkbox) {
                    if (checkbox !== allCheckbox) {
                        checkbox.checked = false;
                    }
                });
            } else {
                document.getElementById('category-all').checked = false;
            }
        }

        // Function to toggle 'All' checkbox for ingredients
        function toggleIngredient(allCheckbox) {
            var checkboxes = document.querySelectorAll('input[name="ingredient[]"]');
            if (allCheckbox.value === 'all') {
                checkboxes.forEach(function(checkbox) {
                    if (checkbox !== allCheckbox) {
                        checkbox.checked = false;
                    }
                });
            } else {
                document.getElementById('ingredient-all').checked = false;
            }
        }

        // Set 'All' checkboxes as checked by default
        window.onload = function() {
            document.getElementById('category-all').checked = true;
            document.getElementById('ingredient-all').checked = true;
        }
    </script>
</body>

</html>