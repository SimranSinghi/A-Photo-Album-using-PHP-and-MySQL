# A-Photo-Album-using-PHP-and-MySQL


Download project5.zip (Links to an external site.) and unzip the files inside your web server document root directory. The project5 directory contains the file createDB.sql, which contains the SQL description of the users table that has the following schema:

users ( username, password, fullname, email, image_dir )
To create the database, start the Apache Web Server and the MySQL Database on your PC using the XAMPP manager console. Run phpMyAdmin (Links to an external site.) on your browser, create a new database with name album by clicking on New. After you create it, select this database (under the name album), go to the SQL tab, and cut and paste the SQL code in createDB.sql and push Go. This will create your schema. You can test your setup on your web browser by using the URL address http://localhost/project5/album.php (Links to an external site.) (This file album.php uses the PDO extension of PHP to insert a new user and to query the users table using MySQL).

Documentation
Please read The PHP Data Objects (PDO) extension (Links to an external site.), especially the PDO class (Links to an external site.).

Project Requirements
You will extend the photo-album application from Project 4 to serve multiple users with separate photo albums. Like in Project 4, create a subdirectory images inside project5. This time, each user has her own directory of images inside project5/images. A user cannot access the photos of another user. The name of the image directory of a user is stored in image_dir in the users table.

Your project is to write three PHP programs album.php, login.php, and register.php inside project5. You can start with your code album.php from Project 4. The login.php script generates a form that has two text windows, one for username and one for password, one "Login" button, and one "Register" button. From the login script, if the user enters a wrong username/password and pushes "Login", it should go to the login script again. If the user enters a correct username/password and pushes "Login", it should go to the album script. If the user pushes "Register" it will go to the register script .  The register script has a form to enter a new username, password, full name, and email,  and a "Register" button. The password must be encoded with md5 (Links to an external site.) and the image_dir name is generated automatically using the PHP function tempnam (Links to an external site.) and is created immediately. If the user already exists, it goes back to register script, otherwise it goes to album script. From the album script, if the user pushes "Logout", it should logout and go to the login script. The album script must always make sure that only authorized users (users who have logged-in properly) can view and upload photos on their own image directory only. Your album.php script must behave exactly the same as in Project 4 but it should 1) all uploads, lists and image views must be on the user image directory only and 2) there is a "Logout" button near the top.

Hints: You should use sessions. You can logout from the album by using the action login.php?logout=true on the Logout button. This must clear the session in login script.
