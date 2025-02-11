<?php
require_once 'classes/application.php';
require_once 'classes/user.php';

$application = new Application();
$user = new User();

// retrieving applications by logged in user
$applications = $application->getAllApplications();
$loggedInUser = isset($_SESSION['user']) ? $_SESSION['user'] : null;

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Blantyre City Council</title>
  <!-- General CSS Files -->
  <link rel="stylesheet" href="assets/css/app.min.css">
  <!-- Template CSS -->
  <link rel="stylesheet" href="assets/css/style.css">
  <link rel="stylesheet" href="assets/css/components.css">
  <link rel="stylesheet" href="assets/bundles/datatables/datatables.min.css">
  <link rel="stylesheet" href="assets/bundles/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css">
  <!-- Custom style CSS -->
  <link rel="stylesheet" href="assets/css/custom.css">
  <link rel='shortcut icon' type='image/x-icon' href='assets/img/favicon.png' />
  <!-- Ensure jQuery is loaded before custom.js -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <!-- font awesome CDN Link -->
  <script src="https://kit.fontawesome.com/32c8b0ab14.js" crossorigin="anonymous"></script>
   
</head>

<body>
  <div class="loader"></div>
  <div id="app">
    <div class="main-wrapper main-wrapper-1">
      <div class="navbar-bg" style="background-color: white;"></div>
      <!-- Removed top nav bar -->
    </div>
  </div>
  <div id="app">
    <div class="main-wrapper main-wrapper-1">
      <div class="navbar-bg"></div>
      
      <div class="main-sidebar sidebar-style-2">
        <aside id="sidebar-wrapper">
          <div class="sidebar-brand">
            <a href="tlo-dashboard.php"> <img alt="image" src="assets/img/logo.png" class="header-logo" /> <span class="logo-name">BCCCIS</span>
            </a>
          </div>
          <ul class="sidebar-menu">
            <li class="dropdown">
              <a href="#" class="#"><i data-feather="monitor"></i><span>Dashboard</span></a>
            </li>
            <li class="dropdown">
              <a href="#" class="nav-link"><i class="fa-solid fa-plus-square"></i><span>Add Business</span></a>
            </li>
            <li class="dropdown">
              <a href="#" class="nav-link"><i class="fa-solid fa-file-invoice"></i><span>Approved Applications</span></a>
            </li>

            <li class="menu-header">Certificates</li>
            <li class="dropdown active">
              <a href="#" class="nav-link"><i class="fa-solid fa-briefcase"></i><span>Business Applications</span></a>
            </li>
            <li class="dropdown">
              <a href="#" class="nav-link"><i class="fa-solid fa-chart-line"></i><span>Analytics</span></a>
            </li>

            <li class="menu-header">Settings</li>
            <li class="dropdown">
              <a href="#" class="nav-link"><i class="fa-solid fa-user-circle"></i><span>Profile</span></a>
            </li>
          </ul>

        </aside>
      </div>
      <!-- Main Content -->
      <div class="main-content" id="main-content">
        <section class="section">
          <div class="section-body">
            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h4>Business Applications</h4>
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
                            <th>Business Owner</th>
                            <th>Application Date</th>
                            <th>Application Status</th>
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
                              <td><?php echo $application['business_owner']; ?></td>
                              <td><?php echo $application['created_at']; ?></td>
                              <?php if ($application['status'] == 'Pending') { ?>
                                <td>
                                  <div class="badge badge-primary badge-shadow"><?php echo $application['status']; ?></div>
                                </td>
                              <?php } else if ($application['status'] == 'Approved') { ?>
                                <td>
                                  <div class="badge badge-success badge-shadow"><?php echo $application['status']; ?></div>
                                </td>
                              <?php } else if ($application['status'] == 'Rejected') { ?>
                                <td>
                                  <div class="badge badge-danger badge-shadow"><?php echo $application['status']; ?></div>
                                </td>
                              <?php } ?>
                              <td>
                                <a class="btn btn-primary view-documents" id="viewDocs" href="application-documents.php?application_id=<?= $application['application_id']; ?>">View Full Application</a>
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
      </div>
    </div>
    <!-- General JS Scripts -->
    <script src="assets/js/app.min.js"></script>
    <!-- JS Libraies -->
    <script src="assets/bundles/apexcharts/apexcharts.min.js"></script>
    <!-- Page Specific JS File -->
    <script src="assets/js/page/index.js"></script>
    <!-- Template JS File -->
    <script src="assets/js/scripts.js"></script>
    <!-- Ensure jQuery is loaded before custom.js -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Custom JS File -->
    <script src="assets/js/custom.js"></script>
    <!--font Awesome JS File-->
    <script src="https://kit.fontawesome.com/32c8b0ab14.js" crossorigin="anonymous"></script>
    <!--JQuery JS CDN-->
    <script src="assets/bundles/datatables/datatables.min.js"></script>
    <script src="assets/bundles/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js"></script>
    <script src="assets/bundles/datatables/export-tables/dataTables.buttons.min.js"></script>
    <script src="assets/bundles/datatables/export-tables/buttons.flash.min.js"></script>
    <script src="assets/bundles/datatables/export-tables/jszip.min.js"></script>
    <script src="assets/bundles/datatables/export-tables/pdfmake.min.js"></script>
    <script src="assets/bundles/datatables/export-tables/vfs_fonts.js"></script>
    <script src="assets/bundles/datatables/export-tables/buttons.print.min.js"></script>

    <script src="assets/js/page/datatables.js"></script>

    <!-- General JS Scripts -->
     <!-- Page Specific JS File -->
  <script src="assets/js/page/index.js"></script>

</body>

</html>