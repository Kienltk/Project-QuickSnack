<?php
include("../../database/connect_database/index.php");
require_once('../../database/query_database/user.php');
require_once('../../database/query_database/products.php');

if (isset($_COOKIE['username'])) {
    header("Location: ../../views/home/home.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {
    $fullName = $_POST["fullName"];
    $username = $_POST["username"];
    $email = $_POST["email"];
    $gender = $_POST["gender"];
    $password = $_POST["password"];

    if (userExistence($username, $email)) {
        $userData = userExistence($username, $email);
        if ($userData['username'] == $username) {
            $check = "Username already registered";
        } else {
            $check = "Email already registered";
        }
    } else if (insertUser($fullName, $username, $email, $gender, $password)) {
        $sql = "SELECT user_id FROM user WHERE username = '$username'";
        $result = mysqli_query($conn, $sql);
        $row = $result->fetch_assoc();
        $userId = $row['user_id'];

        $userCategoryName = "I love";
        if (createUserCategory($userCategoryName, $userId) == true) {
            $check =  "Create a successful account";
        } else {
            $check =  "Account creation failed";
        }
    } else {
        $check =  "Account creation failed";
    }

    echo $check;
}
