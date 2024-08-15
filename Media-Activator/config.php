<?php
$mysqli = new mysqli("localhost", "root", "", "digital_fixer");

if ($mysqli === false) {
    die("ERROR: Could not connect. " . $mysqli->connect_error);
}
?>
