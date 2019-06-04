<?php 
		include ('conn.php');
		 // Connect to database
		$db_connection = mysqli_connect($db_server, $db_username, $db_password, $db_name);

		// Get the Total Games, Wins, Draws, Losses and WinPercentage by Sensitivity Value
		// https://stackoverflow.com/questions/34638841/sql-select-statement-that-displays-number-of-wins-losses-based-off-a-value-win
		$query="SELECT sensitivity_val as SENSITIVITY, 
				count(*)  AS TotalGames,
				SUM(CASE WHEN result='win' THEN 1 ELSE 0 END) AS Wins,
				SUM(CASE WHEN result='draw' THEN 1 ELSE 0 END) AS Draws,
				COUNT(*)-SUM(CASE WHEN result='win' THEN 1 ELSE 0 END)-SUM(CASE WHEN result='draw' THEN 1 ELSE 0 END) AS Losses,
				SUM(CASE WHEN result='win' THEN 1 ELSE 0 END)*100/COUNT(*) AS WinPercentage
				FROM sensitivities 
				WHERE game='csgo'
				GROUP BY sensitivity_val
				ORDER BY WinPercentage Desc";
		$query = mysqli_query($db_connection, $query);
		if (!$query){
		  $result  = 'error';
		  $message = 'query error'; 
		  echo $result;
		  echo $message;
		} else {
			$result  = 'success';
			$message = 'query success';  
			
			
			echo "<table id='winPercentageTbl' border='1'>
			<tr>
			<th><strong>SENSITIVITY</strong></th>
			<th><strong>TOTALGAMES</strong></th>
			<th><strong>WINS</strong></th>
			<th><strong>DRAWS</strong></th>
			<th><strong>LOSSES</strong></th>
			<th><strong>WIN%</strong></th>
			</tr>";
			
			while ($sensitivity = mysqli_fetch_array($query)){
				echo "<tr>";
				echo "<td>" . $sensitivity['SENSITIVITY'] . "</td>";
				echo "<td>" . $sensitivity['TotalGames'] . "</td>";
				echo "<td>" . $sensitivity['Wins'] . "</td>";
				echo "<td>" . $sensitivity['Draws'] . "</td>";
				echo "<td>" . $sensitivity['Losses'] . "</td>";
				echo "<td>" . $sensitivity['WinPercentage'] . "</td>";
				echo "</tr>";
				
			}
			echo "</table>";
		}	
		?>




