<?php $title="Contact";?>
<?php require 'partial/header.part.php';?>
<form action="/login" method="post">
    <label for="name">Neme</label>
    <input type="text" name="name">
    <label for="email">Email</label>
    <input type="text" name="email">
    <input type="submit" value="Submit">
</form>
<?php require 'partial/footer.part.php';?>
