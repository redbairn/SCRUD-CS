<!doctype html>
<html lang="en" dir="ltr">
  <head>
    <title>Sensitivity SCRUD system</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=1000, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <link rel="stylesheet" href="//fonts.googleapis.com/css?family=Oxygen:400,700">
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="layout.css">
    <script charset="utf-8" src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script charset="utf-8" src="//cdn.datatables.net/1.10.0/js/jquery.dataTables.js"></script>
    <script charset="utf-8" src="//cdn.jsdelivr.net/jquery.validation/1.13.1/jquery.validate.min.js"></script>
    <script charset="utf-8" src="webapp.js"></script>
  </head>
  <body>

    <div id="page_container">

      <h1>Sensitivities</h1>
	  
	  
	<div class="arrow_box">
		<h2 class="averages">Averages:</h2><br />
		<h3 class="averages">Avg Sensitivity ( <?php include ('sensavg.php');?> )</h3><br />
		<h3 class="averages" >Avg KPD ( <?php include ('kpdavg.php');?> )</h3><br />
		<h3 class="averages" >Avg Headshot % ( <?php include ('hsavg.php');?> )</h3><br />
	</div>
	
	

      <button type="button" class="button" id="add_sensitivity">Add sensitivity</button>

      <table class="datatable" id="table_sensitivities">
        <thead>
          <tr>
		  	<th>Date_Created</th>
			<th>Date_Updated</th>
            <th>Sensitivity</th>
            <th>KPD</th>
            <th>Kills</th>
			<th>Deaths</th>
			<th>HS (#)</th>
			<th>HPK (%)</th>
			<th>Acc (%)</th>
			<th>2k</th>
			<th>3k</th>
			<th>4k</th>
			<th>5k</th>
			<th>Result</th>
			<th>Score</th>
			<th>Map</th>
            <th>Game</th>
			<th id="comments">Comment</th>
            <th>Functions</th>
          </tr>
        </thead>
        <tbody>
        </tbody>
      </table>

    </div>

    <div class="lightbox_bg"></div>

    <div class="lightbox_container">
      <div class="lightbox_close"></div>
      <div class="lightbox_content">
        <!--step and min for input type-->
        <h2>Add sensitivity</h2>
        <form class="form add" id="form_sensitivity" data-id="" novalidate>
          <div class="input_container">
            <label for="sensitivity_val">Sensitivity: <span class="required">*</span></label>
            <div class="field_container">
              <input type="number" class="text" name="sensitivity_val" id="sensitivity_val" value="" required>
            </div>
          </div>
          <div class="input_container">
            <label for="kpd">Kills Per Death: <span class="required">*</span></label>
            <div class="field_container">
              <input type="number" class="text" name="kpd" id="kpd" value="" min="0" max="50" step="0.01" required>
            </div>
          </div>
          <div class="input_container">
            <label for="kills">Kills: <span class="required">*</span></label>
            <div class="field_container">
              <input type="number" class="text" name="kills" id="kills" value="" min="0" max="200" step="1" required>
            </div>
          </div>
          <div class="input_container">
            <label for="deaths">Deaths: <span class="required">*</span></label>
            <div class="field_container">
              <input type="number" class="text" name="deaths" id="deaths" value="" min="0" max="200" step="1" required>
            </div>
          </div>
		  <div class="input_container">
            <label for="headshot">Headshot: <span class="required">*</span></label>
            <div class="field_container">
              <input type="number" class="text" name="headshot" id="headshot" value="" min="0" max="200" pattern="\d*" maxlength="3" required>
            </div>
          </div>
		  <div class="input_container">
            <label for="hpk">HPK (%): <span class="required">*</span></label>
            <div class="field_container">
              <input type="number" class="text" name="hpk" id="hpk" value="" min="0" max="100" pattern="\d*" maxlength="3" required>
            </div>
          </div>
		   <div class="input_container">
            <label for="accuracy">Accuracy(%): <span class="required">*</span></label>
            <div class="field_container">
              <input type="number" class="text" name="accuracy" id="accuracy" value="" min="0" max="100" pattern="\d*" maxlength="3" required>
            </div>
          </div>
		  <div class="input_container">
            <label for="twok">2K: <span class="required">*</span></label>
            <div class="field_container">
              <input type="number" class="text" name="twok" id="twok" value="" min="0" max="30" pattern="\d*" maxlength="2">
            </div>
          </div>
		  <div class="input_container">
            <label for="threek">3K: <span class="required">*</span></label>
            <div class="field_container">
              <input type="number" class="text" name="threek" id="threek" value="" min="0" max="30" pattern="\d*" maxlength="2">
            </div>
          </div>
		  <div class="input_container">
            <label for="fourk">4K: <span class="required">*</span></label>
            <div class="field_container">
              <input type="number" class="text" name="fourk" id="fourk" value="" min="0" max="30" pattern="\d*" maxlength="2">
            </div>
          </div>
		  <div class="input_container">
            <label for="fivek">5K: <span class="required">*</span></label>
            <div class="field_container">
              <input type="number" class="text" name="fivek" id="fivek" value="" min="0" max="30" pattern="\d*" maxlength="2">
            </div>
          </div>
		  <div class="input_container">
            <label for="result">Win/Loss: <span class="required">*</span></label>
            <div class="field_container">
			<div class="field_container">
				<select name="result" class="text" id="result" value="" required>
					<option value="win">Win</option>
					<option value="loss">Loss</option>
				</select>
			</div>
            </div>
          </div>
		  <div class="input_container">
            <label for="score">Score: <span class="required">*</span></label>
            <div class="field_container">
              <input type="text" class="text" name="score" id="score" value="" required>
            </div>
          </div>
 		  <div class="input_container">
            <label for="map_played">Map: <span class="required">*</span></label>
			<div class="field_container">
				<select name="map_played" class="text" id="map_played" value="" required>
					<option value="AUSTRIA">Austria</option>
					<option value="AZTEC">Aztec</option>
					<option value="CACHE">Cache</option>
					<option value="CANALS">Canals</option>
					<option value="CBBLE">Cobblestone</option>
					<option value="DUST" selected="selected">Dust</option>
					<option value="DUST2" selected="selected">Dust2</option>
					<option value="INFERNO">Inferno</option>
					<option value="MIRAGE">Mirage</option>
					<option value="NUKE">Nuke</option>
					<option value="OVERPASS">Overpass</option>
					<option value="SEASON">Season</option>
					<option value="TRAIN">Train</option>
					<option value="VERTIGO">Vertigo</option>
				</select>
			</div>
          </div>
          <div class="input_container">
            <label for="game">Game: <span class="required">*</span></label>
			<div class="field_container">
				<select name="game" class="text" id="game" value="" required>
					<option value="CSS" selected="selected">Counter Strike Source</option>
					<option value="CSGO">Counter Strike Global Offensive</option>
				</select>
			</div>
          </div>
		  <div class="input_container">
            <label for="comment">Comment: </label>
			<div class="field_container">
				<input type="text" class="text" name="comment" id="comment" value="">
			</div>
          </div>
          <div class="button_container">
            <button type="submit">Add sensitivity</button>
          </div>
        </form>
        
      </div>
    </div>

    <noscript id="noscript_container">
      <div id="noscript" class="error">
        <p>JavaScript support is needed to use this page.</p>
      </div>
    </noscript>

    <div id="message_container">
      <div id="message" class="success">
        <p>This is a success message.</p>
      </div>
    </div>

    <div id="loading_container">
      <div id="loading_container2">
        <div id="loading_container3">
          <div id="loading_container4">
            Loading, please wait...
          </div>
        </div>
      </div>
    </div>

  </body>
</html>