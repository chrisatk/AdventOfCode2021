<?php
require_once( $_SERVER['DOCUMENT_ROOT'] . '/advent_of_code/2021/Classes/autoloader.php' );
/** Error reporting */
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);

$input = new Input( 'https://tkinson.net/advent_of_code/2021/day7.txt' );
$input_line = explode(",",$input->getInput()[0]);

$min_candidate = min($input_line);
$max_candidate = max($input_line);

$candidates = array();

for ($i = $min_candidate; $i <= $max_candidate; $i++ ) {
	$sum = 0;
	foreach($input_line as $input) {
		$sum += abs($input - $i);
	}
	array_push($candidates, $sum);
	echo "For Candidate: ".$i." Sum is: ".$sum."<br />";	
}

echo "Optimal sum is: ".min($candidates);

?>