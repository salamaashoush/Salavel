<?php $title="Register";?>
<?php require 'partial/header.php';?>
<form action="/register" method="post">
    <label for="name">Neme</label>
    <input type="text" name="name"><br>
    <label for="email">Email</label>
    <input type="text" name="email"><br>
    <label for="password">Password</label>
    <input type="password" name="password"><br>
    <input type="submit" value="Submit">
</form>
<?php require  'partial/errors.php'?>
<?php require 'partial/footer.php';?>
