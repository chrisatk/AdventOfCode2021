<?php
require_once( $_SERVER['DOCUMENT_ROOT'] . '/advent_of_code/2021/Classes/autoloader.php' );
/** Error reporting */
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);

$input = new Input( 'https://tkinson.net/advent_of_code/2021/day9.txt' );
$input_line = $input->getInputAsChars();

$counted = array();

function printInput( $input_line, $counted ) {
	echo "<pre>\n";
	foreach($input_line as $y=>$line) {
		foreach($line as $x=>$item) {
			if ( isset( $counted[$y][$x] ) && $counted[$y][$x] == 1 ) {
				echo "<b style=color:red>".$item."</b>";
			} else {
				echo $item;
			}
		}
		echo "<br />\n";
	}
	echo "</pre>\n";
}

function testForLow ( $input_line, $y, $x ) {
	$item = $input_line[$y][$x];

	$up = NULL;
	$down = NULL;
	$left = NULL;
	$right = NULL;
	if ( isset( $input_line[$y-1][$x] ) ) { $up = $input_line[$y-1][$x]; }
	if ( isset( $input_line[$y+1][$x] ) ) { $down = $input_line[$y+1][$x]; }
	if ( isset( $input_line[$y][$x-1] ) ) { $left = $input_line[$y][$x-1]; }
	if ( isset( $input_line[$y][$x+1] ) ) { $right = $input_line[$y][$x+1]; }

	if ( $y == 0 ) { // Top Row skip Up
		if ( $left == NULL ) { // Left edge skip left
			if ( $item < $right && $item < $down ) {
				return array($y,$x);
			}
		} elseif ( $right == NULL ) { // Right edge skip right
			if ( $item < $left && $item < $down ) {
				return array($y,$x);
			}
		} else {
			if ( $item < $down && $item < $left && $item < $right ) {
				return array($y,$x);
			}				
		} 
	} elseif ( $y == count($input_line)-1 ) { // Bottom Row skip Down
		if ( $left == NULL ) { // Left edge skip left
			if ( $item < $right && $item < $up ) {
				return array($y,$x);
			}
		} elseif ( $right == NULL ) { // Right edge skip right
			if ( $item < $left && $item < $up ) {
				return array($y,$x);
			}
		} else {
			if ( $item < $up && $item < $left && $item < $right ) {
				return array($y,$x);
			}								
		}
	} else { // Between Rows, check up and down
		if ( $left == NULL ) { // Left edge skip left
			if ( $item < $right && $item < $up && $item < $down ) {
				return array($y,$x);
			}
		} elseif ( $right == NULL ) { // Right edge skip right
			if ( $item < $left && $item < $up && $item < $down ) {
				return array($y,$x);
			}
		} else {
			if ( $item < $up && $item < $down && $item < $left && $item < $right ) {
				return array($y,$x);
			}								
		}
	}

	return NULL;

}

function addToBasin( $y, $x ) {

	global $input_line;
	global $counted;
	$counted[$y][$x] = 1;
	$item = $input_line[$y][$x];

	$result = 0;

	$up = NULL;
	$down = NULL;
	$left = NULL;
	$right = NULL;
	if ( isset( $input_line[$y-1][$x] ) ) { $up = $input_line[$y-1][$x]; }
	if ( isset( $input_line[$y+1][$x] ) ) { $down = $input_line[$y+1][$x]; }
	if ( isset( $input_line[$y][$x-1] ) ) { $left = $input_line[$y][$x-1]; }
	if ( isset( $input_line[$y][$x+1] ) ) { $right = $input_line[$y][$x+1]; }

	if ( $y == 0 ) { // Top Row skip Up
		if ( $left == NULL ) { // Left edge skip left
			if ( $right > $item && $right < 9 ) {
				// echo "Current Value: ".$item." at (".$y.",".$x.") Moving To: ".$input_line[$y][$x+1]." at (".$y.",".($x+1).") <br />";
				if ( !isset( $counted[$y][$x+1] ) ) {
					$result += 1+ addToBasin($y, $x+1 );
				} else {
					// echo "Already Counted<br />";
				}
			} 
			if ( $down > $item && $down < 9 ) {
				// echo "Current Value: ".$item." at (".$y.",".$x.") Moving To: ".$input_line[$y+1][$x]." at (".($y+1).",".($x).") <br />";
				if ( !isset( $counted[$y+1][$x] ) ) {
					$result += 1+ addToBasin($y+1,$x );
				} else {
					// echo "Already Counted<br />";
				}
			}
		} elseif ( $right == NULL ) { // Right edge skip right
			if ( $left > $item && $left < 9 ) {
				// echo "Current Value: ".$item." at (".$y.",".$x.") Moving To: ".$input_line[$y][$x-1]." at (".($y).",".($x-1).") <br />";
				if ( !isset( $counted[$y][$x-1] ) ) {
					$result += 1+ addToBasin($y,$x-1 );
				} else {
					// echo "Already Counted<br />";
				}
			} 
			if ( $down > $item && $down < 9 ) {
				// echo "Current Value: ".$item." at (".$y.",".$x.") Moving To: ".$input_line[$y+1][$x]." at (".($y+1).",".($x).") <br />";
				if ( !isset( $counted[$y+1][$x] ) ) {
					$result += 1+ addToBasin($y+1,$x );
				} else {
					// echo "Already Counted<br />";
				}
			}
		} else {
			if ( $down > $item && $down < 9 ) {
				// echo "Current Value: ".$item." at (".$y.",".$x.") Moving To: ".$input_line[$y+1][$x]." at (".($y+1).",".($x).") <br />";
				if ( !isset( $counted[$y+1][$x] ) ) {
					$result += 1+ addToBasin($y+1,$x );
				} else {
					// echo "Already Counted<br />";
				}
			} 
			if ( $left > $item && $left < 9 ) {
				// echo "Current Value: ".$item." at (".$y.",".$x.") Moving To: ".$input_line[$y][$x-1]." at (".($y).",".($x-1).") <br />";
				if ( !isset( $counted[$y][$x-1] ) ) {
					$result += 1+ addToBasin($y,$x-1 );
				} else {
					// echo "Already Counted<br />";
				}
			} 
			if ( $right > $item && $right < 9 ) {
				// echo "Current Value: ".$item." at (".$y.",".$x.") Moving To: ".$input_line[$y][$x+1]." at (".($y).",".($x+1).") <br />";
				if ( !isset( $counted[$y][$x+1] ) ) {
					$result += 1+ addToBasin($y,$x+1 );
				} else {
					// echo "Already Counted<br />";
				}
			}
		} 
	} elseif ( $y == count($input_line)-1 ) { // Bottom Row)-1 ) { // skip Down
		if ( $left == NULL ) { // Left edge skip left
			if ( $up > $item && $up < 9 ) {
				// echo "Current Value: ".$item." at (".$y.",".$x.") Moving To: ".$input_line[$y-1][$x]." at (".($y-1).",".($x).") <br />";
				if ( !isset( $counted[$y-1][$x] ) ) {
					$result += 1+ addToBasin($y-1,$x );
				} else {
					// echo "Already Counted<br />";
				}
			} 
			if ( $right > $item && $right < 9 ) {
				// echo "Current Value: ".$item." at (".$y.",".$x.") Moving To: ".$input_line[$y][$x+1]." at (".($y).",".($x+1).") <br />";
				if ( !isset( $counted[$y][$x+1] ) ) {
					$result += 1+ addToBasin($y,$x+1 );
				} else {
					// echo "Already Counted<br />";
				}
			}
		} elseif ( $right == NULL ) { // Right edge skip right
			if ( $up > $item && $up < 9 ) {
				// echo "Current Value: ".$item." at (".$y.",".$x.") Moving To: ".$input_line[$y-1][$x]." at (".($y-1).",".($x).") <br />";
				if ( !isset( $counted[$y-1][$x] ) ) {
					$result += 1+ addToBasin($y-1,$x );
				} else {
					// echo "Already Counted<br />";
				}
			} 
			if ( $left > $item && $left < 9 ) {
				// echo "Current Value: ".$item." at (".$y.",".$x.") Moving To: ".$input_line[$y][$x-1]." at (".($y).",".($x-1).") <br />";
				if ( !isset( $counted[$y][$x-1] ) ) {
					$result += 1+ addToBasin($y,$x-1 );
				} else {
					// echo "Already Counted<br />";
				}
			}
		} else {
			if ( $up > $item && $up < 9 ) {
				// echo "Current Value: ".$item." at (".$y.",".$x.") Moving To: ".$input_line[$y-1][$x]." at (".($y-1).",".($x).") <br />";
				if ( !isset( $counted[$y-1][$x] ) ) {
					$result += 1+ addToBasin($y-1,$x );
				} else {
					// echo "Already Counted<br />";
				}
			} 
			if ( $left > $item && $left < 9 ) {
				// echo "Current Value: ".$item." at (".$y.",".$x.") Moving To: ".$input_line[$y][$x-1]." at (".($y).",".($x-1).") <br />";
				if ( !isset( $counted[$y][$x-1] ) ) {
					$result += 1+ addToBasin($y,$x-1 );
				} else {
					// echo "Already Counted<br />";
				}
			} 
			if ( $right > $item && $right < 9 ) {
				// echo "Current Value: ".$item." at (".$y.",".$x.") Moving To: ".$input_line[$y][$x+1]." at (".($y).",".($x+1).") <br />";
				if ( !isset( $counted[$y][$x+1] ) ) {
					$result += 1+ addToBasin($y,$x+1 );
				} else {
					// echo "Already Counted<br />";
				}
			}
		}
	} else { // Between Rows, check up and down
		if ( $left == NULL ) { // Left edge skip left
			if ( $up > $item && $up < 9 ) {
				// echo "Current Value: ".$item." at (".$y.",".$x.") Moving To: ".$input_line[$y-1][$x]." at (".($y-1).",".($x).") <br />";
				if ( !isset( $counted[$y-1][$x] ) ) {
					$result += 1+ addToBasin($y-1,$x );
				} else {
					// echo "Already Counted<br />";
				}
			} 
			if ( $down > $item && $down < 9 ) {
				// echo "Current Value: ".$item." at (".$y.",".$x.") Moving To: ".$input_line[$y][$x+1]." at (".($y+1).",".($x).") <br />";
				if ( !isset( $counted[$y+1][$x] ) ) {
					$result += 1+ addToBasin($y+1,$x );
				} else {
					// echo "Already Counted<br />";
				}
			} 
			if ( $right > $item && $right < 9 ) {
				// echo "Current Value: ".$item." at (".$y.",".$x.") Moving To: ".$input_line[$y][$x+1]." at (".($y).",".($x+1).") <br />";
				if ( !isset( $counted[$y][$x+1] ) ) {
					$result += 1+ addToBasin($y,$x+1 );
				} else {
					// echo "Already Counted<br />";
				}
			}
		} elseif ( $right == NULL ) { // Right edge skip right
			if ( $up > $item && $up < 9 ) {
				// echo "Current Value: ".$item." at (".$y.",".$x.") Moving To: ".$input_line[$y-1][$x]." at (".($y-1).",".($x).") <br />";
				if ( !isset( $counted[$y-1][$x] ) ) {
					$result += 1+ addToBasin($y-1,$x );
				} else {
					// echo "Already Counted<br />";
				}
			} 
			if ( $down > $item && $down < 9 ) {
				// echo "Current Value: ".$item." at (".$y.",".$x.") Moving To: ".$input_line[$y+1][$x]." at (".($y+1).",".($x).") <br />";
				if ( !isset( $counted[$y+1][$x] ) ) {
					$result += 1+ addToBasin($y+1,$x );
				} else {
					// echo "Already Counted<br />";
				}
			} 
			if ( $left > $item && $left < 9 ) {
				// echo "Current Value: ".$item." at (".$y.",".$x.") Moving To: ".$input_line[$y][$x-1]." at (".($y).",".($x-1).") <br />";
				if ( !isset( $counted[$y][$x-1] ) ) {
					$result += 1+ addToBasin($y,$x-1 );
				} else {
					// echo "Already Counted<br />";
				}
			}
		} else {
			if ( $up > $item && $up < 9 ) {
				// echo "Current Value: ".$item." at (".$y.",".$x.") Moving To: ".$input_line[$y-1][$x]." at (".($y-1).",".($x).") <br />";
				if ( !isset( $counted[$y-1][$x] ) ) {
					$result += 1+ addToBasin($y-1,$x );
				} else {
					// echo "Already Counted<br />";
				}
			} 
			if ( $down > $item && $down < 9 ) {
				// echo "Current Value: ".$item." at (".$y.",".$x.") Moving To: ".$input_line[$y+1][$x]." at (".($y+1).",".($x).") <br />";
				if ( !isset( $counted[$y+1][$x] ) ) {
					$result += 1+ addToBasin($y+1,$x );
				} else {
					// echo "Already Counted<br />";
				}
			} 
			if ( $left > $item && $left < 9 ) {
				// echo "Current Value: ".$item." at (".$y.",".$x.") Moving To: ".$input_line[$y][$x-1]." at (".($y).",".($x-1).") <br />";
				if ( !isset( $counted[$y][$x-1] ) ) {
					$result += 1+ addToBasin($y,$x-1 );
				} else {
					// echo "Already Counted<br />";
				}
			} 
			if ( $right > $item && $right < 9 ) {
				// echo "Current Value: ".$item." at (".$y.",".$x.") Moving To: ".$input_line[$y][$x+1]." at (".($y).",".($x+1).") <br />";
				if ( !isset( $counted[$y][$x+1] ) ) {
					$result += 1+ addToBasin($y,$x+1 );
				} else {
					// echo "Already Counted<br />";
				}
			}
		}
	}

	// echo "Result for ".$item." (".$y.",".$x.") is ".$result."<br />";

	return $result;
}


$low_points = array();
foreach($input_line as $y=>$line) {
	foreach ($line as $x=>$item) {
		$result = testForLow($input_line, $y, $x);
		if ( $result != NULL ) {
			array_push( $low_points, $result );
		}
	}
}

$basin_count = array();
foreach( $low_points as $node ) {
	$counted = array();
	$result = 1 + addToBasin( $node[0], $node[1] );
	array_push( $basin_count, $result );
	echo "<br />";

//	printInput($input_line, $counted);

//	echo "Result: ".$result."<br />";

}

// echo "<pre>\n";
// print_r ($basin_count);
// echo "</pre>\n";


rsort($basin_count);
echo "Top three values are: ".$basin_count[0].",".$basin_count[1].",".$basin_count[2]."<br />";
echo "Answer is ".$basin_count[0]*$basin_count[1]*$basin_count[2];





?>