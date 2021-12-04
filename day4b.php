<?php
require_once( $_SERVER['DOCUMENT_ROOT'] . '/advent_of_code/2021/Classes/autoloader.php' );
/** Error reporting */
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);

$input = new Input( 'https://tkinson.net/advent_of_code/2021/day4.txt' );
$input_list = $input->getInput();

$card_stack = array();
$call_numbers = explode(",",$input_list[0]);

$number_of_cards = ( count( $input_list ) - 1 ) / 6;

for ( $crd = 0; $crd < $number_of_cards; $crd++ ) {
	$card = new BingoCard($crd);
	for ( $ln = 2; $ln < 7; $ln++ ) {
		$card->addLine(explode(" ", str_replace("  ", " ",$input_list[($crd*6)+$ln])));
	}
	array_push($card_stack, $card);
}

foreach ( $call_numbers as $call_number ) {
	foreach( $card_stack as $card ) {
//		$card->printCard();
		$result = $card->callNumber($call_number);
//		echo "Checking ".$call_number."<br />\n";
		if( $result[0] == "BINGO" && count( $card_stack ) > 1 ) {
			echo "BINGO on Card ".$card->getCardNumber()." Sum Remaining: ".$result[1]." Number just called: ".$call_number." Score: ".$result[1]*$call_number." Removing from the stack.<br />";
			unset($card_stack[$card->getCardNumber()]);
		} elseif( $result[0] == "BINGO" && count( $card_stack ) == 1 ) {
			echo "BINGO on Card ".$card->getCardNumber()." Sum Remaining: ".$result[1]." Number just called: ".$call_number." Score: ".$result[1]*$call_number."<br /><br />";
			break 2;
		}
	}
}

?>