<?php
try {
    $response = \App\Core\Session::r('response');
} catch (Exception $e) {
    $e->getMessage();
}
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
<form action="/users" method="post">
    <label for="name">Name</label>
    <input type="text" name="name"><br>
    <label for="name">Email</label>
    <input type="text" name="email"><br>
    <label for="name">Password</label>
    <input type="text" name="password"><br>
    <input type="submit" value="Add">
</form>
<?php partial('errors',['errors'=>$response])?>
<?php partial('footer'); ?>
