<?php 
session_start();

if(!$_SESSION['loggedInUser']){
    header("location: index.php");
    }

include('asset/connect.php');

$email = $_SESSION['loggedInEmail'];
$userLogin = $_SESSION['loggedInUser'];


//load foto
$loadFotoQuery  =   "SELECT foto FROM user where email='$email'";

$loadResult = mysqli_query($conn, $loadFotoQuery);
        
        $fotoResult = mysqli_fetch_array($loadResult); 
        
        $fotoBaru  = $fotoResult['foto']; 
        

//upload foto baru
if(isset($_POST['uploadFoto'])){
    $foto = $_FILES['file']['name'];
    $foto_tmp = $_FILES['file']['tmp_name'];
    
    move_uploaded_file($foto_tmp,"asset/img/$foto");
    
    $insert_foto = "UPDATE user SET foto='$foto' WHERE email='$email'";
    
    $insert_foto = mysqli_query($conn,$insert_foto);
    
    if($insert_foto){
        echo "<script>alert('new foto Uploaded!')</script>";
        echo "<script>window.open('profile.php','_self')</script>";
    }
    
    }//upload foto

//edit data
if(isset($_POST['updateProfile'])){
    
    $name = $_POST["name"];
    $tempPassword=  $_POST["password"];
    $password = password_hash($tempPassword, PASSWORD_DEFAULT);
    
    
    $updateQuery = "UPDATE user 
                SET name='$name',
                password='$password'
                WHERE email='$prevEmail'";
    $editProfile = mysqli_query($conn, $updateQuery);
    
    
    
    if($editProfile){
        //load prev data
        $prevQuery = "SELECT * FROM user WHERE email='$email' ";
    $prevResult= mysqli_query($conn,$prevQuery);
    
    while ($row = mysqli_fetch_assoc($prevResult)){
        $prevName = $row['name'];
        $prevEmail= $row['email'];
    }
        
        $updateQueryStatus = "UPDATE status 
                SET user ='$name',
                    email='$email'
                WHERE email='$prevEmail'";
    
    $editProfileStatus = mysqli_query($conn, $updateQueryStatus);
        
        echo "<script>alert('Profile Updated Successfully')</script>";
        echo "<script>window.open('profile.php','_self')</script>";
        
        //create new session data
        session_start();
            
            //store data in session variable
            $_SESSION['loggedInUser'] = $name;
            $_SESSION['loggedInEmail'] = $email;
            
        
    }
    
}

//load data profile to preview
$loadQuery = "SELECT * FROM user WHERE email = '$email'";
$loadResult = mysqli_query($conn, $loadQuery);

while($row = mysqli_fetch_assoc($loadResult)){
    $updateName = $row['name'];
    $password=$row["password"];
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
      <link rel="stylesheet" type="text/css" href="asset/profile.css">

 

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
              <a href="beranda.php">Beranda</a>
              <a href="logout.php">Logout</a>
          </div>
          
          <div class="updateProfil">
              <div class="uploadFoto">
                  <div class="foto">
                      <img src="<?php echo "asset/img/$fotoBaru"; ?>">
                  </div>
                  <form id="" class="upload" action="profile.php" method="post" enctype="multipart/form-data">
                      <input type="file" name="file" id="file" class="inputfile" />
                      <label class="uploadButton" for="file">Upload</label>
                      <input type="submit" name="uploadFoto" id="uploadFoto">
                  </form>
              </div>
                
          
          <div class="updateData">
              <form method="post" class="formUpdateData">
                  <input name="name" type="text" value="<?php echo $userLogin; ?>">
                  <input name="email" type="email"  value="<?php echo $email; ?>" readonly>
                  <input name="password" type="password" value="<?php echo $password; ?>">
                  <input name="updateProfile" id="updateProfile" class="save" type="submit" value="Save">
              </form>
          </div>
              
        </div>      
          
         
      </div>

    
      

    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="asset/bootstrap/js/bootstrap.min.js"></script>
      
    <script src="asset/script/myScript.js"></script>  
      <script src="asset/jQuery.js"></script>
  </body>
</html>

<script>
    
    $(document).ready(function(){
        

        $('#file').change(function(){
            $('#uploadFoto').trigger('click');
        });
   
        
    });/*document ready*/
    
    
    
    
</script>