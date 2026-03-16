<?php
session_start();

$result = "";

if(isset($_POST['predict']))
{
    $title = $_POST['title'];
    $category = $_POST['category'];

    if($title != "" && $category != "")
    {
        $result = "High Engagement Expected";
    }
}
?>