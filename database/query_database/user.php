<?php
function userExistence($username, $email)
{
    include('../../database/connect_database/index.php');
    $stmt = $conn->prepare("SELECT * FROM user WHERE username = ? OR email = ?");
    $stmt->bind_param("ss", $username, $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $user_data = $result->fetch_assoc();
    $stmt->close();
    $conn->close();

    return $user_data;
}



function insertUser($username, $email, $password)
{
    include('../../database/connect_database/index.php');
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    $stmt = $conn->prepare("INSERT INTO user(username, email, password) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $username, $email, $hashed_password);
    $success = $stmt->execute();
    $stmt->close();
    $conn->close();
    return $success;
}
