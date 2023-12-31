<?php

include("db_config.php");

$host = 'localhost';
$db_name = 'event';
$username = 'root';
$password = '';
$pdo = new PDO("mysql:host=$host;dbname=$db_name;charset=utf8", $username, $password);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["email"]) && isset($_POST["password"])) {
        $email = $_POST["email"];
        $password = $_POST["password"];

        // check the registration of the user
        $stmt = $pdo->prepare("SELECT * FROM registered_user WHERE email = :email");
        $stmt->execute(['email' => $email]);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['password'])) {
            //if login succeeded
            session_start();

            //session for recognizing the expecting registered user
            $_SESSION['email'] = $email;
            $_SESSION['firstName'] = $user['first_name'];
            $_SESSION['lastName'] = $user['last_name'];
            $_SESSION['user_id'] = $user['id'];

            //forwards to the dashboard
            header("Location: register_dashboard.php");
            exit();
        } else {
            //if login failed
            $errorMessage = "Email or password are incorrect!";
            echo "<script>alert('$errorMessage');</script>";
            //header("Location: login.php");
            //exit();
        }
    } else {
        $errorMessage = "Email and password are required!";
        echo "<script>alert('$errorMessage');</script>";
    }
}
?>
