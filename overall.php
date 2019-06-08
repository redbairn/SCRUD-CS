<?php 
		include('topavg.php');
		
		//How many numbers are in our set.
		$numbersInSet = 4;
		 
		//Get the sum of those numbers.
		$sum = $sens0 + $sens1 + $sens2 + $sens3;
		 
		//Calculate the average by dividing $sum by the
		//amount of numbers that are in our set.
		$average = $sum / $numbersInSet;
		
		echo round($average, 4);
		
		?>