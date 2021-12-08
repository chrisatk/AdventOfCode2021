<?php
require_once( $_SERVER['DOCUMENT_ROOT'] . '/advent_of_code/2021/Classes/autoloader.php' );
/** Error reporting */
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);

$input = new Input( 'https://tkinson.net/advent_of_code/2021/day6.txt' );
$input_line = $input->getInput();

$days = 256;
$initial_state = explode(",",$input_line[0]);

$fishes = array();

// Create the fish
foreach ($initial_state as $state) {
	array_push( $fishes, new LanternFish($state) );
}

for ( $i = 0; $i < $days; $i++ ) {
	foreach($fishes as $fish) {
		if ($fish->age() == "Spawn"){
			array_push( $fishes, new LanternFish(8) );
		}
	}
}


echo count($fishes)." Fish";

?>