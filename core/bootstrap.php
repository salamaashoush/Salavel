<?php
use App\Core\App;
session_start();
App::bind('config',require 'config.php');
App::bind('database',new QueryBuilder(
    Connection::make(App::get('config')['database'])
));
require 'core/Utils.php';
