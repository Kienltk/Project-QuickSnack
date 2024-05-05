<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="../../public/css/header.css">
    <style>
        .navbar {
            background-color: #ffffff;
            padding-top: 10px;
            padding-bottom: 10px;
            padding-left: 30px;
            padding-right: 30px;
        }

        #search_bar {
            width: 30% !important;
        }

        .navbar_text {
            transition: transform 0.3s;
        }

        .navbar_text:hover {
            color: #ffa500 !important;
            transform: scale(1.1);
        }

        .active {
            color: #ffa500 !important;
            font-weight: bolder;
        }
    </style>

</head>

<body>
    <?php
    $current_page = $_SERVER['PHP_SELF'];

    $pages_to_highlight = array(
        '/category.php',
        '/food.php',
        '/gallery.php',
        '/login.php'
    );


    $category_class = '';
    $food_class = '';
    $gallery_class = '';
    $login_class = '';


    foreach ($pages_to_highlight as $page) {
        if (strpos($current_page, $page) !== false) {

            switch ($page) {
                case '/category.php':
                    $category_class = 'active';
                    break;
                case '/food.php':
                    $food_class = 'active';
                    break;
                case '/gallery.php':
                    $gallery_class = 'active';
                    break;
                case '/login.php':
                    $login_class = 'active';
                    break;
            }
        }
    }
    ?>

    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand ms-3" href="#">
                <img src="../../public/image/Untitled-1 1.png" alt="" width="50" height="30">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item">
                        <a class="nav-link mx-3 navbar_text <?php echo $category_class; ?>" href="../products/category.php">Category</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link mx-3 navbar_text <?php echo $food_class; ?>" href="food.php">Food</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link mx-3 navbar_text <?php echo $gallery_class; ?>" href="gallery.php">Gallery</a>
                    </li>
                    <li class="nav-item">

                        <a class="nav-link mx-4 navbar_text <?php echo $login_class; ?>" href="login.php" id="saved_recipes">My Saved Recipes</a>
                    </li>

                </ul>
                <form class="d-flex" role="search" style="padding-right: 20px;">
                    <div class="input-group me-1">
                        <input class="form-control" type="search" placeholder="Search" aria-label="Search" id="search_bar">
                        <div class="input-group-text">
                            <button class="btn" type="submit" id="search_icon"><i class="fas fa-search"></i></button>
                        </div>
                    </div>
                </form>
                <!-- if signed in {
                        account icon dropdown when hover;
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Dropdown
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="">Action</a></li>
                                <li><a class="dropdown-item" href="">Another action</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="">Something else here</a></li>
                            </ul>
                        </li>
                    } -->
                <a href="login.php">
                    <button class="btn btn-outline-success mt-2 mb-2">
                        Sign in
                    </button>
                </a>
            </div>
        </div>
    </nav>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <script>
        // navbar fixed on scroll
        document.addEventListener("DOMContentLoaded", function() {
            window.addEventListener('scroll', function() {
                if (window.scrollY > 50) {
                    document.querySelector('nav').classList.add('fixed-top');
                    navbar_height = document.querySelector('nav').offsetHeight;
                    document.body.style.paddingTop = navbar_height + 'px';
                } else {
                    document.querySelector('nav').classList.remove('fixed-top');
                    document.body.style.paddingTop = '0';
                }
            });
        });
    </script>
</body>

</html>