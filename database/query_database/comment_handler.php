<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include ('../../database/connect_database/index.php');

   
    $quick_snack_id = $_POST['quick_snack_id'] ?? '';
    $comment = htmlspecialchars($_POST['comment']);
    $rating = (int) $_POST['rating']; 
    $user_id = $_POST['user_id'];

    $query = "INSERT INTO review (quick_snack_id,user_id, comment, rating) VALUES (?,?,?,?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("iisi", $quick_snack_id, $user_id, $comment, $rating);


    if ($stmt->execute()) {
        header("Location: ../../views/products/product_detail.php?quick_snack_id=$quick_snack_id");
        exit; 
    } else {
        echo "Error: " . $stmt->error;
    }


    $stmt->close();
    $conn->close();
}
