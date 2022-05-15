<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>e-Catalogue</title>

<link href="main.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="book.js">
function weed()
{
	if(!document.getElementById ||!document.createTextNode){return;}
	if(!document.getElementById('weedbook'))
	{
		return;
		}
	var searchValue=document.getElementById('weedbook').value;

		if(searchValue=='weed')
	{
		var really=confirm('All records of this book will be removed from database.\n' +
					'Do you really want to WEED this book?');
		return really;
	}
		else
	{
		return false;
}
}


</script>

</head>

<body>
<div id="wrapper">

<div id="head">
</div>

<center><a href="index.php">Go to Menu</a></center>

<img  class="centerimg" src="images/searchbook.gif" width="197" height="261" />
<h1 class="create">Enter Book title below:</h1>
<img class="createline" src="images/line.gif" width="755" height="1" />

<div class="searchdiv">




<?php 
include "db_connect.php";
$checkempty="SELECT * FROM entry";
$checkempty=mysql_query($checkempty);

if(mysql_num_rows($checkempty)==0){
		echo("<fieldset class='errorfield'>
   <img  class='centerimg' src='images/error.gif' width='130' height='112' /> <p class='error'>
You cant search for book!<br/> No book has been catalogued yet.</p>
    </fieldset><center>
");
	}
?>



<form action="<?php $_SERVER['PHP_SELF'];?>" method="get">
<table class="searchtab" border="0"  width="700">
<tr>
<td><input name="title" type="text"  class="searchtextfield" id="find" onkeypress="autocomplete(this.value, event)" size="90" maxlength="45" value="<?php if($_GET['title']){echo $_GET['title'];}?>"/></td>
<td>




<input  name="search"  type="submit" id="search"  class="search" value="  " /></td>
</tr>

</table><div id="thebook" class="boook"></div>

</form> 
</div>


<?php
if($_GET['search']){
	include("db_connect.php");
	$t=$_GET['title'];

$display = 10;
 // Determine how many pages there are...
 if (isset($_GET['p']) && is_numeric($_GET
['p'])) { // Already been determined.

 $pages = $_GET['p'];
 } else { // Need to determine.

 // Count the number of records:
 $q ="SELECT * FROM books WHERE title LIKE '$t%'";
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
 
 
 
 
 
 
 
 if(isset($_GET['search'])){
 
	$t=$_GET['title'];
		if($t==""){
		die("<fieldset class='errorfield'>
   <img  class='centerimg' src='images/error.gif' width='130' height='112' /> <p class='error'>
    Please enter the book title to search</p>
    </fieldset><center><a href='index.php'>Go to Menu</a></center><div id='footer'></div></div></body></html>
");
		}

	include("db_connect.php");
	
	$sql="SELECT * FROM books WHERE title LIKE '$t%' ORDER BY title ASC LIMIT $start, $display";
	$query=mysql_query($sql);
	if(!$query){
	die( "<fieldset class='errorfield'><img src='images/error.gif' width='130' height='112' /><p class='error'>Sorry could not fetch record from database</p>
	</fieldset> <center><a href='index.php'>Go to Menu</a></center><div id='footer'></div></div></body></html>");
}
	if((mysql_num_rows($query))==0){
	die( "<fieldset class='errorfield'><img src='images/error.gif' width='130' height='112' /><p class='error'>Sorry no match found</p>
	</fieldset> <center><a href='index.php'>Go to Menu</a></center><div id='footer'></div></div></body></html>");
}





	if(mysql_num_rows($query)!=0){
	?>
	
	
	           <fieldset class="resultbookfield">

		
       <div>   <center><h1 class="total">Result</h1></center>
          
          
		<table border="0" width="760">
        <tr class="membersthead">
        <td>Author's name</td>
        <td>Title</td>
        <td>Subject</td>
        <td>Status</td>
        <td></td>
        <td></td>
        </tr>
		<?php
	while($row=mysql_fetch_array($query)){

	$bg = ($bg=='#eeeeee' ? '#ffffff' :'#eeeeee'); // Switch the background
	
	$author=$row['author'];
	$isbn=$row['isbn'];

	echo "<tr class='row' bgcolor='$bg'>"; ?> 
        <td><?php echo $author?></td>
        <td><?php echo $row['title'];?></td>
        <td><?php echo $row['subject'];?></td>
        
        
        
        
        <?php 
			$available="SELECT isbn FROM borrowbook WHERE `isbn`='$isbn'";
	$queryborrow=mysql_query($available);

		if(mysql_num_rows($queryborrow)==1){
        echo"<td><img src='images/not_available.gif' width='15' height='15' />Borrowed(Not available)</td>";
		}
		elseif(mysql_num_rows($queryborrow)==0){
			echo "<td><center><img src='images/successfull.gif' width='15' height='15' />Available</center></td>";
		}
	?>	
		
	
		<?php echo "<td><a href='view_author.php?author=$author'>View record</a></td>";
		echo "<td><center><img src='images/weed2.gif' width='27' height='27' /><form  onsubmit='return weed()'
		action='weed.php' method='post'><input type='submit' value='weed' id='weedbook' /></form></center></td>";?>
        </tr>
        <?php } ?>
 		</table>
        </div>
        </fieldset>
        <?php } 


//paginate result set
if ($pages > 1) {
echo '</center>';
$current_page = ($start/$display) + 1;

if ($current_page != 1) {
 echo '<center><a href="find_book.php?s=' .
($start - $display) . '&p=' . $pages .
'">Previous</a></center> ';
 }


for ($i = 1; $i <= $pages; $i++) {
 if ($i != $current_page) {
 echo '<a href="find_book.php?s=' .
(($display * ($i - 1))) . '&p=' .
$pages . '">' . $i . '</a> ';
 } else {
 echo $i . ' ';
}
 }

if ($current_page != $pages) {
 echo '<center><a href="find_book.php?s=' .
($start + $display) . '&p=' . $pages .
'">Next</a></center>';
 }

 echo '</center>';// Close the paragraph.
 
 }
}
}
 ?>



<center><a href="index.php">Go to Menu</a></center>

<div id="footer">
</div>
</div>


</body>

</html>