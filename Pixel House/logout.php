<?php

    //did users browser send cookies for the session?????
    if(isset ($_COOKIE[session_name() ] ) ) {
        
        //empty the cookie
        setcookie(session_name(),'',time()-86400, '/');
    }



    //clear all session variable
    session_unset();

    //destroy the session
    session_destroy();

    echo "you've been logged out";

    echo "<p><a href='index.php'>Login Again</a></p>" ;

?>
