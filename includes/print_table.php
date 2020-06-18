<?php
include "SimpleXLSX.php";

$table = $_POST['table'];

if ($xlsx = SimpleXLSX::parse($table)) { ?>
    <form action="/includes/update_table.php" method="post">
        <table id="currentTable">
            <?php
            $row = 0;
            $column = 1;

            foreach ($xlsx->rows() as $r) {
                $val = count($r);
                if ($column < $val) {
                    $column = $val;
                }
            }

            include("print_row.php");

            ?>
        </table>
        <input name="pathToTable" type="text" value="<?php echo $table; ?>" hidden />
        <input name="cntrow" type="text" value="<?php echo $row; ?>" hidden />
        <input name="cntcol" type="text" value="<?php echo $column ?>;" hidden />
        <input id="updateButton" name="updateButton" type="submit" hidden />
    </form>
<?php
} else {
    echo SimpleXLSX::parseError();
}
?>
