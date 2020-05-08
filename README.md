# table_processing_plugin
Final project for the Web Technologies subject at FMI, Sofia University

Tasks for the demo:

Importing xlsx files - Tanya
	- Create the input file field and make it functional\
	- Parse the uploaded file (check https://medium.com/@ssaurel/parsing-microsoft-excel-files-in-php-easily-2b68c70ee3be)\
	- Let's asume you have database called `tables`\
	- Create a table called `names` that stores:\
		 * the base names of the uploaded files\
		 * their respective hash\
	- Create table with:\
		* the hashed name of the full path to the file\
		* the data from the file\
	- Print the table as `<table id="table_name_in_DB">` where each cell in the table is a text input/area?\

Notes: I use contenteditable div's. Some useful resource on updating the table: https://stackoverflow.com/questions/1391278/contenteditable-change-events

Manipulating data - Martin\
	- Create the a dropdown to choose tables  (based on their order in uploading)\
	- Create a dropdown to select an operation (only find for the prototype)\
	- Update the table(s) before proceeding to the selected operation\
	- Create a new table called temporary, where you store the final result\
	- Print all tables again and make sure temporary is on top\

Exporting data - Daniel\
	- Create a dropdown to choose the format to save the data (only xlsx atm)\
	- Create an input field that allows the user to chose a name for the new file(s) (should use the data from the names table to suggest the name for the file)\
	- Update the table(s) with the new data\
	- Create a file in the specified format by exporting the data from the DB\
	- Download it on the client's machine\
