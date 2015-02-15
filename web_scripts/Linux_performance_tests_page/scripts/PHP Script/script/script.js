function exec_cmd(){
	var name = document.getElementById("nameFile").innerHTML;
	var dir = document.getElementById("directoryBox").innerHTML;
	document.getElementById("loading-logo").style.display ="block";
	document.getElementById("textLoad").style.display ="block";
	var info = {
		nameFile : name,
		directory : dir
	};
	var request = getRequestObject();

	request.onreadystatechange =
		function() {getResp(request);};
		request.open("POST","updateDB.php",true);

	var datos="info_cmd="+escape(JSON.stringify(info));

	request.setRequestHeader
                 ("Content-Type", 
                  "application/x-www-form-urlencoded");
	request.send(datos);	
}

//Actualizar la lista que se esta mostrando
function getResp(request) {
	if (request.readyState== 4 &&
        request.status == 200) {
		var campo = document.getElementById("links");
		campo.innerHTML = request.responseText;
		document.getElementById("loading-logo").style.display ="none";
		document.getElementById("textLoad").style.display ="none";
	}		
}


function getRequestObject() {
  if (window.ActiveXObject) {
    return(new ActiveXObject("Microsoft.XMLHTTP"));
  } else if (window.XMLHttpRequest) {
    return(new XMLHttpRequest());
  } else {
    return(null);
  }
}
