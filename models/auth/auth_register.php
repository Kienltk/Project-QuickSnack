<?php
require_once('../../database/query_database/user.php');

if (isset($_COOKIE['username'])) {
    header("Location: ../../view/home");
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
        $check =  "Create a successful account";
    } else {
        $check =  "Account creation failed";
    }

    echo $check;
}
