<section class="section">
  <div class="section-body">
    <div class="row clearfix">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
          <div class="card-header">
            <h4>Certificate Application</h4>
          </div>
          <div class="card-body">
            <form class="needs-validation" novalidate="" id="applyform" method="post" action=".../../public/application-controller.php">
              <div class="card-body">
                <div class="row">
                  <div class="form-group col-6">
                    <label for="nationalId"><i class="fas fa-id-card"></i> National ID</label>
                    <input id="nationalId" type="text" class="form-control" name="nationalId" placeholder="Enter National ID" required>
                  </div>
                  <div class="form-group col-6">
                    <label for="businessName"><i class="fas fa-building"></i> Business Name</label>
                    <input id="businessName" type="text" class="form-control" name="businessName" placeholder="Enter Business Name" required>
                  </div>
                </div>
                <div class="row">
                  <div class="form-group col-6">
                    <label for="businessType"><i class="fas fa-briefcase"></i> Business Type</label>
                    <select id="businessType" class="form-control" name="businessType" required>
                      <option value="">Select Business Type</option>
                      <option value="business_premises">Business Premises</option>
                      <option value="food_licence">Food Licence</option>
                      <option value="opaque_beer_licence">Opaque Beer Licence</option>
                      <option value="liquor_licence">Liquor Licence</option>
                    </select>
                  </div>
                  <div class="form-group col-6">
                    <label for="businessAddress"><i class="fas fa-map-marker-alt"></i> Business Address</label>
                    <input id="businessAddress" type="text" class="form-control" name="businessAddress" placeholder="Enter Business Address" required>
                  </div>
                </div>
                <div class="row">
                  <div class="form-group col-6">
                    <label for="leaseNumber"><i class="fas fa-file-contract"></i> Lease Number</label>
                    <input id="leaseNumber" type="text" class="form-control" name="leaseNumber" placeholder="Enter Lease Number" required>
                  </div>
                </div>
                <div class="form-group">
                  <label for="taxCertificate"><i class="fas fa-certificate"></i> Tax Certificate</label>
                  <input id="taxCertificate" type="text" class="form-control" name="taxCertificate" placeholder="Enter Tax Certificate" required>
                </div>
                <div class="form-group">
                  <div class="custom-control custom-checkbox">
                    <input type="checkbox" name="agree" class="custom-control-input" id="agree" required>
                    <label class="custom-control-label" for="agree">I agree with the terms and conditions</label>
                  </div>
                </div>
                <div class="form-group">
                  <button type="submit" class="btn btn-primary btn-sm btn-block">
                    <i class="fas fa-paper-plane"></i> Apply
                  </button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
