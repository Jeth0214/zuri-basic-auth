<?php

session_start();

/* Set status to invalid */
$_SESSION['status'] = 'invalid';

/* Unset user data */
unset($_SESSION['email']);
unset($_SESSION['password']);

/* Redirect to login page */
header('Location: login.php');
