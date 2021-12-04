<?php

class BingoCardNumber {
	private $value;
	private $checked;

	// Constructor
	public function __construct($value) {
		$this->value = $value;
		$this->checked = FALSE;
	}

	public function isChecked() {
		return $this->checked;
	}

	public function checkValue() {
		$this->checked = TRUE;
		return;
	}

	public function getValue() {
		return $this->value;
	}

}

?>