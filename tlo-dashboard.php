<?php
session_start(); // Ensure session is started before accessing session variables
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

// Get counts for different application statuses
$newApplicationsCount = $application->getCountByStatus('Pending'); // Ensure this status matches the database
$approvedApplicationsCount = $application->getCountByStatus('Approved');
$rejectedApplicationsCount = $application->getCountByStatus('Rejected');

// Calculate the percentage changes for each status
$totalApplications = count($applications);
$newApplicationsPercentage = $totalApplications > 0 ? ($newApplicationsCount / $totalApplications) * 100 : 0;
$approvedApplicationsPercentage = $totalApplications > 0 ? ($approvedApplicationsCount / $totalApplications) * 100 : 0;
$rejectedApplicationsPercentage = $totalApplications > 0 ? ($rejectedApplicationsCount / $totalApplications) * 100 : 0;
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
            <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg
									collapse-btn"> <i data-feather="align-justify"></i></a></li>
            <li><a href="#" class="nav-link nav-link-lg fullscreen-btn">
                <i data-feather="maximize"></i>
              </a></li>
            <li>
              <form class="form-inline mr-auto">
                <div class="search-element">
                  <input class="form-control" type="search" placeholder="Search" aria-label="Search" data-width="200">
                  <button class="btn" type="submit">
                    <i class="fas fa-search"></i>
                  </button>
                </div>
              </form>
            </li>
          </ul>
        </div>
        <ul class="navbar-nav navbar-right">
          <!-- Add TLO Dashboard Indicator -->
          <li class="nav-item">
            <span class="nav-link" style="font-size: 1rem; font-weight: 600; color: #4CAF50;">TLO Dashboard</span>
          </li>
          <!-- Removed messages and profile from the top nav bar -->
        </ul>
      </nav>
      <div class="main-sidebar sidebar-style-2">
        <aside id="sidebar-wrapper">
          <div class="sidebar-brand">
            <a href="tlo-dashboard.php">
              <img alt="image" src="assets/img/logo.png" class="header-logo" />
              <span class="logo-name">BCCCIS</span>
            </a>
          </div>
          <ul class="sidebar-menu">
            <li class="dropdown"><a href="tlo-dashboard.php" class="#"><i data-feather="monitor"></i><span>Dashboard</span></a></li>
            <li class="dropdown"><a href="applyform.php" class="nav-link"><i class="fa-solid fa-plus-square"></i><span>Add Business</span></a></li>
            <li class="dropdown"><a href="approved-applications.php" class="nav-link"><i class="fa-solid fa-file-invoice"></i><span>Approved Applications</span></a></li>
            <li class="menu-header">Certificates</li>
            <li class="dropdown active"><a href="/views/business-applications.php" class="nav-link"><i class="fa-solid fa-briefcase"></i><span>Business Applications</span></a></li>
            <li class="dropdown"><a href="analytics.php" class="nav-link"><i class="fa-solid fa-chart-line"></i><span>Analytics</span></a></li>
            <li class="menu-header">Settings</li>
            <li class="dropdown"><a href="profile.php" class="nav-link"><i class="fa-solid fa-user-circle"></i><span>Profile</span></a></li>
          </ul>
        </aside>
      </div>

      <!-- Main Content -->
      <div class="main-content" id="main-content">
        <section class="section">
        <div class="row">
            <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6 col-xs-12"> <!-- Adjusted column width -->
              <div class="card">
                <div class="card-statistic-4">
                  <div class="align-items-center justify-content-between">
                    <div class="row ">
                      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">
                        <div class="card-content">
                          <h5 class="font-15">New Applications</h5>
                          <h2 class="mb-3 font-18"><?php echo $newApplicationsCount; ?></h2>
                          <p class="mb-0"><span class="col-green"><?php echo round($newApplicationsPercentage, 2); ?>%</span> of Total</p>
                        </div>
                      </div>
                      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0">
                        <div class="banner-img">
                          <img src="assets/img/banner/1.png" alt="">
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6 col-xs-12"> <!-- Adjusted column width -->
              <div class="card">
                <div class="card-statistic-4">
                  <div class="align-items-center justify-content-between">
                    <div class="row ">
                      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">
                        <div class="card-content">
                          <h5 class="font-15">Approved Applications</h5>
                          <h2 class="mb-3 font-18"><?php echo $approvedApplicationsCount; ?></h2>
                          <p class="mb-0"><span class="col-orange"><?php echo round($approvedApplicationsPercentage, 2); ?>%</span> of Total</p>
                        </div>
                      </div>
                      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0">
                        <div class="banner-img">
                          <img src="assets/img/banner/2.png" alt="">
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6 col-xs-12"> <!-- Adjusted column width -->
              <div class="card">
                <div class="card-statistic-4">
                  <div class="align-items-center justify-content-between">
                    <div class="row ">
                      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">
                        <div class="card-content">
                          <h5 class="font-15">Rejected Applications</h5>
                          <h2 class="mb-3 font-18"><?php echo $rejectedApplicationsCount; ?></h2>
                          <p class="mb-0"><span class="col-red"><?php echo round($rejectedApplicationsPercentage, 2); ?>%</span> of Total</p>
                        </div>
                      </div>
                      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0">
                        <div class="banner-img">
                          <img src="assets/img/banner/4.png" alt="">
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
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
                                  <a class="btn btn-primary view-documents" 
                                     href="application-documents.php?application_id=<?= htmlspecialchars($app['application_id']) ?>">
                                    View Full Application
                                  </a>
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
