<?php
require_once __DIR__ . '/includes/db.php';
session_start();

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && $password === $user['password']) {
        $_SESSION['user'] = $user['username'];
        header("Location: dashboard.php");
        exit;
    } else {
        $error = "Invalid username or password";
    }
}
?>

<!DOCTYPE html>
<html>
<head>

<title>CEPM Faculty Login</title>

<style>

body{
margin:0;
padding:0;
font-family:Arial, Helvetica, sans-serif;
background:linear-gradient(135deg,#1e3a8a,#2563eb);
height:100vh;
display:flex;
align-items:center;
justify-content:center;
}

/* Login Container */

.login-box{
width:100%;
max-width:400px;
}

/* Card Design */

.card{

background:white;
padding:40px;
border-radius:12px;
box-shadow:0 10px 30px rgba(0,0,0,0.2);
text-align:center;

}

/* Title */

.card h2{
margin-bottom:10px;
color:#1e3a8a;
}

.subtitle{
font-size:14px;
color:#555;
margin-bottom:25px;
}

/* Inputs */

input{

width:100%;
padding:12px;
margin:10px 0;
border:1px solid #ccc;
border-radius:6px;
font-size:14px;
transition:0.3s;

}

input:focus{
border-color:#2563eb;
outline:none;
}

/* Button */

button{

width:100%;
padding:12px;
margin-top:10px;
background:#2563eb;
border:none;
color:white;
font-size:16px;
border-radius:6px;
cursor:pointer;
transition:0.3s;

}

button:hover{
background:#1e40af;
}

/* Error */

.error{
color:red;
margin-bottom:10px;
}

/* Register Link */

.register{

margin-top:20px;
font-size:14px;

}

.register a{

color:#2563eb;
text-decoration:none;
font-weight:bold;

}

.register a:hover{
text-decoration:underline;
}

.footer{

margin-top:20px;
font-size:12px;
color:#777;

}

</style>

</head>

<body>

<div class="login-box">

<div class="card">

<h2>CEPM</h2>
<p class="subtitle">Content Effectiveness Prediction Model</p>

<h3>CEMP Login</h3>

<?php if (!empty($error)): ?>
<p class="error"><?php echo $error; ?></p>
<?php endif; ?>

<form method="POST">

<input type="text" name="username" placeholder="Enter Username" required>

<input type="password" name="password" placeholder="Enter Password" required>

<button type="submit">Login</button>

</form>

<div class="register">

<p>Don't have an account?</p>
<a href="register.php">Register Here</a>

</div>

<div class="footer">

AI Content Analytics System

</div>

</div>

</div>

</body>
</html>