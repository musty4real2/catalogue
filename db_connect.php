<?php

	$conn=@mysql_connect("localhost","root", "");
	if(!$conn){
		die("Sorry, could not connect to the database:".mysql_error());
		}
	$dbcnx=@mysql_select_db("ecatalogue", $conn);
	if(!$dbcnx){
	die( "<fieldset class='errorfield'><img src='images/error.gif' width='130' height='112' /><p class='error'>Error!".mysql_error()."</p>
	</fieldset> <center><a href='index.php'>Go to Menu</a></center><div id='footer'></div></div></body></html>");

		}
?>