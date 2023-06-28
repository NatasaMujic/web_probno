<?php
session_start();
include("db_config.php");

$host = 'localhost';
$db_name = 'event';
$username = 'root';
$password = '';

$pdo = new PDO("mysql:host=$host;dbname=$db_name;charset=utf8", $username, $password);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['firstName'])) {
    // check if the registered user is logged
    if (isset($_SESSION["firstName"])) {
        $username = $_GET['firstName'];

        // Executing a query to delete a registered user
        $stmt = $pdo->prepare("DELETE FROM registered_user WHERE first_name = :firstName");
        $stmt->execute(['firstName' => $username]);

        // redirection to the register.php page after deleting
        header("Location: register.php");
        exit;
    } else {
        echo "You are not logged in!";
    }
}
