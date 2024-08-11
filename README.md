Refactored Code Structure:

Directory Structure:
app\src\
	Controller -> UserController.php (1)
	Entity -> ErrorHandlerObject.php (2)
	Helper -> DbHelper.php (3)
	Service -> UserService.php (4)
UserController.php:
The database processing has been removed.
The controller is now divided into three smaller actions:
	index: Renders the view and returns a list of all users.
	addUser: Creates a new user.
	deleteUser: Deletes a chosen user.

ErrorHandlerObject.php:
Handles errors through methods to set and get error messages.

DbHelper.php:
Contains functions to open a database connection and execute queries.

UserService.php:
Houses all the database queries, which are organized into three functions:
	getAllUsers: Retrieves all user records.
	addUser: Creates a new user.
	deleteUser: Deletes a selected use
