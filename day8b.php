<?php
require_once( $_SERVER['DOCUMENT_ROOT'] . '/advent_of_code/2021/Classes/autoloader.php' );
/** Error reporting */
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);


function sort_string( $str ) {
	$stringParts = str_split($str);
	sort($stringParts);
	return implode($stringParts);
}

function getDigit ($A,$B,$C,$D,$E,$F,$G, $digit) {

	if ( sort_string($digit) == sort_string($B.$C) ) {
		return 1;
	} elseif ( sort_string($digit) == sort_string($A.$B.$G.$E.$D) ) {
		return 2;
	} elseif ( sort_string($digit) == sort_string($A.$B.$G.$C.$D) ) {
		return 3;
	} elseif ( sort_string($digit) == sort_string($F.$B.$G.$C) ) {
		return 4;
	} elseif ( sort_string($digit) == sort_string($A.$F.$G.$C.$D) ) {
		return 5;
	} elseif ( sort_string($digit) == sort_string($A.$F.$G.$C.$D.$E) ) {
		return 6;
	} elseif ( sort_string($digit) == sort_string($A.$B.$C) ) {
		return 7;
	} elseif ( sort_string($digit) == sort_string($A.$B.$C.$D.$E.$F.$G) ) {
		return 8;
	} elseif ( sort_string($digit) == sort_string($A.$B.$C.$D.$F.$G) ) {
		return 9;
	} elseif ( sort_string($digit) == sort_string($A.$B.$C.$D.$E.$F) ) {
		return 0;
	}

	return;
}



$input = new Input( 'https://tkinson.net/advent_of_code/2021/day8.txt' );
$input_line = $input->getInput();

$sum = 0;
foreach($input_line as $line) {

	$items = explode("|",$line);
	$signals = explode(" ",trim($items[0]));
	$digits = explode(" ",trim($items[1]));

	// Drop the 8
	foreach ( $signals as $key => $signal ) {
		if ( strlen($signal) == 7 ){
			unset($signals[$key]);
		} 
	}
	// Work with 1
	foreach ( $signals as $key => $signal ) {
		if ( strlen($signal) == 2 ){
			$count_occurrences = 0;
			foreach ( $signals as $key2 => $signal2 ) {
				if ( substr_count($signal2, $signal[0]) ) {
					$count_occurrences++;
				}
			}
			if ($count_occurrences == 7) {
				$B = $signal[0];
				$C = $signal[1];
			} else {
				$B = $signal[1];
				$C = $signal[0];
			}
			unset($signals[$key]);
		} 
	}
	// Work with 7
	foreach ( $signals as $key => $signal ) {
		if ( strlen($signal) == 3 ){
			for( $j = 0; $j < strlen($signal); $j++ ) {
				if ($signal[$j] != $B && $signal[$j] != $C) {
					$A = $signal[$j];
				}
			}
			unset($signals[$key]);
		} 
	}
	// Work with 4
	foreach ( $signals as $key => $signal ) {
		if ( strlen($signal) == 4 ){
			// Clean up known characters leaving only the two unknowns.
			$new_signal = str_replace( $B, "", $signal );
			$new_signal =	str_replace( $C, "", $new_signal );
			$count_occurrences = 0;
			foreach ( $signals as $key2 => $signal2 ) {
				if ( substr_count($signal2, $new_signal[0]) ) {
					$count_occurrences++;
				}
			}
			if ($count_occurrences == 5) {
				$F = $new_signal[0];
				$G = $new_signal[1];
			} else {
				$F = $new_signal[1];
				$G = $new_signal[0];
			}
			unset($signals[$key]);
		} 
	}

	// Work with the rest
	$the_rest = implode($signals);
	$the_rest = str_replace($A, "", $the_rest);
	$the_rest = str_replace($B, "", $the_rest);
	$the_rest = str_replace($C, "", $the_rest);
	$the_rest = str_replace($F, "", $the_rest);
	$the_rest = str_replace($G, "", $the_rest);

	$values = str_split($the_rest);
	$unique_values = array_unique($values);
	// re-order keys
	$my_uv = array();
	foreach($unique_values as $value) {
		array_push($my_uv, $value);
	}

	if ( substr_count( $the_rest, $my_uv[0] ) == 6 ) {
		$D = $my_uv[0];
		$E = $my_uv[1];
	} else {
		$D = $my_uv[1];
		$E = $my_uv[0];
	}


	// Calculate Values
	$val = 0;
	for ( $i = 0; $i < 4; $i++ ) {
		$val += (1000/pow(10,$i)) * getDigit($A,$B,$C,$D,$E,$F,$G,$digits[$i]);
	}
	$sum += $val;

}

echo "Total Sum: ".$sum;

?>