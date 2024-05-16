<?php
include ('../../database/query_database/function_detail.php');
$id = $_GET['quick_snack_id'];
$query = 'SELECT * FROM image_quick_snack WHERE quick_snack_id= ' . $id . ' AND kind = 1 LIMIT 3';
$result = $conn->query($query);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?php echo $detailRow['name']; ?></title> <!--PHP Product Name-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://unpkg.com/ionicons@5.1.2/dist/ionicons.min.css" />
    <link rel="shortcut icon" href="../../public/image/logo.png" type="image/x-icon">
    <link rel="stylesheet" href="../../public/css/style.css">
    <link rel="stylesheet" href="../../public/css/header.css">
    <link rel="stylesheet" href="../../public/css/product-detail.css">
    <link rel="stylesheet" href="../../public/css/footer.css" />
    <style>
        .carousel-inner .carousel-item img {
            max-height: 450px;
            /* Điều chỉnh chiều cao tối đa của ảnh */
            width: auto;
            margin: 0 auto;
        }

        /* Tùy chỉnh kích thước của carousel */
        #carouselExampleIndicators {
            width: 100%;
            /* Đảm bảo rộng 100% của carousel */
        }

        /* Tùy chỉnh kích thước của carousel control */
        .carousel-control-prev,
        .carousel-control-next {
            width: 5%;
            /* Điều chỉnh chiều rộng của nút điều khiển */
        }

        .carousel-control-prev-icon,
        .carousel-control-next-icon {
            width: 30px;
            /* Điều chỉnh chiều rộng của biểu tượng điều khiển */
            height: 30px;
            /* Điều chỉnh chiều cao của biểu tượng điều khiển */
            background-size: 100%, 100%;
            background-repeat: no-repeat;
        }

        .wishlist-link {
            color: #ff9a62;
        }

        .wishlist-link-wished {
            color: #ff9a62;
        }
    </style>
</head>

<body>
    <header>
        <?php
        include '..\includes\header.php';
        ?>
    </header>
    <div class="container">
        <div class="head">
            <p class="product-detail pt-5">
                Home > Product > <span class="fw-bold"><?php echo $detailRow['name']; ?></span>
                <?php
                if (isset($_COOKIE['userID'])) {
                    $user_id = $_COOKIE['userID'];
                    $isInWishlist = isInWishlist($detailRow['quick_snack_id'], $conn, $user_id);
                    ?>
                    <a
                        href="../../models/products/products_detail.php?product_id=<?php echo $detailRow['quick_snack_id'] ?>"><?php echo ($isInWishlist ? '<i class="fa-solid fa-bookmark wishlist-link-wished" id="favoriteIcon"></i>' : '<i class="far fa-bookmark wishlist-link"
                            id="favoriteIcon"></i>') ?></a>
                    <?php
                } else {
                    ?>
                    <a href="../../views//auth/SignIn.html" class="wishlist-link">Login to add to wishlist</a>
                    <?php
                }
                ?>

            </p>
            <h3><?php echo $detailRow['name']; ?></h3>
        </div>
        <div class="icon align-items-center">
            <div class="d-flex d-sm-inline">
                <span class="pt-1 fw-bold">
                    <i class="fas fa-user" style="color: #ff9a62"></i> <?php
                    // Lấy tên tác giả từ cơ sở dữ liệu
                    $query = "SELECT u.fullname 
                          FROM user u 
                          INNER JOIN quick_snack q ON u.user_id = q.user_id 
                          WHERE q.quick_snack_id = $id";
                    $author_result = $conn->query($query);
                    if ($author_result && $author_result->num_rows > 0) {
                        $author_row = $author_result->fetch_assoc();
                        echo $author_row['fullname'];
                    } else {
                        echo "Unknown";
                    }
                    ?>
                </span>
                <span class="pt-1 fw-bold comment-count">
                    <i class="fas fa-comment " style="color: #ff9a62"></i>
                    <?php echo countComments($conn, $id); ?> Comment
                </span>
                <span class="pt-1 fw-bold">
                    <i class="fas fa-heart" style="color: #ff9a62"></i> Like
                </span>
                <span class="pt-1 fw-bold">
                    <i class="far fa-calendar" style="color: #ff9a62"></i> Apr 30, 2024
                </span>
            </div>
            <span class="pt-1 fw-bold">
                <i class="fas fa-star star-icon" style="color: #ff9a62"></i>
                <i class="fas fa-star star-icon" style="color: #ff9a62"></i>
                <i class="fas fa-star star-icon" style="color: #ff9a62"></i>
                <i class="fas fa-star star-icon" style="color: #ff9a62"></i>
                <i class="fas fa-star-half-alt star-icon" style="color: #ff9a62"></i>
                <span style="color: #8c8c8c;font-size: small;">
                    <?php echo averageRating($conn, $id); ?>/5 Review
                </span>
            </span>
        </div>
        <div class="row pt-4">
            <div class="col-12 col-md-8 pb-0">
                <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        <?php
                        $active = true;
                        if ($result_img->num_rows > 0) {
                            while ($row = $result_img->fetch_assoc()) {
                                $activeClass = $active ? 'active' : ''; 
                                echo '<div class="carousel-item ' . $activeClass . '">';
                                echo '<img src="' . $row['address_img'] . '" class="d-block w-100" alt="Product Image">';
                                echo '</div>';
                                $active = false;
                            }
                        }
                        ?>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
                        data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
                        data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
                <div class="pt-5 d-flex justify-content-center align-items-center">
                    <span class="text-muted mx-3">
                        <i class="far fa-clock fs-3" style="color: #ff9a62"></i> <?php echo $detailRow['time']; ?>
                    </span>
                    <span class="divider mx-3"></span>
                    <span class="text-muted mx-3">
                        <i class="fas fa-user" style="color: #ff9a62"></i> <?php echo $detailRow['yield']; ?>
                    </span>
                    <span class="divider mx-3"></span>
                    <span class="text-muted mx-3">
                        <i class="fas fa-book" style="color: #ff9a62"></i> <?php echo $detailRow['level']; ?>
                    </span>
                </div>
            </div>
            <div class="col-md-4">
                <h5 class="mb-4 ps-2 text-center">Nutrition</h5>
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <tbody>
                            <tr>
                                <th scope="row">Calories</th>
                                <td><?php echo $data['calories']; ?></td>
                            </tr>
                            <tr>
                                <th scope="row">Carbs</th>
                                <td><?php echo $data['carbs']; ?></td>
                            </tr>
                            <tr>
                                <th scope="row">Fat</th>
                                <td><?php echo $data['fat']; ?></td>
                            </tr>
                            <tr>
                                <th scope="row">Protein</th>
                                <td><?php echo $data['protein']; ?></td>
                            </tr>
                            <tr>
                                <th scope="row">Fiber</th>
                                <td><?php echo $data['fiber']; ?></td>
                            </tr>
                            <tr>
                                <th scope="row">Net carbs</th>
                                <td><?php echo $data['net_crabs']; ?></td>
                            </tr>
                            <tr>
                                <th scope="row">Sodium</th>
                                <td><?php echo $data['sodium']; ?></td>
                            </tr>
                            <tr>
                                <th scope="row">Cholesterol</th>
                                <td><?php echo $data['cholesterol']; ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="mt-5 row">
            <div class="col-12 col-sm-6" style="border-right: #E37E21 solid 2px;">
                <h4 class="fs-4 text-center">
                    <i class="fa fa-coffee" aria-hidden="true" style="color: #ff9a62"></i>
                    Ingredients
                </h4>
                <ul class="list-group list-group-light">
                    <?php
                    $ingredientResult = getIngredients();
                    if ($ingredientResult->num_rows > 0) {
                        while ($ingredientRow = $ingredientResult->fetch_assoc()) {
                            echo '<li class="list-group-item border-0 fw-semibold mb-2">';
                            echo '<i class="fas fa-circle text-danger"></i> ' . $ingredientRow['quantity'] . ' ' . $ingredientRow['ingredient_name'];
                            echo '</li>';
                        }
                    } else {
                        echo "Không có nguyên liệu nào.";
                    }
                    ?>
                </ul>
            </div>
            <div class="col-12 col-sm-6 mt-5 mt-sm-0" style="border-left: #E37E21 solid 2px;">
                <h4 class="fs-4 text-center">
                    <i class="fas fa-utensils" style="color: #ff9a62"></i> Recipes
                </h4>
                <ol class="list-group list-group-light">
                    <?php
                    $recipeResult = getRecipes();
                    if ($recipeResult->num_rows > 0) {
                        while ($recipeRow = $recipeResult->fetch_assoc()) {
                            echo '<li class="list-group-item border-0 fw-semibold mb-2">';
                            echo '<i class="fas fa-circle text-danger"></i> ' . $recipeRow['derection'];
                            echo '</li>';
                        }
                    } else {
                        echo "Không có công thức nào.";
                    }
                    ?>
                </ol>
            </div>
        </div>
        <div class="comment-box mt-5">
            <h4 class="fs-4 text-center">
                <i class="fas fa-comment" style="color: #ff9a62"></i> Comment
            </h4>
            <div class="center-text">
                <hr style="border-top: 1px solid #ff9a62" />
            </div>
            <?php
            $commentResult = getComment();
            if ($commentResult->num_rows > 0) {
                while ($commentRow = $commentResult->fetch_assoc()) {
                    ?>
                    <div class="comment mt-4">
                        <div class="comment-header">
                            <div class="comment-avatar">
                                <img src="https://via.placeholder.com/50" alt="Avatar" />
                            </div>
                            <div class="comment-content">
                                <h6><?php echo $commentRow['fullname']; ?></h6>
                                <p class="comment-date"><?php echo $commentRow['time']; ?></p>
                            </div>
                        </div>
                        <p class="comment-text"><?php echo $commentRow['comment']; ?></p>
                        <div class="comment-rating">
                            <?php
                            // Lấy giá trị rating từ cơ sở dữ liệu
                            $rating = $commentRow['rating'];
                            // Vòng lặp để render số lượng ngôi sao tương ứng
                            for ($i = 0; $i < 5; $i++) {
                                if ($i < $rating) {
                                    // Nếu vị trí $i nhỏ hơn giá trị rating, hiển thị ngôi sao filled
                                    echo '<i class="fas fa-star" style="color: #ff9a62"></i>';
                                } else {
                                    // Ngược lại, hiển thị ngôi sao empty
                                    echo '<i class="far fa-star" style="color: #ff9a62"></i>';
                                }
                            }
                            ?>
                        </div>
                        <div class="comment-actions mt-2">
                            <i class="fas fa-thumbs-up" style="color: #ff9a62; margin-right: 10px"></i>
                            <i class="fas fa-reply" style="color: #ff9a62"></i>
                        </div>
                    </div>
                    <?php
                }
            } else {
                echo "<p>No comments available.</p>";
            }
            ?>
            <div class="text-center mt-3">
                <button class="btn_comment">Load More Comments</button>
            </div>
            <div class="comment-form mt-4">
                <form id="comment-form" action="../../database/query_database/comment_handler.php" method="post">
                    <input type="hidden" name="quick_snack_id" value="<?php echo $id; ?>">
                    <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
                    <div>
                        <label for="comment" class="form-label">Comment</label>
                        <textarea class="form-control" id="comment" name="comment" rows="3" required></textarea>
                    </div>
                    <div class="rating mt-2">
                        <!-- Lựa chọn đánh giá -->
                        <input type="radio" id="star5" name="rating" value="5" /><label for="star5" title="5 stars"><i
                                class="fas fa-star"></i></label>
                        <input type="radio" id="star4" name="rating" value="4" /><label for="star4" title="4 stars"><i
                                class="fas fa-star"></i></label>
                        <input type="radio" id="star3" name="rating" value="3" /><label for="star3" title="3 stars"><i
                                class="fas fa-star"></i></label>
                        <input type="radio" id="star2" name="rating" value="2" /><label for="star2" title="2 stars"><i
                                class="fas fa-star"></i></label>
                        <input type="radio" id="star1" name="rating" value="1" /><label for="star1" title="1 star"><i
                                class="fas fa-star"></i></label>
                    </div>
                    <div class="mb-3 text-start">
                        <button class="btn_comment" type="submit">Send</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <footer>
        <?php
        include '..\includes\footer.php';
        ?>
    </footer>
    <script src="https://kit.fontawesome.com/54dbfefd83.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <!-- Trong phần JavaScript -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Lấy phần tử chứa số lượng comment
            var commentCount = document.querySelector('.comment-count');

            // Thêm sự kiện click cho phần tử chứa số lượng comment
            commentCount.addEventListener('click', function () {
                // Di chuyển màn hình xuống phần comment
                var commentBox = document.querySelector('.comment-box');
                commentBox.scrollIntoView({
                    behavior: 'smooth'
                });
            });
        });
    </script>
</body>

</html>