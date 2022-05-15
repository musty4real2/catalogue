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













<center><a href="index.php">Go to Menu</a>	| 	<a href="members.php">back</a></center>
<h1 class="create">Record of book borrowed</h1>
<img class="createline" src="images/line.gif" width="755" height="1" />
<div>


<?php
if($_GET['return']){
	include "db_connect.php";
	
	$returnbook="DELETE FROM borrowbook WHERE `isbn`='{$_GET['isbn']}' OR `matric_no`='{$_GET['matricnumber']}' OR `member_id`='{$_GET['memberid']}'";
	$returnbook=mysql_query($returnbook);


	if(!$returnbook){
echo "error:".mysql_error();		}



	if($returnbook){
		header("location:confirm_return.php");
		}
	if(!$returnbook){?>?
	<fieldset class="errorfield">
   <img  class="centerimg" src="images/error.gif" width="130" height="112" /> <p class="error">Could not return book to the library</p>
    </fieldset>
    <?php
		}
	
	}
?>


















<?php 
$mat=$_GET['matricnumber'];
$id=$_GET['memberid'];
$isbn=$_GET['isbn'];
$name=$_GET['name'];

include "db_connect.php";
$sql="SELECT isbn, borrowed_date, admin FROM borrowbook WHERE `matric_no`='$mat' OR `member_id`='$id'";

$book="SELECT title, author, isbn FROM books WHERE `isbn`='$isbn'";

$sql=mysql_query($sql);
$book=mysql_query($book);


	

while($row=mysql_fetch_array($sql)){
while($result=mysql_fetch_array($book)){

?>



<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="get">



<fieldset class="memberstable">
<p class="total"><?php echo $name;?></p>
</fieldset>




<fieldset class="memberstable">
<table border="0" width="750"> 
<tr>
<td>Title:</td>
<td class="number"><?php echo $result['title'];?></td>
<td>Matric no:</td>
<td  class="number"><?php echo $mat;?></td>
</tr>

<tr>
<td>Author</td>
<td  class="number"><?php echo $result['author'];?></td>
<td>ISBN</td>
<td  class="number"><?php echo $isbn;?></td>
</tr>

</table>

</fieldset>


<fieldset class="memberstable">
<table border="0" width="750"> 
<tr>
<td>Date borrowed:</td>
<td><?php echo $row['borrowed_date'];?></td>
<td>Library admin:</td>
<td><?php echo $row['admin'];?></td>
</tr>

<tr>
<td>Today's date:</td>
<td><?php echo date("l, F d Y");?></td>
<td></td>
<td></td>
</tr>
</table>
</fieldset>

<input type="hidden" name="matric" value="<?php echo $mat;?>" />
<input type="hidden" name="isbn" value="<?php echo $isbn;?>" />
<input type="submit" value="  " class="return" name="return" />

</form>








<?php
	}
}
?>
</div>


<center><a href="index.php">Go to Menu</a>	| 	<a href="members.php">back</a></center>


<div id="footer">
</div>
</div>



</body></html>