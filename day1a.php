<?php
require_once( $_SERVER['DOCUMENT_ROOT'] . '/advent_of_code/2021/Classes/autoloader.php' );
/** Error reporting */
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);

// Day 1a
$input = new Input( 'https://tkinson.net/advent_of_code/2021/day1.txt' );

$previous_line = "";
$count_increases = 0;

foreach ($input->getInput() as $line) {
	if ( $previous_line < $line ) {
		$count_increases++;
	} 
	$previous_line = $line;
}

echo "There were ".$count_increases." increases.";

?>