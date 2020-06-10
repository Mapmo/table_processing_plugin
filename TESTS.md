Testing scenario:

1. Test login access

Pretask: Make sure you are not logged in the system
Steps:
	1. Go to /index.php
Expected Resutls:
	You are told that "You are currently not logged in the system."


2. Register:
Pretask:
	- Test 1 is success
	- You are using the shared DB, or you have root user registrated
	- You are not logged in
Steps:
	1. Click on Register
Expected Resuts:
	- User:________
	- Password:______
	- Retype password:_______
	- captcha (image)
	- Security code:_______
	- Register (button)
	
	2. Click Register 
Expected Results:
	- You are told which fields are necessary to be filled

	3. Test wrong captcha and wrong retype password
Expected Results:
	- You receive proper messages for the error

	4. Create a successful registration
Expected Results:
	- You are told the registration is success
	- In /user/{id} directory is created with the name of the newly created user and it should contain shared_files.yml file
	- You have a link that states "Login to your account"

	5. Click on the link that states "Login to your account"
Expected Results:
	- You arrive at /login_form.php

	6. Go back to /index.php and click Register again
Expected Resuts:
	- User:________
	- Password:______
	- Retype password:_______
	- captcha (image)
	- Security code:_______
	- Register (button)

	7. Repeat step 4. with the same user
Expected Results:
	- You are told that the name is taken	

	8. Repeat step 4. with user root
Expected Results:
	- You are told that the name is taken

3. Login
Pretasks:
	- Test 2 is success
	- You are using the shared DB, or you have root user registrated
	- You are not logged in

Steps:
	1. Go to /index.php
Expected Resuts:
	- User:________
	- Password:______
	- captcha (image)
	- Security code:_______
	- Login (button)
	
	2. Press login 
Expected Resuts:
	- You are told which fields are necessary to be filled

	3. Test wrong password and wrong captcha validation
Expected Results:
	- You are told with a proper message what you did wrong

	4. Enter credentials:
	- User: root
	- Password: 1234
	- Corect captcha
Expected Results:
	- You are logged in the system
	- You see a logout button
	- You see the form to upload a file
	- You see the tables that the root user has

	5. Click on logout in the top left corner
Expected Results:
	- You are returned to /index.php
	- You are no longer logged in the system

	6. Enter the credentials that you used to create the account in Test 2
Expected Results:
	- You are logged in the system
	- You see a logout button
	- You see the form to upload files
	- You receive a proper message that you have no uploaded files
	- Go to the users home directory and validate that he has the shared_files.yaml file and it is empty

4. File uploading
Pretasks:
	- You have a user in the db
	- The user has home directory with his own username
	- Go and manually delete the shared_files.yaml file of the user
	
Steps:
	1. Log in the system as the user
Expected results:
        - You receive a proper message that you have no uploaded files

	2. Click on browse and select an .xlsx file. Click on Open. Then click on the Upload button
Expected results:
	- The file you uploaded now appears in the list of files you have
	- You see owner: filename - access of the file

	3. Click on browse and select the previous file again and also another .xlsx file. Click on Open. Click on the Upload button.
Expected results:
	- Both files are uploaded
	- The duplicating file has name (1)<original_name>
	
	4. Click on Edit for any of the files uploaded
Expected results:
	- You are taken to /visual.php
	- You see a representation of your table on the screen

5. Editting tables
Pretasks:
	- You have a user
	- You have uploaded files
	- Step 4 from Test 4 is success
	- You have opened a table for editting
Steps:
	1. Click on logout
Expected results:
	- You have logged out successfully

	2. Log back into the system and open a table for editting
Expected results:
	- You are again able to edit the table in /visual.php

	3. Click on "Back to home"
Expected results:
	- You are successfully returned to home

	4. Click on the same table for editting
Expected results:
	- You are again able to edit the table in /visual.php

	5. Type some new value in a cell and then click on "Search"
Expected results:
	- The value remains there

	6. Click on Back to home and then return to the same table
Expected results:
	- The changes you did in step 5 are still there

	7. Search for a value that is not in the table (e.g. Sgjherui8gher)
Expected results:
	- You see a no match message

	8. Search for a value that is not in every row (regex working)
Expected results:
	- You see all lines that contain it

	9. Remove the search phrase and return to the full table. Click on a single cell with text. Press all style at top and then press them again.
Expected results:
	- All styles appear and disapper

	10. Add new styles to some cell/cells of a table. Click on "Back to home". Then click on "Edit" button for the same table.
Expected results:
	- The applied styles are still there.

	11. Add new styles to some cell/cells of a table. Click on "Logout". Then use the credentials of the same user to Login. Click on "Edit" button for the same table.
Expected results:
	- The applied styles are still there.

	12. Add new styles to some cell of a table. Then type in serach field a value that is a substring of text in the newly styled cell. Click on "Search".
Expected results:
	- The applied styles on the specific cell are still there.

6. Exporting tables
Pretasks:
	- Test 5 is success
Steps:
	1. Go to the bottom of the table
Expected results:
	- The name of the opened table is shown

	2. Click on "Save as" and try to download the file
Expected results:
	- The file is downloaded successfully





