<?php

function resetArrayKeys($arr) {
	$newList = array();
	foreach($arr as $item) {
		array_push($newList, $item);
	}
	return $newList;
}



?>