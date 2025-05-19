<?php
if (!isset($_GET['application_id'])) {
    // Redirect to the invoice view page if application_id is not set
    header("Location: invoice-view.php");
    exit();
}else {
    // Sanitize the application_id to prevent XSS attacks
    $application_id = htmlspecialchars($_GET['application_id']);

    // update the application status to 'Paid' in the database
    require_once 'classes/Database.php';
    $db = new Database();
    $conn = $db->connect();

    // Use prepared statement to prevent SQL injection
    $stmt = $conn->prepare("UPDATE applications SET paymentStatus = 'Paid' WHERE application_id = ? AND paymentStatus = 'Pending'");
    $stmt->bind_param("i", $application_id);
    $stmt->execute();
    $stmt->close();
    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="en">


<!-- errors-500.html  21 Nov 2019 04:05:02 GMT -->
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Payment Successful</title>
  <!-- General CSS Files -->
  <link rel="stylesheet" href="assets/css/app.min.css">
  <!-- Template CSS -->
  <link rel="stylesheet" href="assets/css/style.css">
  <link rel="stylesheet" href="assets/css/components.css">
  <!-- Custom style CSS -->
  <link rel="stylesheet" href="assets/css/custom.css">
  <link rel='shortcut icon' type='image/x-icon' href='assets/img/favicon.ico' />
  <style>
    .success-tick {
      font-size: 7rem;
      color: #28a745;
      margin-bottom: 20px;
    }
    .success-message {
      font-size: 2rem;
      font-weight: 600;
      color: #28a745;
      margin-bottom: 10px;
    }
    .verify-btn {
      margin-top: 30px;
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
            <div class="success-tick">
              <i class="fas fa-check-circle"></i>
            </div>
            <div class="success-message">
              Payment Successful!
            </div>
            <div class="page-description">
              Thank you. Your payment was received successfully.
            </div>
            <form class="verify-btn" action="" method="post">
              <input type="hidden" name="application_id" value="<?php echo htmlspecialchars($application_id); ?>"
            </form>
          </div>
        </div>
      </div>
    </section>
  </div>
  <!-- General JS Scripts -->
  <script src="assets/js/app.min.js"></script>
  <!-- JS Libraies -->
  <!-- Page Specific JS File -->
  <!-- Template JS File -->
  <script src="assets/js/scripts.js"></script>
  <!-- Custom JS File -->
  <script src="assets/js/custom.js"></script>
  <!-- Font Awesome for tick icon -->
  <script src="https://kit.fontawesome.com/4ad8d6e5b6.js" crossorigin="anonymous"></script>
</body>
</html>