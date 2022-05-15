<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>e-Catalogue</title>
<script type="text/javascript" src="findauthor.js">
</script>
<link href="main.css" rel="stylesheet" type="text/css" />
</head>

<body>

<div id="wrapper">

<div id="head">
</div>


<center><a href="index.php">Go to Menu</a></center>



<img class="centerimg" src="images/author.gif" width="206" height="263" />
<h1 class="create">Enter the Author's name below:</h1>
<img class="createline" src="images/line.gif" width="755" height="1" />
<div class="searchdiv">





<?php 
include "db_connect.php";
$checkempty="SELECT * FROM entry";
$checkempty=mysql_query($checkempty);

if(mysql_num_rows($checkempty)==0){
		echo("<fieldset class='errorfield'>
   <img  class='centerimg' src='images/error.gif' width='130' height='112' /> <p class='error'>
You cant search for Author!<br/> No book has been catalogued yet.</p>
    </fieldset><center>
");
	}
?>






<form action="<?php $_SERVER['PHP_SELF'];?>" method="get">
<table class="searchtab" border="0" width="700" >
<tr>

<td><input name="author" type="text" id="name"   class="searchtextfield" size="45" maxlength="45" value="<?php if($_GET['author']){echo $_GET['author'];}?>" onkeypress="autocomplete(this.value, event)" /></td>
<td><input   name="search" type="submit" id="search" value="  " class="search"  /></td>
</tr>
</table><div id="autocompletediv" class="boook"></div>
</form> 
</div>


<?php
if($_GET['search']){
	include("db_connect.php");

	$a=$_GET['author'];











$display = 10;
 // Determine how many pages there are...
 if (isset($_GET['p']) && is_numeric($_GET
['p'])) { // Already been determined.

 $pages = $_GET['p'];
 } else { // Need to determine.

 // Count the number of records:
 $q ="SELECT DISTINCT author FROM authors WHERE author LIKE '$a%'";
 $r = mysql_query ($q);
$records=mysql_num_rows($r);
if(!$r){echo " could not select for pagination problem";}
if(empty($r)){echo "the database queryis empty";}


 // Calculate the number of pages...
 if ($records > $display) { // More than
 $pages = ceil ($records/$display);
 } else {
$pages = 1;
 }
 }
if (isset($_GET['s']) && is_numeric
($_GET['s'])) {
 $start = $_GET['s'];
 } else {
 $start = 0;
 }
 
 
 
 
 
 
 
 
 
 
 
 
 //get authors name from the url
	
	
	
	if($a==""){
		die("<fieldset class='errorfield'>
   <img  class='centerimg' src='images/error.gif' width='130' height='112' /> <p class='error'>
    Please enter the Author's name to search</p>
    </fieldset><center><a href='index.php'>Go to Menu</a></center><div id='footer'></div></div></body></html>
");
	
	
	}
	
		$sql="SELECT DISTINCT author FROM authors WHERE author LIKE '$a%' ORDER BY author ASC LIMIT $start, $display";
		


$result=mysql_query($sql);
if(!$result){
	die( "<fieldset class='errorfield'><img src='images/error.gif' width='130' height='112' /><p class='error'>Sorry could not fetch record from database</p>
	</fieldset> <center><a href='index.php'>Go to Menu</a></center><div id='footer'></div></div></body></html>");
}

if((mysql_num_rows($result))==0){
	die( "<fieldset class='errorfield'><img src='images/error.gif' width='130' height='112' /><p class='error'>Sorry no match found</p>
	</fieldset> <center><a href='index.php'>Go to Menu</a></center><div id='footer'></div></div></body></html>");
	

}

	
	elseif(mysql_num_rows($result)!=0){
	?>
	
	
	
		
       
       <div class="sresult">   
       <fieldset class="resultbookfield">
       <center><h1 class="total">Result</h1></center>
          <table border="0" width="760">
          
          <tr class="membersthead">
          
          <td>Author</td>
          <td></td>
          </tr>
	<?php 
	while($row=mysql_fetch_array($result)){

$bg = ($bg=='#eeeeee' ? '#ffffff' :'#eeeeee'); // Switch the background
		
		$author=$row['author'];

	echo "<tr class='row' bgcolor='$bg'>"; 
		
		echo "<td class='anames'>$author</td>";
		echo "<td><center><a href='view_author.php?author=$author'>View Author's Record</center></a></td>";
		echo "</tr>";
		
	}
?> </table>	
</fieldset></div>
	
	
	
	
	
<?php }

//paginate result set
if ($pages > 1) {
echo '<br /><p>';
$current_page = ($start/$display) + 1;

if ($current_page != 1) {
 echo '<center><a href="find_entry.php?s=' .
($start - $display) . '&p=' . $pages .
'">Previous</a></center> ';
 }


for ($i = 1; $i <= $pages; $i++) {
 if ($i != $current_page) {
 echo '<a href="find_entry.php?s=' .
(($display * ($i - 1))) . '&p=' .
$pages . '">' . $i . '</a> ';
 } else {
 echo $i . ' ';
}
 }

if ($current_page != $pages) {
 echo '<center><a href="find_entry.php?s=' .
($start + $display) . '&p=' . $pages .
'">Next</a></center>';
 }

 echo '</p>';// Close the paragraph.
 
 }
}
 ?>
 


<center><a href="index.php">Go to Menu</a></center>


<div id="footer">

</div>


</div>

</body>
</html>