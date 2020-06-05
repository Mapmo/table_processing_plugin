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
	- In /user/{id} directory is created with the id of the newly created user and it should contain shared_files.yml file

	5. Go back to index.php and click Register again
Expected Resuts:
	- User:________
	- Password:______
	- Retype password:_______
	- captcha (image)
	- Security code:_______
	- Register (button)

	6. Repeat step 4. with the same user
Expected Results:
	- You are told that the name is taken	

	7. Repeat step 4. with user root
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

	3. Test wrong wrong password and wrong captcha validation
Expected Results:
	- You are told with a proper message what you did wrong

	4. Enter credentials:
	- User: root
	- Password: 1234
	- Corect captcha
Expected Results:
	- You are logged in the system

	5. Click on logout in the top left corner
Expected Results:
	- You are returned to /index.php
	- You are no longer logged in the system

	6. Enter the credentials that you used to create the account in Test 2
Expected Results:
	- You are logged in the system
