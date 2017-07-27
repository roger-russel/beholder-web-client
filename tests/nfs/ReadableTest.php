<?php

use BeholderWebClient\Eyes\Nfs\Eye;
use BeholderWebClient\Eyes\Nfs\NfsStatus as Status;

require_once '/var/www/vendor/autoload.php';

class ReadableTest extends \Codeception\Test\Unit
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

    public function testReadableFile() {

      $eyeName = 'NfsReadable';

      $path = '/mnt/read';
      $filename = 'readable.txt';

      $conf = [
        'eyes' => [
            $eyeName => [
              'type' => 'Nfs',
              'filename' => $filename,
              'path' => $path,
              'write' => false,
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
      $this->assertSame(true, file_exists($path . '/' . $filename), 'file:' . $filename . ' should not exist.');

    }

    public function testCouldNotReadFile() {
      return; // could not make a not readable file at docker :( but it test it changing to r+ on code

      $eyeName = 'NfsNotReadable';

      $path = '/mnt/read';
      $filename = 'notreadable.txt';

      $conf = [
        'eyes' => [
            $eyeName => [
              'type' => 'Nfs',
              'filename' => $filename,
              'path' => $path,
              'write' => false,
            ]
        ]
      ];

      $beholder = new BeholderWebClient\Observer();
      $beholder->setConf($conf);
      $beholder->run();

      $result = $beholder->getResult();

      $message = substr($result[$eyeName]['message'],0,strlen(Status::COULD_NOT_READ_FILE));

      $this->assertArrayHasKey($eyeName, $result);
      $this->assertEquals(Status::COULD_NOT_READ_FILE_NUMBER, $result[$eyeName]['status'], 'Should not be able to read this file.');
      $this->assertEquals(Status::COULD_NOT_READ_FILE, $message);
      $this->assertSame(true, file_exists($path . '/' . $filename), 'file:' . $filename . ' should not exist.');

    }

}
