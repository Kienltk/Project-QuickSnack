<?php
//to-delete
include ("../../database/connect_database/index.php");
$query = "SELECT user_id, username FROM user WHERE user_id = '$_COOKIE[userID]';";

$result = mysqli_query($conn, $query);
$data = mysqli_fetch_array($result);
//


include ("../../models/products/my_saved_recipes_function.php");

if (!isset($_COOKIE["userID"])) {
    header("Location: ../auth/signin.html");
}

if (isset($_POST["add_category"])) {
    addCategory($_COOKIE["userID"]);
}

$user_category = getUserCategory($_COOKIE["userID"]);
if (isset($_GET["id"])) {
    $user_category_product = getProductFromUserCategory($_GET["id"]);
}
$i = 0;

?>

<!doctype html>
<html lang="en">

<head>
    <title><?php echo $data["username"] . "'s Saved Recipes"; ?></title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!-- Bootstrap CSS v5.2.1 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../../public/css/header.css">
    <link rel="stylesheet" href="../../public/css/footer.css">
    <link rel="stylesheet" href="../../public/css/my_saved_recipes.css">

</head>

<body>
    <header>
        <?php
        include ("../includes/header.php");
        ?>
    </header>
    <main>
        <!--Title-->
        <div class="container">
            <h1>
                <form action="" method="POST">
                    My Saved Recipes
                    <button class="btn" value="add_category" name="add_category">Add a Category</button>
                </form>
            </h1>
            <h2>
                <?php
                if (isset($_GET["id"])) {
                    $a = getProductByUserCategoryByCategoryId($_GET["id"]);
                    $row = $a->fetch_assoc();
                    if ($user_category_product->num_rows > 0) {
                        echo "Category: " . $row["user_category_name"];
                    } else
                        echo "Empty list";
                    ?>
                    <a href="my_saved_recipes.php"><br>Back</a>
                    <?php
                }
                ?>
            </h2>
            <?php
            if (!isset($_GET["id"])) {
                ?>
                <button type="button" class="btn dropdown-toggle ms-auto" data-bs-toggle="dropdown"
                    aria-expanded="false">Sort</button>
                <ul name="sort" id="" class="dropdown-menu">
                    <li><a class="dropdown-item" href="">Sort</a></li>
                    <li><a class="dropdown-item" href="">Name</a></li>
                </ul>
                <!--content-->
                <?php
                if ($user_category->num_rows > 0) {
                    $i = 0;
                    while ($row = $user_category->fetch_assoc()) {
                        $i++;
                        if ($i > 4) {
                            $i = 1;
                        }
                        if ($i == 1) {
                            echo "<div class=\"row\">";
                        }
                        ?>
                        <div class="col-lg-3">
                            <div class="container mb-4 category_tab">
                                <a href="my_saved_recipes.php?id=<?php echo $row["user_category_id"]; ?>">
                                    <img src="../../public/image/our_goals.png" alt="" class="category_image pt-3 pt-3"><br>
                                    <h5 class="category_name"><?php echo $row["user_category_name"] ?></h5>
                                </a>
                            </div>
                        </div>
                        <?php
                        if ($i == 4) {
                            echo "</div>";
                        }
                    }
                }
            } else {
                if ($user_category_product->num_rows > 0) {
                    $i = 0;
                    while ($row = $user_category_product->fetch_assoc()) {
                        $i++;
                        if ($i > 4) {
                            $i = 1;
                        }
                        if ($i == 1) {
                            echo "<div class=\"row\">";
                        }
                        ?>
                        <div class="col-lg-3">
                            <div class="container mb-4 category_tab">
                                <img src="<?php echo getImage($row["quick_snack_id"])["address_img"] ?>" alt=""
                                    class="product_image pt-3"><br>
                                <span class="product_category"><?php echo $row["category_name"] ?></span>
                                <h5 class="product_name mt-1 mb-0"><?php echo $row["name"] ?></h5>
                                <div style="text-align: left;">
                                    <span class="product_time"><?php echo $row["time"] ?></span>
                                </div>
                            </div>
                        </div>
                        <?php
                        if ($i == 4) {
                            echo "</div>";
                        }
                    }
                }
            }
            ?>
        </div>
        <?php
        ?>
        </div>
    </main>
    <footer>
        <?php include ("../includes/footer.php") ?>
    </footer>
    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://kit.fontawesome.com/54dbfefd83.js" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
        crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
        crossorigin="anonymous"></script>
</body>

</html>