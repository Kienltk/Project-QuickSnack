<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $name = $_POST["firstName"] . " " . $_POST["lastName"];
  $email = $_POST["email"];
  $phone = $_POST["phone"];
  $message = $_POST["message"];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Contact Us</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../../public/css/contact.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&display=swap">
  <style>
    @media (max-width: 768px) {
  .hero-image {
    height: 15vh;
  }
  .heart-icon {
    width: 50px;
    height: 50px;
  }
  h1 span{
    font-size: 40px;
  }
  .contact-info p {
    font-size: 16px;
  }
}
  </style>
</head>

<body>
  <!-- header -->
  <?php
  include '..\includes\header.php';
  ?>
  <!-- image include text and icon -->
  <div class="hero-image d-flex align-items-center">
    <i class="heart-icon"></i>
    <h1 class="mb-0 flex-grow-1 text-right pr-3" style="margin-left: 2%; font-weight: bold; font-size: 60px;">
      <span style="color: #E37E21;">Contact Us</span>
    </h1>
  </div>
  <!-- main -->
  <div class="container">
    <div class="row">
      <!-- Information -->
      <div class="col-lg-6 contact-info">
        <h2 class="mt-3 mb-4">Let's talk with us</h2>
        <p class="not-bold">Questions, comments, or suggestions? Simply fill in the form and we’ll be in touch shortly.</p>
        <p><i class="fas fa-map-marker-alt" style="color: #E37E21;"></i> Aptech Le Thanh Nghi, 19 Le Thanh Nghi, Hai Ba Trung, Hanoi</p>
        <p><i class="fas fa-phone" style="color: #E37E21;"></i> +84 399524359</p>
        <p><i class="fas fa-envelope" style="color: #E37E21;"></i> vidu@gmail.com</p>
      </div>
      <!-- Form contact -->
      <div class="col-lg-6 mt-4">
        <div class="card rounded-lg shadow-lg">
          <div class="card-body">
            <form class="contact-form">
              <div class="row">
                <div class="col">
                  <input type="text" class="form-control contact-input" id="firstName" required placeholder="First Name *">
                </div>
                <div class="col">
                  <input type="text" class="form-control contact-input" id="lastName" required placeholder="Last Name *">
                </div>
              </div>
              <div class="form-group">
                <input type="email" class="form-control contact-input" id="email" required placeholder="Email *">
              </div>
              <div class="form-group">
                <input type="tel" class="form-control contact-input" id="phone" required placeholder="Phone Number *">
              </div>
              <div class="form-group">
                <textarea class="form-control contact-input" id="message" rows="4" placeholder="Your message..."></textarea>
              </div>
              <button type="submit" class="btn btn-primary">Send Message</button>
              <div id="success-message" class="alert alert-success mt-3 d-none" role="alert">
                Your message has been sent successfully!
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- footer -->
  <?php
  include '..\includes\footer.php';
  ?>
  <script src="../../public/js/contact.js"></script>
<<<<<<< Updated upstream
=======
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

>>>>>>> Stashed changes
</body>

</html>