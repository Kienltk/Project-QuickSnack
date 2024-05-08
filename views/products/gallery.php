<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gallery</title>
    <style>
        .title {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            font-family: sans-serif;
        }

        h1 {
            color: coral;
        }

        .grid-container {
            columns: 5 200px;
            column-gap: 1.5rem;
            width: 90%;
            margin: 0 auto;
        }

        .grid-container div {
            width: 150px;
            margin: 0 1.5rem 1.5rem 0;
            display: inline-block;
            width: 100%;
            border: solid 2px black;
            padding: 5px;
            box-shadow: 5px 5px 5px rgba(0, 0, 0, 0.5);
            border-radius: 5px;
            transition: all .25s ease-in-out;
        }

        .grid-container div:hover img {
            filter: grayscale(0);
        }

        .grid-container div:hover {
            border-color: coral;
        }

        .grid-container div img {
            width: 100%;
            filter: grayscale(100%);
            border-radius: 5px;
            transition: all .25s ease-in-out;
        }

        .grid-container div p {
            margin: 5px 0;
            padding: 0;
            text-align: center;
            font-style: italic;
        }
    </style>
</head>

<body>

    <?php
    include '../../views/includes/header.php';
    ?>

    <div class="title"><h1>Gallery</h1></div>

    <div class="grid-container">
        <?php
        include("../../database/connect_database/index.php");
        $sql = "SELECT name_image, address_img FROM image_quick_snack";
        $result = $conn->query($sql);


        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<div>";
                echo "<img class='grid-item' src='" . $row["address_img"] . "' alt=''>";
                echo "<p>" . $row["name_image"] . "</p>";
                echo "</div>";
            }
        } else {
            echo "Không có dữ liệu";
        }

        $conn->close();
        ?>

    </div>

    <?php
    include '../../views/includes/footer.php';
    ?>

</body>

</html>