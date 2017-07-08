<?php

define('ROOT', '/var/www');
require ROOT . '/vendor/autoload.php';

$conf = [
  'eyes' => [
      'DB' => [
        'type' => 'Db\MySQL',
        'drive' => 'PDO',
        'host' => 'beholder-test-mysql',
        'user' => 'root',
        'password' => 'initial1234',
        'dbname' => 'beholder_test',
        'port' => '3306',
        'querys' => [
          'select' => ['select name from user limit 1']
        ]
      ]
  ]
];

$beholder = new BeholderWebClient\Observer($conf);
$beholder->run();
