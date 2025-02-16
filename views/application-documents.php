<?php
require_once '../classes/application.php';

$application = new Application();

// retrieving applications by logged in user
$applications = $application->getAllApplications();

// Filter applications by application_id if provided
$application_id = isset($_GET['application_id']) ? $_GET['application_id'] : null;
if ($application_id) {
  $applications = array_filter($applications, function ($app) use ($application_id) {
    return $app['application_id'] == $application_id;
  });
}

?>
<head>
  <!-- General CSS Files -->
  <link rel="stylesheet" href="../assets/css/app.min.css">
  <!-- Template CSS -->
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
            <h4>Application Details & Documents</h4>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-striped" id="table-1">
                <thead>
                  <tr>
                    <th>
                      #
                    </th>
                    <th>Business Name</th>
                    <th>Business Category</th>
                    <th>National ID</th>
                    <th>Health Report</th>
                    <th>Tax Clearance</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $count = 0; ?>
                  <?php foreach ($applications as $application) : ?>
                    <?php $count++; ?>
                    <tr>
                      <td><?php echo $count ?></td>
                      <td><?php echo $application['businessName']; ?></td>
                      <td><?php echo $application['businessType']; ?></td>
                      <td><?php echo $application['nationalIdFile']; ?></td>
                      <td><?php echo $application['healthReportFile']; ?></td>
                      <td><?php echo $application['taxClearanceFile']; ?></td>

                      <td>
                        <div class="dropdown">
                          <button class="btn btn-primary dropdown-toggle" type="button" id="actionMenu<?php echo $application['application_id']; ?>" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Action
                          </button>
                          <div class="dropdown-menu" aria-labelledby="actionMenu<?php echo $application['application_id']; ?>">
                            <a class="dropdown-item" href="../public/application-controller.php?approve_id=<?php echo $application['application_id']; ?>">Approve</a>
                            <a class="dropdown-item view-documents" id="viewDocs" href="application-documents.php?application_id=<?php echo $application['application_id']; ?>">View Documents</a>
                            <a class="dropdown-item" href="../public/application-controller.php?reject_id=<?php echo $application['application_id']; ?>">Reject</a>
                          </div>
                        </div>
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

<script src="../assets/js/app.min.js"></script>
<!-- JS Libraries -->
<script src="../assets/bundles/apexcharts/apexcharts.min.js"></script>
<!-- Page Specific JS File -->
<script src="../assets/js/page/index.js"></script>
<!-- Template JS File -->
<script src="../assets/js/scripts.js"></script>
<!-- Ensure jQuery is loaded before custom.js -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Custom JS File -->
<script src="../assets/js/custom.js"></script>
<!-- Font Awesome JS File -->
<script src="https://kit.fontawesome.com/32c8b0ab14.js" crossorigin="anonymous"></script>
<!-- jQuery JS CDN -->
<script src="../assets/bundles/datatables/datatables.min.js"></script>
<script src="../assets/bundles/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js"></script>
<script src="../assets/bundles/datatables/export-tables/dataTables.buttons.min.js"></script>
<script src="../assets/bundles/datatables/export-tables/buttons.flash.min.js"></script>
<script src="../assets/bundles/datatables/export-tables/jszip.min.js"></script>
<script src="../assets/bundles/datatables/export-tables/pdfmake.min.js"></script>
<script src="../assets/bundles/datatables/export-tables/vfs_fonts.js"></script>
<script src="../assets/bundles/datatables/export-tables/buttons.print.min.js"></script>
<!-- jQuery (required for Bootstrap's JavaScript plugins) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Bootstrap JS -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>

<script src="../assets/js/page/datatables.js"></script>
