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
        <div class="themePicker">
          <div class="selectgroup layout-color w-50">
            <label class="#">
              <input type="radio" name="value" value="1" class="selectgroup-input-radio select-layout" checked>
              <span class="selectgroup-button"><i class="fa-regular fa-sun"></i></span>
            </label>
            <label class="#">
              <input type="radio" name="value" value="2" class="selectgroup-input-radio select-layout">
              <span class="selectgroup-button"><i class="fa-solid fa-moon"></i></span>
            </label>
          </div>
        </div>
      </nav>
      <div class="main-sidebar sidebar-style-2">
        <aside id="sidebar-wrapper">
          <div class="sidebar-brand">
            <a href="user-dashboard.php"> <img alt="image" src="assets/img/logo.png" class="header-logo" /> <span class="logo-name">BCCCIS</span>
            </a>
          </div>
          <ul class="sidebar-menu">
            <li class="dropdown">
              <a href="#" class="#"><i data-feather="monitor"></i><span>Dashboard</span></a>
            </li>
            <li class="dropdown">
              <a href="applyform.php" class="nav-link"><i class="fa-regular fa-square-plus"></i><span>New Applications</span></a>
            </li>
            <li class="dropdown">
              <a href="invoices.html" class="nav-link"><i class="fa-solid fa-file-invoice-dollar"></i><span>Invoices</span></a>
            </li>

            <li class="menu-header">Certificates</li>
            <li class="dropdown active">
              <a href="certificates.php" class="nav-link"><i class="fa-solid fa-file-contract"></i><span>Certificates</span></a>
            </li>
            <li class="dropdown">
              <a href="analytics.html" class="nav-link"><i class="fa-solid fa-chart-line"></i><span>Analytics</span></a>
            </li>

            <li class="menu-header">Support</li>
            <li class="dropdown">
              <a href="request.html" class="nav-link"><i class="fa-solid fa-hand"></i><span>Request</span></a>
            </li>
            <li class="dropdown">
              <a href="faq.html" class="nav-link"><i class="fa-solid fa-question"></i><span>FAQ</span></a>
            </li>
            <li class="dropdown">
              <a href="faq.html" class="nav-link"><i class="fa-solid fa-user"></i><span>Profile</span></a>
            </li>
          </ul>

        </aside>
      </div>
      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-body">
            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h4>My Business Certificates</h4>
                  </div>
                  <div class="card-body">
                    <div class="table-responsive">
                      <table class="table table-striped table-hover" id="tableExport" style="width:100%;">
                        <thead>
                          <tr>
                            <th>Name</th>
                            <th>Category</th>
                            <th>Issue Date</th>
                            <th>Status</th>
                            <th>Expiry Date</th>
                            <th>Certificate Fee</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td>Pumani Lodge</td>
                            <td>Lodge & Accomodation</td>
                            <td>15/05/2025</td>
                            <td>Approved</td>
                            <td>15/05/2026</td>
                            <td>MWK320,800.00</td>
                          </tr>
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
    <script src="assets/bundles/datatables/export-ttables/pdfmake.min.js"></script>
    <script src="assets/bundles/datatables/export-tables/vfs_fonts.js"></script>
    <script src="assets/bundles/datatables/export-tables/buttons.print.min.js"></script>

    <script src="assets/js/page/datatables.js"></script>

    <!-- General JS Scripts -->

</body>

</html>