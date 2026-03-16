<?php
session_start();

if(!isset($_SESSION['user']))
{
    header("Location: login.php");
}

$report_data = [
    ["Unit 1",82],
    ["Unit 2",65],
    ["Unit 3",74],
    ["Unit 4",58],
    ["Unit 5",88],
    ["Unit 6",71]
];
?>