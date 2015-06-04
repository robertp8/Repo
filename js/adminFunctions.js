function showHazard(str) {
	if (str == "") {
		document.getElementById("hazTable").innerHTML = "";
		return;
	} else { 
		if (window.XMLHttpRequest) {
			// code for IE7+, Firefox, Chrome, Opera, Safari
			xmlhttp = new XMLHttpRequest();
		} else {
			// code for IE6, IE5
			xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		}
		xmlhttp.onreadystatechange = function() {
			if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
				document.getElementById("hazTable").innerHTML = xmlhttp.responseText;
			}
		}
		xmlhttp.open("GET","php/viewHazards.php?q="+str,true);
		xmlhttp.send();
	}
}

function modifyHazard(str) {
	if (str == "") {
		document.getElementById("updateHazTable").innerHTML = "";
		return;
	} else { 
		if (window.XMLHttpRequest) {
			// code for IE7+, Firefox, Chrome, Opera, Safari
			xmlhttp = new XMLHttpRequest();
		} else {
			// code for IE6, IE5
			xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		}
		xmlhttp.onreadystatechange = function() {
			if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
				document.getElementById("updateHazTable").innerHTML = xmlhttp.responseText;
			}
		}
		xmlhttp.open("GET","php/updateHazards.php?q="+str,true);
		xmlhttp.send();
	}
}


function addFile(str) {
	if (str == "") {
		document.getElementById("viewHazBut").innerHTML = "";
		return;
	} else { 
		if (window.XMLHttpRequest) {
			// code for IE7+, Firefox, Chrome, Opera, Safari
			xmlhttp = new XMLHttpRequest();
		} else {
			// code for IE6, IE5
			xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		}
		xmlhttp.onreadystatechange = function() {
			if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
				document.getElementById("viewHazBut").innerHTML = xmlhttp.responseText;
			}
		}
		xmlhttp.open("GET","php/addButton.php?q="+str,true);
		xmlhttp.send();
	}
}

function addInfo(str) {
	if (str == "") {
		document.getElementById("inputInfo").innerHTML = "";
		return;
	} else { 
		if (window.XMLHttpRequest) {
			// code for IE7+, Firefox, Chrome, Opera, Safari
			xmlhttp = new XMLHttpRequest();
		} else {
			// code for IE6, IE5
			xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		}
		xmlhttp.onreadystatechange = function() {
			if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
				document.getElementById("inputInfo").innerHTML = xmlhttp.responseText;
			}
		}
		xmlhttp.open("GET","php/addInfo.php?q="+str,true);
		xmlhttp.send();
	}
}