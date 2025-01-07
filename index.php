<?php


// get DATABASE_URL
$DATABASE_URL = $_ENV['DATABASE_URL'];

$DATABASE_URL = parse_url($DATABASE_URL);

// make a db connection to mysql using PDO
$host = $DATABASE_URL['host'];
$db = ltrim($DATABASE_URL['path'], '/');
$user = $DATABASE_URL['user'];
$pass = $DATABASE_URL['pass'];

$dsn = "mariadb:host=$host;dbname=$db";


try {
    // Create a PDO instance
    $pdo = new PDO($dsn, $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "SELECT * FROM users";

    echo 'Connected to the database';
    // print the list of user
    $stmt = $pdo->query($sql);
    while ($row = $stmt->fetch()) {
        echo $row['name'] . "\n";
    }


} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
}


?>