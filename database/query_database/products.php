<?php
function getCategory()
{
    include("../../database/connect_database/index.php");
    $smtc = $conn->prepare("SELECT * FROM category");
    $smtc->execute();
    $result = $smtc->get_result();
    $conn->close();
    return $result;
}

function getIngredient()
{
    include("../../database/connect_database/index.php");
    $smtc = $conn->prepare("SELECT * FROM ingredients");
    $smtc->execute();
    $result = $smtc->get_result();
    $conn->close();
    return $result;
}

function getProductBottomTable() {
    include ("../../database/connect_database/index.php");
    $smtc = $conn->prepare("SELECT quick_snack.quick_snack_id, name, level, quick_snack.time, yield, created_at, quick_snack.user_id, category_to_quick_snack.category_id, 
    category_name, ROUND(AVG(review.rating), 1) as avg_rating FROM quick_snack 
    JOIN category_to_quick_snack ON quick_snack.quick_snack_id = category_to_quick_snack.quick_snack_id 
    JOIN category ON category_to_quick_snack.category_id = category.category_id
    JOIN review ON review.quick_snack_id = quick_snack.quick_snack_id
    GROUP BY quick_snack.quick_snack_id
    ORDER BY RAND()");
    $smtc->execute();
    $result = $smtc->get_result();
    $conn->close();
    return $result;
}

function getProductRightTable() {
    include ("../../database/connect_database/index.php");
    $smtc = $conn->prepare("SELECT quick_snack.quick_snack_id, name, level, quick_snack.time, yield, created_at, quick_snack.user_id, category_to_quick_snack.category_id, 
    category_name, ROUND(AVG(review.rating), 1) as avg_rating FROM quick_snack 
    JOIN category_to_quick_snack ON quick_snack.quick_snack_id = category_to_quick_snack.quick_snack_id 
    JOIN category ON category_to_quick_snack.category_id = category.category_id
    JOIN review ON review.quick_snack_id = quick_snack.quick_snack_id
    GROUP BY quick_snack.quick_snack_id
    LIMIT 12");
    $smtc->execute();
    $result = $smtc->get_result();
    $conn->close();
    return $result;
}

function getImage($param) {
    include ("../../database/connect_database/index.php");
    $smtc = $conn->prepare("SELECT * FROM image_quick_snack WHERE quick_snack_id = ?");
    $smtc->bind_param("i", $param);
    $smtc->execute();
    $result = $smtc->get_result();
    $conn->close();
    $return = $result->fetch_assoc();
    return $return;
}

function addProductToUserCategory($quickSnackId, $userCategoryId)
{
    include("../../database/connect_database/index.php");
    $sql = "INSERT INTO quick_snack_to_user_category (quick_snack_id, user_category_id) 
    VALUES ('$quickSnackId', '$userCategoryId')";
    $conn->query($sql);
    $conn->close();
    return true;
}

function createUserCategory($userCategoryName, $userId)
{
    include("../../database/connect_database/index.php");
    $sql = "INSERT INTO user_category (user_category_name, user_id) 
    VALUES (?, ?)";
    $stmt_insert = $conn->prepare($sql);
    $stmt_insert->bind_param("ss", $userCategoryName, $userId);
    if ($stmt_insert->execute()) {
        return true;
    } else {
        return false;
    }
}
