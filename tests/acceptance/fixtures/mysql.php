<?php

require __DIR__ . '/bootstrap.php';

$conf = [
  'eyes' => [
      'DB:allin' => [
        'type' => 'Db\MySQL',
//        'driver' => 'mysqli',
        'host' => 'beholder-test-mysql',
        'user' => 'root',
        'password' => 'initial1234',
        'dbname' => 'beholder_test',
        'port' => '3306',

      ]
  ]
];

$beholder = new BeholderWebClient\Observer($conf);
$beholder->run();
$beholder->writeJson();
