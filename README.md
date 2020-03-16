# Dream_World_Assignment
User Registration form (PHP, HTML, CSS)

GOAL:
Make an HTML form, submit form data to PHP, validate the data, insert into a database, and return a success response to client

Requirements:
Write plain PHP, HTML, and CSS-- no libraries, frameworks, or JavaScript
Output an HTML document including email, password, confirm password, birthday, and submit button
Center the form on the page vertically and horizontally
Make it pretty (hint: bonus points if you use Dream Singles color scheme, logo, and a picture)
Make a list of (10 or more) email addresses
Validate:
email address must not exist in list  
birthday must be 18+  
password matches confirm password at least 8 characters and contains numbers and letters
When input is invalid return a response to let the user know what inputs to correct
Otherwise, input is valid create a schema for a users table if not exists with the above fields and save it to your new Mysql table     using PDO
Return a response to the user updating them on the status of their request 
