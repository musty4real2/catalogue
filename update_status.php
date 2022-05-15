<?php
$isbn=$_GET['isbn'];
?>

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


<h1 class="create">Update Status</h1>
<img class="createline" src="images/line.gif" width="755" height="1" />
<div>

<?php


if($_POST['update']) {
	
	$initialisbn=$_POST['initialisbn'];
	
	
$isbn=$_POST['isbn'];

	
	$class=addslashes($_POST['class']);
	$author=addslashes($_POST['aname']);
	
	$a2=addslashes($_POST['author2']);
	
	$a3=addslashes($_POST['author3']);
	
		
	$a4=addslashes($_POST['author4']);
	$title=addslashes($_POST['title']);
	$subject=addslashes($_POST['subject']);
	$place=addslashes($_POST['place']);
	$year=addslashes($_POST['year']);
	$publisher=addslashes($_POST['publisher']);
	$pages=addslashes($_POST['pages']);
	$text=addslashes($_POST['textual']);
	$illus=$_POST['illustration'];
	$ref=addslashes($_POST['ref']);
	$isbn=addslashes($_POST['isbn']);
	$edition=addslashes($_POST['edition']);
	$accessNum=addslashes($_POST['accessNum']);
	$location=addslashes($_POST['location']);

		
		
		 
		include("db_connect.php");
		 
	$updateAuthors="UPDATE `ecatalogue`.`authors` SET
`isbn`='$isbn', `author`='$author' ,
`entry_date`=NOW() WHERE `isbn`='$initialisbn'";

	$updateSubject="UPDATE `ecatalogue`.`subject` SET `subject`='$subject' ,
	`author`='$author', `isbn`='$isbn', `entry_date`=NOW() WHERE `isbn`='$initialisbn'";
	
	
	
	$updateEntry="UPDATE `ecatalogue`.`entry` SET `class_num`='$class' ,
`author`='$author' ,`author2`='$a2' ,`author3`='$a3' ,`author4`='$a4', `place`='$place' ,`publisher`='$publisher' ,`year`='$year' ,`pages`='$pages' ,`textual`='$text' ,`illustration`='$illus' ,`refrences`='$ref' , `entry_date`=NOW() ,
`edition`='$edition',
`accession_num`='$accessNum', `isbn`='$isbn' WHERE `isbn`='$initialisbn'";

	
	$updateBook="UPDATE `ecatalogue`.`books` SET`author`='$author' ,`title`='$title' ,`subject`='$subject' ,`isbn`='$isbn' ,`entry_date`=NOW() ,`location`='$location' ,`edition`='$edition' WHERE `isbn`='$initialisbn'";


	$updateAuthors=mysql_query($updateAuthors);
	
	$updateSubject=mysql_query($updateSubject);
	if(!$updateSubject){
		die("Problem".mysql_error());}
	
	$updateEntry=mysql_query($updateEntry);
	
	$updateBook=mysql_query($updateBook);
	


		
		
		
	if($updateAuthors && $updateSubject && $updateEntry && $updateBook){
header("location:confirm_update.php");
		}
}

















	include("db_connect.php");
  	$sql="SELECT * FROM `entry` LEFT JOIN `books` USING (isbn) WHERE isbn='$isbn'";
	$query=mysql_query($sql);
if(!$query){
		echo "Sorry, could not fetch record:".mysql_error();
		}
	while($row=mysql_fetch_array($query)){
?>

<form  method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
    
    <fieldset class="authorfield">
      <table class="authortab" border="0" cellspacing="7">

    <tr>
      <td>Main Author:
</td><?php $author=$row['author'];?>
      <td align="left" valign="top"><label>
        <input name="aname" class="grey" type="text" size="38" value="<?php echo $row['author'];?>" id=	"name" onkeypress="autocomplete(this.value, event)"/><span class="warning">*</span>
      </label><div id="autocompletediv" class="author"></div></td>
    
    
      <td>Second Author:
</td>
      <td align="left" valign="top"><label>
        <input name="author2" class="grey" type="text" size="38" value="<?php echo $row['author2'];?>" id="name" onkeypress="autocomplete(this.value, event)"/>
      </label><div id="autocompletediv" class="author2"></div></td>
    </tr>
    
    <tr>
      <td>Third Author:
</td>
      <td align="left" valign="top"><label>
        <input name="author3" class="grey" type="text" size="38" value="<?php echo $row['author3'];?>"id="name" onkeypress="autocomplete(this.value, event)"/>
      </label><div id="autocompletediv" class="author3"></div></td>
      
      
      
      <td>Fourth Author:
</td>
      <td align="left" valign="top"><label>
        <input name="author4" class="grey" type="text" size="38" value="<?php echo $row['author4'];?>" id="name" onkeypress="autocomplete(this.value, event)"/>
      </label><div id="autocompletediv" class="author4"></div></td>
    </tr>
    </table>
    </fieldset>
    
    
    <input type="hidden" name="initialisbn" value="<?php echo $row['isbn'];?>" />
    
    
    
    
    
    
    <fieldset class="titfield">
    
  <table class="tittab"  border="0" cellspacing="7">
    <tr>
      <td>Title:     
</td>
      <td align="left" valign="top"><label>

        <input name="title" type="text" class="grey" size="80" value="<?php echo $row['title'];?>"/>
      </label><span class="warning">*</span> 
</td>
    </tr>
    <tr>
      <td>Subject:     
</td>
      <td align="left" valign="top"><label>

        <input name="subject" type="text" class="grey" id="subject" size="36" value="<?php echo $row['subject'];?>"/>
      </label><span class="warning">*</span> 
</td>
    </tr>
    
        <tr>
      <td>Edition:</td>
      <td><select  class="grey"name="edition" id="edition">  
        <option value="select">select</option>
        <option value="">-----------</option>
        <?php
		if($row['edition']){
		echo "<option value='{$row['edition']}' selected='selected'>".$row['edition']."</option>";
		}
	
        ?>
        <option value="First">First</option>
        <option value="Second">Second</option>
        <option value="Third">Third</option>
        <option value="Fourth">Fourth</option>
        <option value="Fifth">Fifth</option>
        <option value="Sixth">Sixth</option>
        <option value="Seventh">Seventh</option>
        <option value="Eight">Eight</option>
        <option value="NInth">Ninth</option>
        <option value="Tenth">Tenth</option>
        </select><span class="warning">*</span>
         
</td>
<td></td>
    <td></td>
    </tr>

    
    <tr>
      <td>Place of Publication:      
</td>
      <td align="left" valign="top"><label>

        <input name="place" type="text"  class="grey" id="place" size="36" value="<?php echo $row['place'];?>"/>
      </label><span class="warning">*</span>
</td>
    </tr>
    <tr>
      <td>Publisher:      
</td>
      <td align="left" valign="top"><label>
        <input name="publisher" type="text" class="grey" id="publisher" size="36" value="<?php echo $row['publisher'];?>"/>
      </label><span class="warning">*</span>
</td>
    </tr>
    <tr>
      <td>Year of Publication:</td>
      <td align="left" valign="top"><label>

    
    <?php  
		
		
		
		
		echo "<select class='grey' name='year'>";
		echo "<option value=''>Select</option>";
		echo "<option value=''>---</option>";

		for ($y = 1940; $y <= 2015; $y++) {
		echo "<option value='$y'";
		if ($year == $y) {
		echo "selected='selected'";
	}
		echo ">$y</option>\n";
		
		if($row['year']){
		echo "<option value='{$row['year']}' selected='selected'>".$row['year']."</option>";
		}
	}
		echo "</select>";
		
	
		
	?>   
       </label><span class="warning">*</span></td>
    </tr>
    
    
    </table>
    
    </fieldset>
    
    
    
    
    
    
    
 
    <fieldset class="numfield">
  <table class="numtab"  border="0" cellspacing="7">
    <tr>
      <td>Preliminary pages:     
</td>
      <td align="left" valign="top"><label>

        <input type="text" name="pages" class="grey" size="36" id="pages" value="<?php echo $row['pages'];?>" />
      </label><span class="warning">*</span>
    
      <td>Textual Pages:     
</td>
      <td align="left" valign="top"><label>

        <input type="text" name="textual" class="grey" size="36" id="textual" value="<?php echo $row['textual'];?>"/>
      </label><span class="warning">*</span> </td>
    </tr>
    
    
    <tr>
      <td>Illustration:      
</td>
      <td align="left" valign="top"><label>

        <input name="illustration" type="text"  class="grey" size="36" id="illustration"  value="<?php echo $row['illustration'];?>"/>
      </label><span class="warning">*</span></td>
    
      <td>Refrences:
</td>
      <td align="left" valign="top"><label>

        <input name="ref" type="text" class="grey" id="ref" size="36" value="<?php echo $row['refrences'];?>"/>
      </label><span class="warning">*</span></td>
    </tr>
    
    <tr>
      <td>ISBN:     
</td>
      <td align="left" valign="top"><label>

        <input name="isbn" type="text" class="grey" id="isbn" size="36" value="<?php echo $row['isbn'];?>"/>
      </label><span class="warning">*</span> </td>
    
      <td>Accession no:</td>
      <td align="left" valign="top"><label>

        <input name="accessNum" type="text" class="grey" id="accessNum" size="36" value="<?php echo $row['accession_num'];?>"/>
      </label><span class="warning">*</span>     
</td>
    </tr>
            <tr>
      <td>Location:</td>
      <td align="left" valign="top"><label>

        <input name="location" type="text" class="grey" id="location" size="36" value="<?php echo $row['location'];?>"/>
      </label><span class="warning">*</span>      
</td>
      
      
      
   
     <td>Classification no:
</td>
     <td align="left" valign="top"><label for="classfication no:">
        <input name="class" type="text" class="grey" size="36"  value="<?php echo $row['class_num'];?>"/>
      	</label><span class="warning">*</span></td>
    </tr>
</table>
</fieldset>






  <label>
        <input type="submit" name="update" id="submit" value="  " class="update" />
      </label>
   
  
   
  
  
  
</form>
<?php 
} ?>


</div>
<center><a href="index.php">Go to Menu</a></center>
<?php 
echo  "<center><a href='view_author.php?author=$author'>back</a></center>";
?>
<div id="footer">
</div>
</div>



</body>
</html>