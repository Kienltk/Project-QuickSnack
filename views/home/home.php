<<<<<<< Updated upstream
<<<<<<< Updated upstream
<<<<<<< Updated upstream
=======
<?php
include("../../database/connect_database/index.php");

function getRandomImage0Url($conn)
{
    $sql = "SELECT quick_snack_id, address_img FROM image_quick_snack WHERE kind = 0 ORDER BY RAND() LIMIT 1";
=======
<?php
include("../../database/connect_database/index.php");

function getBanner($conn)
{
    $sql = "SELECT * FROM banner ORDER BY RAND() LIMIT 1";
>>>>>>> Stashed changes
    $result = mysqli_query($conn, $sql);
    if ($result) {
        $row = mysqli_fetch_assoc($result);
        return $row;
<<<<<<< Updated upstream
=======
<?php
// database connection
include ("../../database/connect_database/index.php");

// function to fetch a random image
function getRandomImage($conn, $kind) {
    $sql = "SELECT quick_snack_id, address_img FROM image_quick_snack WHERE kind =? ORDER BY RAND() LIMIT 10";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $kind);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        return $result->fetch_assoc();
>>>>>>> Stashed changes
    } else {
        return null;
    }
}

<<<<<<< Updated upstream
function getRandomImage1Url($conn)
{
    $sql = "SELECT quick_snack_id, address_img FROM image_quick_snack WHERE kind = 1 ORDER BY RAND() LIMIT 10";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        // Lấy ngẫu nhiên một hình ảnh từ kết quả trả về
        $randomIndex = rand(0, mysqli_num_rows($result) - 1);
        mysqli_data_seek($result, $randomIndex);
        $row = mysqli_fetch_assoc($result);
        return $row;
=======
>>>>>>> Stashed changes
    } else {
        return null;
    }
}

<<<<<<< Updated upstream
?>
=======
function displayCategories($conn) {
=======


function displayCategories($conn)
{
>>>>>>> Stashed changes
    $sql = "SELECT * FROM category";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->get_result();
    $categories = [];
    while ($row = $result->fetch_assoc()) {
        $categories[] = $row;
    }
    return $categories;
}

$categories = displayCategories($conn);
$num_categories = count($categories);
$categories_per_slide = 5;
$num_slides = ceil($num_categories / $categories_per_slide);

<<<<<<< Updated upstream
// function to fetch a random quick snack id
// function getRandomQuickSnackId($conn) {
//     $sql = "SELECT quick_snack_id FROM quick_snack ORDER BY RAND() LIMIT 1";
//     $stmt = $conn->prepare($sql);
//     $stmt->execute();
//     $result = $stmt->get_result();
//     if ($result->num_rows > 0) {
//         return $result->fetch_assoc()['quick_snack_id'];
//     } else {
//         return null;
//     }
// }

// // function to fetch random comments
// function getRandomComments($conn, $quick_snack_id) {
//     $sql = "SELECT comment FROM review WHERE quick_snack_id =? ORDER BY RAND() LIMIT 4";
//     $stmt = $conn->prepare($sql);
//     $stmt->bind_param("i", $quick_snack_id);
//     $stmt->execute();
//     $result = $stmt->get_result();
//     $comments = [];
//     while ($row = $result->fetch_assoc()) {
//         $comments[] = $row['comment'];
//     }
//     return $comments;
// }

// // fetch random quick snack id
// $randomQuickSnackId = getRandomQuickSnackId($conn);

// // fetch random comments
// $comments = getRandomComments($conn, $randomQuickSnackId);

// fetch random images
$randomImage0 = getRandomImage($conn, 0);
$randomImage1 = getRandomImage($conn, 1);

?>

>>>>>>> Stashed changes
<!DOCTYPE html>
<html lang="en">
=======


?>
<!DOCTYPE html>
<html lang="en">

>>>>>>> Stashed changes
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Quick Snack</title>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../../public/css/home.css" />
    <style>
<<<<<<< Updated upstream
    .category-item.active {
        background-color: red; 
        color: #ffffff;
    }

    .btn-outline-primary {
        border-color: rgba(255, 165, 0, 0.5); 
        color: #ffffff;
        transition: transform 0.3s; 
    }

    .btn-outline-primary:hover {
        background-color: rgba(255, 165, 0, 1); 
        border-color: rgba(255, 165, 0, 1); 
        color: #ffffff; 
        transform: scale(1.1); 
    }
</style>
</head>
<body>
    <header>
        <?php include '..\includes\header.php';?>
=======
     @media (max-width: 768px) {
            .carousel-control-prev, .carousel-control-next {
                display: none !important; 
            }
        }

@media (max-width: 768px) {
    .category-item {
        width: calc(50% - 10px); 
    }
}

@media (max-width: 576px) {
    .category-item {
        width: calc(100% - 10px);
    }
}
</style>
</head>

<body">
    <header>
        <?php
        include '..\includes\header.php';
        ?>
>>>>>>> Stashed changes
    </header>

    <section class="container my-5">
        <div>
<<<<<<< Updated upstream
<<<<<<< Updated upstream
            <?php
            $randomImage0 = getRandomImage0Url($conn);
            if ($randomImage0) {
                echo '<a href="product-detail.php?quick_snack_id=' . $randomImage0['quick_snack_id'] . '">';
                echo '<img src="' . $randomImage0['address_img'] . '" class="img-fluid" alt="Random Image">';
                echo '</a>';
=======
            <?php
            $randomImage = getBanner($conn);
            if ($randomImage) {
                echo '<img src="' . $randomImage['address_banner_img'] . '" class="img-fluid" alt="Random Image">';
>>>>>>> Stashed changes
            } else {
                echo '<img src="" class="img-fluid" alt="Random Image">';
            }
            ?>
<<<<<<< Updated upstream
=======
            <?php if ($randomImage0) :?>
                <a href="product-detail.php?quick_snack_id=<?php echo $randomImage0['quick_snack_id'];?>">
                    <img src="<?php echo $randomImage0['address_img'];?>" class="img-fluid" alt="Random Image">
                </a>
            <?php else :?>
                <img src="" class="img-fluid" alt="Random Image">
            <?php endif;?>
>>>>>>> Stashed changes
=======
>>>>>>> Stashed changes
        </div>
        <div class="mt-5">
            <p class="text-center fs-1 fw-bold">QuickSnacks based on preferences</p>
        </div>
        <div class="position-relative" style="height: 35px;">
            <hr style="color: #E37E21; width: 30%; height: 5px; background-color: #E37E21; border-radius: 5px; opacity: 1;" class="position-absolute top-0 start-50 translate-middle-x">
        </div>

<<<<<<< Updated upstream
        <div style="border-top: #F27900 solid 2px; border-bottom: #F27900 solid 2px;" class="my-5">
        <div class="row justify-content-center mx-2 mt-3 mb-5">
    <div class="carousel slide" data-bs-ride="carousel" id="categoryCarousel">
=======
        <div class="carousel slide" data-bs-ride="carousel" id="categoryCarousel">
>>>>>>> Stashed changes
        <div class="carousel-inner">
            <?php for ($i = 0; $i < $num_slides; $i++) :?>
                <div class="carousel-item <?= $i == 0 ? 'active' : ''?>">
                    <div class="d-flex justify-content-center">
                        <?php for ($j = $i * $categories_per_slide; $j < min(($i + 1) * $categories_per_slide, $num_categories); $j++) :?>
                            <button class="category-item btn btn-outline-primary btn-sm mb-2 me-1 <?= isset($_GET['category']) && $_GET['category'] == $categories[$j]['category_id'] ? 'active' : ''?>" data-category-id="<?= $categories[$j]['category_id']?>">
                                <?= $categories[$j]['category_name']?>
                            </button>
                        <?php endfor;?>
                    </div>
                </div>
            <?php endfor;?>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#categoryCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true" style="background-color: #E37E21;"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#categoryCarousel" data-bs-slide="next" >
            <span class="carousel-control-next-icon" aria-hidden="true" style="background-color: #E37E21;"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
<<<<<<< Updated upstream
</div>

            <div class="image-slider">
<<<<<<< Updated upstream
                <?php
                $randomImage1 = getRandomImage1Url($conn);
                if ($randomImage1) {
                    $imageDivs = '';
                    for ($i = 0; $i < 10; $i++) {
                        echo '<div class="image">';
                        echo '<a href="product-detail.php?quick_snack_id=' . $randomImage1['quick_snack_id'] . '">';
                        echo '<img src="' . $randomImage1['address_img'] . '" class="img-fluid" alt="Random Image">';
                        echo '</a>';
                        echo '</div>';
                    }
                } else {
                    echo "Không có hình ảnh được tìm thấy.";
                }
                ?>
=======
                <?php if ($randomImage1) :?>
                    <?php for ($i = 0; $i < 10; $i++) :?>
                        <div class="image">
                            <a href="product-detail.php?quick_snack_id=<?php echo $randomImage1['quick_snack_id'];?>">
                                <img src="<?php echo $randomImage1['address_img'];?>" class="img-fluid" alt="Random Image">
                            </a>
                        </div>
                    <?php endfor;?>
                <?php else :?>
                    <div class="image">
                        <img src="" class="img-fluid" alt="Random Image">
                    </div>
                <?php endif;?>
>>>>>>> Stashed changes
            </div>
        </div>

        <!-- <div class="comment_quick_food">
            <div>
                <span class="fw-bold fs-1"><?php echo $snack_name;?><i class="fa-solid fa-burger"></i></span>
            </div>
            <div class="row my-3">
                <div class="col-12 col-md-6 mb-3">
                    <img src="<?php echo $address_img;?>" alt="" class="rounded img-fluid text-center" />
                </div>
                <div class="col-12 col-md-6">
                    <div class="row row-cols-1 row-cols-md-2 g-4">
                        <?php foreach ($comments as $comment) :?>
                            <div class="col">
                                <div class="card rounded-4 shadow-lg p-3 mb-2 bg-body-tertiary" style="border-color: #f2790071;">
                                    <div class="card-title d-flex my-3">
                                        <img src="../../public/image/Ellipse 217.png" alt="..." style="width: 50px; height: 50px;">
                                        <div class="ms-2">
                                            <div class="fs-5 fw-bold" style="margin: 0;"><?php echo $user_fullname ;?></div>
                                            <div style="font-size: x-small;">
                                                <?php
                                                    // Hiển thị đánh giá dưới dạng sao
                                                    $ratingStars = "";
                                                    for ($i = 0; $i < $rating; $i++) {
                                                        $ratingStars .= '<i class="fa-solid fa-star text-warning"></i>';
                                                    }
                                                    for ($i = $rating; $i < 5; $i++) {
                                                        $ratingStars .= '<i class="fa-solid fa-star text-secondary"></i>';
                                                    }
                                                    echo $ratingStars;
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <p class="card-text fs-5 fw-normal"><?php echo $comment; ?></p>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach;?>
                    </div>
                </div>
            </div>
        </div> -->
    </section>

    <footer>
        <?php include '..\includes\footer.php';?>
    </footer>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQy4TcM8XRQT8Df9EsrYxDf7tpVpfl3qcYD96BpyPvA4d1FDQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-migrate/3.4.1/jquery-migrate.min.js" integrity="sha512-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js" integrity="sha512-HGOnQO9+SP1V92SrtZfjqxxtLmVzqZpjFFekvzZVWoiASSQgSr4cw9Kqd2+l8Llp4Gm0G8GIFJ4ddwZilcdb8A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://kit.fontawesome.com/54dbfefd83.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous"></script>

    <script src="../../public/js/home.js"></script>

<<<<<<< Updated upstream
</html>
>>>>>>> Stashed changes
=======
    <script>
        $(document).ready(function() {
    $('.category-item').on('click', '.category-item',function() {
        var categoryId = $(this).data('category-id');
        $.ajax({
            type: 'GET',
            url: 'get_images_by_category.php',
            data: {category_id: categoryId},
            success: function(data) {
                $('.image-slider').html('');
                $.each(data, function(index, image) {
                    $('.image-slider').append('<div class="image"><a href="product-detail.php?quick_snack_id=' + image.quick_snack_id + '"><img src="' + image.address_img + '" class="img-fluid"></a></div>');
                });

                // Remove active class from all category items
                $('.category-item').removeClass('active');
                // Add active class to the clicked category item
                $(this).addClass('active');
=======

            <div class="image-slider my-5">
                <?php
                $sql = "SELECT * FROM image_quick_snack WHERE kind = 0";
                $result = mysqli_query($conn, $sql);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo '<div class="image">';
                        echo '<a href="../products/product_detail.php?quick_snack_id=' . $row['quick_snack_id'] . '">';
                        echo '<img src="' . $row['address_img'] . '" class="img-fluid" alt="Random Image"  style = "border: 2px solid #f57c0c;">';
                        echo '</a>';
                        echo '</div>';
                    }
                }
                ?>
            </div>
        </div>
    </section>

    <footer>
        <?php
        include '..\includes\footer.php';
        ?>
    </footer>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-migrate/3.4.1/jquery-migrate.min.js" integrity="sha512-KgffulL3mxrOsDicgQWA11O6q6oKeWcV00VxgfJw4TcM8XRQT8Df9EsrYxDf7tpVpfl3qcYD96BpyPvA4d1FDQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js" integrity="sha512-HGOnQO9+SP1V92SrtZfjqxxtLmVzqZpjFFekvzZVWoiASSQgSr4cw9Kqd2+l8Llp4Gm0G8GIFJ4ddwZilcdb8A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://kit.fontawesome.com/54dbfefd83.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <script src="../../public/js/home.js"></script>
    <script>
//         $(document).ready(function() {
            

//     function updateCategoriesPerSlide() {
//         var windowWidth = $(window).width();
//         if (windowWidth <= 576) {
//             categoriesPerSlide = 1;
//         } else if (windowWidth <= 768) {
//             categoriesPerSlide = 2;
//         } else {
//             categoriesPerSlide = 5;
//         }
//     }

//     updateCategoriesPerSlide(); 
//     $(window).resize(updateCategoriesPerSlide);
// var categoriesPerSlide = <?php echo $categories_per_slide; ?>
// });
//     $(document).ready(function() {
    $(document).ready(function() {
    $('.category-item').click(function() {
        var categoryId = $(this).data('category-id');
        $('.image-slider').load('display_images_by_category.php?category_id=' + categoryId, function() {
            if ($('.image-slider').length > 0) {
                $(".image-slider").slick({
                    slidesToShow: 5,
                    slidesToScroll: 1,
                    infinite: true,
                    arrows: true,
                    draggable: true,
                    focusOnSelect: true,
                    prevArrow: `<button type='button' class='slick-prev slick-arrow'><i class="fa-solid fa-angle-left"></i></button>`,
                    nextArrow: `<button type='button' class='slick-next slick-arrow'><i class="fa-solid fa-angle-right"></i></button>`,
                    responsive: [
                        {
                            breakpoint: 1025,
                            settings: {
                                slidesToShow: 3,
                            },
                        },
                        {
                            breakpoint: 480,
                            settings: {
                                slidesToShow: 1,
                                arrows: false,
                                pauseOnFocus: false,
                                pauseOnHover: false,
                            },
                        },
                    ],
                    autoplay: true,
                    autoplaySpeed: 1000,
                });
>>>>>>> Stashed changes
            }
        });
    });
});
<<<<<<< Updated upstream
    </script>
</body>
</html>
>>>>>>> Stashed changes
=======



// $(window).resize(function() {
//     var windowWidth = $(window).width();
//     var numSlidesToShow = Math.floor(windowWidth / 220); 
//     var categoriesPerSlide = Math.min(numSlidesToShow, <?= $categories_per_slide ?>); 
// });
</script>
    
    </body>

</html>
>>>>>>> Stashed changes
