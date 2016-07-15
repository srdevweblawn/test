<?php 
$log_username = $_POST['log_username'];
$log_password = $_POST['log_password']; 
$reg_username = $_POST['reg_username'];
$reg_password = $_POST['reg_password']; 
//echo $username." ".$password ;
if(!empty($log_username) && !empty($log_password))
{
    $msg_log = login_check($log_username, $log_password);
}
else if(!empty($reg_username) && !empty($reg_password))
{
    $msg_reg = register_check($reg_username, $reg_password);
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
                    <table  style="width: 50%; float: left;">
                    <tr><th colspan="2">Login </th></tr>
                    <tr><th colspan="2"><?php echo $msg_log; ?></th></tr>
                        <tr><td>Username</td><td><input type="email" placeholder="Username" name="log_username" id="log_username" value="" required="required"/></td></tr>
                        <tr><td>Password</td><td><input type="password" placeholder="Password" name="log_password" id="log_password" required="required"/>
                            </td></tr>
                        <tr><td colspan="2"><input type="submit" name="login" value="Login"/></td></tr>
                        <tr><td colspan="2"><a href="<?php echo SITE_URL.'/?page=forgotpass' ?>">Forget Password</a></td></tr>
                    </table>
                </form>
                </tr>
                
                <tr>
                <form method="post">
                    <table   style="width: 50%; float: right;">
                    <tr><th colspan="2">Registration </th></tr>
                    <tr><th colspan="2"><?php echo $msg_reg; ?></th></tr>
                        <tr><td>Username</td><td><input type="email" placeholder="Username" name="reg_username" id="reg_username" value="" required="required"/></td></tr>
                        <tr><td>Password</td><td><input type="password" placeholder="Password" name="reg_password" id="reg_password" required="required"/>
                            </td></tr>
                        <tr><td colspan="2"><input type="submit" name="register" value="Register"/></td></tr>
                    </table>
                </form>
                </tr>
				
</tbody></table>




</body></html>