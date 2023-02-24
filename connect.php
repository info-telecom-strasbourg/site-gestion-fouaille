<?php
// Souvent on identifie cet objet par la variable $conn ou $db
$mysqlConnection = new PDO(
    'mysql:host=$_ENV[DB_HOST];dbname=$_ENV[DB_NAME];charset=utf8;port:3307',
    '$_ENV[DB_USER]',
    '$_ENV[DB_PASS]'
);
?>