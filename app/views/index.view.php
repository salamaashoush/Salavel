<?php
session_start();
if(isset($_SESSION['ERROR_MESSAGE']))
{
    $errors=$_SESSION['ERROR_MESSAGE'];
    unset($_SESSION['ERROR_MESSAGE']);
}
?>
<?php $title="Home";?>
<?php require 'partial/header.php';?>
<h1>Home</h1>

<?php require 'partial/footer.php';?>

