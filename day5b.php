<?php
require_once( $_SERVER['DOCUMENT_ROOT'] . '/advent_of_code/2021/Classes/autoloader.php' );
/** Error reporting */
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);

$input = new Input( 'https://tkinson.net/advent_of_code/2021/day5.txt' );
$input_list = $input->getInput();

$hits = array();
for($i = 0; $i < 1000; $i++) {
	for($j = 0; $j < 1000; $j++) {
		$hits[$i][$j] = 0;
	}
}

$counter=0;
foreach( $input_list as $line ) {
	$input_list[$counter] = str_replace( " -> ",",",$line );
	$input_list[$counter] = explode(",",$input_list[$counter]);

	if ( $input_list[$counter][0] == $input_list[$counter][2] ) { // X matches, loop y
		if ( $input_list[$counter][1] < $input_list[$counter][3] ) {
			for( $y = $input_list[$counter][1]; $y <= $input_list[$counter][3]; $y++ ) {
				$hits[$input_list[$counter][0]][$y] += 1;
			}
		} else {
			for( $y = $input_list[$counter][3]; $y <= $input_list[$counter][1]; $y++ ) {
				$hits[$input_list[$counter][0]][$y] += 1;
			}
		}
	} elseif ( $input_list[$counter][1] == $input_list[$counter][3] ) { // Y matches, loop x
		if ( $input_list[$counter][0] < $input_list[$counter][2] ) {
			for( $x = $input_list[$counter][0]; $x <= $input_list[$counter][2]; $x++ ) {
				$hits[$x][$input_list[$counter][1]] += 1;
			}
		} else {
			for( $x = $input_list[$counter][2]; $x <= $input_list[$counter][0]; $x++ ) {
				$hits[$x][$input_list[$counter][1]] += 1;
			}
		}
	} else { // Diagonal
//		echo "Line ".$counter." is diagonal<br />";
			if( $input_list[$counter][0] < $input_list[$counter][2] ) { // Go right
				$lr = 1;
			} else { // Go left
				$lr = -1;
			}
			if( $input_list[$counter][1] < $input_list[$counter][3] ) { // Go down
				$ud = 1;
			} else { // Go up
				$ud = -1;
			}

			$miny = min( $input_list[$counter][1], $input_list[$counter][3] );
			$maxy = max( $input_list[$counter][1], $input_list[$counter][3] );
			$distance = $maxy-$miny+1;

			for( $increment=0; $increment < $distance; $increment++ ) {
				$hits[ ( $input_list[$counter][0]+($lr*$increment) ) ][ $input_list[$counter][1]+($ud*$increment) ] += 1;
//				echo "Hitting (".($input_list[$counter][0]+($lr*$increment)).",".($input_list[$counter][1]+($ud*$increment)).")<br >";
			}

	}


	$counter++;
}

// echo "<pre>\n";
// print_r($input_list);
// echo "</pre>\n";

//echo "<pre>\n";
$wins=0;
for($y=0; $y<count($hits); $y++) {
	for($x=0; $x< count($hits); $x++) {
		if ($hits[$x][$y] > 1) {
			$wins++;
		}
//		echo $hits[$x][$y];
	}
//	echo "<br />";
}
//echo "</pre>\n";

echo $wins." Wins ".count($hits);


?>