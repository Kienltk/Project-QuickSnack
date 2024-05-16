<?php
function getUserCategory($param) {
    include ("../../database/connect_database/index.php");
    $smtc = $conn->prepare("SELECT * FROM user_category WHERE user_id = ?");
    $smtc->bind_param('s', $param);
    $smtc->execute();
    $result = $smtc->get_result();
    $conn->close();
    return $result;
}

function getUserCategoryByCategoryId($param) {
    include ("../../database/connect_database/index.php");
    $smtc = $conn->prepare("SELECT * FROM user_category WHERE user_category_id = ?");
    $smtc->bind_param('i', $param);
    $smtc->execute();
    $result = $smtc->get_result();
    $conn->close();
    return $result;
}

function getProductFromUserCategory($param) {
    include ("../../database/connect_database/index.php");
    $smtc = $conn->prepare("SELECT * FROM user_category
    JOIN quick_snack_to_user_category ON user_category.user_category_id = quick_snack_to_user_category.user_category_id
    JOIN quick_snack ON quick_snack.quick_snack_id = quick_snack_to_user_category.quick_snack_id
    JOIN category_to_quick_snack ON quick_snack.quick_snack_id = category_to_quick_snack.quick_snack_id
    JOIN category ON category.category_id = category_to_quick_snack.category_id
    WHERE quick_snack_to_user_category.user_category_id = ?
    GROUP BY quick_snack.quick_snack_id;");
    $smtc->bind_param('s', $param);
    $smtc->execute();
    $result = $smtc->get_result();
    $conn->close();
    return $result;
}

function getProductByUserCategoryByCategoryId($param) {
    include ("../../database/connect_database/index.php");
    $smtc = $conn->prepare("SELECT * FROM quick_snack
    JOIN quick_snack_to_user_category ON quick_snack.quick_snack_id = quick_snack_to_user_category.quick_snack_id
    JOIN user_category ON user_category.user_category_id = quick_snack_to_user_category.user_category_id
    WHERE user_category.user_category_id = ?");
    $smtc->bind_param('i', $param);
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

function addCategory($param) {
    include ("../../database/connect_database/index.php");
    $string = "New Category";
    $smtc = $conn->prepare("INSERT INTO user_category (user_category_name, user_id) VALUES (?, ?)");
    $smtc->bind_param("si", $string, $param);
    $smtc->execute();
    $conn->close();
}

function deleteCategory($param) {
    include ("../../database/connect_database/index.php");
    $smtc = $conn->prepare("DELETE FROM user_category WHERE user_category_id = ?");
    $smtc->bind_param("i", $param);
    $smtc->execute();
    $conn->close();
}

function renameUserCategory($name, $id) {
    include ("../../database/connect_database/index.php");
    $smtc = $conn->prepare("UPDATE user_category SET user_category_name = ? WHERE user_category_id = ?");
    $smtc->bind_param("si", $name, $id);
    $smtc->execute();
    $conn->close();
}

function deleteProductFromUserCategory($quick_snack_id, $user_category_id) {
    include ("../../database/connect_database/index.php");
    $smtc = $conn->prepare("DELETE FROM quick_snack_to_user_category WHERE quick_snack_id = ? AND user_category_id = ?");
    $smtc->bind_param("ii", $quick_snack_id, $user_category_id);
    $smtc->execute();
    $conn->close();
}
