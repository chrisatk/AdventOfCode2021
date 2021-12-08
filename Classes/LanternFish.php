<?php

class LanternFish {
	private $currentState;

	// Constructor
	public function __construct( $state ) {

		$this->currentState = $state;

	}

	public function age() {
		$result = "";

		if ( $this->currentState == 0 ) {
			$this->currentState = 6;
			$result = "Spawn";
		} else {
			$this->currentState--;
		}
		return $result;
	}


	public function getState() {
		return $this->currentState;
	}

}

?>