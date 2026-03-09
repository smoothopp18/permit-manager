<?php
require_once 'classes/application.php';
$app = new Application();
// You should implement these methods or queries in your Application class or elsewhere
$allApplications = $app->getAllApplications(); 
$allPayments = $app->getAllPayments(); // You may need to create this method
$recentActivities = $app->getRecentActivities(); // You may need to create this method
$approvedThisWeek = $app->getApprovedThisWeekCount();
$rejectedCount = $app->getRejectedCount();
$successfulPayments = $app->getSuccessfulPaymentsCount();
$certifiedBusinesses = $app->getCertifiedBusinessesCount();
$revokedBusinesses = $app->getRevokedBusinessesCount();
?>

<section class="section">
  <div class="section-body">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h4>Weekly Summary Report</h4>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-striped table-hover" id="tableExport-applications" style="width:100%;">
                <thead>
                  <tr>
                    <th>Approved This Week</th>
                    <th>Rejected</th>
                    <th>Successful Payments</th>
                    <th>Certified Businesses</th>
                    <th>Revoked Businesses</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td><?= $approvedThisWeek ?></td>
                    <td><?= $rejectedCount ?></td>
                    <td><?= $successfulPayments ?></td>
                    <td><?= $certifiedBusinesses ?></td>
                    <td><?= $revokedBusinesses ?></td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- All Applications Table -->
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h4>All Applications Report</h4>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-striped table-hover" id="tableExport-applications" style="width:100%;">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Business Owner</th>
                    <th>Business Name</th>
                    <th>Business Type</th>
                    <th>Business Address</th>
                    <th>Date Applied</th>
                    <th>Status</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $count = 0; foreach ($allApplications as $app): $count++; ?>
                  <tr>
                    <td><?= $count ?></td>
                    <td><?= htmlspecialchars($app['business_owner'] ?? 'N/A') ?></td>
                    <td><?= htmlspecialchars($app['businessName'] ?? 'N/A') ?></td>
                    <td><?= htmlspecialchars($app['businessType'] ?? 'N/A') ?></td>
                    <td><?= htmlspecialchars($app['businessAddress'] ?? 'N/A') ?></td>
                    <td><?= htmlspecialchars($app['created_at'] ?? 'N/A') ?></td>
                    <td>
                      <div class="badge badge-<?= 
                        $app['status'] === 'Approved' ? 'success' : 
                        ($app['status'] === 'Rejected' ? 'danger' : 'primary') 
                      ?> badge-shadow">
                        <?= htmlspecialchars($app['status'] ?? 'Pending') ?>
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

    <!-- All Payments Table -->
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h4>All Payments Report</h4>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-striped table-hover" id="tableExport-payments" style="width:100%;">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Payer</th>
                    <th>Business</th>
                    <th>Amount</th>
                    <th>Date</th>
                    <th>Status</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $count = 0; foreach ($allPayments as $payment): $count++; ?>
                  <tr>
                    <td><?= $count ?></td>
                    <td><?= htmlspecialchars($payment['payer'] ?? 'N/A') ?></td>
                    <td><?= htmlspecialchars($payment['businessName'] ?? 'N/A') ?></td>
                    <td>MWK<?= htmlspecialchars(number_format($payment['amount'], 2)) ?></td>
                    <td><?= htmlspecialchars($payment['date'] ?? 'N/A') ?></td>
                    <td>
                      <div class="badge badge-<?= 
                        $payment['status'] === 'Completed' ? 'success' : 
                        ($payment['status'] === 'Failed' ? 'danger' : 'warning') 
                      ?> badge-shadow">
                        <?= htmlspecialchars($payment['status'] ?? 'Pending') ?>
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

    <!-- Recent Activities Table -->
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h4>Recent Activities Report</h4>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-striped table-hover" id="tableExport-activities" style="width:100%;">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Activity</th>
                    <th>User</th>
                    <th>Date</th>
                    <th>Details</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $count = 0; foreach ($recentActivities as $activity): $count++; ?>
                  <tr>
                    <td><?= $count ?></td>
                    <td><?= htmlspecialchars($activity['action'] ?? 'N/A') ?></td>
                    <td><?= htmlspecialchars($activity['user'] ?? 'N/A') ?></td>
                    <td><?= htmlspecialchars($activity['date'] ?? 'N/A') ?></td>
                    <td><?= htmlspecialchars($activity['details'] ?? '') ?></td>
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
<!-- Page Specific JS File -->
<script src="assets/bundles/datatables/datatables.min.js"></script>
<script src="assets/bundles/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js"></script>
<script src="assets/bundles/datatables/export-tables/dataTables.buttons.min.js"></script>
<script src="assets/bundles/datatables/export-tables/buttons.flash.min.js"></script>
<script src="assets/bundles/datatables/export-tables/jszip.min.js"></script>
<script src="assets/bundles/datatables/export-tables/pdfmake.min.js"></script>
<script src="assets/bundles/datatables/export-tables/vfs_fonts.js"></script>
<script src="assets/bundles/datatables/export-tables/buttons.print.min.js"></script>
<script>
  $(document).ready(function() {
    // Helper function to safely (re)initialize DataTables
    function initOrReinitDataTable(selector) {
      if ($.fn.DataTable.isDataTable(selector)) {
        $(selector).DataTable().destroy(); // Only destroy, don't clear
      }
      $(selector).DataTable({
        dom: 'Bfrtip',
        buttons: ['copy', 'csv', 'excel', 'pdf', 'print']
      });
    }

    initOrReinitDataTable('#tableExport-applications');
    initOrReinitDataTable('#tableExport-payments'); 
    initOrReinitDataTable('#tableExport-activities');
  });
</script>