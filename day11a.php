<?php
require_once( $_SERVER['DOCUMENT_ROOT'] . '/advent_of_code/2021/Classes/autoloader.php' );
/** Error reporting */
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
ini_set('xdebug.max_nesting_level', 100);

$input = new Input( 'https://tkinson.net/advent_of_code/2021/day11.txt' );
$input_line = $input->getInputAsChars();

$flashes = 0;
$allow_zero = array();
$node_list = array();

function increaseEnergyLevel( $y, $x ) {
	global $node_list;
	global $allow_zero;
	$returnVal = 0;
	if ( $node_list[$y][$x] > 0 || isset( $allow_zero[$y][$x] ) ) {
//		echo "Increasing (".$y.", ".$x.") from ".$node_list[$y][$x]." to ".($node_list[$y][$x]+1)."<br />";
		$node_list[$y][$x]++;
		if( $node_list[$y][$x] == 10 ) {
			$returnVal = flash( $y, $x );
		}
	}
	return $returnVal;
}

function flash( $y, $x ) {
	global $node_list;
	$returnVal = 0;
	$node_list[$y][$x] = 0;
	$returnVal++;
	if ( isset( $node_list[$y-1][$x] ) ) { $returnVal += increaseEnergyLevel( $y-1, $x ); } // N
	if ( isset( $node_list[$y-1][$x+1] ) ) { $returnVal += increaseEnergyLevel( $y-1, $x+1 ); } // NE
	if ( isset( $node_list[$y][$x+1] ) ) { $returnVal += increaseEnergyLevel( $y, $x+1 ); } // E
	if ( isset( $node_list[$y+1][$x+1] ) ) { $returnVal += increaseEnergyLevel( $y+1, $x+1 ); } // SE
	if ( isset( $node_list[$y+1][$x] ) ) { $returnVal += increaseEnergyLevel( $y+1, $x ); } // S
	if ( isset( $node_list[$y+1][$x-1] ) ) { $returnVal += increaseEnergyLevel( $y+1, $x-1 ); } // SW
	if ( isset( $node_list[$y][$x-1] ) ) { $returnVal += increaseEnergyLevel( $y, $x-1 ); } // W
	if ( isset( $node_list[$y-1][$x-1] ) ) { $returnVal += increaseEnergyLevel( $y-1, $x-1 ); } // NW
	return $returnVal;
}

function printList() {
	global $node_list;
	echo "<pre>\n";
	foreach( $node_list as $y=>$line ){
		foreach( $line as $x=>$item ) {
			echo $node_list[$y][$x];
		}
		echo "<br />";
	}
	echo "</pre>\n";
}



// Populate the list
foreach( $input_line as $y=>$line ){
	foreach( $line as $x=>$item ) {
		$node_list[$y][$x] = $item;
	}
}


// Pre Print
printList();

// Increase
for ( $i = 0; $i < 100; $i++ ) {
	foreach( $node_list as $y=>$line ){
		foreach( $line as $x=>$item ) {
			$flashes += increaseEnergyLevel( $y, $x );
		}
	}

	$allow_zero = array();
	foreach( $node_list as $y=>$line ){
		foreach( $line as $x=>$item ) {
			if ($node_list[$y][$x] == 0) {
				$allow_zero[$y][$x] = 1;
			}
		}
	}

}



printList();

echo "Total Flashes: ".$flashes;


?>