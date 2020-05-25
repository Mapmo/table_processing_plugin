<?php  
$hasAnyItem = false; #in case there is no match

foreach ($xlsx->rows() as $r) {
        $row++;
	
	$item ='/' . $_GET['search'] . '/i';
	$hasItem = false;
        for ($i = 0; $i < $column; $i++) {
		if (preg_match($item, $r[$i])) {
			$hasItem = true;
			$hasAnyItem = true;
			break;
        	}
	}

	if ($hasItem === true) {
		echo '<tr>';
		for ($i = 0; $i < $column; $i++) {
		    echo '<td><input name="' . $row . '|' . ($i + 1) . '" type="text" value="' . $r[$i] . '"/></td>';
		}
			echo '</tr>';
	}
}

if($hasAnyItem === false) {
	echo '<tr><td><h1>No match found</h1></td></tr>';
}

?>
