<?php
include ("my_saved_recipes_function.php");
deleteProductFromUserCategory($_GET["quick_snack_id"], $_GET["category_id"]);
header("Location: ../../views/products/My_saved_recipes.php?id=$_GET[redirect]");