<?php

define('ROOT', '/var/www');
require ROOT . '/vendor/autoload.php';

$conf = [
  'eyes' => [
      'DB' => [
        'type' => 'Db\MySQL',
        'drive' => 'mysql',
        'connect' => true,
        'hostname' => 'teste',
        'user' => '',
        'password' => '',
        'database' => '',
        'querys' => [
          'select name from user limit 1'
        ]
      ]
  ]
];

$beholder = new BeholderWebClient\Observer($conf);
$beholder->run();
