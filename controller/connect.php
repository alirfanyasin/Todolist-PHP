<?php

$hostname = "localhost";
$username = "root";
$password = "";
$database = "db_todolist";

try {
  $connect = mysqli_connect($hostname, $username, $password, $database);
} catch (Exception $error) {
  echo $error;
}
