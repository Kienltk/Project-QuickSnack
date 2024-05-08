$(document).ready(function() {
    $(".contact-form").on("submit", function(event) {
      event.preventDefault();
  
      // Disable the submit button to prevent multiple submissions
      $("button[type='submit']").prop("disabled", true);
  
      // Send the form data using AJAX
      $.ajax({
        type: "POST",
        url: "send-email.php", // Replace with the URL of your server-side script
        data: $(this).serialize(),
        success: function(response) {
          // Display the success message
          $("#success-message").removeClass("d-none");
  
          // Enable the submit button
          $("button[type='submit']").prop("disabled", false);
        },
        error: function() {
          // Display an error message
          $("#success-message").removeClass("d-none").text("An error occurred. Please try again later.");
  
          // Enable the submit button
          $("button[type='submit']").prop("disabled", false);
        }
      });
    });
  });