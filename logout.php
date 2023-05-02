<?
    require 'bd.php';
    unset($_SESSION['logged_user']);
    header('location: index.php');
    ?>
    