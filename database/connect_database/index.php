<?php
$hostName = "localhost";
$userName_db = "root";
$password_db = "";
$databaseName = "quick_snack_db";

$conn = new mysqli($hostName, $userName_db, $password_db, $databaseName);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}