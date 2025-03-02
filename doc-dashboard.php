<?php

session_start();
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] != 'director_commerce') {
  header("Location: public/index.php");
  exit();
}

require_once 'classes/application.php';

$application = new Application();

// retrieving applications pending director review
$applications = $application->getAllApplications();

// Retrieve dynamic data for the cards
$newPayments = $application->getNewPaymentsCount();
$verifiedPayments = $application->getVerifiedPaymentsCount();
$failedPayments = $application->getFailedPaymentsCount();
$totalRevenue = $application->getTotalRevenue();

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
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <link rel='shortcut icon' type='image/x-icon' href='assets/img/favicon.png' />
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
          <!-- Add DOC Dashboard Indicator -->
          <li class="nav-item">
            <span class="nav-link" style="font-size: 1rem; font-weight: 600; color: #4CAF50;">DOC Dashboard</span>
          </li>
          <!-- Removed messages and profile from the top nav bar -->
        </ul>
      </nav>
      <div class="main-sidebar sidebar-style-2">
        <aside id="sidebar-wrapper">
          <div class="sidebar-brand">
            <a href="doc-dashboard.php"> <img alt="image" src="assets/img/logo.png" class="header-logo" /> <span class="logo-name">BCCCIS</span>
            </a>
          </div>
          <ul class="sidebar-menu">
            <li class="dropdown active">
              <a href="doc-dashboard.php" class="nav-link"><i class="fa-solid fa-tv"></i><span>Dashboard</span></a>
            </li>
            <li class="dropdown">
              <a href="payment-Verification.php" class="nav-link"><i class="fa-solid fa-history"></i><span>Payment History</span></a>
            </li>
            <li class="dropdown">
              <a href="fordward-to-ceo.php" class="nav-link" id="forward-to-ceo-link"><i class="fa-solid fa-share"></i><span>Verified Payments</span></a>
            </li>
            <li class="dropdown">
              <a href="reports.php" class="nav-link"><i class="fa-solid fa-chart-line"></i><span>Analytics</span></a>
            </li>
            <li class="menu-header">Settings</li>
            <li class="dropdown">
              <a href="profile.php" class="nav-link"><i class="fa-solid fa-user"></i><span>Profile</span></a>
            </li>
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
                        <h6 class="mb-0">New Payments</h6>
                        <span class="font-weight-bold mb-0 font-20"><?php echo $newPayments; ?></span>
                      </div>
                      <i class="fa-solid fa-wallet card-icon col-orange font-30 p-r-30"></i>
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
                        <h6 class="mb-0">Verified Payments</h6>
                        <span class="font-weight-bold mb-0 font-20"><?php echo $verifiedPayments; ?></span>
                      </div>
                      <i class="fa-solid fa-check-circle card-icon col-green font-30 p-r-30"></i>
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
                        <h6 class="mb-0">Failed Payments</h6>
                        <span class="font-weight-bold mb-0 font-20"><?php echo $failedPayments; ?></span>
                      </div>
                      <i class="fa-solid fa-times-circle card-icon col-red font-30 p-r-30"></i>
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
                        <span class="font-weight-bold mb-0 font-20">MWK<?php echo number_format($totalRevenue, 2); ?></span>
                      </div>
                      <i class="fa-solid fa-dollar-sign card-icon col-cyan font-30 p-r-30"></i>
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
                    <h4>Approved Business Applications</h4>
                  </div>
                  <div class="card-body">
                    <div class="table-responsive">
                      <table class="table table-striped" id="table-1">
                        <thead>
                          <tr>
                            <th>#</th>
                            <th>Business Name</th>
                            <th>Category</th>
                            <th>Owner</th>
                            <th>Application Date</th>
                            <th>Payment Status</th>
                            <th>Actions</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php $count = 0; ?>
                          <?php foreach ($applications as $application) : ?>
                            <?php if ($application['status'] == 'Approved') : ?>
                              <?php $count++; ?>
                              <tr>
                                <td><?php echo $count ?></td>
                                <td><?php echo $application['businessName']; ?></td>
                                <td><?php echo $application['businessType']; ?></td>
                                <td><?php echo $application['business_owner']; ?></td>
                                <td><?php echo $application['created_at']; ?></td>
                                <td>
                                  <?php if ($application['paymentStatus'] == 'Paid') { ?>
                                    <div class="badge badge-success">Paid</div>
                                  <?php } else { ?>
                                    <div class="badge badge-danger">Not Paid</div>
                                  <?php } ?>
                                </td>
                                <td>
                                  <div class="dropdown">
                                    <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                      Actions
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                      <a class="dropdown-item" href="public/application-controller.php?verify_payment=<?= $application['application_id']; ?>">Verify Payment</a>

                                    </div>
                                  </div>
                                </td>
                              </tr>
                            <?php endif; ?>
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
    <script src="assets/bundles/chartjs/chart.min.js"></script>
    <script src="assets/bundles/datatables/datatables.min.js"></script>
    <script src="assets/bundles/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js"></script>
    <script src="assets/js/page/datatables.js"></script>
    <script src="assets/js/scripts.js"></script>
    <script src="assets/js/custom.js"></script>
  </body>
</html>