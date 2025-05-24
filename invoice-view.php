<?php
require_once 'classes/invoice.php';
require_once 'classes/application.php';

$invoice = new Invoice();
$approvedApplications = $invoice->getApprovedApplications();
?>

<div id="wrapper"></div>
<section class="section">
  <div class="section-body">
    <form>
      <div class="invoice">
        <div class="invoice-print">
          <div class="row">
            <div class="col-lg-12">
               <div style="text-align:center; margin: 40px 0 20px 0;">
            <img 
              src="assets/img/logo.png" 
              alt="BCC Logo" 
              style="max-width: 210px; width: 45%; height: auto; display: inline-block; box-shadow: 0 8px 32px rgba(0,0,0,0.18); border-radius: 32px; background: #fff; padding: 16px;"
            />
            <h1 style="font-size: 2rem; font-weight: bold; color: #1a237e; margin-top: 18px; letter-spacing: 3px; text-shadow: 0 2px 8px rgba(26,35,126,0.08);">
              BLANTYRE CITY COUNCIL
            </h1>
          </div>
              <div class="invoice-title">
                <h2>Invoice</h2>
                <div class="invoice-number">Order #<?php echo rand(10000, 99999); ?></div>
              </div>
              <hr>
              <div class="col-md-6">
                <address>
                  <strong>Billed To:</strong><br>
                  <input type="text" name="business_owner" class="form-control" 
                         value="<?php echo !empty($approvedApplications) ? htmlspecialchars($approvedApplications[0]['business_owner']) : ''; ?>" required><br>

                  <input type="text" name="business_name" class="form-control" 
                         value="<?php echo !empty($approvedApplications) ? htmlspecialchars($approvedApplications[0]['businessName']) : ''; ?>" required><br>

                  <!-- Hidden or visible email input -->
                  <input type="email" name="customer_email" class="form-control" placeholder="Email" 
                         value="<?php echo !empty($approvedApplications) ? htmlspecialchars($approvedApplications[0]['email']) : ''; ?>" required><br>

                  <strong>Order Date:</strong><br>
                  <input type="text" name="order_date" class="form-control" 
                         value="<?php echo date('F d, Y'); ?>" readonly>
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
                    $total = $app['amount'] * 1;
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

            <button type="button" class="btn btn-primary btn-icon icon-left" onClick="makePayment()">
              <i class="fas fa-credit-card"></i> Process Payment
            </button>
          </div>

          <button type="button" class="btn btn-danger btn-icon icon-left">
            <i class="fas fa-times"></i> Cancel
          </button>

          <button type="button" class="btn btn-warning btn-icon icon-left" onclick="window.print()">
            <i class="fas fa-print"></i> Print
          </button>
        </div>
      </div>
    </form>
  </div>
</section>

<!-- PAYMENT SCRIPT -->
<script>
  function makePayment() {
    const businessOwnerInput = document.querySelector('input[name="business_owner"]');
    const businessNameInput = document.querySelector('input[name="business_name"]');
    const emailInput = document.querySelector('input[name="customer_email"]');
    const amountElement = document.querySelector('.invoice-detail-value-lg');

    if (!businessOwnerInput || !businessNameInput || !amountElement || !emailInput) {
      alert("Missing invoice or customer information.");
      return;
    }

    const businessOwner = businessOwnerInput.value.trim();
    const businessName = businessNameInput.value.trim();
    const email = emailInput.value.trim();
    const amountText = amountElement.textContent.replace(/[^\d.]/g, '');
    const amount = parseFloat(amountText);

    if (isNaN(amount)) {
      alert("Invalid amount.");
      return;
    }

    const [firstName = "FirstName", lastName = "LastName"] = businessOwner.split(' ');

    PaychanguCheckout({
      "public_key": "pub-test-Kwolf1IlIvNgIiSDNO0yIm2jmkOBy0bO",
      "tx_ref": 'TX-' + Date.now(),
      "amount": amount,
      "currency": "MWK",
      "callback_url": "http://localhost/permit-manager/paymentSuccessful.php?application_id=" + document.querySelector('input[name="application_id"]').value,
      "return_url": "http://localhost/permit-manager/invoice-view.php",
      "customer": {
        "email": email,
        "first_name": firstName,
        "last_name": lastName,
      },
      "customization": {
        "title": "Invoice Payment",
        "description": `Payment for ${businessName}`,
      },
      "meta": {
        "uuid": "uuid",
        "response": "Response"
      }
    });
  }
</script>
