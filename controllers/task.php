<?php
$app['database']->insert('todos',[
    'description'=>$_POST['desc'],
    'complated'=>false
]);

header('Location: /');
