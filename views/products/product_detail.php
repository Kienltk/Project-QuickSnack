<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Product Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://unpkg.com/ionicons@5.1.2/dist/ionicons.min.css" />
    <link rel="stylesheet" href="../../public/css/product-detail.css" />
    <link rel="stylesheet" href="../../public/css/header.css">

    <style></style>
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
                Home > Product > <span class="fw-bold">Russia Salad</span>
            </p>
            <h3>Russian Salad</h3>
        </div>
        <!-- <div class="icon d-flex align-items-center">
            <span class="pt-1 fw-bold">
                <i class="fas fa-user" style="color: #ff9a62"></i> Author
            </span>
            <span class="pt-1 fw-bold">
                <i class="fas fa-comment" style="color: #ff9a62"></i> Comment
            </span>
            <span class="pt-1 fw-bold">
                <i class="fas fa-heart" style="color: #ff9a62"></i> Like
            </span>
            <span class="pt-1 fw-bold">
                <i class="far fa-calendar" style="color: #ff9a62"></i> Apr 30, 2024
            </span>
            <span class="pt-1 fw-bold">
                <i class="fas fa-star star-icon" style="color: #ff9a62"></i>
                <i class="fas fa-star star-icon" style="color: #ff9a62"></i>
                <i class="fas fa-star star-icon" style="color: #ff9a62"></i>
                <i class="fas fa-star star-icon" style="color: #ff9a62"></i>
                <i class="fas fa-star-half-alt star-icon" style="color: #ff9a62"></i>
                <span style="color: #8c8c8c;font-size: small;"> 4.5/5 Review </span>
            </span>
        </div> -->

        <div class="icon align-items-center">
            <div class="d-flex d-sm-inline">
                <span class="pt-1 fw-bold">
                    <i class="fas fa-user" style="color: #ff9a62"></i> Author
                </span>
                <span class="pt-1 fw-bold">
                    <i class="fas fa-comment" style="color: #ff9a62"></i> Comment
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
                <span style="color: #8c8c8c;font-size: small;"> 4.5/5 Review </span>
            </span>
        </div>


        <div class="row pt-4">
            <div class="col-12 col-md-8 pb-0">
                <img src="https://images.pexels.com/photos/1640772/pexels-photo-1640772.jpeg?auto=compress&cs=tinysrgb&w=600" alt="" class="img-fluid w-100 rounded-2" />
                <div class="pt-5 d-flex justify-content-center align-items-center">
                    <span class="text-muted mx-3">
                        <i class="far fa-clock fs-3" style="color: #ff9a62"></i> 50 min
                    </span>
                    <span class="divider mx-3"></span>
                    <span class="text-muted mx-3">
                        <i class="fas fa-user" style="color: #ff9a62"></i> 2 People
                    </span>
                    <span class="divider mx-3"></span>
                    <span class="text-muted mx-3">
                        <i class="fas fa-book" style="color: #ff9a62"></i> Easy
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
                                <td>494</td>
                            </tr>
                            <tr>
                                <th scope="row">Carbs</th>
                                <td>80g</td>
                            </tr>
                            <tr>
                                <th scope="row">Fat</th>
                                <td>18g</td>
                            </tr>
                            <tr>
                                <th scope="row">Protein</th>
                                <td>24g</td>
                            </tr>
                            <tr>
                                <th scope="row">Fiber</th>
                                <td>23g</td>
                            </tr>
                            <tr>
                                <th scope="row">Net carbs</th>
                                <td>56g</td>
                            </tr>
                            <tr>
                                <th scope="row">Sodium</th>
                                <td>444mg</td>
                            </tr>
                            <tr>
                                <th scope="row">Cholesterol</th>
                                <td>0mg</td>
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
                <!-- <div class="center-text">
                    <hr style="border-top: 1px solid #ff9a62" />
                </div> -->
                <ul class="list-group list-group-light">
                    <li class="list-group-item border-0 fw-semibold mb-2">
                        <i class="fas fa-circle text-danger"></i> 1 Prime Rib Roast
                        (standing rib), approximately 8 pounds
                    </li>
                    <li class="list-group-item border-0 fw-semibold mb-2">
                        <i class="fas fa-circle text-danger"></i> 1/2 cup good-quality
                        balsamic vinegar
                    </li>
                    <li class="list-group-item border-0 fw-semibold mb-2">
                        <i class="fas fa-circle text-danger"></i> 1 cup (packed) Italian
                        parsley leaves
                    </li>
                    <li class="list-group-item border-0 fw-semibold mb-2">
                        <i class="fas fa-circle text-danger"></i> 8 cloves garlic, minced
                    </li>
                    <li class="list-group-item border-0 fw-semibold mb-2">
                        <i class="fas fa-circle text-danger"></i> 1/4 teaspoon salt
                    </li>
                    <li class="list-group-item border-0 fw-semibold">
                        <i class="fas fa-circle text-danger"></i> 3 drops Worcestershire
                        sauce
                    </li>
                </ul>
            </div>
            <div class="col-12 col-sm-6 mt-5 mt-sm-0" style="border-left: #E37E21 solid 2px;">
                <h4 class="fs-4 text-center">
                    <i class="fas fa-utensils" style="color: #ff9a62"></i> Recipes
                </h4>
                <!-- <div class="center-text">
                    <hr style="border-top: 1px solid #ff9a62" />
                </div> -->
                <ol class="list-group list-group-light">
                    <li class="list-group-item border-0 fw-semibold mb-2">
                        <i class="fas fa-circle text-danger"></i> Preheat the oven to
                        375°F (190°C).
                    </li>
                    <li class="list-group-item border-0 fw-semibold mb-2">
                        <i class="fas fa-circle text-danger"></i> In a small bowl, mix
                        together the balsamic vinegar, minced garlic, salt, and
                        Worcestershire sauce.
                    </li>
                    <li class="list-group-item border-0 fw-semibold mb-2">
                        <i class="fas fa-circle text-danger"></i> Rub the mixture evenly
                        over the prime rib roast.
                    </li>
                    <li class="list-group-item border-0 fw-semibold mb-2">
                        <i class="fas fa-circle text-danger"></i> Place the roast in a
                        roasting pan and roast in the preheated oven for about 2 hours, or
                        until a meat thermometer inserted into the thickest part registers
                        135°F (57°C) for medium-rare doneness.
                    </li>
                    <li class="list-group-item border-0 fw-semibold mb-2">
                        <i class="fas fa-circle text-danger"></i> Remove the roast from
                        the oven and let it rest for 15-20 minutes before slicing.
                    </li>
                    <li class="list-group-item border-0 fw-semibold">
                        <i class="fas fa-circle text-danger"></i> Serve hot and enjoy!
                    </li>
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

            <div class="comment">
                <div class="comment-header">
                    <div class="comment-avatar">
                        <img src="https://via.placeholder.com/50" alt="Avatar" />
                    </div>
                    <div class="comment-content">
                        <h6>Eren</h6>
                        <p class="comment-date">April 30, 2024</p>
                    </div>
                </div>
                <p class="comment-text">
                    I cooked this meal for my friendsI totally impressed them!100%
                    recommended
                </p>
                <div class="comment-actions mt-2">
                    <i class="fas fa-thumbs-up" style="color: #ff9a62; margin-right: 10px"></i>
                    <i class="fas fa-reply" style="color: #ff9a62"></i>
                </div>
            </div>

            <div class="comment mt-4">
                <div class="comment-header">
                    <div class="comment-avatar">
                        <img src="https://via.placeholder.com/50" alt="Avatar" />
                    </div>
                    <div class="comment-content">
                        <h6>Nguyễn Đình Chiến</h6>
                        <p class="comment-date">May 1, 2024</p>
                    </div>
                </div>
                <p class="comment-text">An idea great</p>
                <div class="comment-actions mt-2">
                    <i class="fas fa-thumbs-up" style="color: #ff9a62; margin-right: 10px"></i>
                    <i class="fas fa-reply" style="color: #ff9a62"></i>
                </div>
            </div>

            <div class="comment mt-4">
                <div class="comment-header">
                    <div class="comment-avatar">
                        <img src="https://via.placeholder.com/50" alt="Avatar" />
                    </div>
                    <div class="comment-content">
                        <h6>Lê Trung Kiên không nói thế</h6>
                        <p class="comment-date">May 2, 2024</p>
                    </div>
                </div>
                <p class="comment-text">I love page</p>
                <div class="comment-actions mt-2">
                    <i class="fas fa-thumbs-up" style="color: #ff9a62; margin-right: 10px"></i>
                    <i class="fas fa-reply" style="color: #ff9a62"></i>
                </div>
            </div>
            <div class="text-center mt-3">
                <button class="btn_comment">Load More Comments</button>
            </div>
        </div>
    </div>

    <footer>
        <?php
        include '..\includes\footer.php';
        ?>
    </footer>
</body>

</html>