<?php
if (!isset($_GET['application_id'])) {
    // Redirect to the invoice view page if application_id is not set
    header("Location: invoice-view.php");
    exit();
} else {
    // Sanitize the application_id to prevent XSS attacks
    $application_id = htmlspecialchars($_GET['application_id']);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Payment Failed</title>
  <!-- General CSS Files -->
  <link rel="stylesheet" href="assets/css/app.min.css">
  <!-- Template CSS -->
  <link rel="stylesheet" href="assets/css/style.css">
  <link rel="stylesheet" href="assets/css/components.css">
  <!-- Custom style CSS -->
  <link rel="stylesheet" href="assets/css/custom.css">
  <link rel='shortcut icon' type='image/x-icon' href='assets/img/favicon.ico' />
  <style>
    .fail-tick {
      font-size: 7rem;
      color: #dc3545;
      margin-bottom: 20px;
    }
    .fail-message {
      font-size: 2rem;
      font-weight: 600;
      color: #dc3545;
      margin-bottom: 10px;
    }
    .page-description {
      color: #6c757d;
      margin-bottom: 25px;
      font-size: 1.15rem;
    }
    .retry-btn {
      margin-top: 20px;
    }
  </style>
</head>

<body>
  <div class="loader"></div>
  <div id="app">
    <section class="section">
      <div class="container mt-5">
        <div class="page-error">
          <div class="page-inner text-center">
            <div class="fail-tick">
              <i class="fas fa-times-circle"></i>
            </div>
            <div class="fail-message">
              Payment Failed!
            </div>
            <div class="page-description">
              Sorry, your payment could not be processed.<br>
              Please check your payment details or try again.
            </div>
            <div class="retry-btn">
              <a href="invoice-view.php?application_id=<?php echo urlencode($application_id); ?>" class="btn btn-danger btn-lg">
                <i class="fas fa-redo-alt mr-1"></i> Try Again
              </a>
              <a href="dashboard.php" class="btn btn-secondary btn-lg ml-2">
                <i class="fas fa-home mr-1"></i> Back to Dashboard
              </a>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
  <!-- General JS Scripts -->
  <script src="assets/js/app.min.js"></script>
  <script src="assets/js/scripts.js"></script>
  <script src="assets/js/custom.js"></script>
  <!-- Font Awesome for icons -->
  <script src="https://kit.fontawesome.com/4ad8d6e5b6.js" crossorigin="anonymous"></script>
</body>
</html>