<?php

class Input {
	private $input = array();

	// Constructor
	public function __construct( $url ) {

		$myfile = fopen($url, "r") or die("Unable to open file!");
		// Add each line until end of file
		while(!feof($myfile)) {
		  array_push( $this->input, trim(fgets($myfile)) );
		}
		fclose($myfile);

	}

	public function getInput() {
		return $this->input;
	}

	public function getInputAsChars() {
		$new_array = array();
		foreach ( $this->input as $line ) {
			$items = str_split( trim( $line ) );
			array_push( $new_array, $items ); 
		}
		return $new_array;
	}
	

	public function print() {
		foreach ( $this->input as $line ) {
			echo $line."<br />";
		}
		return;
	}


	public function printByChars( $highlight = NULL ) {
		$input_line = $this->getInputAsChars();
		echo "<pre>\n";
		foreach($input_line as $y=>$line) {
			foreach($line as $x=>$item) {
				if ( isset( $highlight[$y][$x] ) && $highlight[$y][$x] == 1 ) {
					echo "<b style=color:red>".$item."</b>";
				} else {
					echo $item;
				}
			}
			echo "<br />\n";
		}
		echo "</pre>\n";
	}



}

?>