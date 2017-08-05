<?php

use BeholderWebClient\Eyes\Db\MongoDb\MongoDbStatus as Status;

require_once '/var/www/vendor/autoload.php';

class MongoDbConnectTest extends \Codeception\Test\Unit
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

      $eyeName = 'MongoDb';

      $conf = [
        'eyes' => [
            $eyeName => [
              'type' => 'Db\MongoDb',
              'host' => 'sdsdsadsdbeholder-test-mongodbsdsd',
              'user' => 'root',
              'password' => 'initial123456',
              'dbname' => 'beholder_test',
              'port' => '270177'
            ]
        ]
      ];

      $beholder = new BeholderWebClient\Observer();
      $beholder->setConf($conf);
      $beholder->run();

      $result = $beholder->getResult();

      $message = substr($result[$eyeName]['message'], 0, strlen(Status::COULD_NOT_CONNECT_TO_SGBD));

      $this->assertArrayHasKey($eyeName, $result);
      $this->assertEquals(Status::COULD_NOT_CONNECT_TO_SGBD, $result[$eyeName]['message']);
      $this->assertEquals(Status::COULD_NOT_CONNECT_TO_SGBD_NUMBER, $result[$eyeName]['status']);

    }




    public function testValidConnect() {

      $eyeName = 'MongoDb';

      $conf = [
        'eyes' => [
            $eyeName => [
              'type' => 'Db\MongoDb',
              'host' => 'beholder-test-mongo',
              'user' => 'root',
              'password' => 'initial1234',
              'dbname' => 'beholder_test',
    //          'port' => '3306'
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
