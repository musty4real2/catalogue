<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>e-Catalogue</title>

<link href="main.css" rel="stylesheet" type="text/css" />
</head>

<body>
<div id="wrapper">
<div id="head">
</div>


<?php


	
	
	
		// list expected fields
$expected = array('fname', 'sname', 'dept', 'matNum', 'level');
// set required fields
$required = array('fname', 'sname', 'dept', 'matNum', 'level');
// create empty array for any missing fields
$missing = array();
// process the $_POST variables
// process the $_POST variables


foreach ($_POST as $key => $value) {
// assign to temporary variable and strip whitespace if not an array
$temp = is_array($value) ? $value : trim($value);
// if empty and required, add to $missing array
if (empty($temp) && in_array($key, $required)) {
array_push($missing, $key);
}
// otherwise, assign to a variable of the same name as $key
elseif (in_array($key, $expected)) {
${$key}=$temp;
}


}


?>






<center><a href="index.php">Go to Menu</a></center>
<img class="centerimg" src="images/members.gif" width="136" height="127" />
<h1 class="create">Register Members</h1>
<img  class="createline" src="images/line.gif" width="755" height="1" />
<div>
<?php 

if($_POST && isset($missing) && !empty($missing)){?>

	<fieldset class="errorfield">
   <img  class="centerimg" src="images/error.gif" width="130" height="112" /> <p class="error">Error!
    Please complete the missing item</p>
    </fieldset>
	<?php }
	
elseif($_POST['register'] && empty($missing)){











	include "db_connect.php";
	$fname=addslashes($_POST['fname']);
	
	$sname=addslashes($_POST['sname']);
	
	$dept=addslashes($_POST['dept']);
	
	$matNum=addslashes($_POST['matNum']);
	$level=addslashes($_POST['level']);
	
	
	
	
	
	$checkregister="SELECT  matric_no FROM members WHERE `matric_no`='$matNum'";

	$checkregister=mysql_query($checkregister);
	
	if(mysql_num_rows($checkregister)!=0){
		$error="<fieldset class='errorfield'>
   <img  class='centerimg' src='images/error.gif' width='130' height='112' /> <p class='error'>
Sorry, that member has already been<br/> registered! Please ensure that the<br/> matric number is correct.</p>
    </fieldset>
";
		}
	else{
	
	
	
	
	
	
	
	
	
	$sql="INSERT INTO `ecatalogue`.`members` (`name` ,`matric_no` ,`department` ,`level`, `date`)
VALUES (CONCAT_WS(', ', '$sname', '$fname'), '$matNum', '$dept', '$level', NOW())";

$query=mysql_query($sql);

 if(!$query){
	echo mysql_error();
	}


	
	if($query){
		
		header("location:confirm_reg.php?name=$sname, $fname");

		}
	

}
}


if($error){
	echo $error;
	}



?>

<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post" enctype="multipart/form-data">

<fieldset class="registerfield">
<legend class="create">Fill form to register new members</legend>
<table border="0" width="750" cellspacing="15">
<tr>
<td width="209">Firstname: </td>
<td width="492"><label>
  <input type="text" name="fname" id="textfield" size="45" onkeypress="" />
</label><?php if (isset($missing) && in_array('fname', $missing)) { ?>
<span class="warning">Please enter firstname</span><?php } ?></td>
</tr>
<tr>
  <td>Surname: </td>
  <td><input type="text" name="sname" id="textfield2" size="45"/><?php if (isset($missing) && in_array('sname', $missing)) { ?>
<span class="warning">Please enter surname</span><?php } ?></td>
</tr>
<tr>
  <td>Department:</td>
  <td><input type="text" name="dept" id="textfield3" size="60"/> <?php if (isset($missing) && in_array('dept', $missing)) { ?>
<span class="warning">Please enter department</span><?php } ?></td>
</tr>
<tr>
  <td>Matric Number: </td>
  <td><input type="text" name="matNum" id="textfield4" size="45" maxlength="14"/><span class="warning">example: 2008/1/31702CS</span><?php if (isset($missing) && in_array('matNum', $missing)) { ?>
<span class="warning">Please enter matric number</span><?php }?></td>
</tr>
<tr>
  <td>Level:</td>
  <td><label>
    <select name="level">
      <option value="" >select</option>
      <option value="">...........</option>
      <option value="IJMB">IJMB</option>
      <option value="Remedial">Remedial</option>
      <option value="100">100</option>
      <option value="200">200</option>
      <option value="300">300</option>
      <option value="400">400</option>
      <option value="500">500</option>
      <option value="Spill">Spill</option>
      <option value="Masters">Masters</option>
      <option value="Post-Graduate">Post-Graduate</option>
      <option value="Other">Other</option>
    </select>
  </label><?php if (isset($missing) && in_array('level', $missing)) { ?>
<span class="warning">Please enter level</span><?php } ?></td>
</tr>








</table>
</fieldset>
    <center><input type="submit" name="register" id="button" value="  "  class="regmem"/></center>
</form>
</div>
<center><a href="index.php">Go to Menu</a></center>


<div id="footer">
</div>
</div>



</body></html>