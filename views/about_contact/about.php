<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Quicksnacks</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="../../public/css/style.css">
    <link rel="stylesheet" href="../../public/css/about.css">
    <link rel="stylesheet" href="../../public/css/header.css">
    <link rel="stylesheet" href="../../public/css/footer.css">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: Arial, sans-serif;
        }

        .background {
            background-color: #FFFFFF;
            border: 2px solid #FFA500;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
        }

        .background:hover {
            transform: translateY(-5px);
        }

        .col-lg-2:hover {
            box-shadow: 0 0 10px rgba(255, 165, 0, 0.5);
        }

        .background img {
            transition: transform 0.3s ease-in-out;
        }

        .background:hover img {
            transform: scale(1.1);
        }


        h2 {
            font-weight: bold;
            color: #FFA500;
        }

        h3 {
            font-weight: bold;
            color: #333;
        }

        h2 {
            font-size: 24px;
            margin-bottom: 10px;
        }

        h3 {
            font-size: 18px;
            margin-bottom: 15px;
        }

        /* Container styles */
        .container {
            max-width: 1200px;
            margin: 40px auto;
            padding: 20px;
        }

        .container-xxl {
            max-width: 1400px;
            margin: 40px auto;
            padding: 20px;
        }

        /* Grid styles */
        .row {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
        }

        .col-lg-2 {
            flex: 0 0 20%;
            max-width: 20%;
            margin: 10px;
        }

        .col-lg-2:hover {
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        }

        /* Header styles */
        header {
            background-color: #FFFFFF;
            padding: 20px;
            text-align: center;
        }

        header h2 {
            font-size: 36px;
            margin-bottom: 10px;
        }

        #our_story,
        #our_mission,
        #our_content,
        #our_goals {
            color: #FFA500;
        }

        @media (min-width: 576px) and (max-width: 1000px) {
            .col-lg-2 {
                flex: 0 0 calc(50% - 20px);
                max-width: calc(50% - 20px);
            }
        }


        @media (max-width: 576px) {
            .col-lg-2 {
                flex-basis: 50%;
                max-width: 50%;
            }

            .row {
                flex-wrap: wrap;
            }

            .col-lg-2:nth-child(odd) {
                margin-right: 0;
            }
        }

        /* Điều chỉnh kích thước ảnh cho thiết bị có độ phân giải thấp hơn */
        @media (max-width: 576px) {
            .background img {
                height: 80px;
                width: auto;
            }
        }
    </style>
</head>

<body>
    <!-- header -->
    <?php
    include '..\includes\header.php';
    ?>
    <div id="page_1">
        <header class="container text-center">
            <div class="row">
                <h2 class="py-3 pt-5 fw-bold">About Quicksnacks</h2>
                <div class="col-md-10 offset-md-1">
                    <h3 class="pb-3 fw-bold">
                        Welcome to QuickSnacks -
                        where we share quick, delicious,
                        and convenient recipes that you
                        can make at home! At QuickSnacks,
                        we believe that everyone can become
                        a talented chef in their own household
                        and create amazing meals in just a few minutes.
                    </h3>
                </div>
            </div>
        </header>
        <div class="container-xxl text-center">
            <div class="row justify-content-evenly">
                <div class="col-lg-2 mb-2 background">
                    <header id="our_mission" class="fs-4 fw-bold fst-italic pt-2 header">
                        Our Mission
                    </header>
                    <div class="text-center">
                        <img src="../../public/image/our_mission.png" height="120px" class="my-3">
                    </div>
                    <span id="our_mission_body">
                        The mission of QuickSnacks
                        is to create a passionate
                        culinary community where
                        people can share and learn
                        simple yet delicious recipes.
                        We aim to inspire individuals
                        to enjoy tasty meals without
                        spending too much time and effort.
                    </span>
                    <div class="white_rectangle"></div>
                </div>
                <div class="col-lg-2 mb-2 background">
                    <header id="our_story" class="fs-4 fw-bold fst-italic pt-2 header">
                        Our Story
                    </header>
                    <div class="text-center">
                        <img src="../../public/image/our_story.png" height="120px" class="my-3">
                    </div>
                    <span id="our_story_body">
                        QuickSnacks was founded out of a
                        passion for food and a desire to
                        share knowledge about quick and
                        tasty recipes. From family secrets
                        to unique creations, we strive to
                        provide people with memorable culinary
                        experiences.
                    </span>
                    <div class="white_rectangle"></div>
                </div>
                <div class="col-lg-2 mb-2 background">
                    <header id="our_content" class="fs-4 fw-bold fst-italic pt-2 header">
                        Our Content
                    </header>
                    <div class="text-center">
                        <img src="../../public/image/our_content.png" height="120px" class="my-3">
                    </div>
                    <span id="our_content_body">
                        QuickSnacks offers a wide range
                        of diverse recipes from around
                        the world, including savory and
                        sweet dishes, appetizers, and desserts.
                        We also share tips and cooking
                        techniques to help you execute recipes
                        easily and successfully.
                    </span>
                    <div class="white_rectangle"></div>
                </div>
                <div class="col-lg-2 mb-2 background">
                    <header id="our_goals" class="fs-4 fw-bold fst-italic pt-2 header">
                        Our Goals
                    </header>
                    <div class="text-center">
                        <img src="../../public/image/our_goals.png" height="120px" class="my-3">
                    </div>
                    <span id="our_goals_body">
                        Our goal is to become the top
                        destination for food lovers who
                        want to execute quick recipes smartly
                        and creatively. We look forward to sharing
                        and learning from our community, creating
                        an inspiring and supportive environment.
                    </span>
                    <div class="white_rectangle"></div>
                </div>
            </div>
        </div>
    </div>
    <?php
    include '..\includes\footer.php';
    ?>
    <script src="https://kit.fontawesome.com/54dbfefd83.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>

</html>