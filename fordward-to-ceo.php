<?php
require_once 'classes/application.php';

$application = new Application();

// retrieving applications by logged in user
$applications = $application->getAllApplications();

// Only keep applications with VerificationStatus 'PaidVerified'
$applications = array_filter($applications, function ($app) {
    return isset($app['VerificationStatus']) && $app['VerificationStatus'] === 'PaidVerified';
});

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
<section class="section">
    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Verified Payments</h4>
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
                                        <th>Amount</th>
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
                                            <td><?php echo 'MWK ' . $application['amount']; ?></td>
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
<!-- General JS Scripts -->
<script src="assets/js/app.min.js"></script>
<script src="assets/bundles/datatables/datatables.min.js"></script>
<script src="assets/bundles/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js"></script>
<script src="assets/js/page/datatables.js"></script>
<script src="assets/js/scripts.js"></script>
<!-- JS Libraries -->
<script src="assets/bundles/apexcharts/apexcharts.min.js"></script>
<!-- Page Specific JS File -->
<script src="assets/js/page/index.js"></script>
<!-- Template JS File -->
<script src="assets/js/scripts.js"></script>
<!-- Custom JS File -->
<script src="assets/js/custom.js"></script>
<!-- Font Awesome JS File -->
<script src="https://kit.fontawesome.com/32c8b0ab14.js" crossorigin="anonymous"></script>
<!-- Bootstrap JS -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>