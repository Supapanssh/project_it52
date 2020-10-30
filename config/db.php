<?php
$whitelist = array(
    '127.0.0.1',
    '::1'
);
if (!in_array($_SERVER['REMOTE_ADDR'], $whitelist)) {
    return [
        'class' => 'yii\db\Connection',
        'dsn' => 'mysql:host=localhost;dbname=stock',
        'username' => 'root',
        'password' => 'Supanvm01',
        'charset' => 'utf8',

        // Schema cache options (for production environment)
        //'enableSchemaCache' => true,
        //'schemaCacheDuration' => 60,
        //'schemaCache' => 'cache',
    ];
} else {
    return [
        'class' => 'yii\db\Connection',
        'dsn' => 'mysql:host=localhost;dbname=stock',
        'username' => 'root',
        'password' => '',
        'charset' => 'utf8',

        // Schema cache options (for production environment)
        //'enableSchemaCache' => true,
        //'schemaCacheDuration' => 60,
        //'schemaCache' => 'cache',
    ];
}
