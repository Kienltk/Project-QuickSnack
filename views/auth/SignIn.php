<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="../../public/css/signin.css">
</head>

<body>
    <div class="container-box">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6 col-left">
                    <!-- Left Column - Image -->
                </div>
                <div class="col-md-6 col-right">
                    <!-- Right Column - Sign In Form -->
                    <div class="card-body">
                        <form>
                            <div class="navbar-brand ms-3" href="../home/home.php">
                                <img src="..\..\public\image\logo.jpg" alt="Logo" width="50" height="30">
                            </div>
                            <div class="text-center mb-4">
                                <h1 class="h3 mb-3 fw-bold">Sign In</h1>
                            </div>

                            <div class="form-outline mb-4">
                                <input type="text" id="username" class="form-control form-control-lg" placeholder="Username" required>
                            </div>

                            <div class="form-outline mb-4">
                                <input type="password" id="password" class="form-control form-control-lg" placeholder="Password" required>
                            </div>

                            <div class="mb-4">
                                <button class="btn btn-primary btn-lg btn-block" type="submit">Sign In</button>
                            </div>
                            <p class="mb-5 text-center text-muted">Don't have an account? <a href="#!" class="text-muted" style="color: #f46b0a !important ; ">Sign up here</a></p>

                            <div class="text-center">
                                <a href="#!" class="small text-muted" style="text-decoration: none">Forgot Password?</a>
                            </div>
                            <div class="text-center" style="color: #e37e21; margin-top: 5%;">
                                <p>-----------------Or -----------------</p>
                            </div>

                            <div class="mb-4">
                                <button class="btn btn-facebook" type="button"><i class="fab fa-facebook"></i> Sign in with Facebook</button>
                                <button class="btn btn-google" type="button"><i class="fab fa-google"></i> Sign in with Google</button>
                            </div>


                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-x2Zv0Aj5a9znzUdytcT6t5GzjpzPA1zhmzLMWbDQs9N5JUX2Y6omw2ms4cO8ETfE" crossorigin="anonymous"></script>
</body>

</html>