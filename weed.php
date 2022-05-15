
<?php
session_start();
$sub=$_SESSION['subject'];
include "db_connect.php";
$isbn=$_SESSION['isbn'];

$entry="DELETE FROM `entry` WHERE `entry`.`isbn`='$isbn'" ;
$books="DELETE FROM `books` WHERE `books`.`isbn`='$isbn'" ;
$subject="DELETE FROM `subject` WHERE `subject`.`isbn`='$isbn'" ;
$authors="DELETE FROM `authors` WHERE `authors`.`isbn`='$isbn'" ;


$entry=mysql_query($entry);
if(!$entry){
	$error[]= "Sorry, Could not delete from database:".mysql_error();
	}
	
$books=mysql_query($books);
if(!$books){
	$error[]= "Sorry, Could not delete from database:".mysql_error();
	}
$ubject=mysql_query($subject);
if(!$subject){
	$error[]="Sorry, Could not delete from database:".mysql_error();
	}
$authors=mysql_query($authors);
if(!$authors){
	$error[]= "Sorry, Could not delete from database:".mysql_error();
	}
	
	foreach($error as $err){
		
		die ($err."<br/>");
		}

if($entry && $books && $subject && $authors){
	$delete="Book has been weeded successfully.";
	header("location:subject.php?weedbook=$delete");
}
?>
</body>
</html>