<?php 
		include ('conn.php');
		 // Connect to database
		$db_connection = mysqli_connect($db_server, $db_username, $db_password, $db_name);

		// Get average of sensitivities
		// Round(AVG(column),X) sets the decimal point limit.
		$query="SELECT ROUND(AVG(hpk),2) AS Average FROM sensitivities";
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
				echo $sensitivity['Average'];
			}
		}	
		?>