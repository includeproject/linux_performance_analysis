
<?php
include_once "conexion.php";
	$con = mysql_connect(DB_SERVER,DB_USER,DB_PASS);
		   mysql_select_db(DB_NAME,$con);
	if (isset($_REQUEST['info_cmd'])) {
	   $datos = json_decode($_REQUEST['info_cmd'],true);
       
	   if (!$con) {
	       echo $texto.mysql_error(); 
	   }
	   else {
	       mysql_query ("SET NAMES 'utf8'");
		   if (!mysql_select_db(DB_NAME)) {
			  echo $texto.mysql_error(); 
		   }
		   else {
		   		//Execute command for PowerTop
				$cmd = "sudo powertop --html=files/".$datos['nameFile'];
				shell_exec($cmd);
		        $sql="INSERT INTO file_record VALUES (0,";
                $sql .= "'".$datos['nameFile']."',";
                $sql .= "'".$datos['directory']."')";
			   			  
		        $result = mysql_query($sql);
				if ($result) {
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
				}
				else {
					echo "ERROR ".$texto.mysql_error(); 
				}
		   }
	   }
	}
 	else {
	   echo $texto." ERROR AL ACTUALIZAR";
	}
 ?>
 
