<?php
include("../../database/connect_database/index.php");
require_once('../../database/query_database/products.php');

$previous = "javascript:history.go(-1)";
if (isset($_SERVER['HTTP_REFERER'])) {
    $previous = $_SERVER['HTTP_REFERER'];
}

if (isset($_GET['product_id'])) {
    $product_id = $_GET['product_id'];
    $user_id = $_COOKIE["userID"];

    $sql = "SELECT 
    uc.user_category_id, 
    uc.user_category_name, 
    uc.user_id, 
    qsuc.quick_snack_id
FROM 
    user_category uc
JOIN 
    quick_snack_to_user_category qsuc ON uc.user_category_id = qsuc.user_category_id
WHERE 
    qsuc.quick_snack_id = $product_id
    AND uc.user_id = $user_id";
    $result = mysqli_query($conn, $sql);
    
    if ($row = $result->fetch_assoc()) {
        $user_category_id = $row['user_category_id'];
        $sql = "DELETE FROM quick_snack_to_user_category
        WHERE quick_snack_id = $product_id AND user_category_id = $user_category_id;";
        $result = mysqli_query($conn, $sql);
        $flag = true;
    } else {
        $sql = "SELECT * FROM user_category WHERE user_id = $user_id AND user_category_name = 'I love'";
        $result = mysqli_query($conn, $sql);
        $row = $result->fetch_assoc();
        $userCategoryId = $row['user_category_id'];
        $flag = addProductToUserCategory($product_id, $userCategoryId);
    }


    if ($flag == true) {
        header("Location: $previous");
        exit();
    } else {
        echo "Lỗi";
    }
}
