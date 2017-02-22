<?php
/**
 * Created by PhpStorm.
 * User: salamaashoush
 * Date: 22/02/17
 * Time: 09:39 ص
 */

namespace App\Core;


class FileStorage
{

    protected $file;
    protected $lines;
    function __construct($file)
    {
        $this->file=$file;
    }

    function getAllRecords()
    {
        $this->lines = file($this->file);
        $records = [];
        foreach ($lines as $line) {
            if ($line != "") {
                $line = trim(preg_replace('/\s\s+/', ' ', $line));
                $record = explode(":", $line);
                $records[] = $record;
            }
        }
        return $records;
    }

    function getById($uid)
    {
        $records = getAllRecords();
        foreach ($records as $record) {
            if ($record[0] == $uid) {
                return $record;
            } else {
                return -1;
            }
        }
    }
    function getByEmail($email)
    {
        $records = getAllRecords();
        foreach ($records as $record) {
            var_dump($record[8]);

            if (in_array($email,$record)) {
                return $record;
            } else {
                return false;
            }
        }
    }
}