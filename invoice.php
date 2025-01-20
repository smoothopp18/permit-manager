<?php
require_once 'classes/application.php';
require_once 'classes/user.php';

$user = new User();
$application = new Application();
// retrieving applications by logged in user
$applications = $application->getUserApplications();

?>
<style>
  .sticky-nav {
    position: -webkit-sticky; /* For Safari */
    position: sticky;
    top: 0;
    background-color: #333;
    z-index: 1000;
  }
</style>
<!-- Main Content -->
<section class="section">
  <div class="section-body sticky-nav">
    <div class="invoice">
      <div class="invoice-print">
        <div class="row">
          <div class="col-lg-12">
            <div class="invoice-title">
              <h2>Invoice</h2>
              <div class="invoice-number">Order #<?php echo $applications[0]['status'] == 'approved' ? $applications[0]['application_id'] : 'null'; ?></div>
            </div>
            <hr>
            <div class="row">
              <div class="col-md-6">
                <address>
                  <strong>Billed To:</strong><br>
                  <?php echo $_SESSION['user']['fullname']; ?><br>
                  <?php echo $applications[0]['status'] == 'approved' ? $applications[0]['businessName'] : 'null'; ?><br>
                  <?php echo $applications[0]['status'] == 'approved' ? $applications[0]['businessAddress'] : 'null'; ?><br>
                </address>
              </div>
            </div>
          </div>
        </div>
        <div class="row mt-4">
          <div class="col-md-12">
            <div class="section-title">Order Summary</div>
            <p class="section-lead">All items here cannot be deleted.</p>
            <div class="table-responsive">
              <table class="table table-striped table-hover table-md">
                <tr>
                  <th data-width="40">#</th>
                  <th>Item</th>
                  <th class="text-center">Price</th>
                  <th class="text-center">Quantity</th>
                  <th class="text-right">Totals</th>
                </tr>
                <?php foreach ($applications as $index => $application) { ?>
                <tr>
                  <td><?php echo $index + 1; ?></td>
                  <td><?php echo $application['status'] == 'approved' ? $application['businessType'] : 'null'; ?></td>
                  <td class="text-center"><?php echo $application['status'] == 'approved' ? 'K100.00' : 'null'; ?></td>
                  <td class="text-center"><?php echo $application['status'] == 'approved' ? '1' : 'null'; ?></td>
                  <td class="text-right"><?php echo $application['status'] == 'approved' ? 'K100.00' : 'null'; ?></td>
                </tr>
                <?php } ?>
              </table>
            </div>
            <div class="row mt-4">
              <div class="col-lg-8">
                
              </div>
              <div class="col-lg-4 text-right">
                <hr class="mt-2 mb-2">
                <div class="invoice-detail-item">
                  <div class="invoice-detail-name">Total</div>
                  <div class="invoice-detail-value invoice-detail-value-lg">K<?php echo array_reduce($applications, function($carry, $application) {
                    return $carry + ($application['status'] == 'approved' ? 100 : 0);
                  }, 0); ?>.00</div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <hr>
      <div class="text-md-right">
        <div class="float-lg-left mb-lg-0 mb-3">
          <button class="btn btn-primary btn-icon icon-left" <?php echo $applications[0]['status'] != 'approved' ? 'disabled' : ''; ?>><i class="fas fa-credit-card"></i> Process Payment</button>
          <button class="btn btn-danger btn-icon icon-left"><i class="fas fa-times"></i> Cancel</button>
       </div>
        <button class="btn btn-warning btn-icon icon-left"><i class="fas fa-print"></i> Print</button>
      </div>
    </div>
  </div>
</section>