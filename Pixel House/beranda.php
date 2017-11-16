<?php 


session_start();
if(!$_SESSION['loggedInUser']){
    header("location: index.php");
    }

$loggedInUser = $_SESSION['loggedInUser'];
$email = $_SESSION['loggedInEmail'];

include('asset/connect.php');

function validateFormData( $formData){
            $formData = trim( stripslashes( htmlspecialchars( $formData ) ) );
            return $formData;
        }

//updateStatus
if(isset($_POST['updateStatus'])){
    
    $username   =   $_SESSION['loggedInUser'];
    $email      =   $_SESSION['loggedInEmail'];
    $status     =   validateFormData($_POST["status"]);
    
    
    $query  =   "INSERT INTO status (user,email,status,time) VALUES ('$username','$email','$status',now())";
    
    if(mysqli_query($conn, $query)){
                echo "";
                
        }else {
//                echo "ERROR: ".$query."<br>".mysqli_error($conn);
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
      <link rel="stylesheet" type="text/css" href="asset/beranda.css">

 

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
              <p>Hi <?php echo $loggedInUser; ?> !</p>
              <a href="profile.php">Profile</a>
              <a href="logout.php">Logout</a>
          </div>
          
          <div class="updateStatus">
              <form class="updateForm" id="updateForm" name="updateForm" action="<?php echo htmlspecialchars( $_SERVER["PHP_SELF"]);?>" method="post">
                  <input required class="status" name="status" type="text" placeholder="Update Status . . ">
                  <input name="updateStatus" class="submit" type="submit" value="Update">
              </form>
          </div>
          <div class="clearfix"></div>
          
          <div class="status">

          </div>
      </div>

    
      

    
      
    <script src="asset/jQuery.js"></script>  
  </body>
</html>

  <script>
      
  $(document).ready(function(){
      
      fetch_data();
      
      function fetch_data()
 {
  var action = "fetch";
     var loggedInUser= "<?php echo $loggedInUser; ?>";
     var loggedInEmail= "<?php echo $email; ?>";
  $.ajax({
   url:"berandaAction.php",
   method:"POST",
   data:{actions:action,loggedInUser:loggedInUser,loggedInEmail:loggedInEmail},
   success:function(data)
   {    
//       var obj = jQuery.parseJSON(data)
       $('.status').html(data);
   }
  })
 }
      
      
      
  });
      
</script>