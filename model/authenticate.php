<?php
include('../config/dbconfig.php');
$db = new dbconfig();

// include_once('../config/config.php');


// Prepare our SQL, preparing the SQL statement will prevent SQL injection.
if ($stmt = $db->connection->prepare('SELECT userid, userfname, userlname, useremail, userpassword, adminlevel FROM login_user WHERE username = ?')) {
	// Bind parameters (s = string, i = int, b = blob, etc), in our case the username is a string so we use "s"
	$stmt->bind_param('s', $_POST['username']);
	$stmt->execute();
	// Store the result so we can check if the account exists in the database.
	$stmt->store_result();
    // echo "test";
    if ($stmt->num_rows > 0) {
        $stmt->bind_result($userid,$fname, $lname, $email, $password, $adminlevel);
        $stmt->fetch();
        // Account exists, now we verify the password.
        // Note: remember to use password_hash in your registration file to store the hashed passwords.
        // if (password_verify($_POST['password'], $password)) {
            // Verification success! User has logged-in!
            if ($_POST['password'] === $password)  {
            // Create sessions, so we know the user is logged in, they basically act like cookies but remember the data on the server.
            session_regenerate_id();
            $_SESSION['loggedin'] = TRUE;
            $_SESSION['name'] = $_POST['username'];
            $_SESSION['userid'] = $userid;
            $_SESSION['fname'] = $fname;
            $_SESSION['lname'] = $lname;
            $_SESSION['email'] = $email;
            $_SESSION['adminlevel'] = $adminlevel;
            // echo 'Welcome ' . $name . '!';
            header('Location: ../view/dashboard.php');
        } else {
            // Incorrect password           
            header('Location: ../index.php');
            $_SESSION['$loginerror']= "Incorrect username or password!";
        }
    } else {
        // Incorrect username      
        header('Location: ../index.php');
        $_SESSION['$loginerror']= "Incorrect username or password!";
    }


	$stmt->close();
}
?>



