<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sign Up</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <link rel="stylesheet" href="../../public/css/signup.css">
</head>

<body>
  <!-- <div class="container-box">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-6 col-left">
        </div>
        <div class="col-md-6 col-right">
  
          <div class="card-body">
            <form>
              <div class="text-center mb-4">
                <h1 class="h3 mb-3 fw-bold">Sign Up</h1>
              </div>

              <div class="form-outline mb-4">
                <input type="text" id="full_name" class="form-control form-control-lg" placeholder="Full Name" required>
              </div>
              <div class="form-outline mb-4">
                <input type="text" id="username" class="form-control form-control-lg" placeholder="Username" required>
              </div>
              <div class="form-outline mb-4">
                <input type="email" id="login" class="form-control form-control-lg" placeholder="Email" required>
              </div>

              <div class="form-outline mb-4">
                <input type="password" id="password" class="form-control form-control-lg" placeholder="Password"
                  required>
              </div>

              <div class="form-outline mb-4">
                <input type="password" id="confirm_password" class="form-control form-control-lg"
                  placeholder="Confirm Password" required>
              </div>

              <div class="form-outline mb-4">
                <select class="form-select form-select-lg" id="gender" aria-label="Gender" required>
                  <option selected disabled>Select Gender</option>
                  <option value="male">Male</option>
                  <option value="female">Female</option>
                  <option value="other">Other</option>
                </select>
              </div>

              <div class="mb-4 form-check">
                <input type="checkbox" class="form-check-input" id="agree_terms" required>
                <label class="form-check-label" for="agree_terms">I agree to the terms and conditions</label>
              </div>

              <div class="mb-4">
                <button class="btn btn-primary btn-lg btn-block" type="submit">Sign Up</button>
              </div>

              <p class="mb-5 text-center text-muted">Already have an account? <a href="#!" class="text-muted">Log in
                  here</a></p>
              <div class="text-center" style="color: #e37e21; margin-top: 5%;">
                <p>-----------------Or -----------------</p>
              </div>
              <div class="mb-4">
                <button class="btn btn-google" type="button"><i class="fab fa-google"></i> Sign up with Google</button>
                <button class="btn btn-facebook" type="button"><i class="fab fa-facebook"></i> Sign up with
                  Facebook</button>
              </div>
              <div class="text-center">
                <a href="#!" class="small text-muted" style="text-decoration: none">Terms of use.</a>
                <span class="mx-2 text-muted">|</span>
                <a href="#!" class="small text-muted" style="text-decoration: none">Privacy policy</a>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div> -->

  <div class="container-box">
    <div class="container">
      <div class="row">
        <div class="col-6 d-none d-lg-block">
          <img src="https://images.pexels.com/photos/1410235/pexels-photo-1410235.jpeg?auto=compress&cs=tinysrgb&w=600"
            alt="" class="img-fluid" style="height: 100%;">
        </div>
        <div class="col-lg-6 col-right">

          <div class="card-body">
            <form>
              <div class="text-center mb-4">
                <h1 class="h3 mb-3 fw-bold">Sign Up</h1>
              </div>

              <div class="form-outline mb-4">
                <input type="text" id="full_name" class="form-control form-control-lg" placeholder="Full Name" required>
              </div>
              <div class="form-outline mb-4">
                <input type="text" id="username" class="form-control form-control-lg" placeholder="Username" required>
              </div>
              <div class="form-outline mb-4">
                <input type="email" id="login" class="form-control form-control-lg" placeholder="Email" required>
              </div>

              <div class="form-outline mb-4">
                <input type="password" id="password" class="form-control form-control-lg" placeholder="Password"
                  required>
              </div>

              <div class="form-outline mb-4">
                <input type="password" id="confirm_password" class="form-control form-control-lg"
                  placeholder="Confirm Password" required>
              </div>

              <div class="form-outline mb-4">
                <select class="form-select form-select-lg" id="gender" aria-label="Gender" required>
                  <option selected disabled>Select Gender</option>
                  <option value="male">Male</option>
                  <option value="female">Female</option>
                  <option value="other">Other</option>
                </select>
              </div>

              <div class="mb-4 form-check">
                <input type="checkbox" class="form-check-input" id="agree_terms" required>
                <label class="form-check-label" for="agree_terms">I agree to the terms and conditions</label>
              </div>

              <div class="mb-4">
                <button class="btn btn-primary btn-lg btn-block" type="submit">Sign Up</button>
              </div>

              <p class="mb-5 text-center text-muted">Already have an account? <a href="signIn.php" class="text-muted">Log in
                  here</a></p>
              <div class="text-center" style="color: #e37e21; margin-top: 5%;">
                <p>------Or------</p>
              </div>
              <div class="mb-4">
                <button class="btn btn-google" type="button"><i class="fab fa-google"></i> Sign up with Google</button>
                <button class="btn btn-facebook" type="button"><i class="fab fa-facebook"></i> Sign up with
                  Facebook</button>
              </div>
              <div class="text-center">
                <a href="#!" class="small text-muted" style="text-decoration: none">Terms of use.</a>
                <span class="mx-2 text-muted">|</span>
                <a href="#!" class="small text-muted" style="text-decoration: none">Privacy policy</a>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-x2Zv0Aj5a9znzUdytcT6t5GzjpzPA1zhmzLMWbDQs9N5JUX2Y6omw2ms4cO8ETfE"
    crossorigin="anonymous"></script>
</body>

</html>