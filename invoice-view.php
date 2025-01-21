<?php
require_once 'classes/invoice.php';
require_once 'classes/application.php';
$invoice = new Invoice();
$approvedApplications = $invoice->getApprovedApplications();
?>

<section class="section">
  <div class="section-body">
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
                <?php
                if (!empty($approvedApplications)) {
                  echo $approvedApplications[0]['business_owner'] . '<br>';
                  echo $approvedApplications[0]['businessName'] . '<br>';
                } else {
                  echo "No approved applications found.<br>";
                }
                ?>
                <strong>Order Date:</strong><br>
                <?php echo date('F d, Y'); ?>
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
                  $total = $app['price'] * 1;  // Assuming quantity = 1 for all
                  $subtotal += $total;
                ?>
                  <tr>
                    <td><?php echo $app['businessName']; ?></td>
                    <td><?php echo $app['businessType']; ?></td>
                    <td class="text-center"><?php echo number_format($app['price'], 2); ?> MWK</td>
                    <td class="text-center">1</td>
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
          <a href="#"><button class="btn btn-primary btn-icon icon-left"><i class="fas fa-credit-card"></i> Process Payment</button></a>
          <a href="#"><button class="btn btn-danger btn-icon icon-left"><i class="fas fa-times"></i> Cancel</button></a>
        </div>
        <button class="btn btn-warning btn-icon icon-left" onclick="window.print()"><i class="fas fa-print"></i> Print</button>
      </div>
    </div>
  </div>
</section>