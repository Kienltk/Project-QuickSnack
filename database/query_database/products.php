<?php
function getCategory()
{
    include ("../../database/connect_database/index.php");
    $smtc = $conn->prepare("SELECT * FROM category");
    $smtc->execute();
    $result = $smtc->get_result();
    $conn->close();
    return $result;
}

function getIngredient()
{
    include ("../../database/connect_database/index.php");
    $smtc = $conn->prepare("SELECT * FROM ingredients");
    $smtc->execute();
    $result = $smtc->get_result();
    $conn->close();
    return $result;
}

function getProduct($filters, $page)
{
    global $conn;

    $results_per_page = 12;

    $start_index = ($page - 1) * $results_per_page;

    $query = "SELECT 
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
        category c ON ctqs.category_id = c.category_id
    LEFT JOIN 
        review r ON qs.quick_snack_id = r.quick_snack_id";

    $conditions = [];

    if (!empty($filters['category'])) {
        $categoryIds = implode(',', $filters['category']);
        $conditions[] = "qs.quick_snack_id IN (
        SELECT quick_snack_id FROM category_to_quick_snack
        WHERE category_id IN ($categoryIds)
        GROUP BY quick_snack_id
        HAVING COUNT(*) = " . count($filters['category']) . "
    )";
    }

    if (!empty($filters['ingredient'])) {
        $ingredientIds = implode(',', $filters['ingredient']);
        $conditions[] = "qs.quick_snack_id IN (
        SELECT quick_snack_id FROM ingredient_to_quick_snack
        WHERE ingredient_id IN ($ingredientIds)
        GROUP BY quick_snack_id
        HAVING COUNT(*) = " . count($filters['ingredient']) . "
    )";
    }

    if (!empty($filters['level'])) {
        $levels = implode("','", $filters['level']);
        $conditions[] = "qs.level IN ('$levels')";
    }

    if (!empty($filters['time_min']) && !empty($filters['time_max'])) {
        $timeMin = $filters['time_min'];
        $timeMax = $filters['time_max'];
        $conditions[] = "qs.time BETWEEN '$timeMin' AND '$timeMax'";
    }

    if (!empty($conditions)) {
        $query .= " WHERE " . implode(' AND ', $conditions);
    }

    $query .= " GROUP BY 
        qs.quick_snack_id,
        qs.name,
        qs.level,
        qs.time,
        qs.yield,
        qs.created_at,
        qs.user_id";

    $sort = isset($_GET['sort']) ? $_GET['sort'] : 'default';
    switch ($sort) {
        case 'name':
            $query .= " ORDER BY qs.name";
            break;
        case 'rating':
            $query .= " ORDER BY average_rating DESC";
            break;
        case 'time':
            $query .= " ORDER BY qs.time";
            break;
        default:
            $query .= " ORDER BY qs.quick_snack_id";
            break;
    }

    $page = 1;

    $countQuery = "SELECT COUNT(*) AS total FROM ($query) AS result";
    $countResult = $conn->query($countQuery);
    $totalCount = $countResult->fetch_assoc()['total'];

    $total_pages = ceil($totalCount / $results_per_page);

    $query .= " LIMIT $start_index, $results_per_page";

    $stmt = $conn->prepare($query);
    $stmt->execute();
    $result = $stmt->get_result();

    return ['products' => $result, 'total_pages' => $total_pages, 'current_sort' => $sort];
}

function getImage($param)
{
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
    include ("../../database/connect_database/index.php");
    $sql = "INSERT INTO quick_snack_to_user_category (quick_snack_id, user_category_id) 
    VALUES ('$quickSnackId', '$userCategoryId')";
    $conn->query($sql);
    $conn->close();
    return true;
}

function createUserCategory($userCategoryName, $userId)
{
    include ("../../database/connect_database/index.php");
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

function isInWishlist($quick_snack_id, $conn, $user_id)
{
    $query = "SELECT qs.user_id, qsuc.quick_snack_id, qsuc.user_category_id
    FROM quick_snack qs
    JOIN quick_snack_to_user_category qsuc ON qs.quick_snack_id = qsuc.quick_snack_id
    JOIN user_category uc ON qsuc.user_category_id = uc.user_category_id
    WHERE uc.user_id = ?
    AND qs.quick_snack_id = ?;
    ";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("si", $user_id, $quick_snack_id);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->num_rows > 0;
}
