<?php
require_once( $_SERVER['DOCUMENT_ROOT'] . '/advent_of_code/2021/Classes/autoloader.php' );
/** Error reporting */
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
ini_set('xdebug.max_nesting_level', 100);

$input = new Input( 'https://tkinson.net/advent_of_code/2021/day10.txt' );
$input_line = $input->getInputAsChars();

$score = 0;

function resetArrayKeys($arr) {
	$newList = array();
	foreach($arr as $item) {
		array_push($newList, $item);
	}
	return $newList;
}

function getMatch($str) {
	$match = "";
	switch($str) {
		case "(":
			$match = ")";
			break;
		case "[":
			$match = "]";
			break;
		case "{":
			$match = "}";
			break;
		case "<":
			$match = ">";
			break;
	}
	return $match;
}

echo "<pre>\n";

foreach($input_line as $line){

	// Eliminate Matches
	$newList = $line;
	for ($j=0; $j < count($line) / 2; $j++) {
		for( $i = 0; $i < count( $newList ); $i++ ) {
			if ( isset( $newList[$i] ) && isset( $newList[$i+1] ) && $newList[$i+1] == getMatch($newList[$i]) ) {
				unset($newList[$i]);
				unset($newList[$i+1]);
			} 
		}
		$newList = resetArrayKeys($newList);
	}
	echo "Eliminated Matches: ".implode($newList)."<br />";

	if (count($newList) == 0) {
		echo "proper list".implode($newList)."<br />";
	} else {
		// Eliminate Openers
		foreach ($newList as $key=>$val) {
			if ( $val == "(" || $val == "[" || $val == "{" || $val == "<" ) {
				unset($newList[$key]);
			} 
		}
		if (count($newList) == 0) {
			echo "Incomplete: ".implode($newList)."<br />";
		} else {
			$newList = resetArrayKeys($newList);
			echo "Corrupt: ".$newList[0]."<br />";
			if ($newList[0] == ")") { $score += 3; }
			if ($newList[0] == "]") { $score += 57; }
			if ($newList[0] == "}") { $score += 1197; }
			if ($newList[0] == ">") { $score += 25137; }
		}


	}





}

echo "</pre>\n";

echo "Total Score: ".$score;


?>