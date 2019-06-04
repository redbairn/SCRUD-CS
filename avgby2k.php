<?php 
		include ('conn.php');
		 // Connect to database
		$db_connection = mysqli_connect($db_server, $db_username, $db_password, $db_name);

		// Get average of sensitivities
		// Round(AVG(column),X) sets the decimal point limit.
		// REmoved the LIMIT 25 in the selection
		$query="SELECT ROUND(AVG(sensitivity_val),4) as AvgTwok
				FROM 
				(SELECT sensitivity_val
				FROM sensitivities
				WHERE twok > '6'
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
				$sens2k=$sensitivity['AvgTwok'];
			}
		}	
		
		// ThreeK
		$query2="SELECT ROUND(AVG(sensitivity_val),4) as AvgThreek
				FROM 
				(SELECT sensitivity_val
				FROM sensitivities
				WHERE threek > '1'
				AND kpd > '1.0'
				AND game = 'csgo'
				ORDER BY hpk DESC) sensitivities";
		
		$query2 = mysqli_query($db_connection, $query2);
		if (!$query2){
		  $result  = 'error';
		  $message = 'query error'; 
		  echo $result;
		  echo $message;
		} else {
			$result  = 'success';
			$message = 'query success';  
			while ($sensitivity = mysqli_fetch_array($query2)){
				$sens3k=$sensitivity['AvgThreek'];
			}
		}	
		// FourK
		$query3="SELECT ROUND(AVG(sensitivity_val),4) as AvgFourk
				FROM 
				(SELECT sensitivity_val
				FROM sensitivities
				WHERE fourk > '0'
				AND kpd > '1.0'
				AND game = 'csgo'
				ORDER BY hpk DESC) sensitivities";
		
		$query3 = mysqli_query($db_connection, $query3);
		if (!$query3){
		  $result  = 'error';
		  $message = 'query error'; 
		  echo $result;
		  echo $message;
		} else {
			$result  = 'success';
			$message = 'query success';  
			while ($sensitivity = mysqli_fetch_array($query3)){
				$sens4k=$sensitivity['AvgFourk'];
			}
		}
		
		?>