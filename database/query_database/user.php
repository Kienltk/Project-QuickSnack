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


function insertUser($fullname, $username, $email, $gender, $password)
{
    include('../../database/connect_database/index.php');
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    $stmt = $conn->prepare("INSERT INTO user(fullname, username, email, gender, password_hash) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $fullname, $username, $email, $gender, $hashed_password);
    $success = $stmt->execute();
    $stmt->close();
    $conn->close();
    return $success;
}


