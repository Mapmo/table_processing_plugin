<form action="delete_table.php" method="post">
    <input name="table" value="<?php echo "users/" . $file['owner'] . '/uploads/' . $file['name']; ?>" hidden />
    <input name="write" value="<?php echo $file['write']; ?>" hidden />
    <input name="owner" value="<?php echo $file['owner']; ?>" hidden />
    <input type="submit" value="Delete" />
</form>