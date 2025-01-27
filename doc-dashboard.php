<?php
require_once 'classes/application.php';

$application = new Application();

// retrieving applications pending director review
$applications = $application->getAllApplications();

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
</head>

<body>
  <div class="loader"></div>
  <div id="app">
    <div class="main-wrapper main-wrapper-1">
      <div class="navbar-bg"></div>
      
      <div class="main-sidebar sidebar-style-2">
        <aside id="sidebar-wrapper">
          <div class="sidebar-brand">
            <a href="director-dashboard.php"> <img alt="image" src="assets/img/logo.png" class="header-logo" /> <span class="logo-name">BCCCIS</span>
            </a>
          </div>
          <ul class="sidebar-menu">
            <li class="dropdown active">
              <a href="doc-dashboard.php" class="#"><i data-feather="monitor"></i><span>Dashboard</span></a>
            </li>
            <li class="dropdown">
              <a href="doc-dashboard.php" class="nav-link"><i class="fa-solid fa-check-circle"></i><span>Payment Verification</span></a>
            </li>
            <li class="dropdown">
              <a href="forward-applications.php" class="nav-link"><i class="fa-solid fa-share"></i><span>Forward to CEO</span></a>
            </li>
            <li class="dropdown">
              <a href="reports.php" class="nav-link"><i class="fa-solid fa-chart-line"></i><span>Reports</span></a>
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
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h4>Application Payments</h4>
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
                            <th>Status</th>
                            <th>Payment Status</th>
                            <th>Actions</th>
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
                              <td>
                                <?php if ($application['status'] == 'Pending Director Approval') { ?>
                                  <div class="badge badge-warning badge-shadow">Pending Review</div>
                                <?php } else if ($application['status'] == 'Approved') { ?>
                                  <div class="badge badge-success badge-shadow">Approved</div>
                                <?php } ?>
                              </td>
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
                                    <a class="dropdown-item" href="application-documents.php?application_id=<?= $application['application_id']; ?>">View</a>
                                    <a class="dropdown-item" href="approve-application.php?application_id=<?= $application['application_id']; ?>">Approve</a>
                                    <a class="dropdown-item" href="reject-application.php?application_id=<?= $application['application_id']; ?>">Reject</a>
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
      </div>
    </div>
    <!-- General JS Scripts -->
    <script src="assets/js/app.min.js"></script>
    <script src="assets/bundles/datatables/datatables.min.js"></script>
    <script src="assets/bundles/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js"></script>
    <script src="assets/js/page/datatables.js"></script>
    <script src="assets/js/scripts.js"></script>
</body>

</html>
