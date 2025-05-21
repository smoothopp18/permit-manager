<?php
require_once '../classes/application.php';
require_once '../classes/user.php';

// Ensure the user is logged in
if (!isset($_SESSION['user']) || !is_array($_SESSION['user'])) {
    header("Location: index.php"); // Redirect to login if user is not logged in
    exit();
}

$user = $_SESSION['user'];
$application = new Application();

// Ensure getAllApplications() always returns an array
$applications = $application->getAllApplications() ?? [];

// Filter applications to only include those with status "Pending"
$pendingApplications = array_filter($applications, function($app) {
    return isset($app['status']) && $app['status'] === 'Pending';
});
?>

<section class="section">
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
                          <?php foreach ($pendingApplications as $app) : ?>
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