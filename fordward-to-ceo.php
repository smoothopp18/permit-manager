<?php
require_once 'classes/application.php';

// Instantiate Application class and retrieve applications for the logged-in user
$application = new Application();
$applications = $application->getAllApplicationsDOC();

// Optional: Filter applications by application_id if provided via GET parameter
$application_id = isset($_GET['application_id']) ? $_GET['application_id'] : null;
if ($application_id) {
    $applications = array_filter($applications, function ($app) use ($application_id) {
        return $app['application_id'] == $application_id;
    });
}
?>

<head>
    <!-- Core CSS Files -->
    <link rel="stylesheet" href="assets/css/app.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/components.css">
    <link rel="stylesheet" href="assets/bundles/datatables/datatables.min.css">
    <link rel="stylesheet" href="assets/bundles/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="assets/css/custom.css">
    <link rel='shortcut icon' type='image/x-icon' href='assets/img/favicon.png' />
    <!-- jQuery (required for custom scripts) -->
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
                                        <th>Verification Status</th>
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
                                            <td>
                                                <div class="badge badge-info"><?php echo $application['verificationStatus']; ?></div>
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
<!-- Core JS Libraries -->
<script src="assets/js/app.min.js"></script>
<script src="assets/bundles/datatables/datatables.min.js"></script>
<script src="assets/bundles/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js"></script>
<script src="assets/js/page/datatables.js"></script>
<script src="assets/js/scripts.js"></script>
<script src="assets/js/custom.js"></script>
<script src="https://kit.fontawesome.com/32c8b0ab14.js" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>