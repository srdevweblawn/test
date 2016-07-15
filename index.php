<?php

/**
 * @author Debtanu
 * @copyright 2015
 */
// include file //
include('function.php');

if($_SESSION['login_status']=='yes'){
    
    $action=$_REQUEST['page'];
    //echo $action ;
    switch($action){
        case ''                 :include('dashboard.php');
                    break;
                    
        case 'logout'           :logout();
                                 redirect('/');   
                    break;
        
        case 'reset_pass' :include('reset_password.php');
                    break;
                                                    
        default                 :include('dashboard.php');
                    break;
    }
}
else
{
    $action=$_REQUEST['page'];
    switch($action){
        
        case 'forgotpass'       :include('forgot_password.php');
                    break;
        
        case 'reset_pass_value' :include('reset_password.php');
                    break;
                                                    
        default                 :include('login.php');
                    break;
    }
    
}

?>