<?php
require_once 'classes/application.php';
require_once 'classes/user.php';p'; 

// Ensure the user is logged in| $_SESSION['user']['role'] != 'business_owner') {
if (!isset($_SESSION['user']) || !is_array($_SESSION['user'])) {
    header("Location: index.php"); // Redirect to login if user is not logged in
    exit();
}
require_once 'classes/application.php';
$user = $_SESSION['user'];
$application = new Application();

// Ensure getAllApplications() always returns an array
$applications = $application->getAllApplications() ?? [];

// Ensure proper filtering keys exist
$applications = array_filter($applications, function($app) {nction($app) {
    return isset($app['verificationStatus'], $app['paymentStatus']) &&
           $app['verificationStatus'] === 'paidVerified' &&
           $app['paymentStatus'] === 'Paid';ter($applications, function($app) {
}); return $app['status'] == 'Approved';
}));
// Fetch dynamic data for the dashboardy_filter($applications, function($app) {
$newApplicationsCount = $application->getCountByStatus('Pending');
$newBusinessesCount = $application->getCountByStatus('Approved');
$approvalRate = $application->getApprovalRate(); // Assuming this method exists
$totalRevenue = $application->getTotalRevenue(); // Load total revenue logic
}));
if (isset($_GET['action']) && isset($_GET['application_id'])) {
    $action = $_GET['action'];
    $application_id = intval($_GET['application_id']);
<html lang="en">
    $application = new Application();
<head>
    if ($action === 'certify') {
        $application->updateCertificateStatus($application_id, 'certified');k-to-fit=no" name="viewport">
    } elseif ($action === 'revoke') {>
        $application->updateCertificateStatus($application_id, 'revoked');
    }nk rel="stylesheet" href="assets/css/app.min.css">
} <!-- Template CSS -->
?><link rel="stylesheet" href="assets/css/style.css">
  <link rel="stylesheet" href="assets/css/components.css">
  <link rel="stylesheet" href="assets/bundles/datatables/datatables.min.css">
<!DOCTYPE html>ylesheet" href="assets/bundles/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css">
<html lang="en">yle CSS -->
  <script src="https://in.paychangu.com/js/popup.js" defer></script>
<head>k rel="stylesheet" href="assets/css/custom.css">
  <meta charset="UTF-8">on' type='image/x-icon' href='assets/img/favicon.png' />
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Blantyre City Council</title>/jquery-3.6.0.min.js"></script>
  <!-- font awesome CDN Link -->
  <!-- General CSS Files -->ontawesome.com/32c8b0ab14.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="assets/css/app.min.css">
  <!-- Template CSS -->
  <link rel="stylesheet" href="assets/css/style.css">
  <link rel="stylesheet" href="assets/css/components.css">
  <link rel="stylesheet" href="assets/bundles/datatables/datatables.min.css">
  <link rel="stylesheet" href="assets/bundles/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css">
  <!-- Custom style CSS -->r main-wrapper-1">
  <link rel="stylesheet" href="assets/css/custom.css">
  <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.png" />
  <!-- Font Awesome -->m-inline mr-auto">
  <script src="https://kit.fontawesome.com/32c8b0ab14.js" crossorigin="anonymous"></script>
  <!-- Ensure jQuery is loaded first -->"sidebar" class="nav-link nav-link-lg
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="assets/js/custom.js"></script>av-link-lg fullscreen-btn">
</head>         <i data-feather="maximize"></i>
              </a></li>
<body>      <li>
  <div class="loader"></div>orm-inline mr-auto">
  <div id="app"><div class="search-element">
    <div class="main-wrapper main-wrapper-1"> type="search" placeholder="Search" aria-label="Search" data-width="200">
      <div class="navbar-bg"></div>n" type="submit">
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
                </div>s="nav-link" style="font-size: 1rem; font-weight: 600; color: #4CAF50;">USER Dashboard</span>
              </form>
            </li>
          </ul>
        </div>ss="main-sidebar sidebar-style-2">
        <ul class="navbar-nav navbar-right">
          <li class="nav-item">rand">
            <span class="nav-link" style="font-size: 1rem; font-weight: 600; color: #4CAF50;">CEO Dashboard</span>class="logo-name">BCCCIS</span>
</li>       </a>
        </ul>iv>
      </nav>l class="sidebar-menu">
      <div class="main-sidebar sidebar-style-2">
        <aside id="sidebar-wrapper">d.php" class="dropdown active"><i data-feather="monitor"></i><span>Dashboard</span></a>
          <div class="sidebar-brand">
            <a href="ceo-dashboard.php">
              <img alt="image" src="assets/img/logo.png" class="header-logo" />square-plus"></i><span>New Application</span></a>
              <span class="logo-name">BCCCIS</span>
            </a>class="dropdown">
          </div> href="invoice-view.php" class="nav-link"><i class="fa-solid fa-file-invoice-dollar"></i><span>Invoices</span></a>
          <ul class="sidebar-menu">
            <li class="dropdown active"><a href="ceo-dashboard.php" class="#"><i data-feather="monitor"></i><span>Dashboard</span></a></li>
            <li class="menu-header">Certificates</li>
            <li class="dropdown"><a href="views/business-applications.php" class="nav-link"><i class="fa-solid fa-briefcase"></i><span>Applications</span></a></li>
            <li class="dropdown"><a href="allCertificates.php" class="nav-link"><i class="fa-solid fa-award"></i><span>Eligible Certificates</span></a></li>
            </li>
            <li class="menu-header">Settings</li>
            <li class="dropdown"><a href="ceo-reports.php" class="nav-link"><i class="fa-solid fa-chart-line"></i><span>Reports</span></a></li>
            <li class="dropdown"><a href="profile.php" class="nav-link"><i class="fa-solid fa-user-circle"></i><span>Profile</span></a></li>
          </ul>
        </aside>class="menu-header">Support</li>
      </div>
            <li class="dropdown">
      <!-- Main Content -->php" class="nav-link"><i class="fa-solid fa-question"></i><span>FAQ</span></a>
      <div class="main-content" id="main-content">
        <section class="section">
          <div class="section-body">class="nav-link"><i class="fa-solid fa-user"></i><span>Profile</span></a>
            <div class="row">
              <div class="col-xl-3 col-lg-6">
                <div class="card">
                  <div class="card-bg">
                    <div class="p-t-20 d-flex justify-content-between">
                      <div class="col">
                        <h6 class="mb-0">New Applications</h6>
                        <span class="font-weight-bold mb-0 font-20"><?= htmlspecialchars($newApplicationsCount) ?></span>
                      </div>n-body">
                      <i class="fas fa-file-alt card-icon col-orange font-30 p-r-30"></i>
                    </div>col-xl-3 col-lg-6">
                    <canvas id="cardChart1" height="80"></canvas>
                  </div>lass="card-statistic-3">
                </div>iv class="card-icon card-icon-large"><i class="fa fa-award" style="font-size: 2.5rem;"></i></div>
              </div><div class="card-content">
              <div class="col-xl-3 col-lg-6">New Applications</h4>
                <div class="card">echo $newApplicationsCount; ?></span>
                  <div class="card-bg">ess mt-1 mb-1" data-height="8">
                    <div class="p-t-20 d-flex justify-content-between">gressbar" data-width="25%" aria-valuenow="25"
                      <div class="col">="0" aria-valuemax="100"></div>
                        <h6 class="mb-0">New Businesses</h6>
                        <span class="font-weight-bold mb-0 font-20"><?= htmlspecialchars($newBusinessesCount) ?></span>
                      </div>
                      <i class="fas fa-briefcase card-icon col-green font-30 p-r-30"></i>
                    </div>
                    <canvas id="cardChart2" height="80"></canvas>
                  </div>ss="card l-bg-cyan">
                </div> class="card-statistic-3">
              </div><div class="card-icon card-icon-large"><i class="fa fa-briefcase" style="font-size: 2.5rem;"></i></div>
              <div class="col-xl-3 col-lg-6">>
                <div class="card">ard-title">Approved Applications</h4>
                  <div class="card-bg">$approvedApplicationsCount; ?></span>
                    <div class="p-t-20 d-flex justify-content-between">
                      <div class="col">gress-bar l-bg-orange" role="progressbar" data-width="25%" aria-valuenow="25"
                        <h6 class="mb-0">Approval Rate</h6>100"></div>
                        <span class="font-weight-bold mb-0 font-20"><?= htmlspecialchars($approvalRate) ?>%</span>
                      </div>
                      <i class="fas fa-thumbs-up card-icon col-indigo font-30 p-r-30"></i>
                    </div>
                    <canvas id="cardChart3" height="80"></canvas>
                  </div>="col-xl-3 col-lg-6">
                </div>lass="card l-bg-purple">
              </div>iv class="card-statistic-3">
              <div class="col-xl-3 col-lg-6">d-icon-large"><i class="fa fa-globe" style="font-size: 2.5rem;"></i></div>
                <div class="card">rd-content">
                  <div class="card-bg">itle">Rejected Applications</h4>
                    <div class="p-t-20 d-flex justify-content-between">span>
                      <div class="col">ess mt-1 mb-1" data-height="8">
                        <h6 class="mb-0">Total Revenue</h6> role="progressbar" data-width="25%" aria-valuenow="25"
                        <span class="font-weight-bold mb-0 font-20">MWK<?= htmlspecialchars(number_format($totalRevenue, 2)) ?></span>
                      </div>
                      <i class="fas fa-coins card-icon col-cyan font-30 p-r-30"></i>
                    </div>
                    <canvas id="cardChart4" height="80"></canvas>
                  </div>
                </div>ss="col-xl-3 col-lg-6">
              </div> class="card l-bg-orange">
            </div><div class="card-statistic-3">
            <div class="row">s="card-icon card-icon-large"><i class="fa fa-money-bill-alt" style="font-size: 2.5rem;"></i></div>
              <div class="col-12">rd-content">
                <div class="card">ard-title">Certificates</h4>
                  <div class="card-header">tificateCount; ?></span>
                    <h4>Business Licences & Certificates</h4>ight="8">
                  </div><div class="progress-bar l-bg-green" role="progressbar" data-width="25%" aria-valuenow="25"
                  <div class="card-body">0" aria-valuemax="100"></div>
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
                            <th>Action</th>tions</h4>
                          </tr>
                        </thead>rd-body">
                        <tbody>"table-responsive">
                          <?php $count = 0; ?>e-striped table-hover" id="" style="width:100%;">
                          <?php foreach ($applications as $app) : ?>
                            <?php $count++; ?>
                            <tr>Business Name</th>
                              <td><?= $count ?></td>
                              <td><?= htmlspecialchars($app['businessName'] ?? 'N/A') ?></td>
                              <td><?= htmlspecialchars($app['businessType'] ?? 'N/A') ?></td>
                              <td><?= htmlspecialchars($app['business_owner'] ?? 'N/A') ?></td>
                              <td><?= htmlspecialchars($app['created_at'] ?? 'N/A') ?></td>
                              <td>rtificate Fee</th>
                                <div class="badge badge-<?= 
                                    $app['status'] === 'Approved' ? 'success' : 
                                    ($app['status'] === 'Rejected' ? 'danger' : 'primary') 
                                  ?> badge-shadow">s as $application) : ?>
                                  <?= htmlspecialchars($app['status'] ?? 'Pending') ?>
                                </div>p echo $application['businessName']; ?></td>
                              </td>?php echo $application['businessType']; ?></td>
                              <td><?php echo $application['created_at']; ?></td>
                                <?php if (!empty($app['application_id'])) : ?>>
                                  <div class="dropdown">n['status']; ?></td>
                                    <button class="btn btn-primary dropdown-toggle" type="button" id="actionMenu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                      Actions$application['amount']; ?></td>
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
                      </table>>
                    </div>/app.min.js"></script>
                  </div>
                </div>s/bundles/apexcharts/apexcharts.min.js"></script>
              </div>ic JS File -->
            </div>ssets/js/page/index.js"></script>
          </div>e JS File -->
        </section>ssets/js/scripts.js"></script>
      </div>tom JS File -->
    </div>t src="assets/js/custom.js"></script>
  </div> JQuery JS CDN -->
    <script src="assets/bundles/datatables/datatables.min.js"></script>
  <!-- General JS Scripts -->es/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js"></script>
  <script src="assets/js/app.min.js"></script>ort-tables/dataTables.buttons.min.js"></script>
  <script src="assets/bundles/apexcharts/apexcharts.min.js"></script>h.min.js"></script>
  <script src="assets/js/page/index.js"></script>-tables/jszip.min.js"></script>
  <script src="assets/js/scripts.js"></script>ort-tables/pdfmake.min.js"></script>
  <script src="assets/js/custom.js"></script>port-tables/vfs_fonts.js"></script>
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
</html></html>