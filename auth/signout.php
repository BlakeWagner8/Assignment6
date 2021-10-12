<?php
session_start();
// if the user is not logged in, redirect them to the public page
if(count($_POST)>0) header('location: index.php');
// redirect the user to the public page.
header('location: index.php');