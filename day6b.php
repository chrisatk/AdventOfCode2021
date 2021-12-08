<?php
require_once( $_SERVER['DOCUMENT_ROOT'] . '/advent_of_code/2021/Classes/autoloader.php' );
/** Error reporting */
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);

$input = new Input( 'https://tkinson.net/advent_of_code/2021/day6.txt' );
$input_line = $input->getInput();

$initial_state = explode(",",$input_line[0]);
$fish_count = 0;

// Launch monster AWS Instance to calculate 256 days for each start state using python since php can't handle the memory allocation.
// Admittedly, this is a brute force approach.
$count = 0;
foreach ($initial_state as $state) {
	if ($state == 1) {
		$fish_count += 6206821033;
	} elseif ($state == 2) {
		$fish_count += 5617089148;
	} elseif ($state == 3) {
		$fish_count += 5217223242;
	} elseif ($state == 4) {
		$fish_count += 4726100874;
	} elseif ($state == 5) {
		$fish_count += 4368232009;
	}
	$count++;
}

echo "A whopping ".($fish_count)." Across ".$count." inputs<br />";


?>