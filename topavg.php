<?php 
		include ('conn.php');
		 // Connect to database
		$db_connection = mysqli_connect($db_server, $db_username, $db_password, $db_name);

		// Get average of sensitivities
		// Round(AVG(column),X) sets the decimal point limit.
		// REmoved the LIMIT 25 in the selection
		$sensitivity = array("query"=>"33", "query1"=>"40", "query2"=>"50", "query3"=>"60");
		$sizeOf = sizeof($sensitivity); 
		
		foreach($sensitivity as $x => $x_value) {
			/* echo $x_value;
			echo $x;
			echo "Key=" . $x . ", Value=" . $x_value; */
			for($counter = 0; $counter < $sizeOf; $counter++){
				$x="SELECT ROUND(AVG(sensitivity_val),4) as Top25kpd1
					FROM 
					(SELECT sensitivity_val
					FROM sensitivities
					WHERE hpk > '". $x_value . "'
					AND kpd > '1.0'
					AND game = 'csgo'
					ORDER BY hpk DESC) sensitivities";
			}
	
			$x = mysqli_query($db_connection, $x);
			if (!$x){
			  $result  = 'error';
			  $message = 'query error'; 
			  echo $result;
			  echo $message;
			} else {
				$result  = 'success';
				$message = 'query success';  
				$sensitivities = array();
				while ($sensitivity = mysqli_fetch_array($x)){
					echo $sensitivity['Top25kpd1'];
					/* $sensitivities[] = $sensitivity;
				
					foreach ($sensitivities as $row) 
					{ 
						for($counter = 0; $counter < 4; $counter++){
							$sens = 'sens'.$counter;
							echo 'Sens= '.$$sens;
							$$sens=$row[0];
						}

					} */
					
					
				}
			}
		}/*End of Foreach*/

		
		?>
		