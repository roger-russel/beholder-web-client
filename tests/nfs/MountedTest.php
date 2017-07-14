<?php

use BeholderWebClient\Eyes\Nfs\Eye;
use BeholderWebClient\Eyes\Nfs\NfsStatus as Status;

require_once '/var/www/vendor/autoload.php';

class MountedTest extends \Codeception\Test\Unit
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

    // tests
    public function testMontedCorrectly() {

      $eyeName = 'NfsMonted';

      $conf = [
        'eyes' => [
            $eyeName => [
              'type' => 'Nfs',
              'path' => '/mnt/read',
              'write' => false,
              'read' => false
            ]
        ]
      ];

      $beholder = new BeholderWebClient\Observer($conf);
      $beholder->run();

      $result = $beholder->getResult();

      $this->assertArrayHasKey($eyeName, $result);
      $this->assertArrayHasKey('status', $result[$eyeName]);
      $this->assertArrayHasKey('message', $result[$eyeName]);

      $this->assertEquals(Status::OK_NUMBER, $result[$eyeName]['status']);
      $this->assertEquals(Status::OK, $result[$eyeName]['message']);

    }

    public function testNotMonted() {

      $eyeName = 'NfsNotMonted';

      $conf = [
        'eyes' => [
            $eyeName => [
              'type' => 'Nfs',
              'path' => '/mnt',
              'write' => false,
              'read' => false,
            ]
        ]
      ];

      $beholder = new BeholderWebClient\Observer($conf);
      $beholder->run();

      $result = $beholder->getResult();

      $this->assertArrayHasKey($eyeName, $result);
      $this->assertArrayHasKey('status', $result[$eyeName]);
      $this->assertArrayHasKey('message', $result[$eyeName]);

      $this->assertEquals(Status::NOT_MOUNTED_NUMBER, $result[$eyeName]['status']);
      $this->assertEquals(Status::NOT_MOUNTED, $result[$eyeName]['message']);

    }

    public function testPathNotExist() {

      $eyeName = 'NfsPathNotExist';

      $conf = [
        'eyes' => [
            $eyeName => [
              'type' => 'Nfs',
              'path' => '/tmp/path/not/exist',
              'write' => false,
              'read' => false,
              'delete' => false
            ]
        ]
      ];

      try {

        $beholder = new BeholderWebClient\Observer($conf);
        $beholder->run();

        $result = $beholder->getResult();

      }catch(Exception $ex){

        $this->assertEquals(Status::PATH_NOT_EXIST_NUMBER, $ex->getCode());
        $this->assertEquals(Status::PATH_NOT_EXIST, $ex->getMessage());

      }

    }

}
