<?php include "../inc/dbinfo.inc"; ?>
<?php

$connection = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD);
if (mysqli_connect_errno()) echo "Failed to connect to MySQL: " . mysqli_connect_error();
$database = mysqli_select_db($connection, DB_DATABASE);

$user_name = htmlentities($_POST['Name']);
  $user_pass = htmlentities($_POST['Password']);
  $user_email = htmlentities($_POST['Email']);

  if (strlen($user_name) || strlen($user_pass) || strlen($user_email)) {
    AddUSER($connection, $user_name, $user_pass, $user_email);
  }
  
function AddUser($connection, $name, $pass,$email) {
   $n = mysqli_real_escape_string($connection, $name);
   $p = mysqli_real_escape_string($connection, $pass);
   $e = mysqli_real_escape_string($connection, $email);

   $query = "INSERT INTO iCenter.users (user_name, user_pass, user_email) VALUES ('$n', '$p', '$e');";

   if(!mysqli_query($connection, $query)) echo("<p>Error adding user data.</p>");
   else include 'home.html';
}
?>