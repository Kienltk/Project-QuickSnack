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

// function getProductBottomTable() {
//     include ("../../database/connect_database/index.php");
//     $smtc = $conn->prepare("SELECT quick_snack.quick_snack_id, name, level, quick_snack.time, yield, created_at, quick_snack.user_id, category_to_quick_snack.category_id, 
//     category_name, ROUND(AVG(review.rating), 1) as avg_rating FROM quick_snack 
//     JOIN category_to_quick_snack ON quick_snack.quick_snack_id = category_to_quick_snack.quick_snack_id 
//     JOIN category ON category_to_quick_snack.category_id = category.category_id
//     JOIN review ON review.quick_snack_id = quick_snack.quick_snack_id
//     GROUP BY quick_snack.quick_snack_id
//     ORDER BY RAND()");
//     $smtc->execute();
//     $result = $smtc->get_result();
//     $conn->close();
//     return $result;
// }

// function getProduct()
// {
//     include("../../database/connect_database/index.php");
//     $smtc = $conn->prepare("SELECT 
//     qs.quick_snack_id,
//     qs.name,
//     qs.level,
//     qs.time,
//     qs.yield,
//     qs.created_at,
//     qs.user_id,
//     MAX(iqs.address_img) AS image_address,
//     GROUP_CONCAT(DISTINCT c.category_name ORDER BY c.category_id SEPARATOR ', ') AS categories,
//     ROUND(AVG(r.rating), 1) AS average_rating
// FROM 
//     quick_snack qs
// LEFT JOIN 
//     image_quick_snack iqs ON qs.quick_snack_id = iqs.quick_snack_id
// LEFT JOIN 
//     category_to_quick_snack ctqs ON qs.quick_snack_id = ctqs.quick_snack_id
// LEFT JOIN 
//     category c ON ctqs.category_id = c.category_id AND c.category_id IS NOT NULL
// LEFT JOIN 
//     review r ON qs.quick_snack_id = r.quick_snack_id
// GROUP BY 
//     qs.quick_snack_id,
//     qs.name,
//     qs.level,
//     qs.time,
//     qs.yield,
//     qs.created_at,
//     qs.user_id
// ORDER BY 
//     qs.quick_snack_id;
// ");
//     $smtc->execute();
//     $result = $smtc->get_result();
//     $conn->close();
//     return $result;
// }

function getProductWithPagination($offset, $limit)
{
    include("../../database/connect_database/index.php");
    $smtc = $conn->prepare("SELECT 
        qs.quick_snack_id,
        qs.name,
        qs.level,
        qs.time,
        qs.yield,
        qs.created_at,
        qs.user_id,
        MAX(iqs.address_img) AS image_address,
        GROUP_CONCAT(DISTINCT c.category_name ORDER BY c.category_id SEPARATOR ', ') AS categories,
        ROUND(AVG(r.rating), 1) AS average_rating
    FROM 
        quick_snack qs
    LEFT JOIN 
        image_quick_snack iqs ON qs.quick_snack_id = iqs.quick_snack_id
    LEFT JOIN 
        category_to_quick_snack ctqs ON qs.quick_snack_id = ctqs.quick_snack_id
    LEFT JOIN 
        category c ON ctqs.category_id = c.category_id AND c.category_id IS NOT NULL
    LEFT JOIN 
        review r ON qs.quick_snack_id = r.quick_snack_id
    GROUP BY 
        qs.quick_snack_id,
        qs.name,
        qs.level,
        qs.time,
        qs.yield,
        qs.created_at,
        qs.user_id
    ORDER BY 
        qs.quick_snack_id
    LIMIT ?, ?");
    $smtc->bind_param("ii", $offset, $limit);
    $smtc->execute();
    $result = $smtc->get_result();
    $conn->close();
    return $result;
}

function getTotalProducts()
{
    include("../../database/connect_database/index.php");
    $result = $conn->query("SELECT COUNT(*) AS total FROM quick_snack");
    $row = $result->fetch_assoc();
    $conn->close();
    return $row['total'];
}

function getImage($param)
{
    include("../../database/connect_database/index.php");
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
