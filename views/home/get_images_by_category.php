<?php
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