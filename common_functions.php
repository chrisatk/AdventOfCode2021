<?php

function resetArrayKeys($arr) {
	$newList = array();
	foreach($arr as $item) {
		array_push($newList, $item);
	}
	return $newList;
}

function printList( $list ) {
	echo "<pre>\n";
	foreach( $list as $y=>$line ){
		foreach( $line as $x=>$item ) {
			echo $list[$y][$x];
		}
		echo "<br />";
	}
	echo "</pre>\n";
}


?>