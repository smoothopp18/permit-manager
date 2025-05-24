<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Login - Blantyre City Council</title>
    <link rel="stylesheet" href="assets/css/app.min.css" />
    <link rel="stylesheet" href="assets/css/style.css" />
    <link rel="stylesheet" href="assets/css/components.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:400,500,700&display=swap" />
    <link rel="shortcut icon" href="assets/img/logo.png" type="image/x-icon" />
    <style>
      body {
        font-family: 'Poppins', Arial, sans-serif;
        background: 
          linear-gradient(rgba(0, 0, 0, 0.35), rgba(0, 123, 255, 0.18)),
          url('assets/img/form-img.jpeg') no-repeat center center fixed;
        background-size: cover;
        min-height: 100vh;
        margin: 0;
        padding: 0;
      }

      .main-container {
        max-width: 1150px;
        margin: 48px auto;
        background: #fff;
        border-radius: 24px;
        box-shadow: 0 12px 40px 0 rgba(31, 38, 135, 0.25);
        display: flex;
        flex-direction: row;
        overflow: hidden;
        opacity: 0.98;
      }

      .welcome-section {
        flex: 1.2;
        background: rgba(0,0,0,0.05);
        display: flex;
        flex-direction: column;
        justify-content: flex-start;
        align-items: center;
        padding: 48px 36px 48px 48px;
      }

      .welcome-section .form-logo {
        width: 140px;
        height: 140px;
        margin-bottom: 18px;
        margin-top: 0;
        align-self: flex-start;
      }

      .welcome-section h1 {
        font-size: 2.5rem;
        font-weight: bold;
        margin-bottom: 0;
        color: #0056b3;
        font-family: 'Poppins', Arial, sans-serif;
      }
      .welcome-section p {
        font-size: 1.15rem;
        margin-top: 56px;
        margin-bottom: 32px;
        color: #333;
        font-family: 'Poppins', Arial, sans-serif;
      }

      .welcome-buttons {
        display: none;
      }

      .form-section {
        flex: 1.5;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 48px 36px;
        background: #fff;
      }

      .card.card-primary {
        background: #fff;
        box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.18);
        border-radius: 18px;
        padding: 32px 24px;
        margin: 0;
        width: 100%;
        max-width: 420px;
        font-family: 'Poppins', Arial, sans-serif;
      }

      .form-logo {
        width: 80px;
        height: 80px;
      }

      .btn-primary {
        background-color: #007bff;
        border: none;
        font-family: 'Poppins', Arial, sans-serif;
      }

      .btn-primary:hover {
        background-color: #0056b3;
      }

      .approved-animate {
        font-size: 10rem;
        color: #28a745;
        margin: 60px 0 0 0;
        width: 100%;
        text-align: center;
        display: block;
        filter: drop-shadow(0 8px 24px rgba(40,167,69,0.35));
        animation: spin-slow 4s linear infinite;
      }

      @media (max-width: 1100px) {
        .main-container {
          flex-direction: column;
          max-width: 98vw;
        }
        .welcome-section, .form-section {
          padding: 32px 16px;
        }
        .form-section {
          justify-content: flex-start;
        }
      }

      @media (max-width: 768px) {
        .main-container {
          flex-direction: column;
          margin: 0;
          border-radius: 0;
        }
        .welcome-section, .form-section {
          padding: 24px 8px;
        }
        .card.card-primary {
          padding: 18px 6px;
        }
      }
    </style>
  </head>

  <body>
    <div class="main-container">
      <div class="welcome-section" style="align-items: center;">
        <img src="assets/img/logo.png" alt="BCC Logo" class="form-logo" style="display: block; margin: 0 auto;">
        <div style="font-size: 1.3rem; font-weight: 500; color: #0056b3; margin-top: 18px; margin-bottom: 18px; text-align: center; width: 100%;">
          Business Premises Certificate Issuance System
        </div>
        <i class="fas fa-check-circle approved-animate" style="width: 100%; text-align: center; display: block;"></i>
        <p><i>"Taking The City Back To People"</i></p>
      </div>
      <div class="form-section">
        <div class="card card-primary w-100">
          <div class="card-header text-center d-flex justify-content-center align-items-center" style="border-bottom: none; background: transparent;">
            <img src="assets/img/logo.png" alt="BCC Logo" class="form-logo mb-2 mx-auto" style="width: 110px; height: 110px;">
          </div>
          <div class="card-body">
            <h3 class="text-center mb-4" style="font-weight: 600; color: #0056b3;">Sign In</h3> <!-- Sign In indication -->
            <form method="POST" action="public/login.php" id="loginForm" class="needs-validation" novalidate>
              <div class="form-group">
                <label for="email">Email</label>
                <div class="input-group">
                  <div class="input-group-prepend"><span class="input-group-text"><i class="fas fa-envelope"></i></span></div>
                  <input id="email" type="email" class="form-control" name="email" placeholder="samueldavidwhite@bcc.mw" required autofocus />
                  <div class="invalid-feedback">
                    Please fill in a valid email
                  </div>
                </div>
              </div>
              <div class="form-group">
                <label for="password">Password</label>
                <div class="input-group">
                  <div class="input-group-prepend"><span class="input-group-text"><i class="fas fa-lock"></i></span></div>
                  <input id="password" type="password" class="form-control" name="password" placeholder="********" required />
                  <div class="invalid-feedback">
                    Please fill in your password
                  </div>
                </div>
              </div>
              <div class="form-group">
                <button type="submit" class="btn btn-primary btn-lg btn-block">Login</button>
              </div>
            </form>
            <div class="text-center mt-2">
              Don't have an account? <a href="index.php">Create One</a>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Scripts -->
    <script src="assets/js/app.min.js"></script>
    <script src="assets/js/scripts.js"></script>
    <script>
      // Show a custom Bootstrap-styled alert with blurred background
      function showCustomAlert(message) {
        const existing = document.getElementById('customAlertModal');
        if (existing) existing.remove();
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
        document.getElementById('closeCustomAlert').onclick = function() {
          modal.remove();
        };
      }

      // Custom validation for login form
      document.querySelector('form.needs-validation').addEventListener('submit', function(e) {
        var email = document.getElementById('email').value.trim();
        var password = document.getElementById('password').value;
        if (!email.match(/^[^@]+@[^@]+\.[^@]+$/)) {
          showCustomAlert('Please enter a valid email address.');
          e.preventDefault();
          return false;
        }
        if (password.length < 6) {
          showCustomAlert('Password must be at least 6 characters.');
          e.preventDefault();
          return false;
        }
      });
    </script>
  </body>
</html>
