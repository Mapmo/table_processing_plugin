<td><input type="text" readonly></td>
<?php
for ($i = 0; $i < $column; $i++) {
    ?>
    <td><input  type="text" value="<?php echo ToAlpha($i)?>" style="text-align: center;" readonly/></td>
    <?php
}