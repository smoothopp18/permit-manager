<section class="section">
  <div class="section-body">
    <div class="row clearfix">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
          <div class="card-header">
            <h4>Business Certificate Application</h4>
          </div>
          <div class="card-body">
            <div id="wizard_horizontal">
              <h2>Business Owner Information</h2>
              <section>
                <div class="step-1">
                  <div class="card">
                    <div class="card-body">
                      <div class="form-row">
                        <div class="form-group col-md-6">
                          <label for="fullName"><i class="fas fa-user"></i> Full Name</label>
                          <input type="text" class="form-control" id="fullName" placeholder="Full Name">
                        </div>
                        <div class="form-group col-md-6">
                          <label for="nationalId"><i class="fas fa-id-card"></i> National ID Number</label>
                          <input type="text" class="form-control" id="nationalId" placeholder="National ID Number">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="businessName"><i class="fas fa-building"></i> Business Name</label>
                        <input type="text" class="form-control" id="businessName" placeholder="Business Name">
                      </div>
                      <div class="form-group">
                        <label for="businessType"><i class="fas fa-briefcase"></i> Business Type/Category</label>
                        <select id="businessType" class="form-control">
                          <option selected>Choose...</option>
                          <option>Business Premises Licence</option>
                          <option>Food Licence</option>
                          <option>Opaque Beer Licence</option>
                          <option>Liquor Licence</option>
                        </select>
                      </div>
                      <div class="form-group">
                        <label for="businessAddress"><i class="fas fa-map-marker-alt"></i> Business Physical Address</label>
                        <input type="text" class="form-control" id="businessAddress" placeholder="Business Physical Address">
                      </div>
                      <div class="form-group">
                        <label for="taxCertificate"><i class="fas fa-file-alt"></i> Tax Clearance Certificate Number</label>
                        <input type="text" class="form-control" id="taxCertificate" placeholder="Tax Clearance Certificate Number">
                      </div>
                    </div>
                  </div>
                </div>
              </section>
              <h2>Upload Documents</h2>
              <section>
                <div class="step-2">
                  <div class="card">
                    <div class="card-body">
                      <div class="form-group">
                        <label for="uploadNationalId"><i class="fas fa-upload"></i> Upload National ID (PDF/JPG/PNG)</label>
                        <input type="file" class="form-control" id="uploadNationalId" accept=".pdf, .jpg, .png">
                      </div>
                      <div class="form-group">
                        <label for="uploadTaxCertificate"><i class="fas fa-upload"></i> Upload Tax Clearance Certificate (PDF/JPG/PNG)</label>
                        <input type="file" class="form-control" id="uploadTaxCertificate" accept=".pdf, .jpg, .png">
                      </div>
                      <div class="form-group">
                        <label for="uploadProofOfPremises"><i class="fas fa-upload"></i> Upload Proof of Business Premises Ownership/Lease (PDF/JPG/PNG)</label>
                        <input type="file" class="form-control" id="uploadProofOfPremises" accept=".pdf, .jpg, .png">
                      </div>
                      <div class="form-group">
                        <label for="uploadHealthSafetyReport"><i class="fas fa-upload"></i> Upload Health and Safety Inspection Report (PDF/JPG/PNG)</label>
                        <input type="file" class="form-control" id="uploadHealthSafetyReport" accept=".pdf, .jpg, .png">
                      </div>
                    </div>
                  </div>
                </div>
              </section>
              <h2>Review & Submit</h2>
              <section>
                <div class="step-3">
                  <div class="card">
                    <div class="card-body">
                      <h5>Review Your Information</h5>
                      <p>Please review the information you have provided before submitting your application.</p>
                      <div class="form-group">
                        <label>Full Name:</label>
                        <p id="reviewFullName"></p>
                      </div>
                      <div class="form-group">
                        <label>National ID Number:</label>
                        <p id="reviewNationalId"></p>
                      </div>
                      <div class="form-group">
                        <label>Business Name:</label>
                        <p id="reviewBusinessName"></p>
                      </div>
                      <div class="form-group">
                        <label>Business Type/Category:</label>
                        <p id="reviewBusinessType"></p>
                      </div>
                      <div class="form-group">
                        <label>Business Physical Address:</label>
                        <p id="reviewBusinessAddress"></p>
                      </div>
                      <div class="form-group">
                        <label>Tax Clearance Certificate Number:</label>
                        <p id="reviewTaxCertificate"></p>
                      </div>
                      <div class="form-group">
                        <label>Uploaded Documents:</label>
                        <ul>
                          <li id="reviewUploadNationalId">National ID</li>
                          <li id="reviewUploadTaxCertificate">Tax Clearance Certificate</li>
                          <li id="reviewUploadProofOfPremises">Proof of Business Premises Ownership/Lease</li>
                          <li id="reviewUploadHealthSafetyReport">Health and Safety Inspection Report</li>
                        </ul>
                      </div>
                    </div>
                  </div>
                </div>
              </section>
            </div>
          </div>
        </div>
      </div>

    </div>
</section>

<!-- General JS Scripts -->
<script src="assets/js/app.min.js"></script>
<script src="assets/bundles/jquery-validation/dist/jquery.validate.min.js"></script>
<!-- JS Libraies -->
<script src="assets/bundles/jquery-steps/jquery.steps.min.js"></script>
<!-- Page Specific JS File -->
<script src="assets/js/page/form-wizard.js"></script>
<!-- Template JS File -->
<script src="assets/js/scripts.js"></script>
<!-- Custom JS File -->
<script src="assets/js/custom.js"></script>
<!---->
</body>

</html>