<?php

 include('asset/connect.php');

function validateFormData( $formData){
            $formData = trim( stripslashes( htmlspecialchars( $formData ) ) );
            return $formData;
        }

//REGISTER
if(isset($_POST["register"])){    
    
    $name = validateFormData($_POST["name"]);
    $email = validateFormData($_POST["email"]);
    $tempPassword = validateFormData( $_POST["password"]);
    $password = password_hash($tempPassword, PASSWORD_DEFAULT);
    
    
    //check double email
    $loadQuery = "SELECT * FROM user WHERE email = '$email'";
    
    $result = mysqli_query($conn, $loadQuery);
    
    if(mysqli_num_rows($result)>0){
        echo "<p class='alertError'>Your email is already registered! Please Login.</p>";
    }else {
        $query = "INSERT INTO user (name,email,password) VALUES ('$name','$email','$password')";
    }
    
    
    if(mysqli_query($conn, $query)){
        
        $queryStatus = "INSERT INTO status (email,user) VALUES ('$email','$name')";
        mysqli_query($conn, $queryStatus);
        
                echo "<p class='alertSuccess'>New Account has been registered. Continue Login</p>";
        }else {
//                echo "ERROR: ".$query."<br>".mysqli_error($conn);
            }   
    mysqli_close($conn);
}



if(isset($_POST['login'])){
    
    $email  = validateFormData($_POST['email']);
    $password  = validateFormData($_POST['password']);
    
    
    //create SQL Query
    $loginQuery = "SELECT * FROM user WHERE email = '$email'"; 
    
    $result = mysqli_query($conn, $loginQuery);
    
    if(mysqli_num_rows($result) > 0){
        
        while($row = mysqli_fetch_assoc($result)){
            $name       = $row['name'];
            $email      = $row['email'];
            $hashedPass = $row['password'];
            
            
        }
        if(password_verify($password, $hashedPass)){
           
            //start session  
            session_start();
            
            //store data in session variable
            $_SESSION['loggedInUser'] = $name;
            $_SESSION['loggedInEmail'] = $email;
            
            header("Location: beranda.php");
        }else //wrong login
            
            //Error message
            echo "<p class='alertError'>Wrong Email & password combination</p>";
        
    }else{ // when data is not found
        echo "<p class='alertError'>Your email not found. Please Register your email</p>";
    }
      
    mysqli_close($conn);
}


?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
      
    <title>Twitter Application</title>
      <link rel="shortcut icon" type="image/x-icon" href="asset/img/myicon.png" />
      <link rel="stylesheet" type="text/css" href="asset/index.css">

 

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
      
    


  </head>
    
    
  <body>
    
      <div class="mainContainer">
          <div class="headLine">
              <h2>Twitter Application</h2>
              
          </div>
          
          <div class="loginForm">
              <h3 align=center>LOGIN</h3>
              <form id="loginForm" name="loginForm" action="<?php echo htmlspecialchars( $_SERVER["PHP_SELF"]);?>" method="post">
                  <input required name="email" class="email" type="email" placeholder="Email">
                  <input required name="password" class="password" type="password" placeholder="Password">
                  <input name="login" class="submit" type="submit" value="Login">
              </form>
          </div>
          <hr class="line">
          <div class="registerForm">
              <h3 align=center>REGISTER</h3>
              <form id="registerForm" name="registerForm" action="<?php echo htmlspecialchars( $_SERVER["PHP_SELF"]);?>" method="post">
                  <input required class="email" name="email" type="email" placeholder="Email">
                  <input required class="name" name="name" type="text" placeholder="Name">
                  <input required class="password" name="password" type="password" placeholder="Password">
                  <input name="register" class="submit" type="submit" value="Register">
              </form>
          </div>
      </div>

    
      

    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="asset/bootstrap/js/bootstrap.min.js"></script>
      
    <script src="asset/script/myScript.js"></script>  
  </body>
</html>