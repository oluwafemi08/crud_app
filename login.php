<?php session_start();
if(isset($_POST['cancel'])){
	header("Location: index.php");
	return;
}

$salt = 'XyZzy12*_';
$stored_hash = '1a52e17fa899cf40fb04cfc42e6352f1'; // Pw is php123

if(isset($_POST['email']) && isset($_POST['password'])){
	if(strlen($_POST['email']) < 1 || strlen($_POST['password']) < 1){
		$_SESSION['error'] = "Email and password are required";
		header("Location: login.php");
		return;
	} elseif (strpos($_POST['email'], '@')=== false) {
		$_SESSION['error'] = "Email must have an at-sign (@)";
		header("Location: index.php");
		return;
	}else{
		$check = hash('md5', $salt . $_POST['password']);
		if ($check == $stored_hash){
		error_log("Login success ".$_POST['email']);
		$_SESSION['name'] = $_POST['email'];
		header("Location: index.php");
		return;	

		
	} else {
		$_SESSION['error'] = "Incorrect password";
		error_log("Login fail ".$_POST['email']." $check");
		header("Location: login.php");
		return;
	}

	}

}


// Fall through into the View

?>

<!DOCTYPE html>
<html>
    <head>
        <title>Oluwafemi Banji's Login Page</title>
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    </head>
    <body>
        <div class="container">
            <h1>Please Log In</h1>
            <?php
    if ( isset($_SESSION['error']) ) {
        echo('<p style="color: red;">'.htmlentities($_SESSION['error'])."</p>\n");
        unset($_SESSION['error']);
    }
    ?>
            <form method="post" class="form-horizontal">
                <div class="form-group">
                    <label class="control-label col-sm-2" for="email">Username:</label>
                    <div class="col-sm-3">
                        <input class="form-control" type="text" name="email" id="email">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-2" for="password">Password:</label>
                    <div class="col-sm-3">
                        <input class="form-control" type="password" name="password" id="password">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-2 col-sm-offset-2">
                        <input class="btn btn-primary" type="submit" value="Log In">
                        <input class="btn" type="submit" name="logout" value="Cancel">
                    </div>
                </div>
            </form>
            <p>
                For a passwordword hint, view source and find a passwordword hint
                in the HTML comments.
                <!-- Hint: The passwordword is the four character sound a cat
                makes (all lower case) followed by 123. -->
            </p>
        </div>
    </body>
</html>