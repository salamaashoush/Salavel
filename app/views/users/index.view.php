<?php
$errors=getErrors();
?>
<?php partial('header', ['title' => "about"]); ?>
<h1>Users</h1>
<?php foreach ($users as $user): ?>
    <p>Name: <?=$user->name?>
        <?php start_form("DELETE","/users/".$user->id)?>
        <input type="submit" value="Delete">
        <?php close_form();?>
    </p>
<?php endforeach; ?>
<?php start_form("post","/users")?>
    <label for="name">Name</label>
    <input type="text" name="name"><br>
    <label for="name">Email</label>
    <input type="text" name="email"><br>
    <label for="name">Password</label>
    <input type="text" name="password"><br>
    <input type="submit" value="Add">
<?php close_form();?>
<?php partial('errors',['errors'=>$errors])?>
<?php partial('footer'); ?>
