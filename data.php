<?php
include 'conn.php';

// Get job (and id)
$job = '';
$id  = '';
if (isset($_GET['job'])){
  $job = $_GET['job'];
  if ($job == 'get_sensitivities' ||
      $job == 'get_sensitivity'   ||
      $job == 'add_sensitivity'   ||
      $job == 'edit_sensitivity'  ||
      $job == 'delete_sensitivity'){
    if (isset($_GET['id'])){
      $id = $_GET['id'];
      if (!is_numeric($id)){
        $id = '';
      }
    }
  } else {
    $job = '';
  }
}

// Prepare array
$mysql_data = array();

// Valid job found
if ($job != ''){
  
  // Connect to database
  $db_connection = mysqli_connect($db_server, $db_username, $db_password, $db_name);
  if (mysqli_connect_errno()){
    $result  = 'error';
    $message = 'Failed to connect to database: ' . mysqli_connect_error();
    $job     = '';
  }
  
  // Execute job	
  if ($job == 'get_sensitivities'){
 
    // Get sensitivities
    $query = "SELECT * FROM sensitivities ORDER BY date_created";
    $query = mysqli_query($db_connection, $query);
    if (!$query){
      $result  = 'error';
      $message = 'query error';
    } else {
      $result  = 'success';
      $message = 'query success';
      while ($sensitivity = mysqli_fetch_array($query)){
        $functions  = '<div class="function_buttons"><ul>';
        $functions .= '<li class="function_edit"><a data-id="'   . $sensitivity['sensitivity_id'] . '" data-name="' . $sensitivity['sensitivity_val'] . '"><span>Edit</span></a></li>';
        $functions .= '<li class="function_delete"><a data-id="' . $sensitivity['sensitivity_id'] . '" data-name="' . $sensitivity['sensitivity_val'] . '"><span>Delete</span></a></li>';
        $functions .= '</ul></div>';
        $mysql_data[] = array(
			"date_created"  => $sensitivity['date_created'],
			"date_updated"  => $sensitivity['date_updated'],
			"sensitivity_val" => $sensitivity['sensitivity_val'],
			"kpd"  => $sensitivity['kpd'],
			"kills"     => $sensitivity['kills'],
			"deaths"    => $sensitivity['deaths'],
			"headshot"    => $sensitivity['headshot'],
			"hpk"    => round($sensitivity['hpk'], 3)*100,
			"accuracy"    => $sensitivity['accuracy'],
			"twok"    => $sensitivity['twok'],
			"threek"    => $sensitivity['threek'],
			"fourk"    => $sensitivity['fourk'],
			"fivek"    => $sensitivity['fivek'],
			"result"    => $sensitivity['result'],
			"score"    => $sensitivity['score'],
			"map_played"  => $sensitivity['map_played'],
			"game"  => $sensitivity['game'],
			"comment"  => $sensitivity['comment'],
			"functions"     => $functions
        );
      }
    }
    
  } elseif ($job == 'get_sensitivity'){
    
    // Get sensitivity
    if ($id == ''){
      $result  = 'error';
      $message = 'id missing';
    } else {
      $query = "SELECT * FROM sensitivities WHERE sensitivity_id = '" . mysqli_real_escape_string($db_connection, $id) . "'";
      $query = mysqli_query($db_connection, $query);
      if (!$query){
        $result  = 'error';
        $message = 'query error';
      } else {
        $result  = 'success';
        $message = 'query success';
        while ($sensitivity = mysqli_fetch_array($query)){
          $mysql_data[] = array(
		  	"date_created"  => $sensitivity['date_created'],
			"date_updated"  => $sensitivity['date_updated'],
            "sensitivity_val"          => $sensitivity['sensitivity_val'],
            "kpd"  => $sensitivity['kpd'],
            "kills"     => $sensitivity['kills'],
            "deaths"    => $sensitivity['deaths'],
			"headshot"    => $sensitivity['headshot'],
			"hpk"    => $sensitivity['hpk'],
			"accuracy"    => $sensitivity['accuracy'],
			"twok"    => $sensitivity['twok'],
			"threek"    => $sensitivity['threek'],
			"fourk"    => $sensitivity['fourk'],
			"fivek"    => $sensitivity['fivek'],
			"result"    => $sensitivity['result'],
			"score"    => $sensitivity['score'],
			"map_played"  => $sensitivity['map_played'],
            "comment"  => $sensitivity['comment'],
			"game"  => $sensitivity['game']
          );
        }
      }
    }
  
  } elseif ($job == 'add_sensitivity'){
    
    // Add sensitivity
	//_To calculate the kpd
	$kills		=$_GET['kills'];
	$deaths		=$_GET['deaths'];
	$kpd_total	=(float)$kills / (float)$deaths;
	//_To calculate the hpk
	$headshots	=$_GET['headshot'];
	$hpk_total	= (float)$headshots / (float)$kills;
	
    $query = "INSERT INTO sensitivities SET ";
    if (isset($_GET['sensitivity_val']))         { $query .= "sensitivity_val         = '" . mysqli_real_escape_string($db_connection, $_GET['sensitivity_val'])         . "', "; }
	$query .= "kpd = '" . mysqli_real_escape_string($db_connection, $kpd_total) . "', ";
    if (isset($_GET['kills']))    { $query .= "kills    = '" . mysqli_real_escape_string($db_connection, $_GET['kills'])    . "', "; }
    if (isset($_GET['deaths']))   { $query .= "deaths   = '" . mysqli_real_escape_string($db_connection, $_GET['deaths'])   . "', "; }
	if (isset($_GET['headshot']))   { $query .= "headshot   = '" . mysqli_real_escape_string($db_connection, $_GET['headshot'])   . "', "; }
	$query .= "hpk   = '" . mysqli_real_escape_string($db_connection, $hpk_total)   . "', ";
	if (isset($_GET['accuracy']))   { $query .= "accuracy   = '" . mysqli_real_escape_string($db_connection, $_GET['accuracy'])   . "', "; }
	if (isset($_GET['twok']))   { $query .= "twok   = '" . mysqli_real_escape_string($db_connection, $_GET['twok'])   . "', "; }
	if (isset($_GET['threek']))   { $query .= "threek   = '" . mysqli_real_escape_string($db_connection, $_GET['threek'])   . "', "; }
	if (isset($_GET['fourk']))   { $query .= "fourk   = '" . mysqli_real_escape_string($db_connection, $_GET['fourk'])   . "', "; }
	if (isset($_GET['fivek']))   { $query .= "fivek   = '" . mysqli_real_escape_string($db_connection, $_GET['fivek'])   . "', "; }
	if (isset($_GET['result']))   { $query .= "result   = '" . mysqli_real_escape_string($db_connection, $_GET['result'])   . "', "; }
	if (isset($_GET['score']))   { $query .= "score   = '" . mysqli_real_escape_string($db_connection, $_GET['score'])   . "', "; }
	if (isset($_GET['map_played'])) { $query .= "map_played = '" . mysqli_real_escape_string($db_connection, $_GET['map_played']) . "',";   }
    if (isset($_GET['game'])) { $query .= "game = '" . mysqli_real_escape_string($db_connection, $_GET['game']) . "',";   }
	if (isset($_GET['comment'])) { $query .= "comment = '" . mysqli_real_escape_string($db_connection, $_GET['comment']) . "'";   }
	$query = mysqli_query($db_connection, $query);
    if (!$query){
      $result  = 'error';
      $message = 'query error';
    } else {
      $result  = 'success';
      $message = 'query success';
    }
  
  } elseif ($job == 'edit_sensitivity'){
    
    // Edit sensitivity
    if ($id == ''){
      $result  = 'error';
      $message = 'id missing';
    } else {
      $query = "UPDATE sensitivities SET ";
		if (isset($_GET['sensitivity_val']))         { $query .= "sensitivity_val         = '" . mysqli_real_escape_string($db_connection, $_GET['sensitivity_val'])         . "', "; }
		if (isset($_GET['kpd'])) { $query .= "kpd = '" . mysqli_real_escape_string($db_connection, $_GET['kpd']) . "', "; }
		if (isset($_GET['kills']))    { $query .= "kills    = '" . mysqli_real_escape_string($db_connection, $_GET['kills'])    . "', "; }
		if (isset($_GET['deaths']))   { $query .= "deaths   = '" . mysqli_real_escape_string($db_connection, $_GET['deaths'])   . "', "; }
		if (isset($_GET['headshot']))   { $query .= "headshot   = '" . mysqli_real_escape_string($db_connection, $_GET['headshot'])   . "', "; }
		if (isset($_GET['hpk']))   { $query .= "hpk   = '" . mysqli_real_escape_string($db_connection, $_GET['hpk'])   . "', "; }
		if (isset($_GET['accuracy']))   { $query .= "accuracy   = '" . mysqli_real_escape_string($db_connection, $_GET['accuracy'])   . "', "; }
		if (isset($_GET['twok']))   { $query .= "twok   = '" . mysqli_real_escape_string($db_connection, $_GET['twok'])   . "', "; }
		if (isset($_GET['threek']))   { $query .= "threek   = '" . mysqli_real_escape_string($db_connection, $_GET['threek'])   . "', "; }
		if (isset($_GET['fourk']))   { $query .= "fourk   = '" . mysqli_real_escape_string($db_connection, $_GET['fourk'])   . "', "; }
		if (isset($_GET['fivek']))   { $query .= "fivek   = '" . mysqli_real_escape_string($db_connection, $_GET['fivek'])   . "', "; }
		if (isset($_GET['result']))   { $query .= "result   = '" . mysqli_real_escape_string($db_connection, $_GET['result'])   . "', "; }
		if (isset($_GET['score']))   { $query .= "score   = '" . mysqli_real_escape_string($db_connection, $_GET['score'])   . "', "; }
		# Becareful if the comma that breaks up each value for the update/insert
		if (isset($_GET['map_played'])) { $query .= "map_played = '" . mysqli_real_escape_string($db_connection, $_GET['map_played']) . "',";   }
		if (isset($_GET['game'])) { $query .= "game = '" . mysqli_real_escape_string($db_connection, $_GET['game']) . "',";   }
		if (isset($_GET['comment'])) { $query .= "comment = '" . mysqli_real_escape_string($db_connection, $_GET['comment']) . "'";   }
      $query .= "WHERE sensitivity_id = '" . mysqli_real_escape_string($db_connection, $id) . "'";
      $query  = mysqli_query($db_connection, $query);
      if (!$query){
        $result  = 'error';
        $message = 'query error';
      } else {
        $result  = 'success';
        $message = 'query success';
      }
    }
    
  } elseif ($job == 'delete_sensitivity'){
  
    // Delete sensitivity
    if ($id == ''){
      $result  = 'error';
      $message = 'id missing';
    } else {
      $query = "DELETE FROM sensitivities WHERE sensitivity_id = '" . mysqli_real_escape_string($db_connection, $id) . "'";
      $query = mysqli_query($db_connection, $query);
      if (!$query){
        $result  = 'error';
        $message = 'query error';
      } else {
        $result  = 'success';
        $message = 'query success';
      }
    }
  
  }
  
  // Close database connection
  mysqli_close($db_connection);

}

// Prepare data
$data = array(
  "result"  => $result,
  "message" => $message,
  "data"    => $mysql_data
);

// Convert PHP array to JSON array
$json_data = json_encode($data);
print $json_data;
?>