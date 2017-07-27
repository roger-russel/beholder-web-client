<?php

use BeholderWebClient\Eyes\Nfs\Eye;
use BeholderWebClient\Eyes\Nfs\NfsStatus as Status;

require_once '/var/www/vendor/autoload.php';

class WriteTest extends \Codeception\Test\Unit
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

    public function testWriteFile() {

      $eyeName = 'NfsWritable';

      $path = '/mnt/write';
      $filename = 'writable.txt';

      $conf = [
        'eyes' => [
            $eyeName => [
              'type' => 'Nfs',
              'filename' => $filename,
              'path' => $path
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
      $this->assertSame(false, file_exists($path . '/' . $filename), 'file:' . $filename . ' should not exist.');

    }

    public function testCouldNotWriteFile() {

      $eyeName = 'NfsNotWritable';

      $path = '/mnt/read';
      $filename = 'notwritable.txt';

      $conf = [
        'eyes' => [
            $eyeName => [
              'type' => 'Nfs',
              'filename' => $filename,
              'path' => $path
            ]
        ]
      ];

      $beholder = new BeholderWebClient\Observer();
      $beholder->setConf($conf);
      $beholder->run();

      $result = $beholder->getResult();

      $message = substr($result[$eyeName]['message'],0,strlen(Status::COULD_NOT_WRITE_FILE));

      $this->assertArrayHasKey($eyeName, $result);
      $this->assertEquals(Status::COULD_NOT_WRITE_FILE_NUMBER, $result[$eyeName]['status']);
      $this->assertEquals(Status::COULD_NOT_WRITE_FILE, $message);
      $this->assertSame(false, file_exists($path . '/' . $filename), 'file:' . $filename . ' should not exist.');

    }

}
