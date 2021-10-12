<?php
session_start();
// if the user is already signed in, redirect them to the members_page.php page
if(count($_POST)>1) header('location: members.php');

// improve the form
?>
<form method="POST" action="auth.php">
    <h1>ASE230 Class Photobook</h1>
    <h2>Sign In</h2>
    <label>Name</label>
    <input type="name" name="name" />
    <label>Email</label>
	<input type="email" name="email" />
    <label>Password</label>
    <input type="password" name="password" />
	
	<input type="submit" value="submit" />
</form>