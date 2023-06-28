<?php
error_reporting(E_ALL);
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300&display=swap" rel="stylesheet">

    <style>
        body{
            font-family: 'Montserrat', sans-serif;
            background-color: #ade8d3;
            padding-top: 7%;
        }
        .form-signup{
            margin: 0 auto;
            max-width: 400px;
            background-color: white;
            padding: 40px;
            border: 2px solid lightgray;
            box-shadow: 10px 10px lightgray;
        }
        .logo img{
            width: 80px;
            height: 80px;
        }

    </style>
</head>
<body>
  <div class="container">
      <form class="form-signup text-center" id="registerForm" method="post" action="register_dashboard.php">
          <div class="logo">
              <img src="colorfull_logo.png">
          </div>
          <h2>Register form</h2>
          <p>Create your account and make events for free</p>
          <div class="form-group">
          <div class="row">
              <div class="col-md-6">
                  <span id="nameError"></span>
                  <input type="text" class="form-control" id="firstname" name="firstname" placeholder="First Name">
              </div>
              <div class="col-md-6">
                  <span id="lastNameError"></span>
                  <input type="text" class="form-control" id="lastname" name="lastname" placeholder="Last Name">
              </div>

              <div class="col-md-12">
                  <input type="text" class="form-control" id="orgname" name="orgname" placeholder="Organization name (not necessary)">
              </div>
          </div>
          </div>

          <div class="form-group">
              <span id="emailError"></span>
              <input type="email" class="form-control" id="email" name="email" placeholder="Email Address">
          </div>
          <div class="form-group">
              <span id="passwordError"></span>
              <input type="password" class="form-control" id="password" name="password" placeholder="Password">
          </div>
          <div class="form-group">
              <span id="password2Error"></span>
              <input type="password" class="form-control" id="password2" name="confirm_password" placeholder="Confirm password">
          </div>
          <input type="submit" class="btn btn-success btn-block" name="btn" value="Submit">
      </form>
  </div>

  <script>
      //JavaScript validacija za proveru podataka registrovanog korisnika

      // Funkcija za postavljanje poruke o grešci i stilova
      function setError(field, errorElement, message) {
          field.style.borderColor = 'red';
          errorElement.textContent = message;
          errorElement.style.color = 'red';
          errorElement.style.fontWeight = 'bold';
      }

      // Funkcija za uklanjanje poruke o grešci i stilova
      function clearError(field, errorElement) {
          field.style.borderColor = '';
          errorElement.textContent = '';
      }

      function validateField(field, errorElement, validationFn, errorMessage) {
          if (!validationFn(field.value)) {
              setError(field, errorElement, errorMessage);
              return false;
          } else {
              clearError(field, errorElement);
              return true;
          }
      }

      function validateEmail(email) {
          const regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
          return regex.test(email);
      }

      function validatePassword(password) {
          const minLength = 8;
          const hasUppercase = /[A-Z]/.test(password);
          const hasLowercase = /[a-z]/.test(password);
          const hasNumber = /[0-9]/.test(password);
          const hasSpecialChar = /[!@#$%^&*()_+\-=[\]{};':"\\|,.<>/?]/.test(password);

          return (
              password.length >= minLength &&
              hasUppercase &&
              hasLowercase &&
              hasNumber &&
              hasSpecialChar
          );
      }

      document.addEventListener('DOMContentLoaded', function() {
          var registerForm = document.getElementById('registerForm');
          registerForm.addEventListener('submit', function(event) {
              var firstName = document.getElementById('firstname');
              var firstNameError = document.getElementById('nameError');
              var lastName = document.getElementById('lastname');
              var lastNameError = document.getElementById('lastNameError');
              var email = document.getElementById('email');
              var emailError = document.getElementById('emailError');
              var password = document.getElementById('password');
              var passwordError = document.getElementById('passwordError');
              var password2 = document.getElementById('password2');
              var password2Error = document.getElementById('password2Error');
              var errors = false;

              errors = !validateField(firstName, firstNameError, value => value !== '', 'Name required!') || errors;
              errors = !validateField(lastName, lastNameError, value => value !== '', 'Last Name required!') || errors;
              errors = !validateField(email, emailError, validateEmail, 'Email is not valid!') || errors;
              errors = !validateField(password, passwordError, validatePassword, 'Password is not valid!') || errors;
              errors = !validateField(password2, password2Error, value => value === password.value, 'Passwords do not match!') || errors;

              if (errors) {
                  event.preventDefault();
              }
          });
      });

  </script>
</body>
</html>


<?php
/*
// Uključite PDO konekciju
include("db_config.php");


$host = 'localhost';
$db_name = 'event';
$username = 'root';
$password = '';
    $pdo = new PDO("mysql:host=$host;dbname=$db_name;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Provera da li su svi potrebni podaci dostavljeni
    if (isset($_POST["firstname"]) && isset($_POST["lastname"]) && isset($_POST["email"]) && isset($_POST["password"]) && isset($_POST["confirm_password"])) {
        $firstName = $_POST["firstname"];
        $lastName = $_POST["lastname"];
        $orgName = $_POST["orgname"];
        $email = $_POST["email"];
        $password = $_POST["password"];
        $confirmPassword = $_POST["confirm_password"];

        // Validacija podataka
        if (empty($firstName) || empty($lastName) || empty($email) || empty($password) || empty($confirmPassword)) {
            echo "Sva polja moraju biti popunjena.";
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo "Nevažeća email adresa.";
        } elseif ($password !== $confirmPassword) {
            echo "Lozinke se ne podudaraju.";
        } else {
            // Hashovanje lozinke
            $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

            // Priprema i izvršavanje upita za unos podataka
            $stmt = $pdo->prepare("INSERT INTO registered_user (first_name, last_name, organization_name, email, password) VALUES (:firstName, :lastName, :orgName, :email, :hashedPassword)");
            $stmt->execute([
                'firstName' => $firstName,
                'lastName' => $lastName,
                'orgName' => $orgName,
                'email' => $email,
                'hashedPassword' => $hashedPassword
            ]);

            echo "Registracija uspešna!";
        }
    } else {
        echo "Svi potrebni podaci nisu dostavljeni.";
    }
}*/
