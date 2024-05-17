<?php
include ('../../database/connect_database/index.php');
include ('../../database/query_database/products.php');

function getDetailProduct()
{
    include ('../../database/connect_database/index.php');
    $id = $_GET['quick_snack_id'];
    $query = "SELECT * FROM quick_snack where quick_snack_id=$id";
    $result = $conn->query($query);
    return $result;
}
$detailResult = getDetailProduct();
$detailRow = $detailResult->fetch_assoc();

function getNutrition()
{
    include ('../../database/connect_database/index.php');
    $id = $_GET['quick_snack_id'];
    $query = "SELECT * FROM nutrition WHERE quick_snack_id=$id";
    $result = $conn->query($query);
    return $result->fetch_assoc();
}

$data = getNutrition();

function getIngredients()
{
    include ('../../database/connect_database/index.php');
    $id = $_GET['quick_snack_id'];
    $query = 'SELECT i.quick_snack_id, i.ingredient_id, i.quantity, s.ingredient_name
    FROM ingredient_to_quick_snack AS i 
    INNER JOIN ingredients AS s ON i.ingredient_id = s.ingredient_id 
    WHERE i.quick_snack_id = ' . $id;
    $result = $conn->query($query);
    return $result;
}

function getRecipes()
{
    include ('../../database/connect_database/index.php');
    $id = $_GET['quick_snack_id'];
    $query = "SELECT * FROM recipe WHERE quick_snack_id=$id";
    $result = $conn->query($query);
    return $result;
}

function getComment()
{
    include ('../../database/connect_database/index.php');
    $id = $_GET['quick_snack_id'];
    $query = "SELECT r.user_id, r.comment, r.rating, u.fullname, u.username, u.email, u.gender, r.time
    FROM review AS r
    INNER JOIN user AS u ON r.user_id = u.user_id 
    WHERE r.quick_snack_id = $id";
    $result = $conn->query($query);
    return $result;
}
function countComments($conn, $quick_snack_id)
{
    $query = "SELECT COUNT(*) AS total_comments FROM review WHERE quick_snack_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $quick_snack_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    return $row['total_comments'];
}
function averageRating($conn, $quick_snack_id)
{
    $query = "SELECT ROUND(AVG(rating),1) AS avg_rating FROM review WHERE quick_snack_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $quick_snack_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    // Làm tròn số lượng rating trung bình
    $avg_rating = ($row['avg_rating']);
    return $avg_rating;
}
function getCategoryTag()
{
    include ('../../database/connect_database/index.php');
    $id = $_GET['quick_snack_id'];
    $query = "SELECT category_name, category.category_id FROM category INNER JOIN category_to_quick_snack ON category.category_id = category_to_quick_snack.category_id WHERE quick_snack_id=$id";
    $result = $conn->query($query);
    return $result;
}

$id = $_GET['quick_snack_id'];
$query = 'SELECT * FROM image_quick_snack WHERE quick_snack_id= ' . $id . ' AND kind = 1 LIMIT 3';
$result_img = $conn->query($query);

?>