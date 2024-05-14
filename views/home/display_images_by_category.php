<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Image Gallery</title>
    <!-- Link Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Tùy chỉnh CSS của bạn nếu cần */
        .image {
            margin-bottom: 20px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="row justify-content-center">
            <?php
            include "../../database/connect_database/index.php";

            if (isset($_GET['category_id'])) {
                $categoryId = $_GET['category_id'];
                $sql = "SELECT * FROM image_quick_snack WHERE quick_snack_id IN (
          SELECT quick_snack_id FROM category_to_quick_snack WHERE category_id = ?
        ) AND kind = 0";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("i", $categoryId);
                $stmt->execute();
                $result = $stmt->get_result();

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $imageUrl = $row['address_img'];
                        $quickSnackId = $row['quick_snack_id'];
                        echo '<div class="col-md-2 ">';
                        echo '<div class="image">';
                        echo '<a href="../products/product_detail.php?quick_snack_id=' . $quickSnackId . '">';
                        echo '<img src="' . $imageUrl . '" class="img-fluid" style = "border: 2px solid #f57c0c;">';
                        echo '</a>';
                        echo '</div>';
                        echo '</div>';
                    }
                } else {
                    echo '<p class="col-12 text-center">No images found for this category</p>';
                }
            }
            ?>
        </div>
    </div>
</body>

</html>