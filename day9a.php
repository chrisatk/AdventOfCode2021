<?php
require_once( $_SERVER['DOCUMENT_ROOT'] . '/advent_of_code/2021/Classes/autoloader.php' );
/** Error reporting */
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);

$input = new Input( 'https://tkinson.net/advent_of_code/2021/day9.txt' );
$input_line = $input->getInputAsChars();

$risk_level = 0;
foreach($input_line as $y=>$line) {
	foreach ($line as $x=>$item) {
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
					$risk_level += $item + 1;
		echo "Line ".$y." Item is ".$item." Up is ".$up." Down is ".$down." Left is ".$left." Right is ".$right." New Risk: ".$risk_level."<br />";
				}
			} elseif ( $right == NULL ) { // Right edge skip right
				if ( $item < $left && $item < $down ) {
					$risk_level += $item + 1;
		echo "Line ".$y." Item is ".$item." Up is ".$up." Down is ".$down." Left is ".$left." Right is ".$right." New Risk: ".$risk_level."<br />";
				}
			} else {
				if ( $item < $down && $item < $left && $item < $right ) {
					$risk_level += $item + 1;
		echo "Line ".$y." Item is ".$item." Up is ".$up." Down is ".$down." Left is ".$left." Right is ".$right." New Risk: ".$risk_level."<br />";
				}				
			} 
		} elseif ( $y == count($input_line)-1 ) { // Bottom Row skip Down
			if ( $left == NULL ) { // Left edge skip left
				if ( $item < $right && $item < $up ) {
					$risk_level += $item + 1;
		echo "Line ".$y." Item is ".$item." Up is ".$up." Down is ".$down." Left is ".$left." Right is ".$right." New Risk: ".$risk_level."<br />";
				}
			} elseif ( $right == NULL ) { // Right edge skip right
				if ( $item < $left && $item < $up ) {
					$risk_level += $item + 1;
		echo "Line ".$y." Item is ".$item." Up is ".$up." Down is ".$down." Left is ".$left." Right is ".$right." New Risk: ".$risk_level."<br />";
				}
			} else {
				if ( $item < $up && $item < $left && $item < $right ) {
					$risk_level += $item + 1;
		echo "Line ".$y." Item is ".$item." Up is ".$up." Down is ".$down." Left is ".$left." Right is ".$right." New Risk: ".$risk_level."<br />";
				}								
			}
		} else { // Between Rows, check up and down
			if ( $left == NULL ) { // Left edge skip left
				if ( $item < $right && $item < $up && $item < $down ) {
					$risk_level += $item + 1;
		echo "Line ".$y." Item is ".$item." Up is ".$up." Down is ".$down." Left is ".$left." Right is ".$right." New Risk: ".$risk_level."<br />";
				}
			} elseif ( $right == NULL ) { // Right edge skip right
				if ( $item < $left && $item < $up && $item < $down ) {
					$risk_level += $item + 1;
		echo "Line ".$y." Item is ".$item." Up is ".$up." Down is ".$down." Left is ".$left." Right is ".$right." New Risk: ".$risk_level."<br />";
				}
			} else {
				if ( $item < $up && $item < $down && $item < $left && $item < $right ) {
					$risk_level += $item + 1;
		echo "Line ".$y." Item is ".$item." Up is ".$up." Down is ".$down." Left is ".$left." Right is ".$right." New Risk: ".$risk_level."<br />";
				}								
			}
		}

	}
}

echo "Risk Sum: ".$risk_level;

?>