
<?php

	$author=$_GET['author'];
	?>
		




<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title> e-Catalogue</title>

<link href="main.css" rel="stylesheet" type="text/css" />
</head>

<body>
<div id="wrapper">
<div id="head">
</div>

<div class="viewdiv">


  <?php
  		include("db_connect.php");

  	$sql="SELECT * FROM `entry` LEFT JOIN `books` USING (author, isbn) WHERE author='$author'";


$query=mysql_query($sql);
if(!$query){
		echo "could not fetch record:".mysql_error();
		}?>
  
		<?php
	while($row=mysql_fetch_array($query)){?>







    <fieldset class="authornamefield">
    <legend class="create">Author</legend>
    <img  class="centerimg"src="images/author.gif" width="206" height="263" />
<p  class="authorname"><?php echo  $row['author'];?></p>
</fieldset>







<?php
if($row['author2'] or $row['author3'] or $row['author4'] != "" ){

?>

<fieldset class="otherauthorfield">
<legend class="create">Other Author(s)</legend>
<table border="0" width="750">

<tr>
<td>
    
    <center><?php if($row['author2']==""){echo "";} else echo $row['author2'];?></center>
    </td>
    
    <td>
    
       
    <center><?php if($row['author3']==""){echo "";} else echo $row['author3'];?></center>
</td>
    
    <td>
     
  <center><?php if($row['author4']==""){echo "";} else echo $row['author4'];?></center></td></tr>
    </table>
</fieldset>
<?php } ?>












<fieldset class="titsubfield">
<table border="0" width="750" cellspacing="15">

<tr>

	<td>Title:</td>
   <td class="t"><?php if($row['title']==""){echo "-";} else echo $row['title'];?></td>
   <td></td>
   <td></td>
</tr>


<tr>
    <?php
    $subject=$row['subject'];
	?>

    <td>Subject:</td>
   <td><?php if($subject==""){echo "-";} else echo $subject;?></td>
   <td></td>
   <td></td>
 </tr>
 
 
 <tr>   
 	<td>ISBN:</td>
   <td class="t"><?php echo $row['isbn'];?></td>

	 <td>Place of Publication:</td>
 
   	<td><?php if($row['place']==""){echo "-";} else echo $row['place'];?></td>
    
</tr>
<tr>
    <td>Edition</td>
    
    <td><?php echo $row['edition'];?></td>

    <td>Year of Publication:</td>
    <td><?php echo $row['year'];?></td>
 </tr>
 <tr>
     <td>Location:</td>
    <td class="t"><?php echo $row['location'];?></td>
    <td></td>
    <td></td>
</tr>
 
 
</table>
</fieldset>









<fieldset class="numberfield">
  <table class="auth" border="0" width="755" cellspacing="15">
 
    <tr>
    <td>Classification number:</td>
    <td class="number"><?php echo $row['class_num'];?></td>
    <td>Accession Number</td>
    <td class="number"><?php echo $row['accession_num'];?></td>
    </tr>
  
    
    <tr>
    <td>Preliminary pages:</td>
    <td><?php echo $row['pages'];?></td>
  	<td>Textual pages:</td>
    <td><?php echo $row['textual'];?></td>
    </tr>
    
    
    <tr>
        <td>Illustration:</td>
        <td class="data"><?php echo $row['illustration'];?></td>
  		<td>Refrences:</td>
        <td class="data"><?php echo $row['refrences'];?></td>
    </tr>
    <tr>
    <td>Date of Entry:</td>
    <td><?php echo $row['entry_date'];?></td>
    <td></td>
    <td></td>
    </tr>
        <tr>
    </tr>
    <tr>
    </tr>
    <tr>
    </tr>


</table>
</fieldset>

<form  action="update_status.php"  method="get">

<input type="hidden" value="<?php echo $row['isbn'];?>" name="isbn"/>
<input type="submit" class="edit" name="edit" value="" />
</form>



<?php }?>


<center><a class="make" href="entry.php">Catalogue another book</a> |	<a class="make" href="index.php">Go to Menu</a>	|	<?php echo "<a href='book.php?subject=$subject'>back to books on $subject</a></center>";
?>
</div>



<div id="footer">
</div>


</div>
</body>
</html>