<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title> e-Catalogue</title>

<link href="main.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">
<!--
function MM_swapImgRestore() { //v3.0
  var i,x,a=document.MM_sr; for(i=0;a&&i<a.length&&(x=a[i])&&x.oSrc;i++) x.src=x.oSrc;
}
function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}

function MM_findObj(n, d) { //v4.01
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
  if(!x && d.getElementById) x=d.getElementById(n); return x;
}

function MM_swapImage() { //v3.0
  var i,j=0,x,a=MM_swapImage.arguments; document.MM_sr=new Array; for(i=0;i<(a.length-2);i+=3)
   if ((x=MM_findObj(a[i]))!=null){document.MM_sr[j++]=x; if(!x.oSrc) x.oSrc=x.src; x.src=a[i+2];}
}
//-->
</script>
</head>

<body onload="MM_preloadImages('images/quick_hover.gif','images/register_hover.gif','images/registered_hover.gif','images/cataloguedbooks_hover.gif','images/borrow_hover.gif','images/findbook_hover.gif','images/findauthor_hover.gif')">
<div id="wrapper">

<div id="head">
</div>




<div id="quick">
  <a href="entry.php" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image1','','images/quick_hover.gif',1)"><img src="images/quick.gif" alt="click to make a catalogue entry" name="Image1"  border="0" id="Image1" /></a>
  </div>






<div id="register">
  <a href="register.php" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image2','','images/register_hover.gif',1)"><img src="images/register.gif" alt="register new members" name="Image2"  border="0" id="Image2" /></a>
  </div>







<div id="registered">
  <a href="members.php" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image3','','images/registered_hover.gif',1)"><img src="images/registered.gif" alt="all registered members" name="Image3"  border="0" id="Image3" /></a>
  </div>












<div id="catalogued">
  <a href="subject.php" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image4','','images/cataloguedbooks_hover.gif',1)"><img src="images/catalogued_books.gif" alt="View all catalogued books" name="Image4"  border="0" id="Image4" /></a></div>







<div id="borrow">
  <a href="borrow_book.php" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image5','','images/borrow_hover.gif',1)"><img src="images/borrow.gif" alt="borrow books to registered members" name="Image5"  border="0" id="Image5" /></a></div>






<div id="findbook">
  <a href="find_book.php" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image6','','images/findbook_hover.gif',1)"><img src="images/findbook.gif" alt="search for a book" name="Image6"  border="0" id="Image6" /></a>
  </div>






<div id="findauthor">
  <a href="find_entry.php" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image7','','images/findauthor_hover.gif',1)"><img src="images/findauthor.gif" alt="search for an author" name="Image7"  border="0" id="Image7" /></a></div>





<div id="footer">
</div>


</div>

</body>
</html>