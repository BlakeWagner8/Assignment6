<?php
session_start();
if(count($_SESSION)==0) header('location: index.php');
?>
<!DOCTYPE html>
<html>
<head>
    <title>Members Page</title>
</head>

<body>
    <h1>This page is for members only</h1>
    <h2>Hello <?= $_SESSION['name'] ?></h2>
    <a href="signout.php"><button type="button">Sign Out</button></a>

</body>

</html>