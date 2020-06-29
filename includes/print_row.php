<?php

if (!isset($_POST['search'])) {
	if(count($xlsx->rows())>0){
		include("print_header_row.php");
	}
	foreach ($xlsx->rows() as $r) {
		$row++;
		echo '<tr>';
		include("includes/print_row_loop.php");
	}
} else {
		$hasAnyItem = false;
		foreach ($xlsx->rows() as $r) {
			$row++;

			$item = '/' . $_POST['search'] . '/i';
			$height = 'style="display: none;"'; //if the regex is not met, then make the line invisible
			for ($i = 0; $i < $column; $i++) {
				if (preg_match($item, $r[$i])) {
					$height = "";
					$hasAnyItem = true;
					break;
				}
			}

			if( !isset($printedHeaderRow) && $hasAnyItem === true ){
				include("print_header_row.php");
				$printedHeaderRow=true;
			}

			echo '<tr ' . $height . '>';
			include("includes/print_row_loop.php");
		}

		if ($hasAnyItem === false) {
			echo '<tr><td><h1>No match found</h1></td></tr>';
		}
}
?>

