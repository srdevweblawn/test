<?php

/**
 * @author Debtanu
 * @copyright 2015
 */
 
// session start // 
session_start();
error_reporting(0);
date_default_timezone_set('Asia/kolkata');
$year = date("Y");

// include file //
include('constant.php');

 function db_conect()
 {
    
	$con=mysql_connect(SERVER_NAME,USER_NAME,PASSWORD)or die(mysql_error());
	mysql_select_db(DATABASE,$con)or die(mysql_error());

 }

function encryptIt( $q ) {
    $cryptKey  = CRYPTKEY;
    $qEncoded      = base64_encode( mcrypt_encrypt( MCRYPT_RIJNDAEL_256, md5( $cryptKey ), $q, MCRYPT_MODE_CBC, md5( md5( $cryptKey ) ) ) );
    return( $qEncoded );
}

function decryptIt( $q ) {
    $cryptKey  = CRYPTKEY;
    $qDecoded      = rtrim( mcrypt_decrypt( MCRYPT_RIJNDAEL_256, md5( $cryptKey ), base64_decode( $q ), MCRYPT_MODE_CBC, md5( md5( $cryptKey ) ) ), "\0");
    return( $qDecoded );
}

function login_check($user, $pass)
 {
    db_conect();
    //echo $user." ".$pass ;
    $sql = "select * from user where username='".$user."' and password='".$pass."' " ;
    
    $execute = mysql_query($sql) or mysql_error($sql);
    $result1 = mysql_fetch_object($execute);
    
    if($result1->id > 0)
    {
        $_SESSION['login_status']='yes';
        $_SESSION['login_id']=$result1->id;
        $_SESSION['login_email']=$result1->username;
        redirect('/');
    }
    else
    {
        $msg = "please check your Username and Password";
        return $msg ;
    }
 }
 
function register_check($user, $pass)
 {
    db_conect();
    //echo $user." ".$pass ;
    $sql = "select * from user where username='".$user."' " ;
    
    $execute = mysql_query($sql) or mysql_error($sql);
    $result1 = mysql_fetch_object($execute);
    
    if($result1->id > 0)
    {
        $msg = "registration not successfull try again";
        return $msg ;
        
    }
    else
    {
        $sql = "INSERT INTO user (username, password)VALUES ('".$user."', '".$pass."')";
        $execute = mysql_query($sql) or mysql_error($sql);
        $_SESSION['login_status']='yes';
        $_SESSION['login_id']=mysql_insert_id();
        redirect('/');
    }
    
 }

function book_cavallo($selected)
 {
    db_conect();
    $year = date("Y");
    $splits = explode(',',$selected);
    
    $tr='';
    foreach($splits as $split)
    {
        $single = explode('_',$split);
        $sql = "INSERT INTO cavallo.booking (user_id, year, week, type) VALUES ('".$_SESSION['login_id']."', '".$year."', '".$single[0]."', '".$single[1]."');";
        if($single[1] == 1){ $cavallo_type = "Cavallo 1"; }
        else if($single[1] == 2){ $cavallo_type = "Cavallo 2"; }
        else if($single[1] == 3){ $cavallo_type = "Cavallo Classic"; }
        $tr .= "<tr><td>".$single[0]."</td><td>".$cavallo_type."</td></tr>";
        $execute = mysql_query($sql) or mysql_error($sql);
    }
    
$to = $_SESSION['login_email'];
$subject = "Your Booking Details";
$message = "
<html>
<head>
<title>Your Booking Details</title>
</head>
<body>
<p>Your Booking Details</p>
<table>
<tr>
<td>Week</td>
<td>Cavallo Type</td>
</tr>
".$tr."
</table>
</body>
</html>
";
// Always set content-type when sending HTML email
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

// More headers
$headers .= 'From: Cavallo<admin@cavallo.com>' . "\r\n";

mail($to,$subject,$message,$headers);
        
        redirect('/');
  
 }
 
function forgot_check($forgot_username)
 {
    db_conect();
    //echo $user." ".$pass ;
    $sql = "select * from user where username='".$forgot_username."' " ;
    
    $execute = mysql_query($sql) or mysql_error($sql);
    $result1 = mysql_fetch_object($execute);
    
    if($result1->id > 0)
    { $code = time()."forgot".$result1->id."id".time();
    $encpt = encryptIt($code);
    $link = SITE_URL.'/?page=reset_pass&code='.$encpt;
    $to = $forgot_username;
$subject = "Forgot Password Link";

$message = "
<html>
<head>
<title>Forgot Password Link</title>
</head>
<body>
<p>Click on this link to reset password</p>
<table>
<tr>
<td>".$link."</td>
</tr>
</table>
</body>
</html>
";

// Always set content-type when sending HTML email
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

// More headers
$headers .= 'From: Cavallo<admin@cavallo.com>' . "\r\n";

mail($to,$subject,$message,$headers);
    
        $msg = "An email has been sent to your email id";
        return $msg ;
        //return $encpt."<br/>".$decpt;
        
    }
    else
    {
         $msg = "Email id not found";
        return $msg ;
    }
    
 }
 
function check_book($week,$type)
 {
    db_conect();
    $year = date("Y");
    //echo $user." ".$pass ;
    $sql = "SELECT * FROM booking WHERE year = '".$year."' and week = '".$week."' and type = '".$type."' " ;
    
    $execute = mysql_query($sql) or mysql_error($sql);
    $result1 = mysql_fetch_object($execute);
    if($result1->id > 0)
    {
        $msg = "yes";
    }
    else
    {
        $msg = "no";
    }
    return $msg ;
    
 }
 
function logout()
{
    session_unset();
}

function redirect($path)
{
    ob_start();
    header('Location: '.SITE_URL.$path);
    ob_end_flush();
    die();
}

 function rest_pass($code,$new_pass)
 {
    db_conect();
    $decpt = decryptIt($code);
    $decpt = explode('forgot',$decpt);
    
    $decpt1 = explode('id',$decpt[1]);
    $id = $decpt1[0];
    
    
    if($id > 0 )
    {
        $sql = "UPDATE user SET password='".$new_pass."' WHERE id='".$id."'" ;
        $execute = mysql_query($sql) or mysql_error($sql);
        
        $msg = "Password reset successfully";
        
    }
    else
    {
        $msg = "Something going wrong please try again";
    }
    return $msg ;
    
 }




















//echo encryptIt('admin');















?>