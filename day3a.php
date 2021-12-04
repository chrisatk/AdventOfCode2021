<?php
require_once( $_SERVER['DOCUMENT_ROOT'] . '/advent_of_code/2021/Classes/autoloader.php' );
/** Error reporting */
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);

$input = new Input( 'https://tkinson.net/advent_of_code/2021/day3.txt' );

$digits = array(0,0,0,0,0,0,0,0,0,0,0,0);

foreach ($input->getInput() as $line) {
	for ( $i = 0; $i < 12; $i++ ) {
		$digits[$i] += $line[$i];
	}
}

for ( $i = 0; $i < 12; $i++ ) {
	if ( $digits[$i] < count( $input->getInput() ) / 2 ) {
		$gamma[$i] = 0;
		$epsilon[$i] = 1;
	} else {
		$gamma[$i] = 1;
		$epsilon[$i] = 0;
	}
}


echo "gamma = ".implode($gamma)."<br />\n";
echo "epsilon = ".implode($epsilon)."<br />\n";

echo bindec(implode($gamma)) * bindec(implode($epsilon))." Solution";

?>