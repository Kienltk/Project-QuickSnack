<?php
include("../../database/connect_database/index.php");
require_once('../../database/query_database/products.php');

if (isset($_GET['product_id'])) {
    $product_id = $_GET['product_id'];
    $user_id = $_COOKIE["userID"];

    $sql = "SELECT * FROM user_category WHERE user_id = $user_id AND user_category_name = 'I love'";
    $result = mysqli_query($conn, $sql);
    $row = $result->fetch_assoc();
    $userCategoryId = $row['user_category_id'];

    $sql_insert = "INSERT INTO quick_snack_to_user_category (quick_snack_id, user_category_id) 
    VALUES ('$product_id', '$userCategoryId')";
    $conn->query($sql_insert);
    $conn->close();

    $add = addProductToUserCategory($product_id, $userCategoryId);

    if ($add == true) {
        header("Location: ../../views/products/product_detail.php?quick_snack_id=$product_id");
        exit();
    } else {
        echo "Lỗi";
    }
}
