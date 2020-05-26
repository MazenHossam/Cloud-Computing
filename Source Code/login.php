<?php
    
    $email=$password;

  if ($_SERVER["REQUEST_METHOD"] == "POST")
   {
        $email=sign_in($_POST["Email"]);
        $password=sign_in($_POST["Password"]);
        // Create connection
        $conn=new mysqli('db-project-ins.cmrbjxuapvqg.us-east-1.rds.amazonaws.com', 'admin', '123qwerty', 'iCenter');
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        } 

        $sql = "SELECT user_pass , user_name FROM iCenter.users WHERE user_email = '$email'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {

            $row = $result->fetch_assoc();

            $pass = $row["user_pass"];
            	
            if($pass==$password)
            {
              $conn=@mysqli_connect('db-project-ins.cmrbjxuapvqg.us-east-1.rds.amazonaws.com', 'admin', '123qwerty', 'iCenter');// connection to insert data

              if ($conn->connect_error ) {
                  die("Connection failed: " . $conn->connect_error);
              }
              
              $sql = "UPDATE iCenter.users SET user_online ='1' WHERE user_email='$email'";

				
				$Name = $row["user_name"];
				
              if ($conn->query($sql) === TRUE)
              {
				  include 'home.html';
					echo '<script language="javascript">';
					echo 'alert(" Welcome ' .$Name. '")';
					echo '</script>';
				  
				  
              }
            }
            else
            {
				include 'login.html';
				   echo '<script language="javascript">';
					echo 'alert("Invalid login info.")';
					echo '</script>';
			}

        } else {
            include 'login.html';
				   echo '<script language="javascript">';
					echo 'alert("E-mail doesnt exist.")';
					echo '</script>';
        }

        $conn->close();
    }

      function sign_in($data)
      {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
      }
 ?>
