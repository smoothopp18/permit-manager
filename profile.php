<?php
session_start(); // Ensure session is started before accessing session variables
require_once 'classes/user.php';

// Check if the user is logged in
if (!isset($_SESSION['user']) || !is_array($_SESSION['user'])) {
    header("Location: index.php");
    exit();
}

// Get user details from the session
$user = $_SESSION['user'];
?>
<div class="section-body">
  <div class="row mt-sm-4">
    <div class="col-12">
      <div class="card">
        <div class="card-body">
          <div class="row">
            <div class="col-lg-12">
              <div class="padding-20">
                <ul class="nav nav-tabs" id="myTab2" role="tablist">
                  <li class="nav-item">
                    <a class="nav-link active" id="home-tab2" data-bs-toggle="tab" href="#about" role="tab"
                      aria-selected="true">Personal Details</a>
                  </li>
                </ul>
                <div class="tab-content tab-bordered" id="myTab3Content">
                  <div class="tab-pane fade show active" id="about" role="tabpanel" aria-labelledby="home-tab2">
                    <div class="row mt-3">
                      <div class="col-md-3 col-6 b-r">
                        <strong>Full Name</strong>
                        <br>
                        <p class="text-muted"><?php echo htmlspecialchars($user['fullname'] ?? 'N/A'); ?></p>
                      </div>
                      <div class="col-md-3 col-6 b-r">
                        <strong>Mobile</strong>
                        <br>
                        <p class="text-muted"><?php echo htmlspecialchars($user['phone'] ?? 'N/A'); ?></p>
                      </div>
                      <div class="col-md-3 col-6 b-r">
                        <strong>Email</strong>
                        <br>
                        <p class="text-muted"><?php echo htmlspecialchars($user['email'] ?? 'N/A'); ?></p>
                      </div>
                      <div class="col-md-3 col-6">
                        <strong>Role</strong>
                        <br>
                        <p class="text-muted"><?php echo htmlspecialchars($user['role'] ?? 'N/A'); ?></p>
                      </div>
                    </div>
                    <!-- Added logout button -->
                    <div class="row mt-3">
                      <div class="col-12 text-right">
                        <a href="logout.php" class="btn btn-danger">Logout</a>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="clearfix"></div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
