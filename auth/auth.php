<?php

// add parameters
$registered = '../data/users.csv.php';
$banned = '../data/banned.csv.php';
if(count($_POST)>0 && isset($_POST['action']{0})) {
    if($_POST['action']=='signup')
        signup($registered, $banned);
    else signin($registered, $banned);
}

function signup($registered, $banned){

    // add the body of the function based on the guidelines of signup.php
    if(count($_POST)>0){
        // check if the fields are empty
        if(!isset($_POST['email'][0])) die(message('error', 'please enter your email. <a href="signup.php">click here<a/>'));
        if(!isset($_POST['password'])) die(message('error', 'please enter your password. <a href="signup.php">click here<a/>'));

        // check if the email is valid
        if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) die(message('error', 'Your email is invalid. <a href="signup.php">click here<a/>'));

        // check if password length is between 8 and 16 characters
        if(strlen($_POST['password'])<8) die(message('error', 'Please enter a password >=8 characters. <a href="signup.php">click here<a/>'));
        if(strlen($_POST['password'])>16) die(message('error', 'Please enter a password <= 16 characters. <a href="signup.php">click here<a/>'));

        // check if the password contains at least 2 special characters
            $pattern = '/^(?=.*[!@#$%^&*-])/';
            if(!preg_match($pattern, $_POST['password'])) die(message('error', 'password should contain special character. <a href="signup.php">click here<a/>'));

        // check if the file containing banned users exists
                if(file_exists($banned)) {
                    // check if the email has not been banned
                    $h=fopen($banned, 'r+');
                    while(!feof($h)) {
                        $line=explode(';', trim(fgets($h)));
                        if(count($line)<2) continue;
                        if($line[0]==$_POST['email']) header('Location: signup.php');
                }
                    fclose($h);
            }


        // check if the file containing users exists
        // check if the email is in the database already
        if(file_exists($registered)) {
            $h=fopen($registered, 'r+');
            while(!feof($h)) {
                $line=explode(';', trim(fgets($h)));
                if(count($line)<2) continue;
                if($line[0]==$_POST['email']) header('Location: signin.php');
            }
            fclose($h);

            // encrypt password
            // save the user in the database
            $h=fopen($registered, 'a+');
            fwrite($h,$_POST['email'].';'.password_hash($_POST['password'],PASSWORD_DEFAULT).PHP_EOL);
            fclose($h);
            // show them a success message and redirect them to the sign in page
            header('location: signin.php');
        }
        else {
            echo 'The user database was not found';
        }
    }
}

// add parameters
function signin($registered, $banned)
{
    // add the body of the function based on the guidelines of signin.php
    if (count($_POST) > 0) {
        // 1. check if email and password have been submitted
        if (!isset($_POST['email'])) die(message('error', 'please enter your email. <a href="signup.php">click here<a/>'));
        if (!isset($_POST['password'])) die(message('error', 'please enter your password. <a href="signup.php">click here<a/>'));
        // 2. check if the email is well formatted
        if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) die(message('error', 'Your email is invalid. <a href="signup.php">click here<a/>'));
        // 3. check if the password is well formatted
        if (strlen($_POST['password']) < 8) die(message('error', 'Please enter a password >=8 characters. <a href="signup.php">click here<a/>'));
        if (strlen($_POST['password']) > 16) die(message('error', 'Please enter a password <= 16 characters. <a href="signup.php">click here<a/>'));


        // check if the file containing banned users exists
        if (file_exists($banned)) {

            // check if the email has not been banned
            $h = fopen($banned, 'r+');
            while (!feof($h)) {
                $line = explode(';', trim(fgets($h)));
                if (count($line) < 2) continue;
                if ($line[0] == $_POST['email']) header('Location: signup.php');
            }
        }

        // 6. check if the file containing users exists
        // 7. check if the email is registered
        if (!file_exists($registered)) die(message('error', 'The user is not registered. <a href="signup.php">click here<a/>'));

        // check if the email has not been banned
        $h = fopen($registered, 'r+');
        while (!feof($h)) {
            $line = explode(';', trim(fgets($h)));
            if (count($line) < 2) continue;
            if ($line[0] == $_POST['email']) {
                // 8. check if the password is correct
                if (!password_verify($_POST['password'], $line[1]))
                    $_SESSION['logged']=false;
                else {
                    // 9. store session information
                    $_SESSION['name']=$line[2];
                    $_SESSION['logged']=true;
                    // 10. redirect the user to the members_page.php page
                    header('location: members.php');
                }
            }
        }
        fclose($h);

    }
}

function signout(){
	// add the body of the function based on the guidelines of signout.php
    // use the following guidelines to create the function in auth.php
    unset($_SESSION['name']);
    unset($_SESSION['logged']);
    session_destroy();
}

function is_logged(){
	// check if the user is logged
    if(isset($_SESSION['logged'])) return true;
    else {
        return false;
    }
	//return true|false

}
function message($title, $message) {
    ?>
    <!DOCTYPE HTML>
    <html>

        <head>
            <title>
                <?=$title?>
            </title>
        </head>

        <body>
            <h1>
                <?=$message?>
            </h1>
        </body>

    </html>
<?php
}