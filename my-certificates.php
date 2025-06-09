<?php
require_once 'classes/application.php';
// session_start();
// // Check if user is logged in
// if (!isset($_SESSION['user_id'])) {
//   header('Location: login.php');
//   exit();
// }

$application = new Application();

// retrieving all certiticates by logged in user
$applications = $application->getUserCertificates();
if ($applications === false) {
    // Handle error if needed
    echo "Error retrieving applications.";
    exit();

}
?>

<head>
  <!-- General CSS Files -->
  <link rel="stylesheet" href="../assets/css/app.min.css">
  <link rel="stylesheet" href="../assets/css/style.css">
  <link rel="stylesheet" href="../assets/css/components.css">
  <link rel="stylesheet" href="../assets/bundles/datatables/datatables.min.css">
  <link rel="stylesheet" href="../assets/bundles/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css">
  <!-- Custom style CSS -->
  <link rel="stylesheet" href="../assets/css/custom.css">
  <link rel='shortcut icon' type='image/x-icon' href='../assets/img/favicon.png' />
  <!-- Ensure jQuery is loaded before custom.js -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<section class="section">
  <div class="section-body">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h4>Business Certificates</h4>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-striped" id="table-1">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Business Type</th>
                    <th>Business Name</th>
                    <th>Issue Date</th>
                    <th>Fee</th>
                    <th>View</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $count = 0; ?>
                  <?php foreach ($applications as $application) : ?>
                    <?php $count++; ?>
                    <tr>
                      <td><?php echo $count; ?></td>
                      <td><?php echo htmlspecialchars($application['businessType']); ?></td>
                      <td><?php echo htmlspecialchars($application['businessName']); ?></td>
                      <td><?php echo !empty($application['issueDate']) ? date('F d, Y', strtotime($application['issueDate'])) : 'N/A'; ?></td>
                      <td><?php echo isset($application['amount']) ? number_format($application['amount'], 2) . ' MWK' : 'N/A'; ?></td>
                      <td>
                        <a href="ecertificate.php?id=<?php echo urlencode($application['application_id']); ?>" class="btn btn-primary btn-sm" target="_blank">
                          View
                        </a>
                      </td>
                    </tr>
                  <?php endforeach; ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- JS Scripts -->
<script src="../assets/js/app.min.js"></script>
<script src="../assets/bundles/apexcharts/apexcharts.min.js"></script>
<script src="../assets/js/page/index.js"></script>
<script src="../assets/js/scripts.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="../assets/js/custom.js"></script>
<script src="https://kit.fontawesome.com/32c8b0ab14.js" crossorigin="anonymous"></script>
<script src="../assets/bundles/datatables/datatables.min.js"></script>
<script src="../assets/bundles/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js"></script>
<script src="../assets/bundles/datatables/export-tables/dataTables.buttons.min.js"></script>
<script src="../assets/bundles/datatables/export-tables/buttons.flash.min.js"></script>
<script src="../assets/bundles/datatables/export-tables/jszip.min.js"></script>
<script src="../assets/bundles/datatables/export-tables/pdfmake.min.js"></script>
<script src="../assets/bundles/datatables/export-tables/vfs_fonts.js"></script>
<script src="../assets/bundles/datatables/export-tables/buttons.print.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
<script src="../assets/js/page/datatables.js"></script>
