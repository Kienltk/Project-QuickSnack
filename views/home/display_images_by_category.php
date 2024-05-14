<?php
// Include file kết nối cơ sở dữ liệu
include "../../database/connect_database/index.php";

// Kiểm tra nếu category_id được gửi từ yêu cầu GET
<<<<<<< Updated upstream
if(isset($_GET['category_id'])) {
=======
if (isset($_GET['category_id'])) {
>>>>>>> Stashed changes
    // Lấy category_id từ yêu cầu
    $categoryId = $_GET['category_id'];

    // Truy vấn cơ sở dữ liệu để lấy hình ảnh tương ứng với category_id
    $sql = "SELECT * FROM image_quick_snack WHERE quick_snack_id IN (
        SELECT quick_snack_id FROM category_to_quick_snack WHERE category_id = ?
    ) AND kind = 0";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $categoryId);
    $stmt->execute();
    $result = $stmt->get_result();

    // Kiểm tra nếu có hình ảnh được tìm thấy
<<<<<<< Updated upstream
    if($result->num_rows > 0) {
        // Hiển thị các hình ảnh tương ứng
        while($row = $result->fetch_assoc()) {
=======
    if ($result->num_rows > 0) {
        // Hiển thị các hình ảnh tương ứng
        while ($row = $result->fetch_assoc()) {
>>>>>>> Stashed changes
            $imageUrl = $row['address_img'];
            $quickSnackId = $row['quick_snack_id'];
            echo '<div class="image">';
            echo '<a href="../products/product_detail.php?quick_snack_id=' . $quickSnackId . '">';
            echo '<img src="' . $imageUrl . '" class="img-fluid">';
            echo '</a>';
            echo '</div>';
        }
    } else {
        // Hiển thị thông báo nếu không có hình ảnh tương ứng
        echo '<p>No images found for this category</p>';
    }
}
<<<<<<< Updated upstream
?>
=======
?>
>>>>>>> Stashed changes
