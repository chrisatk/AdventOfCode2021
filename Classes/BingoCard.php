<?php
require_once( $_SERVER['DOCUMENT_ROOT'] . '/advent_of_code/2021/Classes/autoloader.php' );

class BingoCard {
	private $card_number;
	private $card_values = array();
	private $unchecked_values_sum = 0;

	// Constructor
	public function __construct($card_number) {
		$this->card_number = $card_number;
	}

	public function getCardNumber(){
		return $this->card_number;
	}

	public function addLine( $ln ) {
		$newLine = array();
		foreach ($ln as $value) {
			$cardVal = new BingoCardNumber($value);
			array_push($newLine, $cardVal);
			$this->unchecked_values_sum += $value;
		}
		array_push( $this->card_values, $newLine );
		return;
	}

	public function callNumber( $val ) {
		// check every position for that value
		for ($row = 0; $row < 5; $row++ ){
			for ( $col = 0; $col < 5; $col++ ) {
				// if there is a match, mark it checked
				if ( $this->card_values[$row][$col]->getValue() == $val ) {
					$this->card_values[$row][$col]->checkValue();
					// Update the $unchecked_values_sum
					$this->unchecked_values_sum -= $val;
				}
			}
		}

		// Check for a winning card
		// Rows first
		for ($i = 0; $i < 5; $i++) {
			if ($this->card_values[$i][0]->isChecked() && $this->card_values[$i][1]->isChecked() && $this->card_values[$i][2]->isChecked() && $this->card_values[$i][3]->isChecked() && $this->card_values[$i][4]->isChecked() ) {
				return array("BINGO",$this->unchecked_values_sum);
			}
		}
		// cols next
		for ($i = 0; $i < 5; $i++) {
			if ($this->card_values[0][$i]->isChecked() && $this->card_values[1][$i]->isChecked() && $this->card_values[2][$i]->isChecked()&& $this->card_values[3][$i]->isChecked() && $this->card_values[4][$i]->isChecked()) {
				return array("BINGO",$this->unchecked_values_sum);
			}
		}

		return array("Better Luck Next Time", 0);

	}

	public function printCard() {
		for ($row = 0; $row < 5; $row++ ){
			for ( $col = 0; $col < 5; $col++ ) {
				echo $this->card_values[$row][$col]->getValue()." ";
			}
			echo "<br />\n";
		}
		return;
	}


}

?>