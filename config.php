<?php
return [
    'database'=>[
        'name'=>'lms',
        'username'=>'root',
        'password'=>'root',
        'connection'=>'mysql:host=localhost;',
        'options'=>[
            PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION
        ]
    ]
    ,
    'heroku'=>true
    ,
    'rss'=>[
        "title" => "Open Source LMS Courses",
        "link" => "http://opensourcelms.herokuapp.com",
        "description" => "Open Source LMS Courses",
        "language" => "en",  // optional
    ]
];
