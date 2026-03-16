<!DOCTYPE html>
<html>
<head>
<title>CEMP Course Dashboard</title>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<style>

body{
margin:0;
font-family:Arial;
background:#f4f6fb;
}

/* TOPBAR */

.topbar{
height:60px;
background:#1e40af;
color:white;
display:flex;
align-items:center;
justify-content:space-between;
padding:0 20px;
font-size:20px;
}

/* SIDEBAR */

.sidebar{
position:fixed;
top:60px;
left:0;
width:220px;
height:100%;
background:#1e3a8a;
}

.sidebar button{
width:100%;
padding:15px;
border:none;
background:none;
color:white;
text-align:left;
cursor:pointer;
font-size:16px;
}

.sidebar button:hover{
background:#2563eb;
}

/* MAIN */

.main{
margin-left:220px;
margin-top:60px;
padding:20px;
}

.page{
display:none;
}

/* CARDS */

.cards{
display:grid;
grid-template-columns:repeat(4,1fr);
gap:20px;
margin-bottom:20px;
}

.card{
background:white;
padding:20px;
border-radius:10px;
box-shadow:0 2px 6px rgba(0,0,0,0.1);
text-align:center;
font-size:18px;
}

/* BOX */

.box{
background:white;
padding:20px;
margin-bottom:20px;
border-radius:10px;
box-shadow:0 2px 6px rgba(0,0,0,0.1);
}

/* INPUT */

input,select{
width:100%;
padding:10px;
margin:8px 0;
border:1px solid #ccc;
border-radius:5px;
}

/* BUTTON */

.action{
background:#2563eb;
color:white;
padding:8px 12px;
border:none;
border-radius:5px;
cursor:pointer;
}

/* TABLE */

table{
width:100%;
border-collapse:collapse;
}

table th{
background:#2563eb;
color:white;
padding:10px;
}

table td{
padding:10px;
border:1px solid #ddd;
}

/* EDITOR */

.toolbar{
background:#f1f1f1;
padding:10px;
border:1px solid #ccc;
}

.editor{
border:1px solid #ccc;
min-height:150px;
padding:10px;
font-size:18px;
}

</style>
</head>

<body>

<div class="topbar">
CEMP Course Dashboard
</div>

<div class="sidebar">

<button onclick="showPage('dashboard')">Dashboard</button>
<button onclick="showPage('analysis')">Content Analysis</button>
<button onclick="showPage('content')">Add Content</button>
<button onclick="showPage('users')">User Management</button>
<button onclick="showPage('reports')">Reports</button>
<button onclick="showPage('settings')">Settings</button>
<button onclick="logout()">Logout</button>

</div>

<div class="main">

<!-- DASHBOARD -->

<div id="dashboard" class="page">

<div class="cards">

<div class="card">Courses<br><b>12</b></div>
<div class="card">Students<br><b>340</b></div>
<div class="card">Lessons<br><b>85</b></div>
<div class="card">Completion<br><b>76%</b></div>

</div>

<div class="box">
<canvas id="barChart"></canvas>
</div>

<div class="box">
<canvas id="pieChart"></canvas>
</div>

<div class="box">
<canvas id="lineChart"></canvas>
</div>

</div>

<!-- CONTENT ANALYSIS -->

<div id="analysis" class="page">

<div class="box">

<h2>Content Analysis</h2>

<table id="analysisTable">

<tr>
<th>Topic</th>
<th>Sub Topic</th>
<th>Lesson</th>
<th>Views</th>
</tr>

</table>

</div>

</div>

<!-- ADD CONTENT -->

<div id="content" class="page">

<div class="box">

<h2>Add Course Content</h2>

<input id="topic" placeholder="Topic Name">

<input id="subtopic" placeholder="Sub Topic">

<input id="lesson" placeholder="Lesson Name">

<div class="toolbar">

<button onclick="boldText()">Bold</button>
<button onclick="colorText()">Color</button>
<button onclick="increaseFont()">A+</button>
<button onclick="decreaseFont()">A-</button>

</div>

<div id="editor" class="editor" contenteditable="true">
Write lesson content here...
</div>

<br>

<button class="action" onclick="saveContent()">Save Content</button>

</div>

</div>

<!-- USER MANAGEMENT -->

<div id="users" class="page">

<div class="box">

<h2>User Management</h2>

<input id="username" placeholder="User Name">

<input id="useremail" placeholder="User Email">

<select id="userrole">
<option>Student</option>
<option>Instructor</option>
<option>Admin</option>
</select>

<button class="action" onclick="addUser()">Add User</button>

<br><br>

<table id="userTable">

<tr>
<th>Name</th>
<th>Email</th>
<th>Role</th>
<th>Action</th>
</tr>

</table>

</div>

</div>

<!-- REPORTS -->

<div id="reports" class="page">

<div class="box">

<h2>Reports</h2>

<p>Total Courses: 12</p>
<p>Total Students: 340</p>
<p>Completion Rate: 76%</p>

</div>

</div>

<!-- SETTINGS -->

<div id="settings" class="page">

<div class="box">

<h2>Settings</h2>

<input placeholder="Platform Name">
<input placeholder="Admin Email">

<button class="action">Save Settings</button>

</div>

</div>

<!-- LOGOUT PAGE -->

<div id="logoutPage" class="page">

<div class="box">

<h2>You have been logged out</h2>

<button class="action" onclick="showPage('dashboard')">
Login Again
</button>

</div>

</div>

</div>

<script>

/* PAGE NAVIGATION */

function showPage(page){

var pages=document.querySelectorAll(".page");

pages.forEach(p=>p.style.display="none");

document.getElementById(page).style.display="block";

}

showPage("dashboard");

/* LOGOUT */

function logout(){

showPage("logoutPage");

}

/* EDITOR */

function boldText(){
document.execCommand("bold");
}

function colorText(){
var color=prompt("Enter color");
document.execCommand("foreColor",false,color);
}

function increaseFont(){
document.getElementById("editor").style.fontSize="26px";
}

function decreaseFont(){
document.getElementById("editor").style.fontSize="14px";
}

/* SAVE CONTENT */

function saveContent(){

var topic=document.getElementById("topic").value;
var sub=document.getElementById("subtopic").value;
var lesson=document.getElementById("lesson").value;

if(topic=="" || sub=="" || lesson==""){
alert("Fill all fields");
return;
}

var table=document.getElementById("analysisTable");

var row=table.insertRow();

row.insertCell(0).innerHTML=topic;
row.insertCell(1).innerHTML=sub;
row.insertCell(2).innerHTML=lesson;
row.insertCell(3).innerHTML=Math.floor(Math.random()*500);

alert("Content Saved");

document.getElementById("topic").value="";
document.getElementById("subtopic").value="";
document.getElementById("lesson").value="";
document.getElementById("editor").innerHTML="";

}

/* USER MANAGEMENT */

function addUser(){

var name=document.getElementById("username").value;
var email=document.getElementById("useremail").value;
var role=document.getElementById("userrole").value;

if(name=="" || email==""){
alert("Enter user details");
return;
}

var table=document.getElementById("userTable");

var row=table.insertRow();

row.insertCell(0).innerHTML=name;
row.insertCell(1).innerHTML=email;
row.insertCell(2).innerHTML=role;

row.insertCell(3).innerHTML=
"<button onclick='deleteUser(this)'>Delete</button>";

document.getElementById("username").value="";
document.getElementById("useremail").value="";

}

function deleteUser(btn){

var row=btn.parentNode.parentNode;
row.remove();

}

/* CHARTS */

new Chart(document.getElementById("barChart"),{
type:"bar",
data:{
labels:["HTML","CSS","JS","Python"],
datasets:[{
label:"Views",
data:[1200,900,1500,800]
}]
}
});

new Chart(document.getElementById("pieChart"),{
type:"pie",
data:{
labels:["Programming","Design","Marketing"],
datasets:[{
data:[50,30,20]
}]
}
});

new Chart(document.getElementById("lineChart"),{
type:"line",
data:{
labels:["Jan","Feb","Mar","Apr","May"],
datasets:[{
label:"Students",
data:[50,90,120,200,340]
}]
}
});

</script>

</body>
</html>