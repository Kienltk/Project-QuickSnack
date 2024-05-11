<?php
$current_page = $_SERVER['PHP_SELF'];

$pages_to_highlight = array(
    '/category.php',
    '/products.php',
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
            case '/products.php':
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
        <a class="navbar-brand ms-3" href="../home/home.php">
            <img src="../../public/image/logo.png" alt="" width="100" height="100">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mx-auto fs-5">
                <li class="nav-item">
                    <a class="nav-link mx-3 navbar_text <?php echo $category_class; ?>" href="../products/category.php">Category</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link mx-3 navbar_text <?php echo $food_class; ?>" href="../products/products.php">Food</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link mx-3 navbar_text <?php echo $gallery_class; ?>" href="../products/gallery.php">Gallery</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link mx-4 navbar_text <?php echo $login_class; ?>" href="../../views/products/My_saved_recipes.php">My Saved Recipes</a>

                </li>

            </ul>
            <form class="d-flex" role="search" style="width: 30%;">
                <div class="input-group me-1">
                    <input class="form-control" type="search" placeholder="Search" aria-label="Search" id="search_bar">
                    <div class="input-group-text">
                        <button class="btn" type="submit" id="search_icon"><i class="fas fa-search"></i></button>
                    </div>
                </div>
            </form>

            <?php
            if (isset($_COOKIE["userID"])) {
            ?>
                <div class="dropdown">
                    <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fa-solid fa-user fs-4"></i>
                    </button>
                    <ul class="dropdown-menu" style="width:max-content">
                        <li style="width:max-content"><a class="dropdown-item" href="#">Profile</a></li>
                        <li style="width:max-content"><a class="dropdown-item" href="../../models/user/logout.php">Logout</a></li>
                    </ul>
                </div>
            <?php } else { ?>
                <a href="../auth/SignIn.html">
                    <button class="btn btn-outline-success mt-2 mb-2">
                        Sign in
                    </button>
                </a>
            <?php } ?>
        </div>
    </div>
</nav>
