<!-- <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../../public/css/header.css">
    <style>
        /* .navbar {
            background-color: #ffffff;
            padding-top: 10px;
            padding-bottom: 10px;
            padding-left: 30px;
            padding-right: 30px;
        }

        #search_bar {
            width: 30% !important;
        } */

        /* .navbar_text {
            transition: transform 0.3s;
        } */

        /* .navbar_text:hover {
            color: #ffa500 !important;
            transform: scale(1.1);
        } */
/* 
        .active {
            color: #ffa500 !important;
            font-weight: bolder;
        } */
    </style>

</head>

<body> -->

<?php
$current_page = $_SERVER['PHP_SELF'];

$pages_to_highlight = array(
    '/category.php',
    '/products.php',
    '/gallery.php',
    '/My_saved_recipes.php'
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
            case '/My_saved_recipes.php':
                $login_class = 'active';
                break;
        }
    }
}
include ("../../database/connect_database/index.php");

$user_id = isset($_COOKIE["userID"]) ? $_COOKIE["userID"] : null;
if ($user_id) {
    $sql = "SELECT fullname FROM user WHERE user_id = $user_id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $user_fullname = $row["fullname"];
    }
}

?>

<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <a class="navbar-brand ms-3" href="../home/home.php">
            <img src="../../public/image/logo.png" alt="" width="100" height="100">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mx-auto fs-5">
                <li class="nav-item">
                    <a class="nav-link mx-3 navbar_text <?php echo $category_class; ?>"
                        href="../products/category.php">Category</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link mx-3 navbar_text <?php echo $food_class; ?>"
                        href="../products/products.php">Food</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link mx-3 navbar_text <?php echo $gallery_class; ?>"
                        href="../products/gallery.php">Gallery</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link mx-4 navbar_text <?php echo $login_class; ?>"
                        href="../../views/products/My_saved_recipes.php">My Saved Recipes</a>

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
            <div id="search_results"></div>
            <div id="popupSearch" class="popup">
                <div class="popup-content">
                    <span class="close" id="closePopup">&times;</span>
                    <form class="d-flex" role="search" style="width: 100%;">
                        <div class="input-group me-1">
                            <input class="form-control search-bar-popup" type="search" placeholder="Search"
                                aria-label="Search" id="search-bar-popup">
                            <div class="input-group-text" style="border: 2px solid #ff8800 !important;">
                                <button class="btn search-icon-popup"><i class="fas fa-search"></i></button>
                            </div>
                        </div>
                    </form>
                    <div id="search-results-popup"></div>
                </div>
            </div>




            <?php
            if (isset($_COOKIE["userID"])) {
                ?>
                <div class="dropdown">
                    <button class="btn  dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fa-solid fa-user fs-4"></i>
                    </button>
                    <ul class="dropdown-menu dropdownUser">
                        <li style="font-weight: bold;
                                    color: #ffa500;
                                    padding-left: 10px ;"> <?php echo $user_fullname; ?></li>
                        <li><a class="dropdown-item" href="../auth/user_profile.php"><i class="fa-solid fa-user"></i>
                                Profile</a></li>
                        <li><a class="dropdown-item" href="../../models/user/logout.php"><i
                                    class="fa-solid fa-right-from-bracket"></i> Logout</a></li>
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


<script>
    document.addEventListener("DOMContentLoaded", function () {
        const searchBar = document.getElementById('search_bar');
        const searchResults = document.getElementById('search_results');
        searchResults.style.display = 'none';
        searchBar.addEventListener('input', function () {
            const searchTerm = searchBar.value.trim(); // Get the value of the search input
            if (searchTerm !== '') {
                // Send AJAX request to fetch search results
                const xhr = new XMLHttpRequest();
                xhr.open('POST', '../includes/search.php', true);
                xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                xhr.onreadystatechange = function () {
                    if (xhr.readyState == 4 && xhr.status == 200) {
                        // Handle the response and display search results
                        searchResults.innerHTML = xhr.responseText;
                        searchResults.style.display = 'block';
                    }
                };
                xhr.send('action=search_term&data=' + searchTerm);
            } else {
                // If search term is empty, clear search results
                searchResults.innerHTML = '';
                searchResults.style.display = 'none';
            }
        });
    });
    document.addEventListener("DOMContentLoaded", function () {
        const searchBar = document.getElementById('search_bar');
        const searchIcon = document.getElementById('search_icon');

        searchIcon.addEventListener('click', function (event) {
            event.preventDefault();

            const searchTerm = searchBar.value.trim();
            if (searchTerm !== '') {
                window.location.href = '../products/products.php?search=' + encodeURIComponent(searchTerm);
            } else {
                window.location.href = '../products/products.php';
            }
        });
    });

    window.addEventListener('scroll', function () {
        if (window.scrollY > 50) {
            document.querySelector('nav').classList.add('fixed-top');
            navbar_height = document.querySelector('nav').offsetHeight;
            document.body.style.paddingTop = navbar_height + 'px';
        } else {
            document.querySelector('nav').classList.remove('fixed-top');
            document.body.style.paddingTop = '0';
        }
    });
    if (window.matchMedia("(max-width: 756px)").matches) {
        document.getElementById("search_icon").id = "search_icon_mb";
    }
    window.addEventListener('resize', function () {
        if (window.matchMedia("(max-width: 756px)").matches) {
            document.getElementById("search_icon").id = "search_icon_mb";
        } else {
            if (document.getElementById("search_icon_mb")) {
                document.getElementById("search_icon_mb").id = "search_icon";
            }
        }
    });
    // JavaScript for Popup Search
    document.addEventListener("DOMContentLoaded", function () {
        const searchBarPopup = document.getElementById('search-bar-popup');
        const searchResultsPopup = document.getElementById('search-results-popup');
        searchResultsPopup.style.display = 'none';
        searchBarPopup.addEventListener('input', function () {
            const searchTerm = searchBarPopup.value.trim(); // Get the value of the search input
            if (searchTerm !== '') {
                // Send AJAX request to fetch search results
                const xhr = new XMLHttpRequest();
                xhr.open('POST', '../includes/search.php', true);
                xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                xhr.onreadystatechange = function () {
                    if (xhr.readyState == 4 && xhr.status == 200) {
                        // Handle the response and display search results
                        searchResultsPopup.innerHTML = xhr.responseText;
                        searchResultsPopup.style.display = 'block';
                    }
                };
                xhr.send('action=search_term&data=' + searchTerm);
            } else {
                // If search term is empty, clear search results
                searchResultsPopup.innerHTML = '';
                searchResultsPopup.style.display = 'none';
            }
        });
    });
    document.getElementById("search_icon_mb").addEventListener("click", function () {
        event.preventDefault();
        document.getElementById("popupSearch").style.display = "flex";
    });

    document.getElementById("closePopup").addEventListener("click", function () {
        document.getElementById("popupSearch").style.display = "none";
    });

    document.addEventListener("DOMContentLoaded", function () {
        const searchBarPopup = document.querySelector('.search-bar-popup');
        const searchIconPopup = document.querySelector('.search-icon-popup');
        const searchResultsPopup = document.querySelector('.search-results-popup');

        searchIconPopup.addEventListener('click', function (event) {
            event.preventDefault();
            const searchTerm = searchBarPopup.value.trim();
            if (searchTerm !== '') {
                // Handle search action here, e.g., redirect to search results page
                // Replace the following line with your desired action
                window.location.href = '../products/products.php?search=' + encodeURIComponent(searchTerm);
            }
        });
    });

</script>


<!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script> -->

<!-- <script>
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
</script> -->
<!-- </body>

</html> -->