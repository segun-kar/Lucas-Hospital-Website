<?php

$host = "localhost";
$user = "root";
$password = "";
$database = "lucas_hospital";

$conn = mysqli_connect("localhost", "root", "", "lucas_hospital");

if (!$conn) {

    die("Database connection failed: " . mysqli_connect_error());

}
?>