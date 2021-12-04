<?php
require_once( $_SERVER['DOCUMENT_ROOT'] . '/advent_of_code/2021/Classes/autoloader.php' );
/** Error reporting */
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);

$input = new Input( 'https://tkinson.net/advent_of_code/2021/day2.txt' );

$aim = 0;
$h=0;
$v=0;
foreach ($input->getInput() as $line) {
	$values = explode(" ", $line);

	if ( $values[0] != "forward" ) { // deal with vertical movement
		if ( $values[0] == "down" ) {
			$aim += $values[1];
		} else {
			$aim -= $values[1];
		}
	} else { // it's forward movement
		$h += $values[1];
		$v += $values[1]*$aim;
	}
}

echo "Horizontal: ".$h." Vertical ".$v." Solution: ".$h*$v;

?>