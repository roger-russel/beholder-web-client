<?php

use BeholderWebClient\Eyes\Db\Redis\RedisStatus as Status;

require_once '/var/www/vendor/autoload.php';

class RedisConnectTest extends \Codeception\Test\Unit
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

    public function testInvalidConnect() {

      $eyeName = 'RedisConnect';

      $conf = [
        'eyes' => [
            $eyeName => [
              'type' => 'Db\Redis',
              'host' => 'beholder-test-redis-asd'
            ]
        ]
      ];

      $beholder = new BeholderWebClient\Observer();
      $beholder->setConf($conf);
      $beholder->run();

      $result = $beholder->getResult();

      $message = substr($result[$eyeName]['message'],0,strlen(Status::COULD_NOT_CONNECT_TO_SGBD));

      $this->assertArrayHasKey($eyeName, $result);
      $this->assertEquals(Status::COULD_NOT_CONNECT_TO_SGBD, $message);
      $this->assertEquals(Status::COULD_NOT_CONNECT_TO_SGBD_NUMBER, $result[$eyeName]['status']);

    }

    public function testValidConnect() {

      $eyeName = 'RedisConnect';

      $conf = [
        'eyes' => [
            $eyeName => [
              'type' => 'Db\Redis',
              'host' => 'beholder-test-redis'
            ]
        ]
      ];

      $beholder = new BeholderWebClient\Observer();
      $beholder->setConf($conf);
      $beholder->run();

      $result = $beholder->getResult();

      $this->assertArrayHasKey($eyeName, $result);
      $this->assertEquals(Status::OK, $result[$eyeName]['message']);
      $this->assertEquals(Status::OK_NUMBER, $result[$eyeName]['status']);

    }


}
