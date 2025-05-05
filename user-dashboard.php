<?php
require_once 'classes/session.php';
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] != 'business_owner') {
    header("Location:index.php");
    exit();
}

require_once 'classes/application.php';

$application = new Application();

// retrieving applications by logged in user
$applications = $application->getUserApplications();

// Calculate dynamic data for cards
$newApplicationsCount = count($applications);
$approvedApplicationsCount = count(array_filter($applications, function($app) {
    return $app['status'] == 'approved';
}));
$rejectedApplicationsCount = count(array_filter($applications, function($app) {
    return $app['status'] == 'rejected';
}));
$certificateCount = count(array_filter($applications, function($app) {
    return $app['status'] == 'certificate_issued';
}));

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
  <script src="https://in.paychangu.com/js/popup.js" defer></script>
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
          <!-- Add User Dashboard Indicator -->
          <li class="nav-item">
            <span class="nav-link" style="font-size: 1rem; font-weight: 600; color: #4CAF50;">USER Dashboard</span>
          </li>
          <!-- Removed messages and profile from the top nav bar -->
        </ul>
      </nav>
      <div class="main-sidebar sidebar-style-2">
        <aside id="sidebar-wrapper">
          <div class="sidebar-brand">
            <a href="user-dashboard.php"> <img alt="image" src="assets/img/logo.png" class="header-logo" /> <span class="logo-name">BCCCIS</span>
            </a>
          </div>
          <ul class="sidebar-menu">
            <li class="dropdown">
              <a href="user-dashboard.php" class="dropdown active"><i data-feather="monitor"></i><span>Dashboard</span></a>
            </li>
            <li class="dropdown">
              <a href="applyform.php" class="nav-link"><i class="fa-regular fa-square-plus"></i><span>New Application</span></a>
            </li>
            <li class="dropdown">
              <a href="invoice-view.php" class="nav-link"><i class="fa-solid fa-file-invoice-dollar"></i><span>Invoices</span></a>
            </li>

            <li class="menu-header">Certificates</li>
            <li class="dropdown">
              <!-- Remove the Analytics link -->
              <!-- <a href="analytics.php" class="nav-link"><i class="fa-solid fa-chart-line"></i><span>Analytics</span></a> -->
            </li>
            <li class="dropdown">
              <a href="my-certificates.php" class="nav-link"><i class="fa-solid fa-award"></i><span>My Certificates</span></a>
            </li>

            <li class="menu-header">Support</li>
            <li class="dropdown">
              <a href="request.html" class="nav-link"><i class="fa-solid fa-hand"></i><span>Request</span></a>
            </li>
            <li class="dropdown">
              <a href="faq.html" class="nav-link"><i class="fa-solid fa-question"></i><span>FAQ</span></a>
            </li>
            <li class="dropdown">
              <a href="profile.php" class="nav-link"><i class="fa-solid fa-user"></i><span>Profile</span></a>
            </li>
          </ul>

        </aside>
      </div>
      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-body">
          <div class="row ">
              <div class="col-xl-3 col-lg-6">
                <div class="card l-bg-green">
                  <div class="card-statistic-3">
                    <div class="card-icon card-icon-large"><i class="fa fa-award" style="font-size: 2.5rem;"></i></div>
                    <div class="card-content">
                      <h4 class="card-title">New Applications</h4>
                      <span><?php echo $newApplicationsCount; ?></span>
                      <div class="progress mt-1 mb-1" data-height="8">
                        <div class="progress-bar l-bg-purple" role="progressbar" data-width="25%" aria-valuenow="25"
                          aria-valuemin="0" aria-valuemax="100"></div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-xl-3 col-lg-6">
                <div class="card l-bg-cyan">
                  <div class="card-statistic-3">
                    <div class="card-icon card-icon-large"><i class="fa fa-briefcase" style="font-size: 2.5rem;"></i></div>
                    <div class="card-content">
                      <h4 class="card-title">Approved Applications</h4>
                      <span><?php echo $approvedApplicationsCount; ?></span>
                      <div class="progress mt-1 mb-1" data-height="8">
                        <div class="progress-bar l-bg-orange" role="progressbar" data-width="25%" aria-valuenow="25"
                          aria-valuemin="0" aria-valuemax="100"></div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-xl-3 col-lg-6">
                <div class="card l-bg-purple">
                  <div class="card-statistic-3">
                    <div class="card-icon card-icon-large"><i class="fa fa-globe" style="font-size: 2.5rem;"></i></div>
                    <div class="card-content">
                      <h4 class="card-title">Rejected Applications</h4>
                      <span><?php echo $rejectedApplicationsCount; ?></span>
                      <div class="progress mt-1 mb-1" data-height="8">
                        <div class="progress-bar l-bg-cyan" role="progressbar" data-width="25%" aria-valuenow="25"
                          aria-valuemin="0" aria-valuemax="100"></div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-xl-3 col-lg-6">
                <div class="card l-bg-orange">
                  <div class="card-statistic-3">
                    <div class="card-icon card-icon-large"><i class="fa fa-money-bill-alt" style="font-size: 2.5rem;"></i></div>
                    <div class="card-content">
                      <h4 class="card-title">Certificates</h4>
                      <span><?php echo $certificateCount; ?></span>
                      <div class="progress mt-1 mb-1" data-height="8">
                        <div class="progress-bar l-bg-green" role="progressbar" data-width="25%" aria-valuenow="25"
                          aria-valuemin="0" aria-valuemax="100"></div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h4>My Business Applications</h4>
                  </div>
                  <div class="card-body">
                    <div class="table-responsive">
                      <table class="table table-striped table-hover" id="tableExport" style="width:100%;">
                        <thead>
                          <tr>
                            <th>Business Name</th>
                            <th>Category</th>
                            <th>Created At</th>
                            <th>Issue Date</th>
                            <th>Application Status</th>
                            <th>Expiry Date</th>
                            <th>Certificate Fee</th>
                          </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($applications as $application) : ?>
                            <tr>
                              <td><?php echo $application['businessName']; ?></td>
                              <td><?php echo $application['businessType']; ?></td>
                              <td><?php echo $application['created_at']; ?></td>
                              <td><?php echo $application['issueDate']; ?></td>
                              <td><?php echo $application['status']; ?></td>
                              <td><?php echo $application['expiryDate']; ?></td>
                              <td><?php echo $application['amount']; ?></td>
                            </tr>
                            <?php endforeach;?>
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
    <!-- Custom JS File -->
    <script src="assets/js/custom.js"></script>
    <!-- JQuery JS CDN -->
    <script src="assets/bundles/datatables/datatables.min.js"></script>
    <script src="assets/bundles/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js"></script>
    <script src="assets/bundles/datatables/export-tables/dataTables.buttons.min.js"></script>
    <script src="assets/bundles/datatables/export-tables/buttons.flash.min.js"></script>
    <script src="assets/bundles/datatables/export-tables/jszip.min.js"></script>
    <script src="assets/bundles/datatables/export-tables/pdfmake.min.js"></script>
    <script src="assets/bundles/datatables/export-tables/vfs_fonts.js"></script>
    <!-- Remove the print button script -->
    <!-- <script src="assets/bundles/datatables/export-tables/buttons.print.min.js"></script> -->
    <script src="https://in.paychangu.com/js/popup.js"></script>

    <script src="assets/js/page/datatables.js"></script>
    <script>
      function makePayment(){
      PaychanguCheckout({
        "public_key": "pub-test-Dtj5mdn97klCKcpJckzLC8xD16e4DPkr",
        "tx_ref": '' + Math.floor((Math.random() * 1000000000) + 1),
        "amount": 1000,
        "currency": "MWK",
        "callback_url": "https://example.com/callbackurl",
        "return_url": "https://example.com/returnurl",
        "customer":{
          "email": "yourmail@example.com",
          "first_name":"Mac",
          "last_name":"Phiri",
        },
        "customization": {
          "title": "Test Payment",
          "description": "Payment Description",
        },
        "meta": {
          "uuid": "uuid",
          "response": "Response"
        }
      });
    }
    </script>
</body>

</html>