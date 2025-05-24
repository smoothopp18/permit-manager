<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Blantyre City Council</title>
    <link rel="stylesheet" href="assets/css/app.min.css" />
    <link rel="stylesheet" href="assets/bundles/jquery-selectric/selectric.css" />
    <link rel="stylesheet" href="assets/css/style.css" />
    <link rel="stylesheet" href="assets/css/components.css" />
    <link rel="stylesheet" href="assets/css/custom.css" />
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/logo.png" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
  </head>

  <body>
    <div id="app">
      <section class="section">
        <div class="container mt-5">
          <div class="row">
            <div class="col-12 col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-lg-8 offset-lg-2 col-xl-8 offset-xl-2">
              <div class="card card-primary">
                <div class="loginlogo">
                  <img
                    src="assets/img/form-logo.png"
                    alt="logo"
                    class="formlogo"
                    style="width: 100px; height: 100px"
                  />
                </div>
                <div class="card-header">
                  <h4>Register</h4>
                </div>
                <div class="card-body">
                  <form method="POST" action="public/register.php" id="registerForm">
                    <div class="row">
                      <div class="form-group col-6">
                        <label for="frist_name">First Name</label>
                        <div class="input-group">
                          <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                          </div>
                          <input
                            id="frist_name"
                            type="text"
                            class="form-control"
                            name="firstname"
                            required
                            autofocus
                          />
                        </div>
                      </div>
                      <div class="form-group col-6">
                        <label for="lastname">Last Name</label>
                        <div class="input-group">
                          <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                          </div>
                          <input
                            id="last_name"
                            type="text"
                            class="form-control"
                            name="surname"
                            required
                          />
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="phone">Phone Number</label>
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><i class="fas fa-phone"></i></span>
                        </div>
                        <input
                          id="phone"
                          type="text"
                          class="form-control"
                          name="phone"
                          required
                        />
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="email">Email</label>
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                        </div>
                        <input
                          id="email"
                          type="email"
                          class="form-control"
                          name="email"
                          required
                        />
                      </div>
                    </div>
                    <div class="row">
                      <div class="form-group col-6">
                        <label for="password" class="d-block">Password</label>
                        <div class="input-group">
                          <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-lock"></i></span>
                          </div>
                          <input
                            id="password"
                            type="password"
                            class="form-control pwstrength"
                            data-indicator="pwindicator"
                            name="password"
                            required
                          />
                        </div>
                        <div id="pwindicator" class="pwindicator">
                          <div class="bar"></div>
                          <div class="label"></div>
                        </div>
                      </div>
                      <div class="form-group col-6">
                        <label for="password2" class="d-block">Password Confirmation</label>
                        <div class="input-group">
                          <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-lock"></i></span>
                          </div>
                          <input id="password2" type="password" class="form-control" name="passwordconfirm">
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="custom-control custom-checkbox">
                        <input
                          type="checkbox"
                          name="agree"
                          class="custom-control-input"
                          id="agree"
                        />
                        <label class="custom-control-label" for="agree">
                          I agree with the terms and conditions
                        </label>
                      </div>
                    </div>
                    <div class="form-group">
                      <button
                        type="submit"
                        class="btn btn-primary btn-lg btn-block"
                      >
                        Register
                      </button>
                    </div>
                  </form>
                </div>
                <div class="mb-4 text-muted text-center">
                  Already Registered? <a href="index.php">Login</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
    </div>
    <!-- JS files for registration page functionality -->
    <script src="assets/js/app.min.js"></script>
    <script src="assets/bundles/jquery-pwstrength/jquery.pwstrength.min.js"></script>
    <script src="assets/bundles/jquery-selectric/jquery.selectric.min.js"></script>
    <script src="assets/js/page/auth-register.js"></script>
    <script src="assets/js/scripts.js"></script>
    <script src="assets/js/custom.js"></script>
    <script>
// Displays a custom alert modal with a blurred background
function showCustomAlert(message) {
  const existing = document.getElementById('customAlertModal');
  if (existing) existing.remove();

  // Create modal overlay and alert box
  const modal = document.createElement('div');
  modal.id = 'customAlertModal';
  modal.style.position = 'fixed';
  modal.style.top = 0;
  modal.style.left = 0;
  modal.style.width = '100vw';
  modal.style.height = '100vh';
  modal.style.background = 'rgba(0,0,0,0.3)';
  modal.style.backdropFilter = 'blur(4px)';
  modal.style.display = 'flex';
  modal.style.alignItems = 'center';
  modal.style.justifyContent = 'center';
  modal.style.zIndex = 9999;

  modal.innerHTML = `
    <div class="alert alert-danger text-center shadow-lg" style="max-width: 400px; width: 90%; font-size: 1.1rem;">
      <div>${message}</div>
      <button type="button" class="btn btn-danger mt-3" id="closeCustomAlert">OK</button>
    </div>
  `;

  document.body.appendChild(modal);

  // Remove modal when OK button is clicked
  document.getElementById('closeCustomAlert').onclick = function() {
    modal.remove();
  };
}

// Registration form validation
document.getElementById('registerForm').addEventListener('submit', function(e) {
  // Validate phone number (must be exactly 10 digits)
  var phone = document.getElementById('phone').value.trim();
  if (!/^\d{10}$/.test(phone)) {
    showCustomAlert('Phone number must be exactly 10 digits.');
    e.preventDefault();
    return false;
  }

  // Validate password length (minimum 6 characters)
  var password = document.getElementById('password').value;
  if (password.length < 6) {
    showCustomAlert('Password must be at least 6 characters.');
    e.preventDefault();
    return false;
  }

  // Ensure terms and conditions checkbox is checked
  var agree = document.getElementById('agree');
  if (!agree.checked) {
    showCustomAlert('You must agree with the terms and conditions to register.');
    e.preventDefault();
    return false;
  }
});
    </script>
  </body>
</html>
