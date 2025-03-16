<?php
require_once 'classes/invoice.php';
require_once 'classes/application.php';

$invoice = new Invoice();
$approvedApplications = $invoice->getApprovedApplications();
?>

<section class="section">
  <div class="section-body">
    <form action="process_invoice.php" method="POST">
      <div class="invoice">
        <div class="invoice-print">
          <div class="row">
            <div class="col-lg-12">
              <div class="invoice-title">
                <h2>Invoice</h2>
                <div class="invoice-number">Order #<?php echo rand(10000, 99999); ?></div>
              </div>
              <hr>
              <div class="col-md-6">
                <address>
                  <strong>Billed To:</strong><br>
                  <input type="text" name="business_owner" class="form-control" value="<?php echo !empty($approvedApplications) ? htmlspecialchars($approvedApplications[0]['business_owner']) : ''; ?>" required><br>
                  <input type="text" name="business_name" class="form-control" value="<?php echo !empty($approvedApplications) ? htmlspecialchars($approvedApplications[0]['businessName']) : ''; ?>" required><br>
                  <strong>Order Date:</strong><br>
                  <input type="text" name="order_date" class="form-control" value="<?php echo date('F d, Y'); ?>" readonly>
                </address>
              </div>
            </div>
          </div>
          <div class="row mt-4">
            <div class="col-md-12">
              <div class="section-title">Summary</div>
              <p class="section-lead">All items here cannot be deleted.</p>
              <div class="table-responsive">
                <table class="table table-striped table-hover table-md">
                  <tr>
                    <th class="text-left">Business Name</th>
                    <th>Category</th>
                    <th class="text-center">Price</th>
                    <th class="text-center">Quantity</th>
                    <th class="text-right">Totals</th>
                  </tr>
                  <?php
                  $subtotal = 0;
                  foreach ($approvedApplications as $app):
                    $total = $app['amount'] * 1;  // Assuming quantity = 1 for all
                    $subtotal += $total;
                  ?>
                    <tr>
                      <td><?php echo htmlspecialchars($app['businessName']); ?></td>
                      <td><?php echo htmlspecialchars($app['businessType']); ?></td>
                      <td class="text-center"><?php echo number_format($app['amount'], 2); ?> MWK</td>
                      <td class="text-center"><input type="number" name="quantities[]" class="form-control text-center" value="1" readonly></td>
                      <td class="text-right"><?php echo number_format($total, 2); ?> MWK</td>
                    </tr>
                  <?php endforeach; ?>
                </table>
              </div>
              <div class="row">
                <div class="col-lg-4 offset-lg-8 text-right">
                  <div class="invoice-detail-item">
                    <div class="invoice-detail-name">Subtotal</div>
                    <div class="invoice-detail-value"><?php echo number_format($subtotal, 2); ?> MWK</div>
                  </div>
                  <div class="invoice-detail-item">
                    <div class="invoice-detail-value">0.00 MWK</div>
                  </div>
                  <hr class="mt-2 mb-2">
                  <div class="invoice-detail-item">
                    <div class="invoice-detail-name">Total</div>
                    <div class="invoice-detail-value invoice-detail-value-lg"><?php echo number_format($subtotal, 2); ?> MWK</div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <hr>
        <div class="text-md-right">
          <div class="float-lg-left mb-lg-0 mb-3">
            <input type="hidden" name="application_id" value="<?php echo $approvedApplications[0]['application_id']; ?>">
            <input type="hidden" name="businessType" value="<?php echo $approvedApplications[0]['businessType']; ?>">
            <button type="submit" class="btn btn-primary btn-icon icon-left"><i class="fas fa-credit-card"></i> Process Payment</button>
          </div>
          <button type="button" class="btn btn-danger btn-icon icon-left"><i class="fas fa-times"></i> Cancel</button>
          <button type="button" class="btn btn-warning btn-icon icon-left" onclick="window.print()"><i class="fas fa-print"></i> Print</button>
        </div>
      </div>
    </form>
  </div>
</section>
