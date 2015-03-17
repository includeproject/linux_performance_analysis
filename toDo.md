To Do
##Bugs
###User Interface
######loging.php
Number | Description | Expected result | Actual result | Status
-------|------------|-----------------|---------------|-------
1 | "Remember me" check box | The user will not be prompted to logging each time he opens the page | Do not have a function | Pending
2 | User have an account already, wants to logging but fails to introduce the correct information | A message will pop out asking the user to enter the correct account or password | The user is prompted to create a new account | Correct
3 | User log in correctly whit email account | Have access to his uploaded information | User can't check his uploaded information | Correct
4 | User log in correctly whit user account  | Have access to his uploaded information | Have access to his uploaded information | Correct
#####user_register.php
Number | Description | Expected result | Actual result | Status
-------|------------|-----------------|---------------|-------
1 | User fails to insert correct information on any field | A message will pop out explaining were is  the error and marking the incorrect field whit an asterisk | A message will pop out explaining were is the error but without marking it | Pending
2 | "Remember me" check box | The user will not be prompted to logging each time he opens the page | Do not have a function | Pending
3 | User succeeds creating a new account | A new page will be open whit an open session | A new page will be open whit an open session | Correct
#####user_panel.php
Number | Description | Expected result | Actual result | Status
-------|------------|-----------------|---------------|-------
1 | Navigation bar | Shows the user information | No user information not founded | Pending
2 | Profile button | Shows the profile information | It doesn't have a function | Pending
3 | Counter of the number of uploaded patches | Show the number of patches | Only shows 1 | Pending
4 | User press the button "Test" | A message will pop out telling "Test running" and the button status will change to "Running" | Do not have a function | Pending
5 | News tab | Show the current status of the patch test | Does nothing | Pending

###Server Side
Number | Description | Expected result | Actual result | Status
-------|------------|-----------------|---------------|-------
1 | Password encryption | None one can access the password | All whit minimum skill can access the password | Pending
2 | Uploading patches | Checks if the name of the patch is already on the server | Do not validates nothing | Pending
3 | User register correctly ( Email account ) | The server refuse to register the account whit a duplicated email | The server do not refuse to register the account whit the duplicated email | Pending
4 | Reverting patches | When a patch fails, the server will revert changes | Nothing happens when a patch fails | Pending
5 | Set limit for the number of virtual machines | Have a limit of 5 virtual machines per user | There is no limit for the number of virtual machines | Pending
6 | Script to install kernel from repo | Install kernel from repo | No way to install newer kernel | Pending
7 | Script to install vagrant from repo | Install vagrant from repo | No way to install newer kernel | Pending
8 | "Test" Status | The server change the status on the client side depending of the succes from the path's tests | Nothing happens | Pending