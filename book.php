<?php
session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>e-Catalogue</title>
<script type="text/javascript">
function weed()
{
	if(!document.getElementById ||!document.createTextNode){return;}
	if(!document.getElementById('weedbook')){return;}
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


<link href="main.css" rel="stylesheet" type="text/css" />

</head>

<body>
<div id="wrapper">
<div id="head">
</div>

<center><a href="index.php">Go to Menu</a>		|		<a href="subject.php">back</a></center>
<div class="subdiv">

<img class="centerimg" src="images/cat.gif" width="177" height="255" />
<h1  class="create">Books</h1>
<img class="createline" src="images/line.gif" width="755" height="1" />

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


//get the subject form the URL using the get method
$subject=$_GET['subject'];

//Query the database
$sql="SELECT title, author, isbn FROM books WHERE subject='$subject' ORDER BY title ASC LIMIT $start, $display";
	$query=mysql_query($sql);
if(!$query){
		die( "<div class='sresult'><p class='er'>Sorry, could not fetch record from database:".mysql_error()."</p></div><div id='footer'>
</div>");
		}
		
		
		
		

		
		
		

//if query us empty
if(mysql_num_rows($query)!=0){
	
	
	echo "<h3 class='total'>".mysql_num_rows($query)."book(s) on $subject</h3>";?>
    <fieldset class="booksfield">
<table  class="bookstable" border="0" width="760">
<tr class="thead">
<td>Book Title</td>
<td>Author</td>
<td></td>
<td></td>
<td>Status</td>
</tr>


<?php
//fetch record from database
	while($row=mysql_fetch_array($query)){
		
		$author=htmlspecialchars($row['author']);
		
$bg = ($bg=='#eeeeee' ? '#ffffff' :
'#eeeeee'); // Switch the background

 echo "<tr bgcolor='$bg' class='row'>";  
 	echo "<td>".$row['title']."</td>";
	echo "<center><td>$author</td></center>";

echo  "<center><td><a href='view_author.php?author=$author'>View Record</a></td></center>";
echo  "<center><td>"?> <img src="images/weed2.gif" width="25" height="25" /><form onsubmit="return weed();" action="weed.php" method="post">
<input type="submit" value="weed"  id="weedbook" /></form><?php echo "</td></center>";
		
		$_SESSION['isbn']=$row['isbn']; 






			$available="SELECT COUNT(isbn) AS mine FROM borrowbook WHERE `isbn`='{$row['isbn']}'";
			
	$queryborrow=mysql_query($available);
		
		while($me=mysql_fetch_array($queryborrow)){
			if($me['mine']>0){
        echo"<td><img src='images/not_available.gif' width='15' height='15' />Borrowed(Not available)</td>";
		}
		elseif($me['mine']==0){
			echo "<td><center><img src='images/successfull.gif' width='15' height='15' />Available</center></td>";
		}
		}
		


?>





</tr>


	<?php	}
?>
</table>
</fieldset>
<?php
	}
	//create a session variable to make the subject available on any page
 $_SESSION['subject']=$subject;



//paginate the result set
if ($pages > 1) {
echo '<br /><p>';
$current_page = ($start/$display) + 1;

if ($current_page != 1) {
 echo '<center><a href="book.php?s=' .
($start - $display) . '&p=' . $pages .
'">Previous</a></center> ';
 }


for ($i = 1; $i <= $pages; $i++) {
 if ($i != $current_page) {
 echo '<a href="book.php?s=' .
(($display * ($i - 1))) . '&p=' .
$pages . '">' . $i . '</a> ';
 } else {
 echo $i . ' ';
}
 }

if ($current_page != $pages) {
 echo '<center><a href="book.php?s=' .
($start + $display) . '&p=' . $pages .
'">Next</a></center>';
 }

 echo '</p>';// Close the paragraph.
 
 }
 
 ?>


<center><a href="index.php">Go to Menu</a>		|		<a href="subject.php">back</a></center>
</div>




<div id="footer">
</div>
</div>
</body>
</html>