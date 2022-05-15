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

<center><a href="index.php">Go to Menu</a>	</center>	
<div class="subdiv">



<img  class="centerimg" src="images/members_reg.gif" width="114" height="123" />
<p class="create">Registered members</p>
<img class="createline" src="images/line.gif" width="755" height="1" />






<?php 
include "db_connect.php";
$checkempty="SELECT * FROM members";
$checkempty=mysql_query($checkempty);

if(mysql_num_rows($checkempty)==0){
		echo("<fieldset class='emptyfield'>
   <img  class='centerimg' src='images/error.gif' width='130' height='112' /> <p class='error'>
No member has been registered!</p>
    </fieldset><center>
");
	}
?>






<?php
	include("db_connect.php");

$display = 15;
 // Determine how many pages there are...
 if (isset($_GET['p']) && is_numeric($_GET
['p'])) { // Already been determined.

 $pages = $_GET['p'];
 } else { // Need to determine.

 // Count the number of records:
 $q = "SELECT * FROM `members`";
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

$subject=$_GET['subject'];
$sql="SELECT * FROM members ORDER BY name ASC LIMIT $start, $display";
	$query=mysql_query($sql);
if(!$query){
		die( "<div class='sresult'><p class='er'>Sorry, could not fetch record:".mysql_error()."</p></div><div id='footer'>
</div>");
		}


$countmem="SELECT COUNT(*) AS members FROM members";
$countmem=mysql_query($countmem);
while($me=mysql_fetch_array($countmem)){
	echo "<h3 class='total'>".$me['members']."  Registered Member(s)</h3>";
}
if(mysql_num_rows($query)!=0){
	
?>    <fieldset class="memberstable">
<table  border="0" width="760">
<tr class="membersthead">
<td>Name</td>
<td>Matric Number</td>
<td>Department</td>
<td>Level</td>
<td>Book(s) Borrowed</td>

</tr>

<?php
	while($row=mysql_fetch_array($query)){
		
		
		
$bg = ($bg=='#eeeeee' ? '#ffffff' :'#eeeeee'); // Switch the background

 	echo "<tr  class='row' bgcolor='$bg'>";  
 	echo "<td>".$row['name']."</td>";
	echo "<td><center>".$row['matric_no']."</center></td>";
	echo "<td>".$row['department']."</td>";
	echo "<td><center>".$row['level']."<center></td>";
	
	
	$mem="SELECT matric_no, isbn, member_id FROM borrowbook WHERE `matric_no`='{$row['matric_no']}' OR 
	`member_id`='{$row['members_id']}'";
	
	$memb=mysql_query($mem);
	if(mysql_num_rows($memb)>0){
		
	while($result=mysql_fetch_array($memb)){
	
 echo "<td><center>".mysql_num_rows($memb)."	 <a href='return_book.php?matricnumber={$row['matric_no']}& memberid={$row['members_id']}&isbn={$result['isbn']}&name={$row['name']}'>return book</a></center></td>";
		}
	}
		
	elseif(mysql_num_rows($memb)==0){
		echo "<td><center> 0 </center></td>";
		}
		
		echo "</tr>";
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
 echo '<center><a href="members.php?s=' .
($start - $display) . '&p=' . $pages .
'">Previous</a></center> ';
 }


for ($i = 1; $i <= $pages; $i++) {
 if ($i != $current_page) {
 echo '<a href="members.php?s=' .
(($display * ($i - 1))) . '&p=' .
$pages . '">' . $i . '</a> ';
 } else {
 echo $i . ' ';
}
 }

if ($current_page != $pages) {
 echo '<center><a href="members.php?s=' .
($start + $display) . '&p=' . $pages .
'">Next</a></center>';
 }

 echo '</center>';// Close the paragraph.
 
 }
 ?>


<center><a href="index.php">Go to Menu</a>	</center>	
</div>




<div id="footer">
</div>
</div>
</body>
</html>