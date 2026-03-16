<?php
session_start();

if(isset($_POST['register']))
{
    $name  = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $city  = $_POST['city'];

    // Store name in session (example)
    $_SESSION['user'] = $name;

    header("Location: dashboard.php");
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Faculty Registration</title>

<style>

body{
margin:0;
font-family:Arial;
background:linear-gradient(135deg,#4facfe,#00f2fe);
height:100vh;
display:flex;
justify-content:center;
align-items:center;
}

.form-box{
background:white;
padding:40px;
width:350px;
border-radius:10px;
box-shadow:0 10px 25px rgba(0,0,0,0.2);
text-align:center;
}

h2{
margin-bottom:20px;
color:#333;
}

input{
width:90%;
padding:12px;
margin:10px 0;
border:1px solid #ccc;
border-radius:5px;
font-size:14px;
}

input:focus{
border-color:#4facfe;
outline:none;
}

button{
width:95%;
padding:12px;
background:#4facfe;
border:none;
color:white;
font-size:16px;
border-radius:5px;
cursor:pointer;
}

button:hover{
background:#2b8df7;
}

.login-link{
margin-top:15px;
}

.login-link a{
color:#4facfe;
text-decoration:none;
font-weight:bold;
}

</style>

</head>

<body>

<div class="form-box">

<h2>CEP Registration</h2>

<form method="post">

<input type="text" name="name" placeholder="Faculty Name" required>

<input type="email" name="email" placeholder="Email Address" required>

<input type="tel" name="phone" placeholder="Phone Number" required>

<input type="text" name="city" placeholder="City" required>

<button type="submit" name="register">Register</button>

</form>

<div class="login-link">
Already registered?  
<a href="login.php">Login Here</a>
</div>

</div>

</body>
</html>