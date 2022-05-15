<?php 
session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>e-Catalogue</title>

<link href="main.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="title.js">	</script>

</head>

<body>
<div id="wrapper">
<div id="head">
</div>

<?php

//if the button has been clicked
	
	
	// list expected fields
$expected = array('matric', 'libAdmin', 'isbn');
// set required fields
$required = array('matric', 'libAdmin', 'isbn');
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
<img  class="centerimg"src="images/borrowbook.gif" width="175" height="206" />
<h1 class="create">Borrow book</h1>
<img  class="createline"src="images/line.gif" width="755" height="1" />
<div>





<?php 
include "db_connect.php";
$checkempty="SELECT * FROM members";
$checkempty=mysql_query($checkempty);

if(mysql_num_rows($checkempty)==0){
		echo("<fieldset class='errorfield'>
   <img  class='centerimg' src='images/error.gif' width='130' height='112' /> <p class='error'>
You cant borrow book!<br/> No member has been registered yet.</p>
    </fieldset>
");
	}
?>


<?php 
include "db_connect.php";
$checkempty="SELECT * FROM books";
$checkempty=mysql_query($checkempty);

if(mysql_num_rows($checkempty)==0){
		echo("<fieldset class='errorfield'>
   <img  class='centerimg' src='images/error.gif' width='130' height='112' /> <p class='error'>
You cant borrow book!<br/> No book has been catalogued yet.</p>
    </fieldset>
");
	}
?>





<?php
if($_POST && isset($missing) && !empty($missing)){?>

	<fieldset class="errorfield">
   <img  class="centerimg" src="images/error.gif" width="130" height="112" /> <p class="error">Error!
    Please complete the missing item</p>
    </fieldset>
	<?php }
	
elseif($_POST['borrow'] && empty($missing)){





include "db_connect.php";

$lib=addslashes($_POST['libAdmin']);
$id=$_SESSION['id'];
$mat=addslashes($_POST['matric']);
$isbn=$_POST['isbn'];

$check="SELECT isbn FROM borrowbook WHERE `isbn`='$isbn'";
$check=mysql_query($check);
if(mysql_num_rows($check)>0){
	die( "<fieldset class='errorfield'><img src='images/error.gif' width='130' height='112' /><p class='error'>Sorry this member has already borrow a book and cannot borrow anymore until that book is returned.</p>
	</fieldset> <center><a href='index.php'>Go to Menu</a></center><div id='footer'></div></div></body></html>");
	}
elseif(mysql_num_rows==0){
$borrow="INSERT INTO borrowbook (`isbn`, `borrowed_date`, `admin`, `member_id`, `matric_no`)
							VALUES('$isbn', NOW(), '$lib', '$id', '$mat')";

$borrow=mysql_query($borrow);
if(!$borrow){
	die( "<fieldset class='errorfield'><img src='images/error.gif' width='130' height='112' /><p class='error'>Sorry could not borrow book</p>
	</fieldset> <center><a href='index.php'>Go to Menu</a></center><div id='footer'></div></div></body></html>");
	}
if($borrow){
	header("location:confirm_borrow.php");
	}

}
}

?>

<?php 
//include the connector and query databasse
	include "db_connect.php";
	$sql="SELECT subject, title, author, isbn FROM books ORDER BY title ASC";

	$sql=mysql_query($sql);

	if(!$sql){
	echo"Sorry, could not fetch books from database".mysql_error();
	}
?>



<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post" >



<fieldset class="bornamefield">


<table border="0" width="750" cellspacing="20">
<tr>
<?php
$members="SELECT name, members_id, matric_no FROM members ORDER BY name ASC";
$members=mysql_query($members);
?>
<td>Member:     
</td>
<td><label>
<select name="matric" class="select">
<option value="">     select from this list         </option>
<option value="">---------------------</option>
<?php while($row=mysql_fetch_array($members)){
	$name=$row['name'];
echo "<option value='{$row['matric_no']}'>$name   {$row['matric_no']}  </option>";

$_SESSION['id']=$row['members_id'];
}
?>
</select>
</label> <?php if (isset($missing) && in_array('matric', $missing)) { ?>
<span class="warning">Please enter name</span><?php } ?></td>

</tr>




<tr>

<td>Admin:  </td>
<td><label>
  <input type="text" name="libAdmin"  size="45" id="textfield" />
</label><?php if (isset($missing) && in_array('libAdmin', $missing)) { ?>
<span class="warning">Please enter admin name</span><?php } ?></td>
</tr>

</table>
</fieldset>





<fieldset class="bornamefield">
<legend class="create">Type in the title of the book</legend>
<table border="0" width="750" cellspacing="20">
<tr>
<td></td>
<td>
<label>
  <input type="text" name="isbn" onkeypress="autocomplete(this.value, event)"  class="title" size="70" id="title" />
</label> <?php if (isset($missing) && in_array('isbn', $missing)) { ?>
<span class="warning">Please enter title</span><?php } ?><div id="findtitle"></div></td>
</tr>

</table>









</table>
</fieldset>
    <input type="submit" name="borrow" id="button" value="  " class="borrowbutton" />
</form>
</div>
<center><a href="index.php">Go to Menu</a></center>


<div id="footer">
</div>
</div>



</body></html>