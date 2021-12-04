<?php
require_once( $_SERVER['DOCUMENT_ROOT'] . '/advent_of_code/2021/Classes/autoloader.php' );
/** Error reporting */
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);

$input = new Input( 'https://tkinson.net/advent_of_code/2021/day3.txt' );


function whatsMostCommon( $myList, $position ) {
	$digits = array(0,0,0,0,0,0,0,0,0,0,0,0);
	foreach ($myList as $line) {
		for ( $i = 0; $i < 12; $i++ ) {
			$digits[$i] += $line[$i];
		}
	}

	if ( $digits[$position] < count( $myList ) / 2 ) {
		$result = 0;
	} else {
		$result = 1;
	}

	return $result;

}


$o2_list = $input->getInput();
for($pos =0; $pos< 12; $pos++) {
	$new_o2_list = array();
	for ($ln = 0; $ln < count($o2_list); $ln++) {
		if ($o2_list[$ln][$pos] == whatsMostCommon($o2_list, $pos)) {
			array_push($new_o2_list, $o2_list[$ln]);
		}
	}
	$o2_list = $new_o2_list;
	if (count($o2_list) == 1) { // Stop the process if we're down to one element
		break;
	}
}

echo $o2_list[0]." is the O2 Sensor<br />";

// Never repeat code...but I'm pressed for time so here we go...
$co2_list = $input->getInput();
for($pos =0; $pos< 12; $pos++) {
	$new_co2_list = array();
	for ($ln = 0; $ln < count($co2_list); $ln++) {
		if ($co2_list[$ln][$pos] != whatsMostCommon($co2_list, $pos)) {
			array_push($new_co2_list, $co2_list[$ln]);
		}
	}
	$co2_list = $new_co2_list;
	if (count($co2_list) == 1) { // Stop the process if we're down to one element
		break;
	}
}

echo $co2_list[0]." is the CO2 Scrubber<br />";

echo "Life Support is: ".bindec($o2_list[0])*bindec($co2_list[0]);


?>