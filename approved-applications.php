<?php
require_once 'classes/application.php';
require_once 'classes/user.php';

// Verify user authentication
if (!isset($_SESSION['user']) || !is_array($_SESSION['user'])) {
    header("Location: index.php");
    exit();
}

$user = $_SESSION['user'];
$application = new Application();

// Fetch all approved business applications
$approvedApplications = $application->getApprovedApplications() ?? [];
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