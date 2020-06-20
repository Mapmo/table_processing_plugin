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

    2a. Click on the Upload button without choosing files for upload
Expected results:
    - Error message is shown

	2b. Click on browse and select an .xlsx file. Click on Open. Then click on the Upload button
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

	13. Click on 'Edit' button for a table that is your property(you are the owner). Click on a cell of your choice. Then click on 'Lock/Unlock Cell'
Expected results: The cell is getting blue - it is locked for other users.

	14. Execute step 13 and click 'Back to home'. Then click 'Edit' for the same table. 
Expected results: The cell from step 13 is still blue.

	15.  Execute step 13 and click 'Logout'. Then login and click 'Edit' for the same table.
Expected results: The cell from step 13 is still blue.

	16. Execute steps 13, 14 and 15, but instead of clicking 'Lock/Unlock Cell', click 'Lock/Unlock Row' and 'Lock/Unlock Column'.
Expected results: The cells are still blue (locked).

	17. Share the table with locked cell/cells with another user who can edit it. Logout and login as that user. Click on 'Edit' for the shared table. 
Expected results: The locked cells should be displayed with grey background. The user has no right to edit the content in this cells. The user has no right to apply styles (as bold, italic or underlined) to the locked cells.

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

7. Share files
Pretasks:
	- Have 2 accounts in the system
	- At least one of the accounts should have a file that is not shared with the other account
	- Make sure you know what files both accounts have

Steps:
	1. Login to the system with the account that will be sharing the file
Expected results:
	- You log in successfully

	2. In the field under the file for sharing type the name of the other account. Make sure the dropdown has value Readonly press "Share"
Expected results:
	- You get a green message that share was success

 	3. Repeat step 2, but use Edit in the dropdown this time
Expected results:
	- You get a green message that share was success

	4. Logout of the system and the log in as the other user
Expected results:
	- You log in successfully and you see the shared files on the bottom
	- The user is the same that shared them
	- The permissions are as you set them
	- Readonly file is above the writeable file

	5. Click Edit for the Readonly file
Expected results:
	- You see all the data, but you cannot edit it
	
	6. Type something specifi for search in the search bar and press the Search button
Expected results:
	- You see only what you are searching for

	7. Clear the search field and press the Search button
Expected results:
	- You see all the rows of the table you uploaded

	8. Click on "Back to home"
Expected results:
	- You are back at index.php
	- All the files are where they were before

	9. Click on the writeable file that you shared with this account
Expected results:
	- You see the content of the file
	- You are able to edit the file

	10. Make some changes in the table and press Search
Expected results: 
	- The changes are preserved

	11. Click on "Back to home" and then open the Readonly table that you shared
Expected results: 
	- The changes from 10. are there as well

	12. Click on "Back to home"

	13. Type the name of the current account in any field for sharing and press Share
Expected results: 
	- You get a warning that you cannot share the file with yourself

	14. Type a non existent name in the share field
Expected results: 
	- You are told that there is no such user

	15. Logout and login with the first account
Expected results:
	- All the files are there as you left them

	16. Click Edit on the table you shared
Expected results: 
	- Verify that the file has been changed in step 10.

8. Shared files mutex
Pretasks:
	- Have 2 users in the system
	- The users need to have at least one shared file
	- You haven't opened this file in the past 10 minutes
Steps:
	1. Login with the 2 users in 2 different sessions (use Incognito for something different once)
	2. Have user A open the shared file
Expected results:
	- User A can easily log and edit the file (or view it if it is readonly)
	3. Have user B open the shared file
Expected results:
	- User B cannot open the file and is notified that user A is using it
	- User A has no problems using the file
	4. User A goes back to home
	5. User B attempts to edit the file
Expected results:
	- User B enters successfully
	6. User A attempts to edit the file
Expected results:
	- User A cannot open the file and is notified that user A is using it
	- User B has no problems using the file
	7. User B logouts of the system
	8. User A attempts to edit the file
Expected results:
	- User A enters succesfully
	9. User B logs back in the system and attempts to edit the file
Expected results:
	- User B cannot open the file and is notified that user A is using it
	- User A has no problems using the file
	11. Wait more than 11 minutes. Attempt to enter editting with user B
Expected results:
	- User B cannot open the file and is notified that user A is using it
	- User A has no problems using the file

	10. Exit user A's browser and wait more than 11 minutes to try to edit the file as user B
Expected results:
	- User B succesfully enters the file for editting
