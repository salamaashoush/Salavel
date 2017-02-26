<?php
/**
 * Created by PhpStorm.
 * User: salamaashoush
 * Date: 22/02/17
 * Time: 12:16 م
 */

namespace App\Models;


use App\Core\DB\ORM;

class User extends ORM
{
    protected static $table='users';
    protected static $pk='id';

}