<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $username = $_POST["username"];
  $password = $_POST["password"];

  // Connect to the database
  $servername = "localhost";
  $dbusername = "root";
  $dbpassword = "";
  $dbname = "ds_erp";
  $conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

  // Check connection
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

  // Check if username and password are valid
  $sql = "SELECT * FROM login WHERE username='$username' AND password='$password'";
  $result = $conn->query($sql);

  if ($result->num_rows == 1) {
    // Authentication succeeded
    $_SESSION["username"] = $username;
    header("Location: dash.php");
    exit();
  } else {
    // Authentication failed
    echo "<script>alert('Invalid username or password');</script>";
  }
  $conn->close();
}
?>

<html>
<head>
	<title>Login Page</title>
	<script>
        function showError(message) {
        document.getElementById("error-message").innerHTML = message;
        document.getElementById("overlay").style.display = "block";
}

        function closePopup() {
        document.getElementById("overlay").style.display = "none";
        }

    </script>
    <style>
        header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 20px;
  background-color: #2c3e50;
  color: #fff;
}
        * {
	margin: 0;
	padding: 0;
	box-sizing: border-box;
}

body {
	background-color: #222;
	font-family: sans-serif;
}

.login-box {
	width: 280px;
	position: absolute;
	top: 50%;
	left: 50%;
	transform: translate(-50%, -50%);
	color: white;
}

.login-box h2 {
	text-align: center;
	margin-bottom: 40px;
}

.user-box {
	position: relative;
}

.user-box input {
	width: 100%;
	padding: 10px 0;
	font-size: 16px;
	color: white;
	margin-bottom: 30px;
	border: none;
	border-bottom: 1px solid white;
	outline: none;
	background: transparent;
}

.user-box label {
	position: absolute;
	top: 0;
	left: 0;
	color: white;
	font-size: 16px;
	padding: 10px 0;
	pointer-events: none;
	transition: 0.5s;
}

.user-box input:focus ~ label,
.user-box input:valid ~ label {
	top: -20px;
	left: 0;
	color: #03a9f4;
	font-size: 12px;
}

input[type="submit"] {
	background: transparent;
	border: none;
	outline: none;
	color: white;
	background: #03a9f4;
	padding: 10px 20px;
	cursor: pointer;
	border-radius: 5px;
}

.popup {
	display: none;
	position: fixed;
	z-index: 1;
	left: 0;
	top: 0;
	width: 100%;
	height: 100%;
	overflow: auto;
	background-color: rgba(0,0,0,0.4);
}

.popup-content {
	background-color: white;
	margin: 15% auto;
	padding: 20px;
	border: 1px solid #888;
	width: 50%;
}

.close {
	color: #aaaaaa;
	float: right;
	font-size: 28px;
	font-weight: bold;
}

.close:hover {
	color: #000;
	cursor: pointer;
}
nav ul {
  list-style: none;
  display: flex;
}

nav li {
  margin-right: 20px;
}

nav a {
  color: #fff;
  text-decoration: none;
  transition: all 0.3s ease-in-out;
}

nav a:hover {
  color: #e67e22;
}

    </style>
</head>
<body>
<header>
      <div class="logo">
        <h1>Prime Bank</h1>
      </div>
      <nav>
        <ul>
          <li><a href="index.html">Home</a></li>
          <li><a href="about-us.html">About</a></li>
          <li><a href="login.php">Services</a></li>
          <li><a href="contact-us.html">Contact</a></li>
        </ul>
      </nav>
    </header>
	<div class="login-box">
		<h2>Login Here</h2>
		<form method="post" action="login.php">
			<div class="user-box">
				<input type="text" name="username" required="">
				<label>Username</label>
			</div>
			<div class="user-box">
				<input type="password" name="password" required="">
				<label>Password</label>
			</div>
			<input type="submit" value="Login">
		</form>
	</div>
	<div class="popup" id="errorPopup">
		<div class="popup-content">
			<span class="close" onclick="hideError()">&times;</span>
			<p id="errorMessage"></p>
		</div>
	</div>
</body>
</html>
