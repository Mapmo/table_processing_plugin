<?php
include "SimpleXLSX.php";
if ($xlsx = SimpleXLSX::parse($_GET['table'])) {
    echo '<form action="update_table.php" method="post"><table>';
    $row = 0;
    $column = 1;

    foreach ($xlsx->rows() as $r) {
        $val = count($r);
        if ($column < $val) {
            $column = $val;
        }
    }

    foreach ($xlsx->rows() as $r) {
        $row++;
        echo '<tr>';
        for ($i = 0; $i < $column; $i++) {
            echo '<td><input name="' . $row . '|' . ($i + 1) . '" type="text" value="' . $r[$i] . '"/></td>';
        }
        echo '</tr>';
    }
    echo '</table>';
    echo '<input name="pathToTable" type="text" value="' . $_GET['table'] . '" hidden/>';
    echo '<input name="cntrow" type="text" value="' . $row . '" hidden/>';
    echo '<input name="cntcol" type="text" value="' . $column . '" hidden/>';
    echo '<input id="update-button" name="update-button" type="submit" hidden/>';
    echo '</form>';
} else {
    echo SimpleXLSX::parseError();
}
