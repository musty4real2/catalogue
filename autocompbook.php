
<link href="main.css" rel="stylesheet" type="text/css" />
<?php
//Add in our database connector.
require_once ("db_connect.php");



//query to select string from database
$myquery = "SELECT title FROM books WHERE title  LIKE ('".mysql_real_escape_string($_GET['sstring']). "%')";
if ($userquery = mysql_query ($myquery)){
if (mysql_num_rows ($userquery) > 0){
?>





<div style="background: #ffffff; border-style: solid; border-width: 1px;
border-color: #dbddde;">

<?php
	while ($userdata = mysql_fetch_array ($userquery)){?>
    <div style="padding: 4px; height: 20px;" onmouseover="this.style.background= '#3aa4bf'" onmouseout="this.style.background = '#FFFFFF'"  
  
    onclick="setvalue ('<?php echo $userdata['title']; ?>')">
	<?php echo $userdata['title']; ?></div><?php
}
?>
</div>
<?php
	}elseif(mysql_num_rows==0) {
	echo "<p class='warning'>Sorry, this book you want to search for does not exist</p>";}

	} else {
	echo mysql_error();
}
?>
