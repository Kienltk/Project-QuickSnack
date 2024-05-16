<?php
include ("../../database/connect_database/index.php");
require_once ('../../database/query_database/products.php');

$previous = "javascript:history.go(-1)";
if (isset($_SERVER['HTTP_REFERER'])) {
    $previous = $_SERVER['HTTP_REFERER'];
}

if (isset($_GET['product_id'])) {
    $product_id = $_GET['product_id'];
    $user_id = $_COOKIE["userID"];

    $sql = "SELECT * FROM user_category WHERE user_id = $user_id AND user_category_name = 'I love'";
    $result = mysqli_query($conn, $sql);
    $row = $result->fetch_assoc();
    $userCategoryId = $row['user_category_id'];

    $add = addProductToUserCategory($product_id, $userCategoryId);

    if ($add == true) {
        header("Location: $previous");
        exit();
    } else {
        echo "Lỗi";
    }
}
