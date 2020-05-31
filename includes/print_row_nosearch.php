<?php
foreach ($xlsx->rows() as $r) {
    $row++;
    echo '<tr>';
    for ($i = 0; $i < $column; $i++) {
?>
        <td><input name="<?php echo $row . '|' . ($i + 1); ?>" type="text" value="<?php echo $r[$i];?>" onclick="updateRowAndCol( <?php echo $row; ?> , <?php echo $i + 1; ?>)" /></td>
<?php
    }
    echo '</tr>';
}
