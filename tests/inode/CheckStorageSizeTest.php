<?php

use BeholderWebClient\Eyes\Inode\Eye;
use BeholderWebClient\Eyes\Inode\Status as Status;

require_once '/var/www/vendor/autoload.php';

class CheckStorageSize extends \Codeception\Test\Unit
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

    public function testeSucessyful() {

      $eyeName = 'InodeOk';
      $storagePath = exec('df -i | head -n 2 | tail -n 1 | awk -F" " \'{print $6}\'');
      $acceptablePercentsUsage = 100;

      $conf = [
        'eyes' => [
          $eyeName => [
            'type' => 'Inode',
            'storage_path' => $storagePath,
            'acceptable_percents_usage' => $acceptablePercentsUsage,
          ],
        ],
      ];

      $beholder = new BeholderWebClient\Observer();
      $beholder->setConf($conf);
      $beholder->run();

      $result = $beholder->getResult();

      $this->assertArrayHasKey($eyeName, $result);

      $this->assertEquals(Status::OK_NUMBER, $result[$eyeName]['status']);
      $this->assertEquals(Status::OK, $result[$eyeName]['message']);

    }

    public function testeUnSucessyful() {

      $eyeName = 'InodeOk';
      $storagePath = exec('df -i | head -n 2 | tail -n 1 | awk -F" " \'{print $6}\'');
      $acceptablePercentsUsage = -1;

      $conf = [
        'eyes' => [
          $eyeName => [
            'type' => 'Inode',
            'storage_path' => $storagePath,
            'acceptable_percents_usage' => $acceptablePercentsUsage,
          ],
        ],
      ];

      $beholder = new BeholderWebClient\Observer();
      $beholder->setConf($conf);
      $beholder->run();

      $result = $beholder->getResult();

      $this->assertArrayHasKey($eyeName, $result);

      $this->assertEquals(Status::MAX_USAGE_ALLOWED_NUMBER, $result[$eyeName]['status']);
      $this->assertEquals(Status::MAX_USAGE_ALLOWED, $result[$eyeName]['message']);

    }


}
