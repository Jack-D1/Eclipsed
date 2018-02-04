<?php

$unsorted = array(5340985234098523,341329432054,234324,678658,768568568,34635643,345134,1345341515,134513451345,134513454135,13451346656,564654654,9265645,5654654656,13451345,31455431523,134134,134,7643,456346346346,1);

function quick_sort($array)
{
	// find array size
	$length = count($array);
	
	// base case test, if array of length 0 then just return array to caller
	if($length <= 1){
		return $array;
	}
	else{
	
		// select an item to act as our pivot point, since list is unsorted first position is easiest
		$pivot = $array[0];
		
		// declare our two arrays to act as partitions
		$left = $right = array();
		
		// loop and compare each item in the array to the pivot value, place item in appropriate partition
		for($i = 1; $i < count($array); $i++)
		{
			if($array[$i] < $pivot){
				$left[] = $array[$i];
			}
			else{
				$right[] = $array[$i];
			}
		}
		
		// use recursion to now sort the left and right lists
		return array_merge(quick_sort($left), array($pivot), quick_sort($right));
	}
}

$sorted = quick_sort($unsorted);

for($i = 1; $i < count($sorted); $i++){
	echo $sorted[$i];
	echo "<br>";
}
//print_r($sorted);


?>