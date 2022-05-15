
<link href="main.css" rel="stylesheet" type="text/css" />
<?php
//Add in our database connector.
require_once ("db_connect.php");



//query to select string from database
$myquery = "SELECT author FROM authors WHERE author  LIKE ('%".mysql_real_escape_string($_GET['sstring']). "%')";
if ($userquery = mysql_query ($myquery)){
if (mysql_num_rows ($userquery) > 0){
?>





<div style="background: #CCCCCC; border-style: solid; border-width: 1px;
border-color: #000000;">

<?php
	while ($userdata = mysql_fetch_array ($userquery)){?>
    <div style="padding: 4px; height: 14px;" onmouseover="this.style.background= '#EEEEEE'" onmouseout="this.style.background = '#CCCCCC'" 
  
    onclick="setvalue ('<?php echo $userdata['author']; ?>')">
	<?php echo $userdata['author']; ?></div><?php
}
?>
</div>
<?php
	}elseif(mysql_num_rows==0) {
	echo "<p class='warning'>Sorry, this author does not exist!</p>";}

	} else {
	echo mysql_error();
}
?>
