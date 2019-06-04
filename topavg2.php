<?php 
		include ('conn.php');
		 // Connect to database
		$db_connection = mysqli_connect($db_server, $db_username, $db_password, $db_name);

		// Get average of sensitivities
		// Round(AVG(column),X) sets the decimal point limit.
		// REmoved the LIMIT 25 to the selection
		$query="SELECT ROUND(AVG(sensitivity_val),4) as Top25kpd2
				FROM 
				(SELECT sensitivity_val
				FROM sensitivities
				WHERE hpk > '40'
				AND kpd > '1.0'
				AND game = 'csgo'
				ORDER BY hpk DESC) sensitivities";
		
		$query = mysqli_query($db_connection, $query);
		if (!$query){
		  $result  = 'error';
		  $message = 'query error'; 
		  echo $result;
		  echo $message;
		} else {
			$result  = 'success';
			$message = 'query success';  
			while ($sensitivity = mysqli_fetch_array($query)){
				$sens2=$sensitivity['Top25kpd2'];
			}
		}	
		?>
		