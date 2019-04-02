<?php
header('Content-Type: application/json; charset=utf-8');
include 'mysqlConnect.php';

$result = file_get_contents('../JSON/db.json');

$dates = json_decode($result);

// echo var_dump($dates[0]->name);
// echo $dates[0]->name;

for($i = 0; $i < count($dates); $i++ ){
	$name = $dates[$i]->name;
	$desc = $dates[$i]->desc;
	$img = $dates[$i]->img;
	$minItem = $dates[$i]->minItem;
	$price = $dates[$i]->price;
	$currency = $dates[$i]->currency;
	$category = $dates[$i]->category;
	$icoClass = $dates[$i]->icoClass;
	$order = $dates[$i]->order;

	$query = "INSERT INTO `touraudio_products` (`name`,`desc`,`img`,`minItem`,`price`,`currency`,`category`,`icoClass`, `order`)
	VALUES ('$name','$desc','$img','$minItem','$price',
		'$currency','$category','$icoClass','$order')";
		if(mysqli_query($conn,$query)){
			echo $i.' -> '.$dates[$i]->name.' - '.$dates[$i]->desc.' - '.$dates[$i]->img.' - '.$dates[$i]->minItem.' - '.$dates[$i]->price
			.' - '.$dates[$i]->currency.' - '.$dates[$i]->category.' - '.$dates[$i]->icoClass.' - '.$dates[$i]->order.'<br>';
		} else {
			echo $i.'<font color=red> - ERROR </font><br>' ;
			if($i == count($dates) - 1) {
				echo '<font color=red><b>'.$query.'</b></font>';
			}
		}
}
 ?>
