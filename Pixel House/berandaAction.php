<?php 


include('asset/connect.php'); 


if($_POST["actions"] == "fetch"){
    
    $loggedInUser = $_POST["loggedInUser"];
    $loggedInEmail= $_POST["loggedInEmail"];
    $query  =   "SELECT * FROM status Order BY time DESC";
    
    $result = mysqli_query($conn,$query);
    
    while($row = mysqli_fetch_assoc($result)){
        $email = $row["email"];
        $status=  $row["status"];
        $name   =   $row["user"];
        
        if($status == ''){
            echo "";
        }else{
            if($loggedInEmail !== $email){
            
            $queryFoto  = "SELECT foto FROM user WHERE email = '$email' ";
    
            $fotoResult = mysqli_query($conn,$queryFoto);
            
            $row = mysqli_fetch_assoc($fotoResult);
                $foto = $row['foto'];
                        
            
            echo "<div class='statusTeman statusWrapper'>
                  <div class='foto'>
                      <img src='asset/img/$foto' class='fotoProfil'>
                  </div>
                  <div class='isiStatus'>
                      <h3 class='loginName'>$name</h3>
                      <p class='userStatus'>$status</p>
                  </div>
              </div>";
        }else{
            
            //loadfoto
            $queryFoto  =   "SELECT foto FROM user WHERE email = '$email' ";
    
            $fotoResult = mysqli_query($conn,$queryFoto);
            
            $row = mysqli_fetch_assoc($fotoResult);
                $foto = $row['foto'];
            
            
            echo "<div class='myStatus statusWrapper'>
                  <div class='myFoto'>
                      <img src='asset/img/$foto' class='fotoProfil'>
                  </div>
                  <div class='isiStatus'>
                      <h3 class='loginName'>$name</h3>
                      <p class='userStatus'>$status</p>
                  </div>
              </div>";
            
        }
        }
        
            
    }
//    echo json_encode($status);
    
    
}
?>