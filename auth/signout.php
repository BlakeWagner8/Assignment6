<?php
session_start();
require_once('auth/auth.php');

// if the user is not logged in, redirect them to the public page
if(is_logged()) signout();

// redirect the user to the public page.
header('location: index.php');