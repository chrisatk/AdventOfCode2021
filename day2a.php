<?php
require_once( $_SERVER['DOCUMENT_ROOT'] . '/advent_of_code/2021/Classes/autoloader.php' );
/** Error reporting */
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);

// Day 1a
$input = new Input( 'https://tkinson.net/advent_of_code/2021/day2.txt' );

$h=0;
$v=0;
foreach ($input->getInput() as $line) {
	$values = explode(" ", $line);

	if ( $values[0] != "forward" ) { // deal with vertical movement
		if ( $values[0] == "down" ) {
			$v += $values[1];
		} else {
			$v -= $values[1];
		}
	} else { // it's forward movement
		$h += $values[1];
	}
}

echo "Horizontal: ".$h." Vertical ".$v." Solution: ".$h*$v;

?>