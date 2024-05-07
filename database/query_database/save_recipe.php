<?php
session_start();

if (isset($_SESSION['user_id'])) {
    // Đã đăng nhập, nên lưu sản phẩm vào danh sách yêu thích của người dùng
    $userId = $_SESSION['user_id'];
    $productId = $_GET['quick_snack_id'];

    // Ở đây bạn có thể thêm mã SQL để thêm sản phẩm vào danh sách yêu thích của người dùng trong cơ sở dữ liệu
    // Ví dụ:
    include ('../../database/connect_database/index.php');
    $query = "INSERT INTO favorite_recipes (user_id, quick_snack_id) VALUES ($userId, $productId)";
    $conn->query($query);

    echo "Product saved to favorites successfully!";
} else {
    // Người dùng chưa đăng nhập, không thể lưu sản phẩm
    echo "You need to log in to save recipes to favorites.";
}
?>