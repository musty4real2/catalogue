// JavaScript Document

function getHTTPObject() {
var xhr = false;
if (window.XMLHttpRequest) {
xhr = new XMLHttpRequest();
} else if (window.ActiveXObject) {
try {
xhr = new ActiveXObject("Msxml2.XMLHTTP");
} catch(e) {
try {
xhr = new ActiveXObject("Microsoft.XMLHTTP");
} catch(e) {
xhr = false;
}
}
}
return xhr;
}





function autocomplete(thevalue, e){
	
	var request=getHTTPObject();
	var theObject=document.getElementById("autocompletediv");
	
	theObject.style.visibility="visible";
	theObject.style.width="253px";
	
	

	//location we are loading the page into
	var objID="autocompletediv";
	
		
		
		if(thevalue.length>0){
			var serverPage="autocompauthors.php" + "?sstring=" + thevalue;
			} else{
				var serverPage="autocompauthors.php" + "?sstring"+ thevalue.substr(0, (thevalue.length -1));
			}
		
			
			
			

				var obj=document.getElementById(objID);
				request.open("GET", serverPage, true);
				request.onreadystatechange=function(){
				if(request.readyState==4 && request.status==200){
				obj.innerHTML=request.responseText;
				}
			}
			request.send(null);
		
		}
	
	function setvalue(thevalue){
		var divobj=document.getElementById("autocompletediv");
		
		divobj.style.visibility="hidden";
		divobj.style.height="0px";
		divobj.style.width="0px";
		document.getElementById("name").value= thevalue;
		}