<?php
require_once 'classes/application.php';
require_once 'classes/user.php';

// Ensure the user is logged in
if (!isset($_SESSION['user']) || !is_array($_SESSION['user'])) {
    header("Location: index.php"); // Redirect to login if user is not logged in
    exit();
}

$user = $_SESSION['user'];
$application = new Application();

// Ensure getAllApplications() always returns an array
$applications = $application->getAllApplications() ?? [];

// Ensure proper filtering keys exist
$applications = array_filter($applications, function($app) {
    return isset($app['verificationStatus'], $app['paymentStatus']) &&
           $app['verificationStatus'] === 'paidVerified' &&
           $app['paymentStatus'] === 'Paid';
});

// Fetch dynamic data for the dashboard
$newApplicationsCount = $application->getCountByStatus('Pending');
$newBusinessesCount = $application->getCountByStatus('Approved');
$approvalRate = $application->getApprovalRate(); // Assuming this method exists
$totalRevenue = $application->getTotalRevenue(); // Load total revenue logic

if (isset($_GET['action']) && isset($_GET['application_id'])) {
    $action = $_GET['action'];
    $application_id = intval($_GET['application_id']);

    $application = new Application();

    if ($action === 'certify') {
        $application->updateCertificateStatus($application_id, 'certified');
    } elseif ($action === 'revoke') {
        $application->updateCertificateStatus($application_id, 'revoked');
    }
}
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
  <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.png" />
  <!-- Font Awesome -->
  <script src="https://kit.fontawesome.com/32c8b0ab14.js" crossorigin="anonymous"></script>
  <!-- Ensure jQuery is loaded first -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="assets/js/custom.js"></script>
</head>

<body>
  <div class="loader"></div>
  <div id="app">
    <div class="main-wrapper main-wrapper-1">
      <div class="navbar-bg"></div>
      <nav class="navbar navbar-expand-lg main-navbar sticky">
        <div class="form-inline mr-auto">
          <ul class="navbar-nav mr-3">
            <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg collapse-btn"> <i data-feather="align-justify"></i></a></li>
            <li><a href="#" class="nav-link nav-link-lg fullscreen-btn"><i data-feather="maximize"></i></a></li>
            <li>
              <form class="form-inline mr-auto">
                <div class="search-element">
                  <input class="form-control" type="search" placeholder="Search" aria-label="Search" data-width="200">
                  <button class="btn" type="submit"><i class="fas fa-search"></i></button>
                </div>
              </form>
            </li>
          </ul>
        </div>
        <ul class="navbar-nav navbar-right">
          <li class="nav-item">
            <span class="nav-link" style="font-size: 1rem; font-weight: 600; color: #4CAF50;">CEO Dashboard</span>
</li>
        </ul>
      </nav>
      <div class="main-sidebar sidebar-style-2">
        <aside id="sidebar-wrapper">
          <div class="sidebar-brand">
            <a href="ceo-dashboard.php">
              <img alt="image" src="assets/img/logo.png" class="header-logo" />
              <span class="logo-name">BCCCIS</span>
            </a>
          </div>
          <ul class="sidebar-menu">
            <li class="dropdown active"><a href="ceo-dashboard.php" class="#"><i data-feather="monitor"></i><span>Dashboard</span></a></li>
            <li class="menu-header">Certificates</li>
            <li class="dropdown"><a href="views/business-applications.php" class="nav-link"><i class="fa-solid fa-briefcase"></i><span>Applications</span></a></li>
            <li class="dropdown"><a href="allCertificates.php" class="nav-link"><i class="fa-solid fa-award"></i><span>Eligible Certificates</span></a></li>
    
            <li class="menu-header">Settings</li>
            <li class="dropdown"><a href="ceo-reports.php" class="nav-link"><i class="fa-solid fa-chart-line"></i><span>Reports</span></a></li>
            <li class="dropdown"><a href="profile.php" class="nav-link"><i class="fa-solid fa-user-circle"></i><span>Profile</span></a></li>
          </ul>
        </aside>
      </div>

      <!-- Main Content -->
      <div class="main-content" id="main-content">
        <section class="section">
          <div class="section-body">
            <div class="row">
              <div class="col-xl-3 col-lg-6">
                <div class="card">
                  <div class="card-bg">
                    <div class="p-t-20 d-flex justify-content-between">
                      <div class="col">
                        <h6 class="mb-0">New Applications</h6>
                        <span class="font-weight-bold mb-0 font-20"><?= htmlspecialchars($newApplicationsCount) ?></span>
                      </div>
                      <i class="fas fa-file-alt card-icon col-orange font-30 p-r-30"></i>
                    </div>
                    <canvas id="cardChart1" height="80"></canvas>
                  </div>
                </div>
              </div>
              <div class="col-xl-3 col-lg-6">
                <div class="card">
                  <div class="card-bg">
                    <div class="p-t-20 d-flex justify-content-between">
                      <div class="col">
                        <h6 class="mb-0">New Businesses</h6>
                        <span class="font-weight-bold mb-0 font-20"><?= htmlspecialchars($newBusinessesCount) ?></span>
                      </div>
                      <i class="fas fa-briefcase card-icon col-green font-30 p-r-30"></i>
                    </div>
                    <canvas id="cardChart2" height="80"></canvas>
                  </div>
                </div>
              </div>
              <div class="col-xl-3 col-lg-6">
                <div class="card">
                  <div class="card-bg">
                    <div class="p-t-20 d-flex justify-content-between">
                      <div class="col">
                        <h6 class="mb-0">Approval Rate</h6>
                        <span class="font-weight-bold mb-0 font-20"><?= htmlspecialchars($approvalRate) ?>%</span>
                      </div>
                      <i class="fas fa-thumbs-up card-icon col-indigo font-30 p-r-30"></i>
                    </div>
                    <canvas id="cardChart3" height="80"></canvas>
                  </div>
                </div>
              </div>
              <div class="col-xl-3 col-lg-6">
                <div class="card">
                  <div class="card-bg">
                    <div class="p-t-20 d-flex justify-content-between">
                      <div class="col">
                        <h6 class="mb-0">Total Revenue</h6>
                        <span class="font-weight-bold mb-0 font-20">MWK<?= htmlspecialchars(number_format($totalRevenue, 2)) ?></span>
                      </div>
                      <i class="fas fa-coins card-icon col-cyan font-30 p-r-30"></i>
                    </div>
                    <canvas id="cardChart4" height="80"></canvas>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h4>Business Licences & Certificates</h4>
                  </div>
                  <div class="card-body">
                    <div class="table-responsive">
                      <table class="table table-striped" id="table-1">
                        <thead>
                          <tr>
                            <th>#</th>
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
                          <?php foreach ($applications as $app) : ?>
                            <?php $count++; ?>
                            <tr>
                              <td><?= $count ?></td>
                              <td><?= htmlspecialchars($app['businessName'] ?? 'N/A') ?></td>
                              <td><?= htmlspecialchars($app['businessType'] ?? 'N/A') ?></td>
                              <td><?= htmlspecialchars($app['business_owner'] ?? 'N/A') ?></td>
                              <td><?= htmlspecialchars($app['created_at'] ?? 'N/A') ?></td>
                              <td>
                                <div class="badge badge-<?= 
                                    $app['status'] === 'Approved' ? 'success' : 
                                    ($app['status'] === 'Rejected' ? 'danger' : 'primary') 
                                  ?> badge-shadow">
                                  <?= htmlspecialchars($app['status'] ?? 'Pending') ?>
                                </div>
                              </td>
                              <td>
                                <?php if (!empty($app['application_id'])) : ?>
                                  <div class="dropdown">
                                    <button class="btn btn-primary dropdown-toggle" type="button" id="actionMenu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                      Actions
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="actionMenu">
                                      <a class="dropdown-item" href="ceo-dashboard.php?action=certify&application_id=<?= htmlspecialchars($app['application_id']) ?>">Certify</a>
                                      <a class="dropdown-item" href="ceo-dashboard.php?action=revoke&application_id=<?= htmlspecialchars($app['application_id']) ?>">Revoke</a>
                                    </div>
                                  </div>
                                <?php else : ?>
                                  <span class="text-muted">No Application ID</span>
                                <?php endif; ?>
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
  </div>

  <!-- General JS Scripts -->
  <script src="assets/js/app.min.js"></script>
  <script src="assets/bundles/apexcharts/apexcharts.min.js"></script>
  <script src="assets/js/page/index.js"></script>
  <script src="assets/js/scripts.js"></script>
  <script src="assets/js/custom.js"></script>
  <script src="assets/bundles/datatables/datatables.min.js"></script>
  <script src="assets/bundles/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js"></script>
  <script src="assets/bundles/datatables/export-tables/dataTables.buttons.min.js"></script>
  <script src="assets/bundles/datatables/export-tables/buttons.flash.min.js"></script>
  <script src="assets/bundles/datatables/export-tables/jszip.min.js"></script>
  <script src="assets/bundles/datatables/export-tables/pdfmake.min.js"></script>
  <script src="assets/bundles/datatables/export-tables/vfs_fonts.js"></script>
  <script src="assets/bundles/datatables/export-tables/buttons.print.min.js"></script>
  <script src="assets/js/page/datatables.js"></script>
</body>

</html>
