<?php

use BeholderWebClient\Eyes\Db\DbStatus as Status;

require_once '/var/www/vendor/autoload.php';

class MySQLConnectTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    public function __construct(){

      $pdo = require __DIR__ . '/helperPdo.php';
      $pdo->exec('CREATE DATABASE IF NOT EXISTS beholder_test');
    }

    protected function _before()
    {

    }

    protected function _after()
    {
    }

    public function testInvalidConnect() {

      $eyeName = 'MySQLConnect';

      $conf = [
        'eyes' => [
            $eyeName => [
              'type' => 'Db\MySQL',
              'host' => 'beholder-test-mysql',
              'user' => 'root',
              'password' => 'initial123456',
              'dbname' => 'beholder_test',
              'port' => '3306'
            ]
        ]
      ];

      $beholder = new BeholderWebClient\Observer();
      $beholder->setConf($conf);
      $beholder->run();

      $result = $beholder->getResult();

      $message = substr($result[$eyeName]['message'],0,strlen(Status::COULD_NOT_CONNECT_TO_SGBD));

      $this->assertArrayHasKey($eyeName, $result);
      $this->assertEquals(Status::COULD_NOT_CONNECT_TO_SGBD_NUMBER, $result[$eyeName]['status']);
      $this->assertEquals(Status::COULD_NOT_CONNECT_TO_SGBD, $message);

    }

    public function testValidConnect() {

      $eyeName = 'MySQLConnect';

      $conf = [
        'eyes' => [
            $eyeName => [
              'type' => 'Db\MySQL',
              'host' => 'beholder-test-mysql',
              'user' => 'root',
              'password' => 'initial1234',
              'dbname' => 'beholder_test',
              'port' => '3306'
            ]
        ]
      ];

      $beholder = new BeholderWebClient\Observer();
      $beholder->setConf($conf);
      $beholder->run();

      $result = $beholder->getResult();

      $this->assertArrayHasKey($eyeName, $result);
      $this->assertEquals(Status::OK_NUMBER, $result[$eyeName]['status']);
      $this->assertEquals(Status::OK, $result[$eyeName]['message']);

    }


}
