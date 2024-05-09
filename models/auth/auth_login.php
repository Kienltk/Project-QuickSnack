<?php
include('../../database/connect_database/index.php');
require_once('../../database/query_database/user.php');

if (isset($_COOKIE['userID'])) {
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

            $stmt = $conn->prepare("SELECT user_id FROM user WHERE username = ?;");
            $stmt->bind_param("s", $username);
            $stmt->execute();
            $result = $stmt->get_result();
            $user_data = $result->fetch_assoc();
            $stmt->close();
            $conn->close();

            $userID = $user_data['user_id'];
            setcookie('userID', $userID, time() + (86400 * 30), '/');

            $check = "Logged in successfully";
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
}
