<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>e-Catalogue</title>
<script type="text/javascript" src="author.js">




// JavaScript Document

function getHTTPObject() {
var xhr = false;
if (window.XMLHttpRequest) {
xhr = new XMLHttpRequest();
} else if (window.ActiveXObject) {
try {
xhr = new ActiveXObject("Msxml2.XMLHTTP");
} catch(e) {
try {
xhr = new ActiveXObject("Microsoft.XMLHTTP");
} catch(e) {
xhr = false;
}
}
}
return xhr;
}

function autocomplete(thevalue, e){
	
	var request=getHTTPObject();
	var theObject=document.getElementById("subjectdiv");
	
	theObject.style.visibility="visible";
	theObject.style.width="152px";
	
	

	//location we are loading the page into
	var objID="subjectdiv";
	
		
		
		if(thevalue.length>0){
			var serverPage="autocompsubject.php" + "?sstring=" + thevalue;
			} else{
				var serverPage="autocompsubject.php" + "?sstring"+ thevalue.substr(0, (thevalue.length -1));
			}
		
			
			
			

				var obj=document.getElementById(objID);
				request.open("GET", serverPage, true);
				request.onreadystatechange=function(){
				if(request.readyState==4 && request.status==200){
				obj.innerHTML=request.responseText;
				}
			}
			request.send(null);
		
		}
	
	function setvalue(thevalue){
		var divobj=document.getElementById("subjectdiv");
		
		divobj.style.visibility="hidden";
		divobj.style.height="0px";
		divobj.style.width="0px";
		document.getElementById("subject").value= thevalue;
		}


</script>

<link href="main.css" rel="stylesheet" type="text/css" />
</head>

<body>
<div id="wrapper">
<div id="head">
</div>







<center><a href="index.php">Go to Menu</a></center>
<img class="centerimg"src="images/entry.gif" width="70" height="100" /><h1 class="create">Catalogue a book</h1>
<img class="createline" src="images/line.gif" width="750" height="1" />
<div>
<?php
	
		// list expected fields
$expected = array('class', 'aname', 'author2', 'author3', 'author4', 'title', 'subject', 'place', 'publisher', 'year', 'pages', 'textual', 'illustration', 'ref', 'accessNum', 'edition', 'location', 'isbn');
// set required fields
$required = array('class', 'aname', 'title', 'subject', 'place', 'publisher', 'year', 'pages', 'textual', 'illustration', 'ref', 'accessNum', 'edition', 'location', 'isbn');
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

if($_POST && isset($missing) && !empty($missing)){?>

	<fieldset class="errorfield">
   <img  class="centerimg" src="images/error.gif" width="130" height="112" /> <p class="error">Error!
    Please complete the missing item</p>
    </fieldset>
	<?php }
	
if($_POST['submit'] && empty($missing)){
	$class=addslashes($_POST['class']);
	
	$aname=addslashes($_POST['aname']);
		
		
	$a2=addslashes($_POST['author2']);
	
	$a3=addslashes($_POST['author3']);
	
		
	$a4=addslashes($_POST['author4']);
	
		
	$title=addslashes($_POST['title']);
		
	$subject=addslashes($_POST['subject']);
	$place=addslashes($_POST['place']);
		
	$publisher=addslashes($_POST['publisher']);
		
	$year=$_POST['year'];
	
	$pages=addslashes($_POST['pages']);
		
	$text=addslashes($_POST['textual']);
		
		
	$illus=addslashes($_POST['illustration']);
		
	$ref=addslashes($_POST['ref']);
		
	$accessNum=addslashes($_POST['accessNum']);
		
	$edition=addslashes($_POST['edition']);

	$location=addslashes($_POST['location']);
		


	$isbn=htmlentities($_POST['isbn']);

		 
	
	
	include("db_connect.php");
	
	
	
	$enterAuthors="INSERT INTO `ecatalogue`.`authors` (`isbn`,`author`,`entry_date`)
				VALUES ('$isbn', UPPER('$aname'), NOW())";


	$enterSubject="INSERT INTO `ecatalogue`.`subject` (`subject` , `author`, `isbn`, `entry_date` )
				VALUES ('$subject', UPPER('$aname'), '$isbn', NOW())";
	
	
	
	$entry="INSERT INTO `ecatalogue`.`entry` (`class_num` ,`author` ,`author2` ,`author3` ,`author4`, `place` 					               ,`publisher` ,`year` ,`pages` ,`textual` ,`illustration` ,`refrences` , `entry_date` ,`edition` ,
				`accession_num`, `isbn`)
	
				VALUES ('$class', UPPER('$aname'), UPPER('$a2'), UPPER('$a3'), UPPER('$a4'), '$place', '$publisher', '$year', '$pages', '$text', 						                 '$illus', '$ref', NOW(), '$edition', '$accessNum', '$isbn')";

	$enterBook="INSERT INTO `ecatalogue`.`books` (`author` ,`title` ,`subject` ,`isbn` ,`entry_date` ,`location` 	                ,`edition`)VALUES (
 				UPPER('$aname'), '$title', '$subject','$isbn', NOW(), '$location', '$edition')";


	
	$enterAuthors=mysql_query($enterAuthors);
	if(!$enterAuthors){
	$sqlError[]="Sorry could not complete entry:".mysql_error();
		}
		
	$enterSubject=mysql_query($enterSubject);
	if(!$enterSubject){
	$sqlError[]="Sorry, could not complete entry:".mysql_error();
		}
		
	$entry=mysql_query($entry);
	if(!$entry){
	$sqlError[]="Sorry, could not complete entry:".mysql_error();
		}
		
	$enterBooks=mysql_query($enterBook);
	if(!$enterBooks){
	$sqlError[]="Sorry, could not complete entry:".mysql_error();
		}

		
		foreach($sqlError as $err){
		echo "Application Database Error:	$err<br/>";
			}
		
		
	header("location:confirmation.php");
	
	
	}
?>

	

	
	


























<form  method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">

	
    
    <fieldset class="authorfield">
      <table class="authortab" border="0" cellspacing="7">

    <tr>
      <td>Main Author:
</td>
      <td align="left" valign="top"><label>
        <input name="aname" type="text" size="38" value="<?php if ($_POST['aname']){echo $_POST['aname'];}?>" id=	"name" onkeypress="autocomplete(this.value, event)"/><span class="warning">*</span><?php if (isset($missing) && in_array('aname', $missing)) { ?>
<span class="warning">Please enter Author's name</span><?php } ?>
      </label>    <div id="autocompletediv" class="author"></div>
</td>
    
    
      <td>Second Author:
</td>
      <td align="left" valign="top"><label>
        <input name="author2" type="text" size="38" value="<?php if ($_POST['author2']){echo $_POST['author2'];}?>"/><?php if (isset($missing) && in_array('author2', $missing)) { ?>
<span class="warning">Please enter Author's name</span><?php } ?>
      </label><div id="autocompletediv" class="author2"></div></td>
    </tr>
    
    <tr>
      <td>Third Author:
</td>
      <td align="left" valign="top"><label>
        <input name="author3" type="text" size="38" value="<?php if ($_POST['author3']){echo $_POST['author3'];}?>"/><?php if (isset($missing) && in_array('author3', $missing)) { ?>
<span class="warning">Please enter Author's name</span><?php } ?>
      </label><div id="autocompletediv" class="author3"></div></td>
      
      
      
      <td>Fourth Author:
</td>
      <td align="left" valign="top"><label>
        <input name="author4" type="text" size="38" value="<?php if ($_POST['author4']){echo $_POST['author4'];}?>"/><?php if (isset($missing) && in_array('author4', $missing)) { ?>
<span class="warning">Please enter Author's name</span><?php } ?>
      </label><div id="autocompletediv" class="author4"></div></td>
    </tr>
    </table>
    </fieldset>
    
    
    
    
    
    
    
    
    
    <fieldset class="titfield">
    
  <table class="tittab"  border="0" cellspacing="7">
    <tr>
      <td>Title:     </td>
      <td align="left" valign="top"><label>
        <input name="title" type="text" size="80" value="<?php if ($_POST['title']){echo $_POST['title'];}?>"/>
      </label><span class="warning">*</span> <?php if (isset($missing) && in_array('title', $missing)) { ?>
<span class="warning">Please enter title</span><?php } ?></td>
		<td></td>
		<td></td>
    </tr>
    <tr>
      	<td>Subject:     </td>
      	<td align="left" valign="top">
      <label>
        <input name="subject" type="text" id="subject" size="40"  value="<?php if ($_POST['subject']){echo $_POST['subject'];}?>"/>
      </label>
      <span class="warning">*</span> <?php if (isset($missing) && in_array('subject', $missing)) { ?>
<span class="warning">Please enter subject</span><?php } ?></td>
<td></td>
<td></td>
    </tr>
    
        <tr>
      <td>Edition:</td>
      <td><select name="edition">  
        <option value="">select</option>
        <option value="">-----------</option>
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
        <?php if($_POST['edition']){echo "<option value='{$_POST['edition']}' selected='selected'>
		{$_POST['edition']}</option>";
}?>
        </select><span class="warning">*</span>
           <?php if (isset($missing) && in_array('edition', $missing)) { ?>
<span class="warning">Please enter edition</span><?php } ?></td>
<td></td>
    <td></td>
    </tr>

    
    <tr>
      <td>Place of Publication:</td>
      <td align="left" valign="top"><label>
      <input name="place" type="text" id="place" size="40" value="<?php if ($_POST['place']){echo $_POST['place'];}?>"/>
      </label><span class="warning">*</span><?php if (isset($missing) && in_array('place', $missing)) { ?>
<span class="warning">Please enter place of publication</span><?php } ?>
	<td></td>
	<td></td>
    </tr>
    
    <tr>
      <td>Publisher:      
</td>
      <td align="left" valign="top"><label>
        <input name="publisher" type="text" id="publisher" size="40" value="<?php if ($_POST['publisher']){echo $_POST['publisher'];}?>"/>
      </label><span class="warning">*</span><?php if (isset($missing) && in_array('publisher', $missing)) { ?>
<span class="warning">Please enter Publisher</span><?php } ?>
</td>
	<td></td>
	<td></td>

    </tr>
    <tr>
    
      <td>Year of Publication:</td>
      <td align="left" valign="top"><label>

    
    <?php  
		
		
		
		
		echo "<select name='year'>";
		echo "<option value=''>Select</option>";
		echo "<option value=''>---</option>";

		for ($y = 1940; $y <= 2015; $y++) {
		echo "<option value='$y'";
		if ($year == $y) {
		echo "selected='selected'";
	}
		echo ">$y</option>\n";
	}
		echo "</select>";
		
	
		
	?>   
       </label><span class="warning">*</span><?php if (isset($missing) && in_array('year', $missing)) { ?>
<span class="warning">Please enter year of publication</span><?php } ?></td>
       	<td></td>
	<td></td>

    </tr>
    
    
    </table>
    
    </fieldset>
    
    
    
    
    
    
    
 
    <fieldset class="numfield">
  <table class="numtab"  border="0" cellspacing="7">
    <tr>
      <td>Preliminary pages:     
</td>
      <td align="left" valign="top"><label>

        <input type="text" name="pages" size="40" id="pages" value="<?php if ($_POST['pages']){echo $_POST['pages'];}?>" />
      </label><span class="warning">*</span> <?php if (isset($missing) && in_array('pages', $missing)) { ?>
<span class="warning">Please enter preliminary pages</span><?php } ?></td>
    
      <td>Textual Pages:     
</td>
      <td align="left" valign="top"><label>

        <input type="text" name="textual" size="40" id="textual" value="<?php if ($_POST['textual']){echo $_POST['textual'];}?>"/>
      </label><span class="warning">*</span> <?php if (isset($missing) && in_array('textual', $missing)) { ?>
<span class="warning">Please enter textual pages</span><?php }  if(!empty($_POST['textual']) && !is_numeric($_POST['textual'])){?><span class="warning">Textual pages must be integers</span> <?php }?></td>
    </tr>
    
    
    <tr>
      <td>Illustration:      
</td>
      <td align="left" valign="top"><label>

        <input name="illustration" type="text" size="40" id="illustration"  value="<?php if($_POST['illustration']){echo $_POST['illustration'];}?>"/>
      </label><span class="warning">*</span><?php if (isset($missing) && in_array('illustration', $missing)) { ?>
<span class="warning">Please enter illustration</span><?php } ?></td>
    
      <td>Refrences:
</td>
      <td align="left" valign="top"><label>

        <input name="ref" type="text" id="ref" size="40" value="<?php if($_POST['ref']){echo $_POST['ref'];}?>"/>
      </label><span class="warning">*</span><?php if (isset($missing) && in_array('ref', $missing)) { ?>
<span class="warning">Please enter refrence</span><?php } ?></td>
    </tr>
    
    <tr>
      <td>ISBN:     
</td>
      <td align="left" valign="top"><label>

        <input name="isbn" type="text" id="isbn" size="40" value="<?php if($_POST['isbn']){echo $_POST['isbn'];}?>"/>
      </label><span class="warning">*</span> <?php if (isset($missing) && in_array('isbn', $missing)) { ?>
<span class="warning">Please enter ISBN</span><?php } if(!empty($_POST['isbn']) && !is_numeric($_POST['isbn'])){?><span class="warning">ISBN must be integers</span><?php } ?></td>
    
      <td>Accession no:</td>
      <td align="left" valign="top"><label>

        <input name="accessNum" type="text" id="accessNum" size="40" value="<?php if($_POST['accessNum']){echo $_POST['accessNum'];}?>"/>
      </label><span class="warning">*</span>      <?php if (isset($missing) && in_array('accessNum', $missing)) { ?>
<span class="warning">Please enter accession number</span><?php } ?>
</td>
    </tr>
            <tr>
      <td>Location:</td>
      <td align="left" valign="top"><label>

        <input name="location" type="text" id="location" size="40" value="<?php if($_POST['location']){echo $_POST['location'];}?>"/>
      </label><span class="warning">*</span>      <?php if (isset($missing) && in_array('location', $missing)) { ?>
<span class="warning">Please enter location</span><?php } ?>
</td>
      
      
      
   
     <td>Classification no:
</td>
     <td align="left" valign="top"><label for="classfication no:">
        <input name="class" type="text" size="40"  value="<?php if ($_POST['class']){echo $_POST['class'];}?>"/>
      	</label><span class="warning">*</span><?php if (isset($missing) && in_array('class', $missing)) { ?>
<span class="warning">Please enter the classification number</span><?php } ?></td>
    </tr>
</table>
</fieldset>






  <label>
        <input type="submit" name="submit" id="submit" class="submit" value=" " />
      </label>
   
  
   
  
  
  
</form>
</div>
<center><a href="index.php">Go to Menu</a></center>


<div id="footer">
</div>
</div>



</body></html>