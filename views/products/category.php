<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Category Page</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <style>
        .card {
            box-shadow: rgba(0, 0, 0, 0.3) 0px 19px 38px, rgba(0, 0, 0, 0.22) 0px 15px 12px !important; 
            margin: 15px !important;
            
        }
        .card-img-top {
            border-radius: 50%  !important;
            width: 150px    !important; 
            height: 150px   !important; 
            object-fit: cover   !important; 
            align-self: center  !important; 
        }
        .card-title {
            text-align: center  !important;
            height: 50px !important;
            margin-top: 10px    !important; 
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
        
        // Truy vấn để lấy dữ liệu từ bảng image_category
        $sql = "SELECT * FROM image_category";
        $result = $conn->query($sql);
        
        // Kiểm tra nếu có dữ liệu được trả về
        if ($result->num_rows > 0) {
            // Duyệt qua từng hàng dữ liệu và hiển thị
            while($row = $result->fetch_assoc()) {
                echo '<div class="col-md-3 mb-3">';
                echo '<div class="card">';
                echo '<img src="' . $row["address_img_category"] . '" class="card-img-top" alt="Category Image">';
                echo '<div class="card-body">';
                echo '<h5 class="card-title">' . $row["name"] . '</h5>';
                echo '</div>';
                echo '</div>';
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
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>