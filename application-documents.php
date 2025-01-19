<?php
require_once 'classes/application.php';

$application = new Application();

// retrieving applications by logged in user
$applications = $application->getAllApplications();

// Filter applications by application_id if provided
$application_id = isset($_GET['application_id']) ? $_GET['application_id'] : null;
if ($application_id) {
  $applications = array_filter($applications, function ($app) use ($application_id) {
    return $app['application_id'] == $application_id;
  });
}

?>
<section class="section">
  <div class="section-body">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h4>Application Details & Documents</h4>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-striped" id="table-1">
                <thead>
                  <tr>
                    <th>
                      #
                    </th>
                    <th>Business Name</th>
                    <th>Business Category</th>
                    <th>National ID</th>
                    <th>Health Report</th>
                    <th>Tax Clearence</th>
                    <th>Action</th>
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
                      <td><?php echo $application['nationalIdFile']; ?></td>
                      <td><?php echo $application['healthReportFile']; ?></td>
                      <td><?php echo $application['taxClearanceFile']; ?></td>

                      <td>
                        <div class="dropdown">
                          <button class="btn btn-primary dropdown-toggle" type="button" id="actionMenu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Action
                          </button>
                          <div class="dropdown-menu" aria-labelledby="actionMenu">
                            <a class="dropdown-item" href="public/application-controller.php?approve_id=<?= $application['application_id']; ?>">Approve</a>
                            <a class="dropdown-item view-documents" id="viewDocs" href="application-documents.php?application_id=<?= $application['application_id']; ?>">View Documents</a>
                            <a class="dropdown-item" href="public/application-controller.php?reject_id=<?= $application['application_id']; ?>">Reject</a>
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