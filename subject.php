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



<center><a href="index.php">Go to Menu</a></center>
<div class="subdiv">
<img  class="centerimg"src="images/cat.gif" width="70" height="100" />
<h1 class="create">All Catalogued Books</h1>
<img  class="createline"src="images/line.gif" width="755" height="1" />



<?php

	include("db_connect.php");

$display = 15;
 // Determine how many pages there are...
 if (isset($_GET['p']) && is_numeric($_GET
['p'])) { // Already been determined.

 $pages = $_GET['p'];
 } else { // Need to determine.

 // Count the number of records:
 $q = "SELECT * FROM `entry`";
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

$countbook="SELECT COUNT(*) AS numbooks FROM books";
$sql="SELECT DISTINCT subject FROM books ORDER BY `subject` ASC LIMIT $start, $display";
	$query=mysql_query($sql);
if(!$query){
	die( "<fieldset class='emptyfield'>
   <img  class='centerimg' src='images/error.gif' width='130' height='112' /> <p class='error'>
  No book has been catalogued!</p>
    </fieldset><center><a href='index.php'>Go to Menu</a></center><div id='footer'></div></div></body></html>
");
		}
if((mysql_num_rows($query))==0){
	die( "<fieldset class='emptyfield'>
   <img  class='centerimg' src='images/error.gif' width='130' height='112' /> <p class='error'>
  No book has been catalogued!</p>
    </fieldset><center><a href='index.php'>Go to Menu</a></center><div id='footer'></div></div></body></html>
");
}
$countbook=mysql_query($countbook);
while($me=mysql_fetch_array($countbook)){
	echo "<h3 class='total'>".$me['numbooks']."  book(s)</h3>";?>
    
    

	
	
	
	
	<?php 
	

    if($_GET['weedbook']){?>
	
    <fieldset class="booksfield"><center><h2 class="create"><img src="images/weed2.gif" width="148" height="177" /><?php echo $_GET['weedbook'];?></h2></center></fieldset>
    <?php } ?>
        <fieldset class="booksfield">










<table  class="bookstable"border="0" width="760">
<tr class="thead">
<td>SUBJECT</td>
<td>Click to view to view books</td>
</tr>

<?php
	while($row=mysql_fetch_array($query)){
		
		
		
$bg = ($bg=='#eeeeee' ? '#ffffff' :
'#eeeeee'); // Switch the background
		$id=$row['id'];


 echo "<tr class='row' bgcolor='$bg'>";  
		$title=$row['title'];
		$subject=$row['subject'];
		echo "<td>$subject</td>";
		
		$ask="SELECT `subject` FROM books WHERE subject='$subject'";
		$request=mysql_query($ask);
		if(!$sql){echo "Sorry, could not select:".mysql_error();
		}
		$number=mysql_num_rows($request);
		echo "<td><center><a href='book.php?subject=$subject'>$number book(s)</center></td>";
		echo '</tr>';
		
		
		
		
		}
?></table>
</fieldset>
<?php
	}


//paginate result set
if ($pages > 1) {
echo '<center>';
$current_page = ($start/$display) + 1;

if ($current_page != 1) {
 echo '<center><a href="subject.php?s=' .
($start - $display) . '&p=' . $pages .
'">Previous</a></center> ';
 }


for ($i = 1; $i <= $pages; $i++) {
 if ($i != $current_page) {
 echo '<a href="subject.php?s=' .
(($display * ($i - 1))) . '&p=' .
$pages . '">' . $i . '</a> ';
 } else {
 echo $i . ' ';
}
 }

if ($current_page != $pages) {
 echo '<center><a href="subject.php?s=' .
($start + $display) . '&p=' . $pages .
'">Next</a></center>';
 }

 echo '</center>';// Close the paragraph.
 
 }
 ?>



</div>


<center><a href="index.php">Go to Menu</a></center>

<div id="footer">
</div>
</div>
</body>
</html>