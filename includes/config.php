<?php
$db_host = 'localhost';
$db_user = 'username';
$db_pass = 'password';
$db_name = 'my_database';

$conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

if (!$conn) {
  die("Błąd połączenia z bazą danych: " . mysqli_connect_error());
}
