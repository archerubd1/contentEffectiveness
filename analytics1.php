<?php
session_start();

if(!isset($_SESSION['user']))
{
    header("Location: login.php");
}

$engagement = 80;
$completion = 72;
$quiz_score = 75;
$interaction = 68;
$skills = 70;
?>