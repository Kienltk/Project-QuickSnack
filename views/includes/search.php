<?php
include ('../../database/connect_database/index.php');

if ($_POST["action"] == "search_term") {
    $searchTerm = $_POST["data"];
    $q = $conn->query("SELECT name, quick_snack_id FROM `quick_snack` WHERE name LIKE '%{$searchTerm}%'");
    $output = "<ul>";
    if (mysqli_num_rows($q) > 0) {
        while ($result = mysqli_fetch_assoc($q)) {
            $output .= '<li><a href="../products/product_detail.php?quick_snack_id=' . $result['quick_snack_id'] . '">' . $result["name"] . '</a></li>';
        }
    } else {
        $output .= "<li>No Record found</li>";
    }
    $output .= "</ul>";
    echo $output;
}

if ($_POST["action"] == "search") {
    $searchTerm = $_POST["data"];
    $output = '';
    $limit_per_page = 3;
    $page = "";
    if (isset($_POST["page_no"])) {
        $page = $_POST["page_no"];
    } else {
        $page = 1;
    }
    $offset = ($page - 1) * $limit_per_page;
    $result = $conn->query("SELECT quick_snack_id, name 
    FROM `quick_snack` 
    LEFT JOIN category AS c ON quick_snack_id = c.category_id
    WHERE name LIKE '%{$searchTerm}%'
    LIMIT {$offset}, {$limit_per_page}");
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $output .= '<li><a href="../products/product_detail.php?quick_snack_id=' . $row["quick_snack_id"] . '">' . $row["name"] . '</a></li>';
        }
    }
    echo $output;
}
?>


        <!-- // $q2 = $conn->query("SELECT * FROM `product`  WHERE   p_title LIKE '%{$searchTerm}%'");;
//         $total_record = mysqli_num_rows($q2);
//         $total_page = ceil($total_record / $limit_per_page);
//         $output .= '<nav aria-label="Page navigation example my-5" class="d-flex justify-content-center mt-5" style="cursor: pointer; font-size:1.5rem;" >
//         <ul class="pagination">';
//         if ($page > 1) {
//             $output .= '<li class="page-item"><a class="page-link" id="SearchPagination" data-id="' . ($page - 1) . '">Previous</a></li>';
//         };
//         for ($i = 1; $i <= $total_page; $i++) {
//             if ($i == $page) {
//                 $className = "active";
//             } else {
//                 $className = "";
//             }
//             $output .= '<li class="page-item  ' . $className . '"><a class="page-link " id="SearchPagination" data-id="' . $i . '">' . $i . '</a></li>';
//         };
//         if ($total_page > $page) {

//             $output .= '<li class="page-item"><a class="page-link" id="SearchPagination" data-id="' . ($page + 1) . '">Next</a></li>';
//         }
//         $output .= '</ul>
//                 </nav>';
//         echo $output;
//     } else {
//         echo $output = 'no record found ';
//     }
// } -->