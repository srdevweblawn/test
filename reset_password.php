<?php 
$code = $_REQUEST['code'];
$new_pass = $_POST['new_pass'];
$con_pass = $_POST['con_pass'];
if(!empty($code) && !empty($new_pass) && !empty($con_pass) && $new_pass == $con_pass )
{
    $msg_forgot = rest_pass($code,$new_pass);
}
else
{
   $msg_reset = "Confirm Password does not match"; 
}

include('header.php');
?>
<body>

<table style="width: 320px">
				<tbody><tr>
								<td class="style2" colspan="4">
								<img alt="" src="images/FORZABLOGO_150.gif" width="150" height="75"><br>
								<br>
								Revision date:
								<!--webbot bot="Timestamp" S-Type="EDITED" S-Format="%Y-%m-%d" startspan -->2015-09-01<!--webbot bot="Timestamp" i-checksum="12576" endspan --></td>
				</tr>
				<tr>
                <form method="post">
                    <table >
                    <tr><th colspan="2">Reset Password </th></tr>
                    <tr><th colspan="2"><?php echo $msg_reset; ?></th></tr>
                        <tr><td>New Password</td><td><input type="password" placeholder="*****" name="new_pass" id="new_pass" value="" required="required"/></td></tr>
                         <tr><td>Confirm Password</td><td><input type="password" placeholder="*****" name="con_pass" id="con_pass" value="" required="required"/></td></tr>   
                        <tr><td colspan="2"><input type="submit" name="submit" value="Submit"/></td></tr>
                    </table>
                </form>
                </tr>
                
                
				
</tbody></table>




</body></html>