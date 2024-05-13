<?php
include ("my_saved_recipes_function.php");
deleteCategory($_GET["id"]);
header("Location: ../../views/products/My_saved_recipes.php");