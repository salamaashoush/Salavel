<?php $title="Home";?>
<?php require 'partial/header.php';?>
<?php foreach ($tasks as $task): ?>
    <li><?=$task->description?>
<?php endforeach; ?>
<form action="/add" method="POST">
    <input type="text" name="desc">
    <input type="submit" value="submit">
</form>
<?php require 'partial/footer.php';?>

