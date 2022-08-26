<?php
$jobtype =$gen=$fname = $lname=$contact=$email=$address ="";
$nameErr = $emailErr = $fnameErr = $lnameErr= $contactErr=$addressErr="";

$link = new mysqli("localhost","root","","mydb1");
if ($link === false)
{
	die("couldn't connect ".$link->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $jobtype = test_input($_POST["jobtype"]);
    $gen = test_input($_POST["gender"]);

    if(empty($_POST["firstname"]))
    {
      $fnameErr = "firstname is required";
    }
	else{
     $fname = test_input($_POST["firstname"]);
	// check if name only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z-' ]*$/",$fname)) {
      $fnameErr = "Only letters and white space allowed";
	 }
  }

  if(empty($_POST["lastname"]))
  {
    $lnameErr = "lastname is required";
  }
else{
   $lname = test_input($_POST["lastname"]);
// check if name only contains letters and whitespace
  if (!preg_match("/^[a-zA-Z-' ]*$/",$lname)) {
    $lnameErr = "Only letters and white space allowed";
 }
}
if(empty($_POST["contact"]))
{
  $contactErr = "contact is required";
}
else{
 $contact = test_input($_POST["contact"]);
}


  if (empty($_POST["email"])) {
    $emailErr = "Email is required";
  } else {
    $email = test_input($_POST["email"]);
    // check if e-mail address is well-formed
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $emailErr = "Invalid email format";
    }
  }

  $address = test_input($_POST["address"]);


if($fname!="" && $lname!="" &&$contact!=""&& $email!="" && $address!=""){
$sql = "INSERT INTO worktable VALUES ('$jobtype','$gen','$fname','$lname','$contact','$email','$address');";

if(mysqli_query($link,$sql)=== true){
header("Location:afterregistration2.html");
}
else
echo "There was an error";
}
}
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>
