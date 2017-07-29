<?php

use BeholderWebClient\Eyes\Db\DbStatus as Status;

require_once '/var/www/vendor/autoload.php';

class MySQLConnectTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    protected function _before()
    {

    }

    protected function _after()
    {
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
