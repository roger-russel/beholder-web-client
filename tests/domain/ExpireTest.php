<?php

use BeholderWebClient\Eyes\Domain\Eye;
use BeholderWebClient\Eyes\Domain\DomainStatus as Status;

require_once __DIR__ . '/fixtures/HelperDomain.php';

require_once '/var/www/vendor/autoload.php';

class ExpireTest extends \Codeception\Test\Unit
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

    public function testExpireOkDomain() {

      $eyeName = 'HelperDomain';

      $conf = [
        'eyes' => [
            $eyeName => [
              'type' => 'HelperDomain',
              'domain' => 'published.com.br',
              'now' => '1501263087' //2017-07-28, this key exists only on tests.
            ]
        ]
      ];

      $beholder = new BeholderWebClient\Observer();
      $beholder->setConf($conf);
      $beholder->run();

      $result = $beholder->getResult();

      $this->assertArrayHasKey($eyeName, $result);
      $this->assertEquals(Status::OK_NUMBER, $result[$eyeName]['status'], 'Status should be ' . Status::OK_NUMBER);
      $this->assertEquals(Status::OK, $result[$eyeName]['message'], 'Message should be ' . Status::OK);

    }


    public function testCloseToExpiredDomain() {

      $eyeName = 'HelperDomain';

      $conf = [
        'eyes' => [
            $eyeName => [
              'type' => 'HelperDomain',
              'domain' => 'published.com.br',
              'expire' => 30,
              'now' => '1525737600' //2018-05-18, this key exists only on tests.
            ]
        ]
      ];

      $beholder = new BeholderWebClient\Observer();
      $beholder->setConf($conf);
      $beholder->run();

      $result = $beholder->getResult();

      $this->assertArrayHasKey($eyeName, $result);
      $this->assertEquals(Status::CLOSE_TO_EXPIRE_NUMBER, $result[$eyeName]['status'], 'Status should be ' . Status::CLOSE_TO_EXPIRE_NUMBER);
      $this->assertEquals(Status::CLOSE_TO_EXPIRE, $result[$eyeName]['message'], 'Message should be ' . Status::CLOSE_TO_EXPIRE);

    }

    public function testExpireNotFound() {

      $eyeName = 'HelperDomain';

      $conf = [
        'eyes' => [
            $eyeName => [
              'type' => 'HelperDomain',
              'domain' => 'published.com',
              'expire' => 30,
              'now' => '1501263087' //2017-07-28, this key exists only on tests.
            ]
        ]
      ];

      $beholder = new BeholderWebClient\Observer();
      $beholder->setConf($conf);
      $beholder->run();

      $result = $beholder->getResult();

      $this->assertArrayHasKey($eyeName, $result);
      $this->assertEquals(Status::NOT_IMPLEMENTED_NUMBER, $result[$eyeName]['status'], 'Status should be ' . Status::NOT_IMPLEMENTED_NUMBER);
      $this->assertEquals(Status::UNKNOW_EXPIRE_DATE, $result[$eyeName]['message'], 'Message should be ' . Status::UNKNOW_EXPIRE_DATE);

    }


}
