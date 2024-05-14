<?php
include ("../../database/connect_database/index.php");

function getBanner($conn)
{
    $sql = "SELECT * FROM banner ORDER BY RAND() LIMIT 1";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        $row = mysqli_fetch_assoc($result);
        return $row;
    } else {
        return null;
    }
}



function displayCategories($conn)
{
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



?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Quick Snack</title>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="shortcut icon" href="../../public/image/logo.png" type="image/x-icon">
    <link rel="stylesheet" href="../../public/css/style.css">
    <link rel="stylesheet" href="../../public/css/home.css" />
    <link rel="stylesheet" href="../../public/css/header.css">
    <link rel="stylesheet" href="../../public/css/footer.css">


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"
        crossorigin="anonymous" />

    <style>
        @media (max-width: 768px) {

            .carousel-control-prev,
            .carousel-control-next {
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

        .form-control:focus {
            border-color: initial;
            box-shadow: none;
        }
    </style>
</head>

<body">
    <header>
        <?php
        include '..\includes\header.php';
        ?>
    </header>

    <section class="container my-5">
        <div>
            <?php
            $randomImage = getBanner($conn);
            if ($randomImage) {
                echo '<img src="' . $randomImage['address_banner_img'] . '" class="img-fluid" alt="Random Image">';
            } else {
                echo '<img src="" class="img-fluid" alt="Random Image">';
            }
            ?>
        </div>
        <div class="mt-5">
            <p class="text-center fs-1 fw-bold">QuickSnacks based on preferences</p>
        </div>
        <div class="position-relative" style="height: 35px;">
            <hr style="color: #E37E21; width: 30%; height: 5px; background-color: #E37E21; border-radius: 5px; opacity: 1;"
                class="position-absolute top-0 start-50 translate-middle-x">
        </div>

        <div class="carousel slide" data-bs-ride="carousel" id="categoryCarousel">
            <div class="carousel-inner">
                <?php for ($i = 0; $i < $num_slides; $i++): ?>
                    <div class="carousel-item <?= $i == 0 ? 'active' : '' ?>">
                        <div class="d-flex justify-content-center">
                            <?php for ($j = $i * $categories_per_slide; $j < min(($i + 1) * $categories_per_slide, $num_categories); $j++): ?>
                                <button
                                    class="category-item btn btn-outline-primary btn-sm mb-2 me-1 <?= isset($_GET['category']) && $_GET['category'] == $categories[$j]['category_id'] ? 'active' : '' ?>"
                                    data-category-id="<?= $categories[$j]['category_id'] ?>">
                                    <?= $categories[$j]['category_name'] ?>
                                </button>
                            <?php endfor; ?>
                        </div>
                    </div>
                <?php endfor; ?>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#categoryCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true" style="background-color: #E37E21;"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#categoryCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true" style="background-color: #E37E21;"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>

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

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-migrate/3.4.1/jquery-migrate.min.js"
        integrity="sha512-KgffulL3mxrOsDicgQWA11O6q6oKeWcV00VxgfJw4TcM8XRQT8Df9EsrYxDf7tpVpfl3qcYD96BpyPvA4d1FDQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js"
        integrity="sha512-HGOnQO9+SP1V92SrtZfjqxxtLmVzqZpjFFekvzZVWoiASSQgSr4cw9Kqd2+l8Llp4Gm0G8GIFJ4ddwZilcdb8A=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://kit.fontawesome.com/54dbfefd83.js" crossorigin="anonymous"></script>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>

    <script src="../../public/js/home.js"></script>
    <script>
        $(document).ready(function () {
            $('.category-item').click(function () {
                var categoryId = $(this).data('category-id');
                $('.image-slider').load('display_images_by_category.php?category_id=' + categoryId, function () {
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
                            responsive: [{
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
                    }
                });
            });
        });

    </script>

    </body>

</html>