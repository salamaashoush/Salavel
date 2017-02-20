<?php
$tasks=$app['database']->selectAll('todos');
$tasks=array_map(function($task){
    $task->complated=false;
    return $task;
},$tasks);
require 'views/index.view.php';
