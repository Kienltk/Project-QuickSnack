<?php
<<<<<<< Updated upstream
require_once '../../database/connect_database/index.php';

$category_id = $_GET['category_id'];

$sql = "SELECT quick_snack_id, address_img FROM image_quick_snack WHERE kind =? ORDER BY RAND() LIMIT 10";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $category_id);
$stmt->execute();
$result = $stmt->get_result();

$images = [];
while ($row = $result->fetch_assoc()) {
    $images[] = $row;
}

echo json_encode($images);
=======
include("../../database/connect_database/index.php");

// Kiểm tra xem category_id đã được gửi qua AJAX chưa
if (isset($_GET['category_id'])) {
    $category_id = $_GET['category_id'];

    // Truy vấn để lấy danh sách các hình ảnh liên quan đến category được chọn
    $sql = "SELECT * FROM image_quick_snack WHERE quick_snack_id IN (
        SELECT quick_snack_id FROM category_to_quick_snack WHERE category_id = ?
    ) AND kind = 0";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $category_id);
    $stmt->execute();
    $result = $stmt->get_result();

    // Chuyển đổi kết quả thành mảng và trả về dưới dạng JSON
    $images = [];
    while ($row = $result->fetch_assoc()) {
        $images[] = $row;
    }
    echo json_encode($images);
} else {
    // Nếu không có category_id được gửi, trả về một mảng rỗng
    echo json_encode([]);
}
?>
>>>>>>> Stashed changes
