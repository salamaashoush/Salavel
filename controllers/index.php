<?php
$tasks=App::get('database')->selectAll('todos');
require 'views/index.view.php';
