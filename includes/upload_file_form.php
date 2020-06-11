<!-- included in index.php -->
<!-- Upload file(s) form -->
<form action="includes/parse_file.php" enctype="multipart/form-data" method="post">
	<label for="upload">Select files (accepts only Excel 2007+ files):</label>
	<input type="file" id="upload" name="upload[]" accept=".xlsx" multiple="multiple"><br><br>
	<input type="submit" value="Upload">
</form>

