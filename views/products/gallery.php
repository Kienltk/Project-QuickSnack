<?php
// Include database connection file
include("../../database/connect_database/index.php");

// Set pagination variables
$limit = 20; // Number of records per page
$page = isset($_GET['page'])? $_GET['page'] : 1;
$start = ($page - 1) * $limit;

// Fetch records from database
$sql = "SELECT name_image, address_img FROM image_quick_snack LIMIT $limit OFFSET $start";
$result = $conn->query($sql);

// Check if records exist
if ($result->num_rows > 0) {
    $images = array();
    while ($row = $result->fetch_assoc()) {
        $images[] = array(
            'name' => $row["name_image"],
            'address' => $row["address_img"]
        );
    }
} else {
    $images = array();
}

// Close database connection


// Calculate total pages
$sql = "SELECT COUNT(*) FROM image_quick_snack";
$result = $conn->query($sql);
$row = $result->fetch_row();
$total_records = $row[0];
$total_pages = ceil($total_records / $limit);
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gallery</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        .title {
    display: flex;
    justify-content: center;
    align-items: center;
    flex-direction: column;
    font-family: sans-serif;
    color: #E37E21;
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
    transition: all.25s ease-in-out;
}

.grid-container div:hover img {
    filter:grayscale(0);
}

.grid-container div:hover {
    border-color: coral;
    transform: scale(1.1);
}

.grid-container img {
    width: 100%;
    /* filter: grayscale(1); */
    border-radius: 5px;
}

.grid-container p {
    font-family: sans-serif;
    color: #333;
    margin-top: 10px;
    text-align: center;
}

.pagination {
    display: flex;
    justify-content: center;
    margin-top: 20px;
}

.pagination a {
    margin: 0 5px;
    padding: 5px;
    border: 1px solid #ccc;
    border-radius: 5px;
    text-decoration: none;
    color: #333;
}

.pagination a:hover {
    background-color: #f2f2f2;
}

.pagination .active {
    background-color: #E37E21;
    color: #fff;
}
    </style>
</head>
<body>

    <?php include '../../views/includes/header.php';?>

    <div class="title"><h1>Gallery</h1></div>

    <div class="grid-container">
        <?php foreach ($images as $image) {?>
            <div>
                <img src="<?php echo $image['address'];?>" alt="">
                <p><?php echo $image['name'];?></p>
            </div>
        <?php }?>
    </div>

    <!-- Pagination -->
    <div class="pagination">
        <?php for ($i = 1; $i <= $total_pages; $i++) {?>
            <a href="?page=<?php echo $i;?>"><?php echo $i;?></a>
        <?php }?>
    </div>

    <?php include '../../views/includes/footer.php';?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLeSaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>
</html>