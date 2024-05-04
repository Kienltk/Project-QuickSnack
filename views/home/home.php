<<<<<<< Updated upstream
=======
<?php
include("../../database/connect_database/index.php");

function getRandomImage0Url($conn)
{
    $sql = "SELECT quick_snack_id, address_img FROM image_quick_snack WHERE kind = 0 ORDER BY RAND() LIMIT 1";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        $row = mysqli_fetch_assoc($result);
        return $row;
    } else {
        return null;
    }
}

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
    } else {
        return null;
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Quick Snack</title>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../../public/css/home.css" />
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
            $randomImage0 = getRandomImage0Url($conn);
            if ($randomImage0) {
                echo '<a href="product-detail.php?quick_snack_id=' . $randomImage0['quick_snack_id'] . '">';
                echo '<img src="' . $randomImage0['address_img'] . '" class="img-fluid" alt="Random Image">';
                echo '</a>';
            } else {
                echo '<img src="" class="img-fluid" alt="Random Image">';
            }
            ?>
        </div>
        <div class="mt-5">
            <p class="text-center fs-1 fw-bold">QuickSnacks based on preferences</p>
        </div>
        <div class="position-relative" style="height: 35px;">
            <hr style="color: #E37E21; width: 30%; height: 5px; background-color: #E37E21; border-radius: 5px; opacity: 1;" class="position-absolute top-0 start-50 translate-middle-x">
        </div>

        <div style="border-top: #F27900 solid 2px; border-bottom: #F27900 solid 2px;" class="my-5">
            <div class="row justify-content-center mx-2 mt-3 mb-5">
                <span class="category-item badge fs-5 col-2 mb-2 me-1" style="opacity: 100%;">All</span>
                <span class="category-item badge fs-5 col-2 mb-2 me-1">Kids</span>
                <span class="category-item badge fs-5 col-2 mb-2 me-1">Healthy</span>
                <span class="category-item badge text-wrap fs-5 col-4 mb-2 me-1">Easy to Digest</span>
                <span class="category-item badge fs-5 col-2 mb-2 me-1">Smoothies</span>
            </div>

            <div class="image-slider">
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
            </div>
        </div>

        <div>
            <div>
                <span class="fw-bold fs-1">Burger King <i class="fa-solid fa-burger"></i></span>
            </div>
            <div class="row my-3">
                <div class="col-12 col-md-6 mb-3">
                    <img src="../../public/image/big-hamburger-with-double-beef-french-fries_252907-8 1.png" alt="" class="rounded img-fluid text-center" />

                </div>
                <div class="col-12 col-md-6">
                    <div class="row row-cols-1 row-cols-md-2 g-4">
                        <div class="col">
                            <div class="card rounded-4 shadow-lg p-3 mb-2 bg-body-tertiary" style="border-color: #f2790071;">
                                <div class="card-title d-flex my-3">
                                    <img src="../../public/image/Ellipse 217.png" alt="..." style="width: 50px; height: 50px;">
                                    <div class="ms-2">
                                        <div class="fs-5 fw-bold" style="margin: 0;">Name</div>
                                        <div style="font-size: x-small;">
                                            <i class="fa-solid fa-star text-warning"></i>
                                            <i class="fa-solid fa-star text-warning"></i>
                                            <i class="fa-solid fa-star text-warning"></i>
                                            <i class="fa-solid fa-star text-warning"></i>
                                            <i class="fa-solid fa-star text-secondary"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <p class="card-text fs-5 fw-normal">Amazing</p>
                                </div>
                            </div>
                        </div>
                        <div class="col d-none d-sm-block">
                            <div class="card rounded-4 shadow-lg p-3 mb-2 bg-body-tertiary" style="border-color: #f2790071;">
                                <div class="card-title d-flex my-3">
                                    <img src="../../public/image/Ellipse 217.png" alt="..." style="width: 50px; height: 50px;">
                                    <div class="ms-2">
                                        <div class="fs-5 fw-bold" style="margin: 0;">Name</div>
                                        <div style="font-size: x-small;">
                                            <i class="fa-solid fa-star text-warning"></i>
                                            <i class="fa-solid fa-star text-warning"></i>
                                            <i class="fa-solid fa-star text-warning"></i>
                                            <i class="fa-solid fa-star text-warning"></i>
                                            <i class="fa-solid fa-star text-secondary"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <p class="card-text fs-5 fw-normal">Amazing</p>
                                </div>
                            </div>
                        </div>
                        <div class="col d-none d-sm-block">
                            <div class="card rounded-4 shadow-lg p-3 mb-2 bg-body-tertiary" style="border-color: #f2790071;">
                                <div class="card-title d-flex my-3">
                                    <img src="../../public/image/Ellipse 217.png" alt="..." style="width: 50px; height: 50px;">
                                    <div class="ms-2">
                                        <div class="fs-5 fw-bold" style="margin: 0;">Name</div>
                                        <div style="font-size: x-small;">
                                            <i class="fa-solid fa-star text-warning"></i>
                                            <i class="fa-solid fa-star text-warning"></i>
                                            <i class="fa-solid fa-star text-warning"></i>
                                            <i class="fa-solid fa-star text-warning"></i>
                                            <i class="fa-solid fa-star text-secondary"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <p class="card-text fs-5 fw-normal">Amazing</p>
                                </div>
                            </div>
                        </div>
                        <div class="col d-none d-sm-block">
                            <div class="card rounded-4 shadow-lg p-3 mb-2 bg-body-tertiary" style="border-color: #f2790071;">
                                <div class="card-title d-flex my-3">
                                    <img src="../../public/image/Ellipse 217.png" alt="..." style="width: 50px; height: 50px;">
                                    <div class="ms-2">
                                        <div class="fs-5 fw-bold" style="margin: 0;">Name</div>
                                        <div style="font-size: x-small;">
                                            <i class="fa-solid fa-star text-warning"></i>
                                            <i class="fa-solid fa-star text-warning"></i>
                                            <i class="fa-solid fa-star text-warning"></i>
                                            <i class="fa-solid fa-star text-warning"></i>
                                            <i class="fa-solid fa-star text-secondary"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <p class="card-text fs-5 fw-normal">Amazing</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="row">
                <div class="col position-relative">
                    <div class="position-relative position-absolute top-50 end-0 translate-middle-y arrow">
                        <i class="fa-solid fa-chevron-left fa-xl position-absolute top-50 start-50 translate-middle"></i>
                    </div>
                </div>
                <div class="col-8 col-sm-2">
                    <img src="../../public/image/big-hamburger-with-double-beef-french-fries_252907-8 1.png" alt="" srcset="" class="img-fluid">
                </div>
                <div class="col-2 d-none d-sm-block">
                    <img src="../../public/image/big-hamburger-with-double-beef-french-fries_252907-8 1.png" alt="" srcset="" class="img-fluid">
                </div>
                <div class="col-2 d-none d-sm-block">
                    <img src="../../public/image/big-hamburger-with-double-beef-french-fries_252907-8 1.png" alt="" srcset="" class="img-fluid">
                </div>
                <div class="col position-relative">
                    <div class="position-relative position-absolute top-50 start-0 translate-middle-y arrow">
                        <i class="fa-solid fa-chevron-right fa-xl position-absolute top-50 start-50 translate-middle"></i>
                    </div>
                </div>
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
    </body>

</html>
>>>>>>> Stashed changes
