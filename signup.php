
<?php
//Registeration form with validation
// define variables and set to empty values
$nameErr = $emailErr = $mobileErr = $addressErr = $pwdErr = "";
$name = $email = $mobile_no = $address = $password = "";

$link = new mysqli("localhost","root","","mydb1");
if ($link === false)
{
	die("couldn't connect ".$link->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["Name"])) {
    $nameErr = "Name is required";
  }
  else
  {
    $name = test_input($_POST["Name"]);
    if(strlen($_POST["Name"])<4)
    $nameErr = "Username should be atleast 4 characters long";
	else{
	// check if name only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z-' ]*$/",$name)) {
      $nameErr = "Only letters and white space allowed";
	 }
  }}

  if (empty($_POST["email"])) {
    $emailErr = "Email is required";
  } else {
    $email = test_input($_POST["email"]);
    // check if e-mail address is well-formed
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $emailErr = "Invalid email format";
    }
  }

  if (empty($_POST["phn"])) {
    $mobileErr = "Mobile number is required";
  } else {
    $mobile_no = test_input($_POST["phn"]);
  }

	 if(empty($_POST["psw"])){
    $pwdErr = "password required";
  }
  else{
  $password = test_input($_POST["psw"]);
  $number = preg_match('@[0-9]@', $password);
  $uppercase = preg_match('@[A-Z]@', $password);
  $lowercase = preg_match('@[a-z]@', $password);
  $specialChars = preg_match('@[^\w]@', $password);

      if(strlen($password) < 8 || !$number || !$uppercase || !$lowercase || !$specialChars) {
       $pwdErr = "Password must be at least 8 characters in length and must contain at least one number, one upper case letter, one lower case letter and one special character.";
  }
  }


if($name!="" && $email!="" && $mobile_no!="" && $password !=""){
$sql = "INSERT INTO registrationtable VALUES ('$name','$email','$password','$mobile_no');";

session_start();
$_SESSION['NAME'] = $name;
if(mysqli_query($link,$sql)=== true){
header("Location:home.php");
}
else
echo "<script>There was an error</script>";
}
}
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}


?>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
body {
  font-family: Arial, Helvetica, sans-serif;
  background-color: #019267;
}

* {
  box-sizing: border-box;
}

/* Add padding to containers */
.container {
  padding: 16px;
  background-color: white;
}

/* Full-width input fields */
input[type=text], input[type=password], input[type=number] {
  width: 100%;
  padding: 15px;
  margin: 5px 0 22px 0;
  display: inline-block;
  border: none;
  background: #f1f1f1;
}

input[type=text]:focus, input[type=password]:focus input[type=number]:focus {
  background-color: #ddd;
  outline: none;
}

/* Overwrite default styles of hr */
hr {
  border: 1px solid #f1f1f1;
  margin-bottom: 25px;
}

/* Set a style for the submit button */
.registerbtn {
  background-color: #019267;
  color: white;
  padding: 16px 20px;
  margin: 8px 0;
  border: none;
  cursor: pointer;
  width: 100%;
  opacity: 0.9;
}

.registerbtn:hover {
  opacity: 1;
}

/* Add a blue text color to links */
a {
  color: dodgerblue;
}

/* Set a grey background color and center the text of the "sign in" section */
.signin {
  background-color: #f1f1f1;
  text-align: center;
}
input[type=text], input[type=password] ,input[type=number] {
  width: 100%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  box-sizing: border-box;
}

/* Set a style for all buttons */
button {
  background-color: #019267;
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  cursor: pointer;
  width: 100%;
}

button:hover {
  opacity: 0.8;
}

/* Extra styles for the cancel button */
.cancelbtn {
  width: auto;
  padding: 10px 18px;
  background-color: #f44336;
}

/* Center the image and position the close button */
.imgcontainer {
  text-align: center;
  margin: 24px 0 12px 0;
  position: relative;
}

img.avatar {
  width: 10%;
  border-radius:20%;
}

.container {
  padding: 16px;
}

span.psw {
  float: right;
  padding-top: 16px;
}

/* The Modal (background) */
.modal {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
  padding-top: 60px;
}

/* Modal Content/Box */
.modal-content {
  background-color: #fefefe;
  margin: 5% auto 15% auto; /* 5% from the top, 15% from the bottom and centered */
  border: 1px solid #888;
  width: 80%; /* Could be more or less, depending on screen size */
}

/* The Close Button (x) */
.close {
  position: absolute;
  right: 25px;
  top: 0;
  color: #000;
  font-size: 35px;
  font-weight: bold;
}

.close:hover,
.close:focus {
  color: red;
  cursor: pointer;
}

/* Add Zoom Animation */
.animate {
  -webkit-animation: animatezoom 0.6s;
  animation: animatezoom 0.6s
}

@-webkit-keyframes animatezoom {
  from {-webkit-transform: scale(0)}
  to {-webkit-transform: scale(1)}
}

@keyframes animatezoom {
  from {transform: scale(0)}
  to {transform: scale(1)}
}

/* Change styles for span and cancel button on extra small screens */
@media screen and (max-width: 300px) {
  span.psw {
     display: block;
     float: none;
  }
  .cancelbtn {
     width: 100%;
  }
}
</style>
</head>
<body>

<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method = "post">
  <div class="container">
    <center><h1 style= "font-family:Arial">REGISTER</h1>
    <p style= "font-family:papyrus">Please fill in to create an account and take a step ahead with our community!</p></center>
    <hr>

	<label for="Name"><b>Name</b></label><span class="error">* <?php echo $nameErr;?></span>
    <input type="text" placeholder="Enter Name" name="Name" id="Name" required minlength = "4">

    <label for="email"><b>Email</b></label><span class="error">* <?php echo $emailErr;?></span>
    <input type="text" placeholder="Enter Email" name="email" id="email" required >

    <label for="psw"><b>Password</b></label><span class="error">* <?php echo $pwdErr;?></span>
    <input type="password" placeholder="Enter Password" name="psw" id="psw" required>

    <label for="psw-repeat"><b>Confirm Password</b></label><span class="error">* <?php echo $pwdErr;?></span>
    <input type="password" placeholder="Confirm Password" name="psw-repeat" id="psw-repeat" required>

	<label for="phn"><b>Mobile Number</b></label><span class="error">* <?php echo $mobileErr;?></span>
    <input type="number" placeholder="Enter Phone Number" name="phn" id="phn" required minlength = "10">
    <hr>



   <button type="submit" class="registerbtn">Register</button>
  </div>
</form>

  <!-- <div class="container signin">
    <p>Already have an account?</p>
	<button onclick="document.getElementById('id01').style.display='block'" style="width:auto;">Login</button>

<div id="id01" class="modal">

  <form class="modal-content animate" action="action_page.php" method="post">
    <div class="imgcontainer">
      <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
      <img src="file:///C:/Users/HP/Pictures/teammember_whoarewe_1635191851-modified.png" alt="Avatar" class="avatar">
    </div>

    <div class="container">
      <label for="email"><b>Email</b></label>
      <input type="text" placeholder="Enter Email" name="email" required>

      <label for="psw"><b>Password</b></label>
      <input type="password" placeholder="Enter Password" name="psw" required>

      <a href = "#"><button type="submit">Login</button></a>
      <label>
        <input type="checkbox" checked="checked" name="remember"> Remember me
      </label>
    </div>

    <div class="container" style="background-color:#f1f1f1">
	&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp



      <button type="button" onclick="document.getElementById('id01').style.display='none'" class="cancelbtn">Cancel</button>
      <span class="psw">Forgot <a href="#">password?</a></span>
    </div>
  </form>
</div>
-->
<script>
// Get the modal
var modal = document.getElementById('id01');

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
</script>
  </div>
</body>
</html>
