<?php

// add parameters
if(count($_POST)>0 && isset($_POST['action']{0})) {
    if($_POST['action']=='signup')
        signup();
    else signin();
}

function signup(){
	// add the body of the function based on the guidelines of signup.php
    if(count($_POST)>0){
        // check if the fields are empty
        if(!isset($_POST['email'])) die('please enter your email');
        if(!isset($_POST['password'])) die('please enter your password');

        // check if the email is valid
        if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) die('Your email is invalid');

        // check if password length is between 8 and 16 characters
        if(strlen($_POST['password'])<8) die('Please enter a password >=8 characters');
        if(strlen($_POST['password'])>16) die('Please enter a password <= 16 characters');

        // check if the password contains at least 2 special characters
            $pattern = '/^(?=.*[!@#$%^&*-])';
            if(!preg_match($pattern, $_POST['password'])) die('password should contain special character');

        // check if the file containing banned users exists
                if(file_exists('banned.csv.php')) {

                    // check if the email has not been banned
                    $h=fopen('banned.csv.php', 'r+');
                    while(!feof($h)) {
                        $line=explode(';', trim(fgets($h)));
                        if(count($line)<2) continue;
                        if($line[0]==$_POST['email']) header('Location: signup.php');
                }
            }

        // check if the file containing users exists
        // check if the email is in the database already
        if(file_exists('users.csv.php')) {
            $h=fopen('users.csv.php', 'r+');
            while(!feof($h)) {
                $line=explode(';', trim(fgets($h)));
                if(count($line)<2) continue;
                if($line[0]==$_POST['email']) header('Location: signin.php');
            }
            fclose($h);
            // encrypt password
            // save the user in the database
            $h=fopen('user.csv.php', 'a+');
            fwrite($h,$_POST['email'].';'.password_hash($_POST['password'],PASSWORD_DEFAULT).PHP_EOL);
            fclose($h);
            // show them a success message and redirect them to the sign in page
            header('location: signin.php');
        }
    }
}

// add parameters
function signin()
{
    // add the body of the function based on the guidelines of signin.php
    if (count($_POST) > 0) {
        // 1. check if email and password have been submitted
        if (!isset($_POST['email'])) die('please enter your email');
        if (!isset($_POST['password'])) die('please enter your password');
        // 2. check if the email is well formatted
        if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) die('Your email is invalid');
        // 3. check if the password is well formatted
        if (strlen($_POST['password']) < 8) die('Please enter a password >=8 characters');
        if (strlen($_POST['password']) > 16) die('Please enter a password <= 16 characters');


        // check if the file containing banned users exists
        if (file_exists('banned.csv.php')) {

            // check if the email has not been banned
            $h = fopen('banned.csv.php', 'r+');
            while (!feof($h)) {
                $line = explode(';', trim(fgets($h)));
                if (count($line) < 2) continue;
                if ($line[0] == $_POST['email']) header('Location: signup.php');
            }
        }

        // 6. check if the file containing users exists
        // 7. check if the email is registered
        if (!file_exists('users.csv.php')) die('The user is not registered');

        // check if the email has not been banned
        $h = fopen('users.csv.php', 'r+');
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
        /*
        echo 'check email+password';
        if(true){
            $_SESSION['logged']=true;

        }else $_SESSION['logged']=false;
        */
    }
}

function signout(){
	// add the body of the function based on the guidelines of signout.php
    // use the following guidelines to create the function in auth.php
    $_SESSION['logged']=false;
    session_destroy();
}

function is_logged(){
	// check if the user is logged
	//return true|false
}