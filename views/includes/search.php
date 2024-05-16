<?php
include('../../database/connect_database/index.php');

if ($_POST["action"] == "search_term") {
    $searchTerm = $_POST["data"];
    $limit_per_page = 6;
    $output = "<ul>";

    // Khai báo và tính toán offset
    $page = isset($_POST["page_no"]) ? $_POST["page_no"] : 1;
    $offset = ($page - 1) * $limit_per_page;

    // Truy vấn SQL sử dụng MIN() cho cột address_img
    $q = $conn->query("SELECT qs.quick_snack_id, qs.name, MIN(iqs.address_img) AS address_img 
                        FROM `quick_snack` AS qs 
                        LEFT JOIN `image_quick_snack` AS iqs ON qs.quick_snack_id = iqs.quick_snack_id 
                        WHERE qs.name LIKE '%{$searchTerm}%' 
                        GROUP BY qs.quick_snack_id, qs.name 
                        LIMIT {$offset}, {$limit_per_page}");

    if (mysqli_num_rows($q) > 0) {
        while ($result = mysqli_fetch_assoc($q)) {
            // Thêm hình ảnh nhỏ trước tên sản phẩm
            $output .= '<li><img src="' . $result["address_img"] . '" alt="Product Image" width="50" height="50"> <a href="../products/product_detail.php?quick_snack_id=' . $result['quick_snack_id'] . '">' . $result["name"] . '</a></li>';
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
    $limit_per_page = 10;

    // Khai báo và tính toán offset
    $page = isset($_POST["page_no"]) ? $_POST["page_no"] : 1;
    $offset = ($page - 1) * $limit_per_page;

    // Truy vấn SQL không sử dụng MIN() cho cột address_img
    $result = $conn->query("SELECT qs.quick_snack_id, qs.name, iqs.address_img 
                            FROM `quick_snack` AS qs 
                            LEFT JOIN `image_quick_snack` AS iqs ON qs.quick_snack_id = iqs.quick_snack_id 
                            WHERE qs.name LIKE '%{$searchTerm}%' 
                            GROUP BY qs.quick_snack_id, iqs.address_img 
                            LIMIT {$offset}, {$limit_per_page}");

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            // Thêm hình ảnh nhỏ trước tên sản phẩm
            $output .= '<li><img src="' . $row["address_img"] . '" alt="Product Image" width="50" height="50"> <a href="../products/product_detail.php?quick_snack_id=' . $row["quick_snack_id"] . '">' . $row["name"] . '</a></li>';
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