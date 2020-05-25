<?php  
$hasAnyItem = false; #in case there is no match

foreach ($xlsx->rows() as $r) {
        $row++;
	
	$item ='/' . $_GET['search'] . '/i';
	$height = 'style="display: none;"';
   	$hidden = "hidden";
        for ($i = 0; $i < $column; $i++) {
		if (preg_match($item, $r[$i])) {
			$hidden = "";
			$height = "";
			$hasAnyItem = true;
			break;
        	}
	}

	echo '<tr ' . $height . '>';
	for ($i = 0; $i < $column; $i++) {
	    echo '<td><input name="' . $row . '|' . ($i + 1) . '" type="text" value="' . $r[$i] . '" ' . $hidden . '/></td>';
	}
	echo '</tr>';
}

if($hasAnyItem === false) {
	echo '<tr><td><h1>No match found</h1></td></tr>';
}

?>
