<?php
require_once('../../database/query_database/user.php');

if (isset($_COOKIE['username'])) {
    header("Location: ../../views/home/home.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];
    $email = "";

    if (userExistence($username, $email)) {
        $userData = userExistence($username, $email);
        if ($userData['username'] == $username && password_verify($password, $userData['password_hash']) == true) {
            $check = "Logged in successfully";
            setcookie('username', $username, time() + (86400 * 30), '/');
        } else if ($userData['username'] == $username && password_verify($password, $userData['password_hash']) == false) {
            $check = "Password is incorrect";
        } else if ($userData['username'] == $username) {
            $check = "Username is not registered";
        } else {
            $check =  "Login unsuccessful";
        }
    } else {
        $check =  "Login unsuccessful";
    }

    echo $check;
} else {
    echo "ngu";
}