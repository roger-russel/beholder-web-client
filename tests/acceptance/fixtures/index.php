<?php

define('ROOT', '/var/www');
require ROOT . '/vendor/autoload.php';

$conf = [
  'eyes' => [
      'DB' => [
        'type' => 'Db\MySQL',
//        'driver' => 'mysqli',
        'host' => 'beholder-test-mysql',
        'user' => 'root',
        'password' => 'initial1234',
        'dbname' => 'beholder_test',
        'port' => '3306',
        'query' => [
          'select' => ['select name from user limit 1']
        ]
      ]
  ]
];

$beholder = new BeholderWebClient\Observer($conf);
$beholder->run();
