<?php
ob_start();
// define variables and set to empty values
$nameErr = $pwdErr = "";
$Name = $pwd = "";
$link = new mysqli("localhost","root","","mydb1");
if ($link === false)
{
	die("couldn't connect ".$link->connect_error);
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if(!empty($_POST["name1"]))
   $Name = $_POST["name1"];

   if(!empty($_POST["password"]))
	   $pwd = $_POST["password"];
}


	   $sql = "SELECT * FROM registrationtable WHERE NAME = '$Name' AND PASSWORD='$pwd';";

$result = mysqli_query($link,$sql);
        if (mysqli_num_rows($result) === 1) {

            $row = mysqli_fetch_assoc($result);

            if ($row['NAME'] === $Name && $row['PASSWORD'] === $pwd) {
				session_start();

                $_SESSION['NAME'] = $row['NAME'];

				header("Location:home.php");
				exit();
            }else{

                echo " HIIIIII !Incorrect User name or password";
            }
        }else{

            echo " Hello!!!!!Incorrect User name or password";
        }


?>
