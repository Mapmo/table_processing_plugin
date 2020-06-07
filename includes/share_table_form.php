<!-- here should be some js that pops the form to type username and rights, rather than having them shown all the time -->
<!-- The form for sharing a file with other users -->
<!-- Included in index.php -->
<form method="post" action="includes/share_table.php">
	<input name="name" value="<?php echo $file['name'];?>" hidden />
	<input name="owner" value="<?php echo $file['owner'];?>" hidden />
	<input type="text" name="userTo" placeholder="User to share the file with" required />
	<select name="write">
		<option value="0">Readonly</option>
		<option value="1">Edit</option>
	</select>
	<input type="submit" value="Share" />
</form>

