<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Apply Now - Blantyre City Council</title>
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
        max-width: 1150px; /* Wider floating page */
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
        align-items: center; /* Center content horizontally */
        padding: 48px 36px 48px 48px;
      }

      .welcome-section .form-logo {
        width: 140px;  /* Bigger logo */
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
        margin-top: 56px; /* Huge space between heading and paragraph */
        margin-bottom: 32px;
        color: #333;
        font-family: 'Poppins', Arial, sans-serif;
      }

      .welcome-buttons {
        display: none; /* Hide the buttons */
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
            <h4 class="text-center mb-4" style="font-weight: 600; color: #0056b3;">Sign Up</h4> <!-- Sign Up indication -->
            <form method="POST" action="public/register.php" id="registerForm">
              <div class="row">
                <div class="form-group col-6">
                  <label for="frist_name">First Name</label>
                  <div class="input-group">
                    <div class="input-group-prepend"><span class="input-group-text"><i class="fas fa-user"></i></span></div>
                    <input id="frist_name" type="text" class="form-control" name="firstname" required autofocus />
                  </div>
                </div>
                <div class="form-group col-6">
                  <label for="lastname">Last Name</label>
                  <div class="input-group">
                    <div class="input-group-prepend"><span class="input-group-text"><i class="fas fa-user"></i></span></div>
                    <input id="last_name" type="text" class="form-control" name="surname" required />
                  </div>
                </div>
              </div>
              <div class="form-group">
                <label for="phone">Phone Number</label>
                <div class="input-group">
                  <div class="input-group-prepend"><span class="input-group-text"><i class="fas fa-phone"></i></span></div>
                  <input id="phone" type="text" class="form-control" name="phone" required />
                </div>
              </div>
              <div class="form-group">
                <label for="email">Email</label>
                <div class="input-group">
                  <div class="input-group-prepend"><span class="input-group-text"><i class="fas fa-envelope"></i></span></div>
                  <input id="email" type="email" class="form-control" name="email" required />
                </div>
              </div>
              <div class="row">
                <div class="form-group col-6">
                  <label for="password">Password</label>
                  <div class="input-group">
                    <div class="input-group-prepend"><span class="input-group-text"><i class="fas fa-lock"></i></span></div>
                    <input id="password" type="password" class="form-control" name="password" required />
                  </div>
                </div>
                <div class="form-group col-6">
                  <label for="password2">Confirm Password</label>
                  <div class="input-group">
                    <div class="input-group-prepend"><span class="input-group-text"><i class="fas fa-lock"></i></span></div>
                    <input id="password2" type="password" class="form-control" name="passwordconfirm" required />
                  </div>
                </div>
              </div>
              <div class="form-group">
                <div class="custom-control custom-checkbox">
                  <input type="checkbox" name="agree" class="custom-control-input" id="agree" />
                  <label class="custom-control-label" for="agree">I agree to the terms and conditions</label>
                </div>
              </div>
              <div class="form-group">
                <button type="submit" class="btn btn-primary btn-lg btn-block">Register</button>
              </div>
            </form>
            <div class="text-center mt-2">
              Already registered? <a href="index.php">Login here</a>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Scripts -->
    <script src="assets/js/app.min.js"></script>
    <script src="assets/js/scripts.js"></script>
    <script>
    </script>
  </body>
</html>
