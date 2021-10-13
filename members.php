<?php
session_start();
require_once('auth/auth.php');

if(!is_logged()) header('location: index.php');
?>
<!DOCTYPE html>
<html>
<head>
    <title>Members Page</title>
</head>

<body>
    <h1>This page is for members only</h1>
    <h2>Hello</h2>
    <a href="signout.php"><button type="button">Sign Out</button></a>

</body>

</html>