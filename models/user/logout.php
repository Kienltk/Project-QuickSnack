<?php
setcookie('userID', '', time() - 3600, "/");

header("Location: ../../views/home/home.php");
exit();
