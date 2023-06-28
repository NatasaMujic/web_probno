<?php
session_start();
include("db_config.php");

$host = 'localhost';
$db_name = 'event';
$username = 'root';
$password = '';

$pdo = new PDO("mysql:host=$host;dbname=$db_name;charset=utf8", $username, $password);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Provjeri je li korisnik prijavljen
    if (isset($_SESSION["firstName"])) {
        $firstName1 = $_POST["firstname1"];
        $lastName1 = $_POST["lastname1"];
        $orgName1 = $_POST["orgname1"];
        $email1 = $_POST["email1"];
        $password1 = $_POST["password1"];
        $confirmPassword1 = $_POST["confirm_password1"];
        $username = $_SESSION["firstName"];

        // Provjeri jesu li polja lozinke prazna
        if (!empty($password1) && !empty($confirmPassword1)) {
            // Provjeri jesu li lozinke iste
            if ($password1 !== $confirmPassword1) {
                echo "Lozinke se ne podudaraju!";
                exit;
            }

            // Generiraj hash lozinke
            $hashedPassword1 = password_hash($password, PASSWORD_BCRYPT);

            // Izvrši upit za ažuriranje podataka korisnika s promjenom lozinke
            $stmt = $pdo->prepare("UPDATE registered_user SET first_name = :firstName1, last_name = :lastName1, organization_name = :orgName1, email = :email1, password = :hashedPassword1 WHERE first_name = :username");
            $stmt->execute([
                'firstName1' => $firstName1,
                'lastName1' => $lastName1,
                'orgName1' => $orgName1,
                'email1' => $email1,
                'hashedPassword1' => $hashedPassword1,
                'username' => $username
            ]);

            echo "Podaci (uključujući lozinku) su uspješno ažurirani!";
        } else {
            // Izvrši upit za ažuriranje podataka korisnika bez promjene lozinke
            $stmt = $pdo->prepare("UPDATE registered_user SET first_name = :firstName1, last_name = :lastName1, organization_name = :orgName1, email = :email1 WHERE first_name = :username");
            $stmt->execute([
                'firstName1' => $firstName1,
                'lastName1' => $lastName1,
                'orgName1' => $orgName1,
                'email1' => $email1,
                'username' => $username
            ]);

            echo "Podaci su uspješno ažurirani!";
        }
    } else {
        echo "Niste prijavljeni!";
    }
}
