<?php
// Include the Application class and retrieve all application payment records
require_once 'classes/application.php';
$app = new Application();
$recentPayments = $app->getAllApplications();
?>
<section class="section">
  <div class="section-body">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h4>Recent Payments Report</h4>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-striped table-hover" id="tableExport" style="width:100%;">
                <thead>
                  <tr>
                    <th>Business Owner</th>
                    <th>Business Name</th>
                    <th>Business Type</th>
                    <th>Business Address</th>
                    <th>Amount</th>
                    <th>Verification Status</th>
                    <th>Certificate Status</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($recentPayments as $payment): ?>
                    <tr>
                      <td><?php echo htmlspecialchars($payment['business_owner']); ?></td>
                      <td><?php echo htmlspecialchars($payment['businessName']); ?></td>
                      <td><?php echo htmlspecialchars($payment['businessType']); ?></td>
                      <td><?php echo htmlspecialchars($payment['businessAddress']); ?></td>
                      <td><?php echo htmlspecialchars($payment['amount']); ?></td>
                      <td><?php echo htmlspecialchars($payment['verificationStatus']); ?></td>
                      <td><?php echo htmlspecialchars($payment['certificateStatus']); ?></td>
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
<!-- DataTables and export functionality scripts -->
<script src="assets/bundles/datatables/datatables.min.js"></script>
<script src="assets/bundles/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js"></script>
<script src="assets/bundles/datatables/export-tables/dataTables.buttons.min.js"></script>
<script src="assets/bundles/datatables/export-tables/buttons.flash.min.js"></script>
<script src="assets/bundles/datatables/export-tables/jszip.min.js"></script>
<script src="assets/bundles/datatables/export-tables/pdfmake.min.js"></script>
<script src="assets/bundles/datatables/export-tables/vfs_fonts.js"></script>
<script src="assets/bundles/datatables/export-tables/buttons.print.min.js"></script>
<script src="assets/js/page/datatables.js"></script>