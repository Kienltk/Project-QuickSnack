<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include ('../../database/connect_database/index.php');

    // Kiểm tra và xử lý dữ liệu
    $quick_snack_id = $_POST['quick_snack_id'] ?? ''; // Tránh lỗi nếu 'quick_snack_id' không tồn tại
    $comment = htmlspecialchars($_POST['comment']); // Xử lý ký tự đặc biệt trong comment
    $rating = (int) $_POST['rating']; // Chuyển đổi rating thành kiểu số nguyên
    $user_id = $_POST['user_id'];

    // Chuẩn bị câu lệnh SQL sử dụng prepared statement
    $query = "INSERT INTO review (quick_snack_id,user_id, comment, rating) VALUES (?,?,?,?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("iisi", $quick_snack_id, $user_id, $comment, $rating);

    // Thực thi câu lệnh SQL
    if ($stmt->execute()) {
        header("Location: ../../views/products/product_detail.php?quick_snack_id=$quick_snack_id");
        exit; // Dừng kịch bản sau khi chuyển hướng
    } else {
        echo "Error: " . $stmt->error;
    }

    // Đóng kết nối
    $stmt->close();
    $conn->close();
}
