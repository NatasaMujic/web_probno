<?php

$host = 'localhost';
$db_name = 'event';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db_name;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  
        echo "Connection successfuly!";


} catch(PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
}


/*
class config{
    public static function connect(){
        $host = 'localhost';
        $db_name = 'event';
        $username = 'root';
        $password = '';

        try {
            $pdo = new PDO("mysql:host=$host;dbname=$db_name;charset=utf8", $username, $password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            echo "Connection successfuly!";


        } catch(PDOException $e) {
            echo 'Connection failed: ' . $e->getMessage();
        }
        return $pdo;
}

}
*/


