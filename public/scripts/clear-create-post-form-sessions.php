<?php session_start();

if ( $_POST['action'] === 'clear-post-form-sessions' )
{
    unset($_SESSION['form-sessions']);
    echo true;
} else {  header('Location: /'); }
exit();