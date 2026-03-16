<?php
session_start();

$result="";

if(isset($_POST['predict']))
{
    $title=$_POST['title'];
    $category=$_POST['category'];

    if($title!="" && $category!="")
    {
        $result="High Engagement Expected";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Prediction</title>

<style>

body{
font-family:Arial;
background:#d1d5db;
margin:0;
}

.container{
width:600px;
margin:60px auto;
background:#e5e7eb;
padding:30px;
}

h1{
font-size:32px;
}

input{
width:220px;
height:25px;
}

button{
padding:6px 15px;
cursor:pointer;
}

</style>

</head>

<body>

<div class="container">

<h1>Content Effectiveness Prediction</h1>

<?php
if($result!="")
{
echo "<p>Prediction Result: <b>$result</b></p>";
}
?>

<form method="post">

<p>Content Title</p>
<input type="text" name="title" required>

<p>Category</p>
<input type="text" name="category" required>

<br><br>

<button type="submit" name="predict">Predict</button>

</form>

</div>

</body>
</html>