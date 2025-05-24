
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta
      content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no"
      name="viewport"
    />
    <title>Blantyre City Council</title>
    <!-- Main CSS files -->
    <link rel="stylesheet" href="assets/css/app.min.css" />
    <link rel="stylesheet" href="assets/bundles/bootstrap-social/bootstrap-social.css" />
    <link rel="stylesheet" href="assets/css/style.css" />
    <link rel="stylesheet" href="assets/css/components.css" />
    <link rel="stylesheet" href="assets/css/custom.css" />
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/logo.png" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
  </head>

  <body>
    <div class="loader"></div>
    <div id="app">
      <section class="section">
        <div class="container mt-5">
          <div class="row">
            <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
              <div class="card card-primary">
                <div class="loginlogo">
                  <img
                    src="assets/img/form-logo.png"
                    alt="logo"
                    class="logo logo-dark"
                    style="width: 100px; height: 100px"
                  />
                </div>
                <div class="card-header">
                  <h4>Login</h4>
                </div>
                <div class="txt">
                  <span><p>Please enter your email and password</p></span>
                </div>
                <div class="card-body">
                  <!-- Login form -->
                  <form
                    method="POST"
                    action="public/login.php"
                    class="needs-validation"
                    novalidate=""
                  >
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
                          tabindex="1"
                          placeholder="samueldavidwhite@bcc.mw"
                          required
                          autofocus
                        />
                        <div class="invalid-feedback">
                          Please fill in a valid email
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="d-block">
                        <label for="password" class="control-label">Password</label>
                      </div>
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><i class="fas fa-lock"></i></span>
                        </div>
                        <input
                          id="password"
                          type="password"
                          class="form-control"
                          name="password"
                          tabindex="2"
                          placeholder="********"
                          required
                        />
                        <div class="invalid-feedback">
                          please fill in your password
                        </div>
                      </div>
                    </div>

                    <div class="form-group">
                      <button
                        type="submit"
                        class="btn btn-primary btn-lg btn-block"
                        tabindex="4"
                      >
                        Login
                      </button>
                    </div>
                  </form>
                </div>
              </div>
              <div class="mt-5 text-muted text-center">
                Don't have an account?
                <a href="auth-register.php">Create One</a>
              </div>
            </div>
          </div>
        </div>
      </section>
    </div>
    <!-- Main JS scripts -->
    <script src="assets/js/app.min.js"></script>
    <script src="assets/js/scripts.js"></script>
    <script src="assets/js/custom.js"></script>
    <script>
// Show a custom Bootstrap-styled alert with blurred background
function showCustomAlert(message) {
  // Remove any existing alert modal
  const existing = document.getElementById('customAlertModal');
  if (existing) existing.remove();

  // Create the modal overlay
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

  // Alert content
  modal.innerHTML = `
    <div class="alert alert-danger text-center shadow-lg" style="max-width: 400px; width: 90%; font-size: 1.1rem;">
      <div>${message}</div>
      <button type="button" class="btn btn-danger mt-3" id="closeCustomAlert">OK</button>
    </div>
  `;

  document.body.appendChild(modal);

  // Close alert on button click
  document.getElementById('closeCustomAlert').onclick = function() {
    modal.remove();
  };
}

// Custom validation for login form
document.querySelector('form.needs-validation').addEventListener('submit', function(e) {
  var email = document.getElementById('email').value.trim();
  var password = document.getElementById('password').value;

  // Validate email format
  if (!email.match(/^[^@]+@[^@]+\.[^@]+$/)) {
    showCustomAlert('Please enter a valid email address.');
    e.preventDefault();
    return false;
  }

  // Validate password length
  if (password.length < 6) {
    showCustomAlert('Password must be at least 6 characters.');
    e.preventDefault();
    return false;
  }
});
</script>
  </body>
</html>
