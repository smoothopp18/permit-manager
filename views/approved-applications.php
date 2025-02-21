<?php
session_start(); // Ensure session is started before accessing session variables
require_once '../classes/application.php';
require_once '../classes/user.php';

// Ensure the user is logged in
if (!isset($_SESSION['user']) || !is_array($_SESSION['user'])) {
    header("Location: ../index.php"); // Redirect to login if user is not logged in
    exit();
}

$user = $_SESSION['user'];
$application = new Application();

// Ensure getAllApplications() always returns an array
$applications = $application->getAllApplications() ?? [];

// Filter applications to only include approved ones
$approvedApplications = array_filter($applications, function($app) {
    return $app['status'] === 'Approved';
});
?>
<section class="section">
    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Approved Businesses</h4>
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
                                    <?php foreach ($approvedApplications as $app) : ?>
                                        <?php $count++; ?>
                                        <tr>
                                            <td><?= $count ?></td>
                                            <td><?= htmlspecialchars($app['businessName'] ?? 'N/A') ?></td>
                                            <td><?= htmlspecialchars($app['businessType'] ?? 'N/A') ?></td>
                                            <td><?= htmlspecialchars($app['business_owner'] ?? 'N/A') ?></td>
                                            <td><?= htmlspecialchars($app['created_at'] ?? 'N/A') ?></td>
                                            <td>
                                                <div class="badge badge-success badge-shadow">
                                                    <?= htmlspecialchars($app['status'] ?? 'Pending') ?>
                                                </div>
                                            </td>
                                            <td>
                                                <a href="/views/eCertificate.php">View Certificate</a>
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
