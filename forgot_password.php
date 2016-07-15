<?php 
$forgot_username = $_POST['forgot_username'];
if(!empty($forgot_username) )
{
    $msg_forgot = forgot_check($forgot_username);
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
                    <tr><th colspan="2">Forget Password </th></tr>
                    <tr><th colspan="2"><?php echo $msg_forgot; ?></th></tr>
                        <tr><td>Email</td><td><input type="email" placeholder="Username" name="forgot_username" id="log_username" value="" required="required"/></td></tr>
                            
                        <tr><td colspan="2"><input type="submit" name="submit" value="Submit"/></td></tr>
                    </table>
                </form>
                </tr>
                
                
				
</tbody></table>




</body></html>