<?php
$work =$projectname = $email=$website=$budget=$description ="";
$nameErr = $emailErr = "";
$link = new mysqli("localhost","root","","mydb1");
if ($link === false)
{
	die("couldn't connect ".$link->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $work = test_input($_POST["work"]);

    if(empty($_POST["projectname"]))
    {
      $nameErr = "Name is required";
    }
	else{
     $projectname = test_input($_POST["projectname"]);
	// check if name only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z-' ]*$/",$projectname)) {
      $nameErr = "Only letters and white space allowed";
	 }
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

  $website = test_input($_POST["website"]);
  $budget = test_input($_POST["budget"]);
  $description = test_input($_POST["desc"]);


if($projectname!="" && $email!=""){
$sql = "INSERT INTO hiringtable VALUES ('$work','$projectname','$email','$website','$budget','$description');";

if(mysqli_query($link,$sql)=== true){
header("Location:afterregistration.html");
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
