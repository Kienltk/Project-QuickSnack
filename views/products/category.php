<?php
function isInWishlist($quick_snack_id, $conn, $user_id)
{
    $query = "SELECT qs.user_id, qsuc.quick_snack_id, qsuc.user_category_id
        FROM quick_snack qs
        JOIN quick_snack_to_user_category qsuc ON qs.quick_snack_id = qsuc.quick_snack_id
        JOIN user_category uc ON qsuc.user_category_id = uc.user_category_id
        WHERE qs.user_id = ?
        AND qs.quick_snack_id = ?;
        ";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("si", $user_id, $quick_snack_id);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->num_rows > 0;
}
?>

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

        .pagination .page-item.active .page-link {
            background-color: #E37E21 !important;
            border-color: #E37E21 !important;
        }

        .pagination .page-link {
            color: #E37E21;
        }

        .pagination a {
            margin: 0 5px;
            padding: 5px;
            border-radius: 5px;
            text-decoration: none;
            color: #333;
        }

        .pagination .page-link:hover {
            background-color: #E37E21 !important;
            color: white;
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

            // Truy vấn để lấy tổng số lượng bản ghi
            $sql_total = "SELECT COUNT(*) as total FROM image_category";
            $result_total = $conn->query($sql_total);
            $row_total = $result_total->fetch_assoc();
            $total_records = $row_total['total'];

            $limit = 8; // Số bản ghi trên mỗi trang
            $total_pages = ceil($total_records / $limit); // Số lượng trang
            $page = isset($_GET['page']) ? $_GET['page'] : 1; // Trang hiện tại
            $start = ($page - 1) * $limit; // Vị trí bắt đầu của bản ghi
            
            // Truy vấn để lấy dữ liệu từ bảng image_category
            $sql = "SELECT * FROM image_category LIMIT $start, $limit";
            $result = $conn->query($sql);

            // Kiểm tra nếu có dữ liệu được trả về
            if ($result->num_rows > 0) {
                // Duyệt qua từng hàng dữ liệu và hiển thị
                while ($row = $result->fetch_assoc()) {
                    echo '<div class="col-12 col-sm-6 col-lg-3 mb-3">';
                    echo '<a href="products.php?categoryId='.$row["id"].'">';
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

        <!-- Điều hướng phân trang -->
        <nav aria-label="Page navigation">
            <ul class="pagination justify-content-center">
                <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                    <li class="page-item <?= $i == $page ? 'active' : '' ?>">
                        <a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a>
                    </li>
                <?php endfor; ?>
            </ul>
        </nav>
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