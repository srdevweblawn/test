<?php
include('header.php');
$selected = $_POST['selected'];
if(!empty($selected))
{
    $msg = book_cavallo($selected);
}

        echo $_SESSION['login_id'];
        echo $_SESSION['login_email'];
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
								<td class="style3" colspan="4"><br>
								<span class="style8"><strong>Bokning av trailer</strong></span><br>
								</td>
				</tr>
				<tr>
								<td class="style5" colspan="4"><?php echo $year ; ?><br>
								</td>
				</tr>
				<tr>
								<td style="width: 20px" class="style2">&nbsp;</td>
								<td class="style1" colspan="3">Model</td>
				</tr>
				<tr>
								<td style="width: 20px" class="style7">Week</td>
								<td style="width: 100px" class="style1">Cavallo 
								1</td>
								<td style="width: 100px" class="style1">Cavallo 
								2</td>
								<td style="width: 100px" class="style1">Cavallo 
								Classic</td>
				</tr>
                
                <?php 
                for($i=1;$i<=53;$i++)
                {
                    $first = check_book($i, '1');
                    $second = check_book($i, '2');
                    $third = check_book($i, '3');
                    //echo $first." ".$second." ".$third ;
                    ?>
    				<tr>
    								<td style="width: 20px" class="style6"><?php echo $i; ?></td>
    								<td style="width: 100px" class="style4">
    								<img alt="" src="images/<?php if($first == "yes"){echo "Bokad_vagn";}else{echo "Ledig_vagn";} ?>.gif" width="40" height="24" <?php if($first == "no"){?>onclick="book('<?php echo $i."_1"; ?>');"<?php } ?> id="<?php echo $i."_1"; ?>"/></td>
    								<td style="width: 100px" class="style4">
    								<img alt="" src="images/<?php if($second == "yes"){echo "Bokad_vagn";}else{echo "Ledig_vagn";} ?>.gif" width="40" height="24" <?php if($second == "no"){?>onclick="book('<?php echo $i."_2"; ?>');"<?php } ?> id="<?php echo $i."_2"; ?>"/></td>
    								<td style="width: 100px" class="style4">
    								<img alt="" src="images/<?php if($third == "yes"){echo "Bokad_vagn";}else{echo "Ledig_vagn";} ?>.gif" width="40" height="24" <?php if($third == "no"){?>onclick="book('<?php echo $i."_3"; ?>');"<?php } ?> id="<?php echo $i."_3"; ?>"/></td>
    				</tr>
                    <?php
                }
                
                 ?>
				
</tbody></table>
<form method="post">
				<input name="Submit1" type="submit" value="submit"><input name="Reset1" type="reset" onclick="clear_all();" value="reset">
                <input name="selected" id="selected" type="hidden" />
                </form>


<script>
function clear_all()
{
    var pre_val = $('#selected').val();
    var res = pre_val.split(",");
    for (i = 0; i < res.length; i++) {
        $("#"+res[i]).attr('src', 'images/Ledig_vagn.gif');
    }
    $('#selected').val('');
}

function book(id)
{
    var pre_val = $('#selected').val();
    var found = 0;
    var res = pre_val.split(",");
    var res_new = '';
    for (i = 0; i < res.length; i++) {
        if( res[i] == id )
        {
            found = 1 ;
        }
        else
        {
            if(res_new == '')
            {
                res_new = res[i];
            }
            else
            {
                res_new = res_new+','+res[i];
            }  
        }
    }
    
    if(found == 1)
    {
        $("#"+id).attr('src', 'images/Ledig_vagn.gif');
    }
    else
    {
        if(res_new == '')
        {
            res_new = id;
            $("#"+id).attr('src', 'images/Vald_vagn.gif');
        }
        else
        {
            res_new = res_new+','+id;
            $("#"+id).attr('src', 'images/Vald_vagn.gif');
        }
    }
    
    $('#selected').val(res_new);
    
}

</script>

</body></html>