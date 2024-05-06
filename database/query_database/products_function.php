<?php
function getCategory() {
    include ("../../database/connect_database/index.php");
    $smtc = $conn->prepare("SELECT * FROM category");
    $smtc->execute();
    $result = $smtc->get_result();
    $conn->close();
    return $result;
}

function getIngredient() {
    include ("../../database/connect_database/index.php");
    $smtc = $conn->prepare("SELECT * FROM ingredients");
    $smtc->execute();
    $result = $smtc->get_result();
    $conn->close();
    return $result;    
}

function getProduct() {
    include ("../../database/connect_database/index.php");
    $smtc = $conn->prepare("SELECT name, level, quick_snack.time, yield, created_at, quick_snack.user_id, category_to_quick_snack.category_id, 
    category_name, ROUND(AVG(review.rating), 1) as avg_rating FROM quick_snack 
    JOIN category_to_quick_snack ON quick_snack.quick_snack_id = category_to_quick_snack.quick_snack_id 
    JOIN category ON category_to_quick_snack.category_id = category.category_id
    JOIN review ON review.quick_snack_id = quick_snack.quick_snack_id
    GROUP BY quick_snack.quick_snack_id");
    $smtc->execute();
    $result = $smtc->get_result();
    $conn->close();
    return $result;    
}

