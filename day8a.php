<?php
require_once( $_SERVER['DOCUMENT_ROOT'] . '/advent_of_code/2021/Classes/autoloader.php' );
/** Error reporting */
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);

$input = new Input( 'https://tkinson.net/advent_of_code/2021/day8.txt' );
$input_line = $input->getInput();

$count = 0;
$wins = array(2, 4, 3, 7);
foreach($input_line as $line) {
	$items = explode("|",$line);
	$digits = explode(" ",trim($items[1]));
	foreach ($digits as $digit) {
//		echo "Checking ".$digit."<br />";
		if ( in_array( strlen($digit), $wins) ) {
			$count++;
//			echo "Win<br />";
		}

	}
}

echo $count." wins";

?>