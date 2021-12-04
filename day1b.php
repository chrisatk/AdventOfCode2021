<?php
require_once( $_SERVER['DOCUMENT_ROOT'] . '/advent_of_code/2021/Classes/autoloader.php' );
/** Error reporting */
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);

$input = new Input( 'https://tkinson.net/advent_of_code/2021/day1.txt' );

$previous_line = "";
$count_increases = 0;

$the_list = $input->getInput(); // Store input as an array

for ($i = 3; $i < count($the_list); $i++ ) { // Go from #4 through the last element
	$first = $the_list[$i-3] + $the_list[$i-2] + $the_list[$i-1];
	$second = $the_list[$i-2] + $the_list[$i-1] + $the_list[$i];
echo "considering ".$first." and ".$second."<br />\n";
	if ( $first < $second ) {
		$count_increases++;
	}
}

echo "There were ".$count_increases." increases.";

?>