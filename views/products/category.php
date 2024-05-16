

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Category Page</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="shortcut icon" href="../../public/image/logo.png" type="image/x-icon">
    <link rel="stylesheet" href="../../public/css/style.css">
    <link rel="stylesheet" href="../../public/css/header.css">
    <link rel="stylesheet" href="../../public/css/footer.css">
    <!-- Custom CSS -->
    <style>
        .card {
            box-shadow: rgba(0, 0, 0, 0.3) 0px 19px 38px, rgba(0, 0, 0, 0.22) 0px 15px 12px !important;
            margin: 15px !important;

        }

        .card-img-top {
            border-radius: 50% !important;
            width: 150px !important;
            height: 150px !important;
            object-fit: cover !important;
            align-self: center !important;
        }

        .card-title {
            text-align: center !important;
            height: 50px !important;
            margin-top: 10px !important;
        }
    </style>
</head>

<body>
    <?php
    include '../../views/includes/header.php';
    ?>
    <div class="container">
        <div class="row">
            <?php
            include ('../../database/connect_database/index.php');
            $sql = "SELECT * FROM image_category";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo '<div class="col-md-3 mb-3">';
                    echo '<a href="products.php?categoryId=' . $row["id"] . '">'; 
                    echo '<div class="card">';
                    echo '<img src="' . $row["address_img_category"] . '" class="card-img-top my-3" alt="Category Image">';
                    echo '<div class="card-body">';
                    echo '<h5 class="card-title">' . $row["name"] . '</h5>';
                    echo '</div>';
                    echo '</div>';
                    echo '</a>'; 
                    echo '</div>';
                }
                
            } else {
                echo "0 results";
            }
            $conn->close();
            ?>
        </div>
    </div>
    <?php
    include '../../views/includes/footer.php';
    ?>

    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://kit.fontawesome.com/54dbfefd83.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>


</body>

</html>