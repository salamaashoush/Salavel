<?php partial('header',['title'=>"Register"]);?>
<form action="/register" method="post">
    <label for="name">Neme</label>
    <input type="text" name="name"><br>
    <label for="email">Email</label>
    <input type="text" name="email"><br>
    <label for="password">Password</label>
    <input type="password" name="password"><br>
    <input type="submit" value="Submit">
</form>
<?php partial('errors',['errors'=>$valid]) ?>
<?php require 'partial/footer.part.php';?>
