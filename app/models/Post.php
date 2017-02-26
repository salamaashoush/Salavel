<?php
/**
 * Created by PhpStorm.
 * User: salamaashoush
 * Date: 22/02/17
 * Time: 12:15 م
 */

namespace App\Models;


use App\Core\DB\ORM;

class Post extends ORM
{
    protected static $table='posts';
    protected static $pk='id';
}