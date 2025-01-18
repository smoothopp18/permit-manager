<section class="section">
  <div class="section-body">
    <div class="row clearfix">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
          <div class="card-header">
            <h4>Business Certificate Application</h4>
          </div>
          <div class="card-body">
            <form id="businessCertificateForm" method="post" action=".../../public/application-controller.php">
              <div id="wizard_horizontal">
                <!-- Step 1: Business Owner Information -->
                <h2>Business Owner Information</h2>
                <section>
                  <div class="card">
                    <div class="card-body">
                      <div class="form-row">
                        <div class="form-group col-md-6">
                          <label for="fullName"><i class="fas fa-user"></i> Full Name</label>
                          <input type="text" class="form-control" id="fullName" name="fullName" placeholder="Full Name" required>
                        </div>
                        <div class="form-group col-md-6">
                          <label for="nationalId"><i class="fas fa-id-card"></i> National ID Number</label>
                          <input type="text" class="form-control" id="nationalId" name="nationalId" placeholder="National ID Number" required>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="businessName"><i class="fas fa-building"></i> Business Name</label>
                        <input type="text" class="form-control" id="businessName" name="businessName" placeholder="Business Name" required>
                      </div>
                      <div class="form-group">
                        <label for="businessType"><i class="fas fa-briefcase"></i> Business Type/Category</label>
                        <select id="businessType" name="businessType" class="form-control" required>
                          <option value="">Choose...</option>
                          <option>Business Premises Licence</option>
                          <option>Food Licence</option>
                          <option>Opaque Beer Licence</option>
                          <option>Liquor Licence</option>
                        </select>
                      </div>
                      <div class="form-group">
                        <label for="businessAddress"><i class="fas fa-map-marker-alt"></i> Business Physical Address</label>
                        <input type="text" class="form-control" id="businessAddress" name="businessAddress" placeholder="Business Physical Address" required>
                      </div>
                      <div class="form-group">
                        <label for="taxCertificate"><i class="fas fa-file-alt"></i> Tax Clearance Certificate Number</label>
                        <input type="text" class="form-control" id="taxCertificate" name="taxCertificate" placeholder="Tax Clearance Certificate Number" required>
                      </div>
                    </div>
                  </div>
                </section>

                <!-- Step 2: Upload Documents -->
                <h2>Upload Documents</h2>
                <section>
                  <div class="card">
                    <div class="card-body">
                      <div class="form-group">
                        <label for="uploadNationalId"><i class="fas fa-upload"></i> Upload National ID (PDF/JPG/PNG)</label>
                        <input type="file" class="form-control" id="uploadNationalId" name="uploadNationalId" accept=".pdf,.jpg,.png" required>
                      </div>
                      <div class="form-group">
                        <label for="uploadTaxCertificate"><i class="fas fa-upload"></i> Upload Tax Clearance Certificate (PDF/JPG/PNG)</label>
                        <input type="file" class="form-control" id="uploadTaxCertificate" name="uploadTaxCertificate" accept=".pdf,.jpg,.png" required>
                      </div>
                      <div class="form-group">
                        <label for="uploadProofOfPremises"><i class="fas fa-upload"></i> Upload Proof of Business Premises Ownership/Lease (PDF/JPG/PNG)</label>
                        <input type="file" class="form-control" id="uploadProofOfPremises" name="uploadProofOfPremises" accept=".pdf,.jpg,.png" required>
                      </div>
                      <div class="form-group">
                        <label for="uploadHealthSafetyReport"><i class="fas fa-upload"></i> Upload Health and Safety Inspection Report (PDF/JPG/PNG)</label>
                        <input type="file" class="form-control" id="uploadHealthSafetyReport" name="uploadHealthSafetyReport" accept=".pdf,.jpg,.png" required>
                      </div>
                    </div>
                  </div>
                </section>

                <!-- Step 3: Review & Submit -->
                <h2>Review & Submit</h2>
                <section>
                  <div class="card">
                    <div class="card-body">
                      <h5>Review Your Information</h5>
                      <div class="form-group"><strong>Full Name:</strong> <p id="reviewFullName"></p></div>
                      <div class="form-group"><strong>National ID Number:</strong> <p id="reviewNationalId"></p></div>
                      <div class="form-group"><strong>Business Name:</strong> <p id="reviewBusinessName"></p></div>
                      <div class="form-group"><strong>Business Type/Category:</strong> <p id="reviewBusinessType"></p></div>
                      <div class="form-group"><strong>Business Physical Address:</strong> <p id="reviewBusinessAddress"></p></div>
                      <div class="form-group"><strong>Tax Clearance Certificate Number:</strong> <p id="reviewTaxCertificate"></p></div>
                    </div>
                  </div>
                </section>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- JS Libraries -->
<script src="assets/bundles/jquery-validation/dist/jquery.validate.min.js"></script>
<script src="assets/bundles/jquery-steps/jquery.steps.min.js"></script>
<script src="assets/js/page/form-wizard.js"></script>
<script src="assets/js/scripts.js"></script>
