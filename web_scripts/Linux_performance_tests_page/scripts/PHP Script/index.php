<?php

	include_once "conexion.php";

	$con = mysql_connect(DB_SERVER,DB_USER,DB_PASS);
		mysql_select_db(DB_NAME,$con);
		
	if (!$con) {
		die('No me pude conectar: ' . mysql_error());
	}
	mysql_query ("SET NAMES 'utf8'");
	if (!mysql_select_db(DB_NAME))
		die("No pude seleccionar la base de datos ".DB_NAME);

	$today = getdate();
	$date = $today['mday']."-".$today['mon']."-".$today['year'];
	$time = $today['hours'].":".$today['minutes'].":".$today['seconds'];
	//Command to get hostname
	$hostname = shell_exec('hostname');
	//Concat name of file
	$name = $date."_".$time."_".$hostname;
	
 ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
	  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
	<html xmlns="http://www.w3.org/1999/xhtml">
		<head>
			<meta http-equiv="Content-Type" content="text/html;charset=utf-8" /> 
			<link rel="stylesheet" href="style/style.css" type="text/css" />
			 <script src="script/script.js" type="text/javascript"></script>
			<title>Principal - PowerTop</title> 
			<link rel="shortcut icon" href="img/powertop-logo.png" type="image/x-icon"/> 
		</head>
		<body>
			<img id="powertop-logo" title="Test PowerTop" src="img/powertop-logo.png" onclick="exec_cmd();" >
			<span id="textLoad"><img id="loading-logo" title="Loading..." src="img/loader.gif">This will take 20 seconds.</span>
			<br/>
			<br/>
			<br/>
			<label id="nameFile"><?php echo $name;?></label>
			<label id="directoryBox" ><?php echo shell_exec('pwd')."/files/";?></label>
			<label id="links">
				<?php
				    $sql="SELECT * FROM file_record ORDER BY directory ASC";
				   			  
			        $result = mysql_query($sql);
					if ($result) {
						$n = mysql_num_rows($result);
						for ($i=0; $i<$n; $i++) {
							$registro = mysql_fetch_row($result);
							echo "<a href='".$registro[2]."''>".$registro[1]."</a><br/>";
						}
					}
					else {
						echo "ERROR ".$texto.mysql_error(); 
					}
				?>

			</label>
		</body>


	</html>