<html>
<head>
<title> Search </title>
<link rel="stylesheet" href="css/styles.css">
</head>

<body>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" style="width:50%; text-align:center; margin-left:27%; margin-top:5%;">
<h1>Select the type of job to be searched:</h1><br><br>
<select class="work" name="work">
  <option value="----">----</option>
  <option value="Convenience store">Convenience store</option>
  <option value="barista">Barista</option>
  <option value="typingjob">typing job</option>
  <option value="paid survey jobs">Paid survey Jobs</option>
  <option value="online advertising">Online Advertising</option>
  <option value="voice recognition">Voice Recognition</option>
  <option value="spreadsheet entry">Spreadsheet Entry</option>
  <option value="powerpoint presentation">Powerpoint Presentation</option>
  <option value="language translation">Language Translation</option>
  <option value="online graphic">Online Graphic</option>
</select><br><br>
<button type="submit" name="submit" class=" button button1" >Search</button><br><br>
<a href="home.php" ><button type="button" name="button" class=" button button1">click to return to homepage </button> </a><br><br>


<?php

// define variables and set to empty values

$Name = "";
$link = new mysqli("localhost","root","","mydb1");
if ($link === false)
{
	die("couldn't connect ".$link->connect_error);
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {

$Name = test_input($_POST["work"]);

$sql = "SELECT * FROM worktable WHERE TYPE = '$Name';";
$result = mysqli_query($link,$sql);
$row = mysqli_fetch_assoc($result);

if (mysqli_num_rows($result) > 0) {
  // output data of each row
  echo "The details are:-<br>";
  while($row = mysqli_fetch_assoc($result)) {
    echo "<br>First Name: " . $row["FIRSTNAME"]."<br>Last Name: ".$row["LASTNAME"]."<br />Gender: ".$row["GENDER"]."<br>Mobile_no: ".$row["CONTACT"]." <br>email: " . $row["EMAIL"]."<br />Address: ".$row["ADDRESS"] ."<br><br>";
  }
} else {
  echo "0 results";
}
}
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>
</form>
</body>
</html>
