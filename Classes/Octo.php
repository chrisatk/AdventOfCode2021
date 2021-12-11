<?php
require_once( $_SERVER['DOCUMENT_ROOT'] . '/advent_of_code/2021/Classes/autoloader.php' );

class Octo {
	private $energy_level;
	private $y;
	private $x;
	private $node_list;

	// Constructor
	public function __construct( $energy_level, $y, $x, $node_list ) {
		$this->energy_level = $energy_level;
		$this->y = $y;
		$this->x = $x;
		$this->node_list = $node_list;
	}

	public function getEnergyLevel(){
		return $this->energy_level;
	}

	public function increaseEnergyLevel(){
		$returnVal = 0;
		$this->energy_level++;
		if( $this->energy_level == 10 ) {
			$returnVal = $this->flash();
		}
		return $returnVal;
	}

	public function flash() {
		$returnVal = 0;
		$this->energy_level = 0;
		if ( isset( $this->node_list[$this->y-1][$this->x] ) ) { $this->node_list[$this->y-1][$this->x]->increaseEnergyLevel(); } // N
		if ( isset( $this->node_list[$this->y-1][$this->x+1] ) ) { $this->node_list[$this->y-1][$this->x+1]->increaseEnergyLevel(); } // NE
		if ( isset( $this->node_list[$this->y][$this->x+1] ) ) { $this->node_list[$this->y][$this->x+1]->increaseEnergyLevel(); } // E
		if ( isset( $this->node_list[$this->y+1][$this->x+1] ) ) { $this->node_list[$this->y+1][$this->x+1]->increaseEnergyLevel(); } // SE
		if ( isset( $this->node_list[$this->y+1][$this->x] ) ) { $this->node_list[$this->y+1][$this->x]->increaseEnergyLevel(); } // S
		if ( isset( $this->node_list[$this->y+1][$this->x-1] ) ) { $this->node_list[$this->y+1][$this->x-1]->increaseEnergyLevel(); } // SW
		if ( isset( $this->node_list[$this->y][$this->x-1] ) ) { $this->node_list[$this->y][$this->x-1]->increaseEnergyLevel(); } // W
		if ( isset( $this->node_list[$this->y-1][$this->x-1] ) ) { $this->node_list[$this->y-1][$this->x-1]->increaseEnergyLevel(); } // NW
		return( $returnVal );
	}


}

?>