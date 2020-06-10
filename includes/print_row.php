<?php

if (!isset($_POST['search'])) {
	foreach ($xlsx->rows() as $r) {
		$row++;
		echo '<tr>';
		include("includes/print_row_loop.php");
	}
} else {
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

			echo '<tr ' . $height . '>';
			include("includes/print_row_loop.php");
		}

		if ($hasAnyItem === false) {
			echo '<tr><td><h1>No match found</h1></td></tr>';
		}
}
?>

