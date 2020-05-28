<?php  
  foreach ($xlsx->rows() as $r) {
        $row++;
        echo '<tr>';
        for ($i = 0; $i < $column; $i++) {
            echo '<td><input name="' . $row . '|' . ($i + 1) . '" type="text" value="' . $r[$i] . '"/></td>';
        }
        echo '</tr>';
    }
