# table_processing_plugin
Final project for the Web Technologies subject at FMI, Sofia University

Tasks for the demo:

Importing xlsx files - Tanya

	- issue: more than 1 sheet in file\
	- code refactoring as per the code-guide file
	
Notes: I use contenteditable div's. Some useful resource on updating the table (for the join, filter, etc.): https://stackoverflow.com/questions/1391278/contenteditable-change-events\

Manipulating data - Martin\
	- Create a new table called temporary, where you store result of an operation (e.g. SELECT, JOIN)

Exporting data - Daniel\
	+ Create a dropdown to choose the format to save the data (only xlsx atm)\
	+ Create an input field that allows the user to cho0se a name for the new file(s) (should use the data from the names table to suggest the name for the file)\
	- Create a file in the specified format by exporting the data from the DB\
	+ Download it on the client's machine
	- If the extension of the uploaded file and the wanted extension of the downloaded file aren't the same -> Use library for the conversion 
    	- Use different folder for downloading/conversion stage
	- Add the changes to the README.md file

for future
	- maximum of uploaded files\
	- define("SUPPORTED_FILE_EXTENSIONS", ["xlsx"]); from visual.php should be used for importing as well
	- Add numbers and digits to the cells
	- Create a dropdown to select an operation (only SELECT for the prototype)\
