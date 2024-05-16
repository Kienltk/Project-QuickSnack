<?php
include("../../database/connect_database/index.php");


if (!isset($_COOKIE["userID"])) {

    header("Location: login.php");
    exit();
}

$gender_mapping = array(
    1 => "Male",
    2 => "Female",
    3 => "Other"
);

$user_id = $_COOKIE["userID"];


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $new_fullname = $_POST['new_fullname'];
    $new_email = $_POST['new_email'];
    $new_gender_id = $_POST['new_gender'];
    $new_gender = $gender_mapping[$new_gender_id];
    if ($new_gender == 'male') {
        $new_gender_id = 1;
    } elseif ($new_gender == 'female') {
        $new_gender_id = 2;
    } elseif ($new_gender == 'other') {
        $new_gender_id = 3;
    }
    $new_password = $_POST['new_password'];
    $password_hash = password_hash($new_password, PASSWORD_BCRYPT);

    $profile_image_path = null;

    if (isset($_FILES['new_profile_image']) && $_FILES['new_profile_image']['error'] == UPLOAD_ERR_OK) {

        $upload_dir = '../../public/image/uploads/';
        $profile_image_path = $upload_dir . basename($_FILES['new_profile_image']['name']);
        move_uploaded_file($_FILES['new_profile_image']['tmp_name'], $profile_image_path);
    }

    $sql_update = "UPDATE user SET fullname = ?, email = ?, gender = ?, password_hash = ?, profile_image = ? WHERE user_id = ?";
    $stmt_update = $conn->prepare($sql_update);
    $stmt_update->bind_param("sssisi", $new_fullname, $new_email, $new_gender_id, $password_hash, $profile_image_path, $user_id);

    if ($stmt_update->execute()) {
        header("Location: user_profile.php");
        exit();
    } else {
        echo "Error updating record: " . $stmt_update->error;
    }

    $stmt_update->close();
}
$sql = "SELECT fullname, username, email, gender, profile_image FROM user WHERE user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="shortcut icon" href="../../public/image/logo.png" type="image/x-icon">
    <link rel="stylesheet" href="../../public/css/style.css">
    <link rel="stylesheet" href="../../public/css/header.css">
    <link rel="stylesheet" href="../../public/css/footer.css">


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" crossorigin="anonymous" />
    <style>
        .card {
            border: 4px solid orange !important;
            border-radius: 10px !important;
            background-color: #ffffff !important;
            margin: 20px !important;
        }


        .card-body>* {
            margin: 3% !important;
        }


        .table tbody tr {
            margin: 3% !important;
        }

        .card-title {
            margin: 10% 0 !important;
            color: #ffa500;
        }

        .profile_information {
            margin: 5% 0 !important;
            color: #ffa500;
        }

        .profile_view {
            margin: 3% 0 !important;
        }

        .btn-outline-primary {
            border: none !important;
            border-radius: 10px !important;
            background-color: #ffffff !important;
            margin: 20px !important;
        }

        .modal-content {
            border: 4px solid orange !important;
            color: #ffa500;
        }

        .update_button {
            border: none !important;
            border-radius: 10px !important;
            background-color: #ffa500 !important;
        }

    </style>


</head>

<body>
    <header>
        <?php
        include '..\includes\header.php';
        ?>
    </header>
    <div class="container mt-5" style="min-width: 450px !important;">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                        <div class="col-md-4 text-center">
    <!-- Avatar and Fullname -->
    <?php
    $profile_image = !empty($user['profile_image']) ? $user['profile_image'] : '../../public/image/user_profile.png';
    ?>
    <img src="<?php echo $profile_image; ?>" alt="Avatar" class="img-fluid rounded-circle mb-3" style="margin-top: 20% !important; height:150px !important; width :150px  !important; border: 4px solid orange !important; border-radius: 50% !important;">

<h5 class="card-title" style=" margin-top: 25% !important;"><?php echo $user['fullname']; ?></h5>
</div>
                            <div class=" col-md-8">
                                    <!-- Information -->
                                    <h1 class="card-title">Information</h1>
                                    <table class="table">
                                        <tbody>
                                            <tr>
                                                <th scope="row">
                                                    <div class="profile_information">Username:</div>
                                                </th>
                                                <td>
                                                    <div class="profile_view">
                                                        <?php echo $user['username']; ?>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row">
                                                    <div class="profile_information">Email:</div>
                                                </th>
                                                <td>
                                                    <div class="profile_view">
                                                        <?php echo $user['email']; ?>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row">
                                                    <div class="profile_information">Gender:</div>
                                                </th>
                                                <td>
                                                    <div class="profile_view">
                                                        <?php echo $gender_mapping[$user['gender']]; ?>
                                                    </div class="profile_view">
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row">
                                                    <div class="profile_information">Password:</div>
                                                </th>
                                                <td>

                                                    <div class="profile_view">
                                                        *********
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                            </div>
                        </div>
                        <!-- Edit Button -->
                        <button type="button" class="btn btn-outline-primary position-absolute top-0 end-0" data-bs-toggle="modal" data-bs-target="#editModal" style="">
                            <i class="fa-solid fa-pen-to-square" style="color: #f08138;"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Profile</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="post" enctype="multipart/form-data">
    <div class="mb-3">
        <label for="new_profile_image" class="form-label">Upload Profile Image:</label>
        <input type="file" class="form-control" id="new_profile_image" name="new_profile_image" accept="image/*">
    </div>

                        <div class="mb-3">
                            <label for="new_fullname" class="form-label">New Full Name:</label>
                            <input type="text" class="form-control" id="new_fullname" name="new_fullname" value="<?php echo $user['fullname']; ?>">
                        </div>
                        <div class="mb-3">
                            <label for="new_email" class="form-label">New Email:</label>
                            <input type="email" class="form-control" id="new_email" name="new_email" value="<?php echo $user['email']; ?>">
                        </div>
                        <div class="mb-3">
                            <label for="new_gender" class="form-label">New Gender:</label>
                            <select class="form-select" id="new_gender" name="new_gender">
                                <?php foreach ($gender_mapping as $key => $value) : ?>
                                    <option value="<?php echo $key; ?>" <?php if ($user['gender'] == $key) echo 'selected'; ?>><?php echo $value; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="new_password" class="form-label">New Password:</label>
                            <input type="password" class="form-control" id="new_password" name="new_password">
                        </div>
                        <button type="submit" class="btn btn-primary update_button">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-migrate/3.4.1/jquery-migrate.min.js" integrity="sha512-KgffulL3mxrOsDicgQWA11O6q6oKeWcV00VxgfJw4TcM8XRQT8Df9EsrYxDf7tpVpfl3qcYD96BpyPvA4d1FDQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js" integrity="sha512-HGOnQO9+SP1V92SrtZfjqxxtLmVzqZpjFFekvzZVWoiASSQgSr4cw9Kqd2+l8Llp4Gm0G8GIFJ4ddwZilcdb8A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://kit.fontawesome.com/54dbfefd83.js" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <footer>
        <?php
        include '..\includes\footer.php';
        ?>
    </footer>
</body>

</html>