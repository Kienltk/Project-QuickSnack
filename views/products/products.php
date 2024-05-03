<!doctype html>
<html lang="en">
    <head>
        <title>Products</title>
        <!-- Required meta tags -->
        <meta charset="utf-8" />
        <meta
            name="viewport"
            content="width=device-width, initial-scale=1, shrink-to-fit=no"
        />

        <!-- Bootstrap CSS v5.2.1 -->
        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
            crossorigin="anonymous"
        />
        <link rel="stylesheet" href="../../public/css/products.css">
        <link rel="stylesheet" href="../../public/css/header.css">
    </head>

    <body>
            <?php include ("../includes/header.php"); ?>
        <main>
            <div class="container">
                <h2 class="my-5 ">
                    The result for
                    <span class="search_result">"russian salad"</span> <!-- Search result -->
                </h2>
            </div>
            <div class="container">
                <div class="row">
                    <!--Left table-->
                    <div class="col-lg-4">
                        <div class="d-flex my-2">
                            <h3>
                                Filter the Food
                            </h3>
                            <button type="button" class="btn btn-danger dropdown-toggle ms-auto" data-bs-toggle="dropdown" aria-expanded="false">Sort</button>
                            <ul name="sort" id="" class="dropdown-menu">
                                <li><a class="dropdown-item " href="">Sort</a></li>
                                <li><a class="dropdown-item " href="">Name</a></li>
                            </ul>
                        </div>
                        <form action="">
                            <table id="table" class="">
                                <tr class="border_top">
                                    <th>
                                        Category
                                    </th>
                                </tr>
                                <tr>
                                    <td>
                                        <input type="checkbox" name="search" id="" value="kids">
                                        <span>
                                            Kids
                                        </span>
                                    </td>
                                    <td>
                                        <input type="checkbox" name="search" id="" value="healthy">
                                        <span>
                                            Healthy
                                        </span>
                                    </td>
                                    <td>
                                        <input type="checkbox" name="search" id="" value="easy_to_digest">
                                        <span>
                                            Easy to Digest
                                        </span>
                                    </td>
                                </tr>
<!--PHP loop starting here-->
                                <tr>
                                    <td>
                                        <input type="checkbox" name="search" id="" value="smoothie">
                                        <span>
                                            Smoothie
                                        </span>
                                    </td>
                                    <td>
                                        <input type="checkbox" name="search" id="" value="kids">
                                        <span>
                                            Kids
                                        </span>
                                    </td>
                                    <td>
                                        <input type="checkbox" name="search" id="" value="healthy">
                                        <span>
                                            Healthy
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <input type="checkbox" name="search" id="" value="easy_to_digest" class="search_category">
                                        <span>
                                            Easy to Digest
                                        </span>
                                    </td>
                                    <td>
                                        <input type="checkbox" name="search" id="" value="healthy" class="search_category">
                                        <span>
                                            Healthy
                                        </span>
                                    </td>
                                    <td>
                                        <input type="checkbox" name="search" id="" value="easy_to_digest" class="search_category">
                                        <span>
                                            Easy to Digest
                                        </span>
                                    </td>
                                </tr>
                                <tr class="border_top">
                                    <th>
                                        Ingrediants
                                    </th>
                                <tr>
                                    <td>
                                        <input type="checkbox" name="search" id="" value="apple" class="search_ingrediant">
                                        <span>
                                            Apple
                                        </span>
                                    </td>
                                    <td>
                                        <input type="checkbox" name="search" id="" value="vinegar" class="search_ingrediant">
                                        <span>
                                            Vinegar
                                        </span>
                                    </td>
                                    <td>
                                        <input type="checkbox" name="search" id="" value="chocolate" class="search_ingrediant">
                                        <span>
                                            Chocolate
                                        </span>
                                    </td>
                                </tr>
<!--PHP loop starting here-->
                                <tr border_bottom>
                                    <td>
                                        <input type="checkbox" name="search" id="" value="egg" class="search_ingrediant">
                                        <span>
                                            Egg
                                        </span>
                                    </td>
                                    <td>
                                        <input type="checkbox" name="search" id="" value="cucumber" class="search_ingrediant">
                                        <span>
                                            Cucumber
                                        </span>
                                    </td>
                                    <td>
                                        <input type="checkbox" name="search" id="" value="peach" class="search_ingrediant">
                                        <span>
                                            Peach
                                        </span>
                                    </td>
                                </tr>
                                <tr class="border_top">
                                    <th>
                                        Level
                                    </th>
                                </tr>
                                <tr class="border_bottom">
                                    <td>
                                        <input type="radio" name="level" id="easy" value="easy">
                                        Easy
                                    </td>
                                    <td>
                                        <input type="radio" name="level" id="medium" value="medium">
                                        Medium
                                    </td>
                                    <td>
                                        <input type="radio" name="level" id="difficult" value="difficult">
                                        Difficult
                                    </td>
                                </tr>
                                <tr class="border_top">
                                    <th>
                                        Cooking time
                                    </th>
                                </tr>
                                <tr>
                                    <td colspan="3" class="text-center">
                                        <input type="range" class="form-range" name="cooking_time" id="cooking_time" value="5" min="5" max="45" step="5">
                                        <br>
                                        <span>
                                            45 minutes <!-- PHP value-->
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="3" class="text-center">
                                        <input type="submit" value="Filter" id="submit" class="btn my-2">
                                    </td>
                                </tr>
                            </table>
                        </form>
                    </div>
                    <!--Right table-->
                    <div class="col-lg-2">
                        <div class="container mb-4 product_tab">
                            <img src="../../public/image/rounded.png" alt="" class="product_image pt-3 pt-3"><br>
                            <span class="product_category">Dairy Free</span>
                            <h5 class="product_name mt-1 mb-0">Russian Salad</h5>
                            <div style="text-align: left;">
                                <span class="product_time">40 Min</span>
                                <span class="product_rating">4.5</span>
                            </div>
                            <span class="product_icon mb-3">Icon</span>
                        </div>
<!--Column loop start here-->
                        <div class="container my-4 product_tab">
                            <img src="../../public/image/rounded.png" alt="" class="product_image pt-3"><br>
                            <span class="product_category">Dairy Free</span>
                            <h5 class="product_name mt-1 mb-0">Russian Salad</h5>
                            <div style="text-align: left;">
                                <span class="product_time">40 Min</span>
                                <span class="product_rating">4.5</span>
                            </div>
                            <span class="product_icon">Icon</span> <br>
                        </div>
                        <div class="container my-4 product_tab">
                            <img src="../../public/image/rounded.png" alt="" class="product_image pt-3"><br>
                            <span class="product_category">Dairy Free</span>
                            <h5 class="product_name mt-1 mb-0">Russian Salad</h5>
                            <div style="text-align: left;">
                                <span class="product_time">40 Min</span>
                                <span class="product_rating">4.5</span>
                            </div>
                            <span class="product_icon">Icon</span> <br>
                        </div>
                    </div>
<!--Row loop start here-->
                    <div class="col-lg-2">
                        <div class="container mb-4 product_tab">
                            <img src="../../public/image/rounded.png" alt="" class="product_image pt-3"><br>
                            <span class="product_category">Dairy Free</span>
                            <h5 class="product_name mt-1 mb-0">Russian Salad</h5>
                            <div style="text-align: left;">
                                <span class="product_time">40 Min</span>
                                <span class="product_rating">4.5</span>
                            </div>
                            <span class="product_icon mb-3">Icon</span>
                        </div>
<!--Column loop start here-->
                        <div class="container my-4 product_tab">
                            <img src="../../public/image/rounded.png" alt="" class="product_image pt-3"><br>
                            <span class="product_category">Dairy Free</span>
                            <h5 class="product_name mt-1 mb-0">Russian Salad</h5>
                            <div style="text-align: left;">
                                <span class="product_time">40 Min</span>
                                <span class="product_rating">4.5</span>
                            </div>
                            <span class="product_icon">Icon</span> <br>
                        </div>
                        <div class="container my-4 product_tab">
                            <img src="../../public/image/rounded.png" alt="" class="product_image pt-3"><br>
                            <span class="product_category">Dairy Free</span>
                            <h5 class="product_name mt-1 mb-0">Russian Salad</h5>
                            <div style="text-align: left;">
                                <span class="product_time">40 Min</span>
                                <span class="product_rating">4.5</span>
                            </div>
                            <span class="product_icon">Icon</span> <br>
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <div class="container mb-4 product_tab">
                            <img src="../../public/image/rounded.png" alt="" class="product_image pt-3"><br>
                            <span class="product_category">Dairy Free</span>
                            <h5 class="product_name mt-1 mb-0">Russian Salad</h5>
                            <div style="text-align: left;">
                                <span class="product_time">40 Min</span>
                                <span class="product_rating">4.5</span>
                            </div>
                            <span class="product_icon mb-3">Icon</span>
                        </div>
<!--Column loop start here-->
                        <div class="container my-4 product_tab">
                            <img src="../../public/image/rounded.png" alt="" class="product_image pt-3"><br>
                            <span class="product_category">Dairy Free</span>
                            <h5 class="product_name mt-1 mb-0">Russian Salad</h5>
                            <div style="text-align: left;">
                                <span class="product_time">40 Min</span>
                                <span class="product_rating">4.5</span>
                            </div>
                            <span class="product_icon">Icon</span> <br>
                        </div>
                        <div class="container my-4 product_tab">
                            <img src="../../public/image/rounded.png" alt="" class="product_image pt-3"><br>
                            <span class="product_category">Dairy Free</span>
                            <h5 class="product_name mt-1 mb-0">Russian Salad</h5>
                            <div style="text-align: left;">
                                <span class="product_time">40 Min</span>
                                <span class="product_rating">4.5</span>
                            </div>
                            <span class="product_icon">Icon</span> <br>
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <div class="container mb-4 product_tab">
                            <img src="../../public/image/rounded.png" alt="" class="product_image pt-3"><br>
                            <span class="product_category">Dairy Free</span>
                            <h5 class="product_name mt-1 mb-0">Russian Salad</h5>
                            <div style="text-align: left;">
                                <span class="product_time">40 Min</span>
                                <span class="product_rating">4.5</span>
                            </div>
                            <span class="product_icon mb-3">Icon</span>
                        </div>
<!--Column loop start here-->
                        <div class="container my-4 product_tab">
                            <img src="../../public/image/rounded.png" alt="" class="product_image pt-3"><br>
                            <span class="product_category">Dairy Free</span>
                            <h5 class="product_name mt-1 mb-0">Russian Salad</h5>
                            <div style="text-align: left;">
                                <span class="product_time">40 Min</span>
                                <span class="product_rating">4.5</span>
                            </div>
                            <span class="product_icon">Icon</span> <br>
                        </div>
                        <div class="container my-4 product_tab">
                            <img src="../../public/image/rounded.png" alt="" class="product_image pt-3"><br>
                            <span class="product_category">Dairy Free</span>
                            <h5 class="product_name mt-1 mb-0">Russian Salad</h5>
                            <div style="text-align: left;">
                                <span class="product_time">40 Min</span>
                                <span class="product_rating">4.5</span>
                            </div>
                            <span class="product_icon">Icon</span> <br>
                        </div>
                    </div>
                    </div>
                </div>
            </div>

        <!--Bottom Table-->
        <div class="container">
            <h3>
                Recommended QuickFoods
            </h3>
            <div class="row">
                <div class="col-xxl-3" style="border: 1px solid">
                    <img src="../../public/image/rectangle.png" alt="" class="product_image pt-3"><br>
                    <span class="product_category">Dairy Free</span>
                    <h5 class="product_name mt-1 mb-0">Russian Salad</h5>
                    <div style="text-align: left;">
                        <span class="product_time">40 Min</span>
                        <span class="product_rating">4.5</span>
                    </div>
                    <span class="product_icon mb-3">Icon</span>
                </div>
                <div class="col-xxl-3" style="border: 1px solid">
                    <img src="../../public/image/rectangle.png" alt="" class="product_image pt-3"><br>
                    <span class="product_category">Dairy Free</span>
                    <h5 class="product_name mt-1 mb-0">Russian Salad</h5>
                    <div style="text-align: left;">
                        <span class="product_time">40 Min</span>
                        <span class="product_rating">4.5</span>
                    </div>
                    <span class="product_icon mb-3">Icon</span>
                </div>
                <div class="col-xxl-3" style="border: 1px solid">
                    <img src="../../public/image/rectangle.png" alt="" class="product_image pt-3"><br>
                    <span class="product_category">Dairy Free</span>
                    <h5 class="product_name mt-1 mb-0">Russian Salad</h5>
                    <div style="text-align: left;">
                        <span class="product_time">40 Min</span>
                        <span class="product_rating">4.5</span>
                    </div>
                    <span class="product_icon mb-3">Icon</span>
                </div>
                <div class="col-xxl-3" style="border: 1px solid">
                    <img src="../../public/image/rectangle.png" alt="" class="product_image pt-3"><br>
                    <span class="product_category">Dairy Free</span>
                    <h5 class="product_name mt-1 mb-0">Russian Salad</h5>
                    <div style="text-align: left;">
                        <span class="product_time">40 Min</span>
                        <span class="product_rating">4.5</span>
                    </div>
                    <span class="product_icon mb-3">Icon</span>
                </div>
            </div>
            <div class="text-center my-5">
                <button type="button" class="btn" id="load_more">Load more</button>
            </div>
        </div>
        </main>
        <?php include ("../includes/footer.php") ?>
        <!-- Bootstrap JavaScript Libraries -->
        <script
            src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
            integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
            crossorigin="anonymous"
        ></script>

        <script
            src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
            integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
            crossorigin="anonymous"
        ></script>
        <script>
        </script>
    </body>
</html>