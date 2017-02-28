<?php
/**
 * Created by PhpStorm.
 * User: salamaashoush
 * Date: 22/02/17
 * Time: 12:16 م
 */

namespace App\Models;


use App\Core\DB\ORM;

class Comment extends ORM
{
    protected static $table='comments';
    protected static $pk='id';

    public function user()
    {
        return User::retrieveByField('id',$this->uid)[0];
    }
    public function post()
    {
        return Post::retrieveByField('id',$this->pid)[0];
    }
}