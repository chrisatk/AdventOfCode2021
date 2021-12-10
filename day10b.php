<?php
require_once( $_SERVER['DOCUMENT_ROOT'] . '/advent_of_code/2021/Classes/autoloader.php' );
/** Error reporting */
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
ini_set('xdebug.max_nesting_level', 100);

$input = new Input( 'https://tkinson.net/advent_of_code/2021/day10.txt' );
$input_line = $input->getInputAsChars();

$score_list = array();

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
	$score = 0;

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

	$tryMe = $newList;
	// Eliminate Openers
	foreach ($tryMe as $key=>$val) {
		if ( $val == "(" || $val == "[" || $val == "{" || $val == "<" ) {
			unset($tryMe[$key]);
		} 
	}
	if (count($tryMe) == 0) {
		echo "Incomplete: ".implode($newList)."<br />";
		for ($i = count($newList)-1; $i >= 0; $i-- ) {
			$match = getMatch($newList[$i]);
			$score = $score * 5;
			if ($match == ")") { $score += 1; }
			if ($match == "]") { $score += 2; }
			if ($match == "}") { $score += 3; }
			if ($match == ">") { $score += 4; }
		}
		array_push($score_list, $score);

	} else {
		// Ignore Corrupt Lines
		// $newList = resetArrayKeys($newList);
		// echo "Corrupt: ".$newList[0]."<br />";
		// if ($newList[0] == ")") { $score += 3; }
		// if ($newList[0] == "]") { $score += 57; }
		// if ($newList[0] == "}") { $score += 1197; }
		// if ($newList[0] == ">") { $score += 25137; }
	}


}

sort($score_list);

print_r($score_list);

$middle = count($score_list)/2;

echo $score_list[$middle];

echo "</pre>\n";



?>