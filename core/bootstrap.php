<?php
use App\Core\App;
session_start();
App::bind('config',require 'config.php');
\App\Core\DB\ORM::useConnection(Connection::make(App::get('config')['database']));
App::bind('uploader',new \App\Core\Uploader());
require 'core/Helper.php';

