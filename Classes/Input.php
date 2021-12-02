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

	public function print() {
		foreach ( $this->input as $line ) {
			echo $line."<br />";
		}
		return;
	}

}

?>