<?php
include "SimpleXLSX.php";

$table = $_GET['table'];

if ($xlsx = SimpleXLSX::parse($table)) { ?>
    <form action="update_table.php" method="post">
        <table>
            <?php
            $row = 0;
            $column = 1;

            foreach ($xlsx->rows() as $r) {
                $val = count($r);
                if ($column < $val) {
                    $column = $val;
                }
            }

            if (isset($_GET['search'])) {
                include "print_row_search.php";
            } else {
                include "print_row_nosearch.php";
            }

            ?>
        </table>
        <input name="pathToTable" type="text" value=" <?php echo $table; ?>" hidden />
        <input name="cntrow" type="text" value="<?php $row; ?>" hidden />
        <input name="cntcol" type="text" value="<?php $column ?>;" hidden />
        <input id="updateButton" name="updateButton" type="submit" hidden />
    </form>
<?php
} else {
    echo SimpleXLSX::parseError();
}
?>