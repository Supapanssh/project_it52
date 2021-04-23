<?php
$whitelist = array(
    '127.0.0.1',
    '::1'
);
return [
    'class' => 'yii\db\Connection',
    'dsn' => 'mysql:host=localhost;dbname=stock',
    'username' => 'root',
    'password' => 'root',
    'charset' => 'utf8',
];