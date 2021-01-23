<?php
    $title = "Email Confirmation";
    include_once 'header.php';
    include_once 'navbar_header.php';
    
    $confirm_code = $_REQUEST['confirm_code'];
    
    
    include_once 'db_info.php';
    $q = "SELECT * FROM user WHERE statekey = '$confirm_code'";

    $result = mysqli_query($db_conn,$q);
    $count = mysqli_num_rows($result);
    
    if(0<$count)
    {
        @mysqli_query($db_conn,"UPDATE `user` SET status = '1', statekey = '0' WHERE statekey = '$confirm_code'");
        echo '<h4 class="text-center">Thank You! Registration succussfully completed. Click here to <a href="https://www.bccfalna.com/rm/OMS/login_form.php">Login</a></h4>';
    }
    
    else
        echo '<h4 class="text-center">Username does not match.</h4>';
    @mysqli_close($db_conn);
    
    include_once 'navbar_footer.php';
    include_once 'footer.php';
?>