<?php 
		include ('conn.php');
		 // Connect to database
		$db_connection = mysqli_connect($db_server, $db_username, $db_password, $db_name);

		// Get average of sensitivities
		// Round(AVG(column),X) sets the decimal point limit.
		// Removed the LIMIT 25 in the selection
		/* $hspercent = array("33", "40", "50","60");
		foreach($hspercent as $x => $x_value) {
			$query="SELECT ROUND(AVG(sensitivity_val),4) as Top25kpd1
				FROM 
				(SELECT sensitivity_val
				FROM sensitivities
				WHERE hpk > '". $x_value . "'
				AND kpd > '1.0'
				AND game = 'csgo'
				ORDER BY hpk DESC) sensitivities";

			
		}/*End of Foreach*/
				/*$q = mysqli_query($db_connection, $query);
				if (!$q){
				  $result  = 'error';
				  $message = 'query error'; 
				  echo $result;
				  echo $message;
				}else{
					$result  = 'success';
					$message = 'query success'; 
					$sensitivities = array();
					while ($sensitivity = mysqli_fetch_array($q)){
						/* echo $sensitivity['Top25kpd1']; 
	
					}	 

				} */
	
	
		$query="SELECT ROUND(AVG(sensitivity_val),4) as Top25kpd2
					FROM 
					(SELECT sensitivity_val
					FROM sensitivities
					WHERE hpk > '33'
					AND kpd > '1.0'
					AND game = 'csgo') sensitivities";
		
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
				$sens0=$sensitivity['Top25kpd2'];
			}
		}	
		
		
		
		$query="SELECT ROUND(AVG(sensitivity_val),4) as Top25kpd2
			FROM 
			(SELECT sensitivity_val
			FROM sensitivities
			WHERE hpk > '40'
			AND kpd > '1.0'
			AND game = 'csgo') sensitivities";
		
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
				$sens1=$sensitivity['Top25kpd2'];
			}
		}	
		
		$query="SELECT ROUND(AVG(sensitivity_val),4) as Top25kpd2
			FROM 
			(SELECT sensitivity_val
			FROM sensitivities
			WHERE hpk > '50'
			AND kpd > '1.0'
			AND game = 'csgo') sensitivities";
		
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
		
		$query="SELECT ROUND(AVG(sensitivity_val),4) as Top25kpd2
			FROM 
			(SELECT sensitivity_val
			FROM sensitivities
			WHERE hpk > '60'
			AND kpd > '1.0'
			AND game = 'csgo') sensitivities";
		
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
				$sens3=$sensitivity['Top25kpd2'];
			}
		}
		
		
		?>
		