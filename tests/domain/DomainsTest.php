<?php

use BeholderWebClient\Eyes\Domain\Eye;
use BeholderWebClient\Eyes\Domain\DomainStatus as Status;

require_once __DIR__ . '/fixtures/HelperDomain.php';

require_once '/var/www/vendor/autoload.php';

class DomainTest extends \Codeception\Test\Unit
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

    public function testVerifyWithoutDomain() {

      $eyeName = 'HelperDomain';

      $conf = [
        'eyes' => [
            $eyeName => [
              'type' => 'HelperDomain'
            ]
        ]
      ];

      try {

        $beholder = new BeholderWebClient\Observer();
        $beholder->setConf($conf);
        $beholder->run();
        $result = $beholder->getResult();

      } catch(Exception $ex) {

        $code = $ex->getCode();
        $message = $ex->getMessage();

      }

      $this->assertEquals(Status::EXPECTATION_FAILED_NUMBER, $code, 'Status should be ' . Status::EXPECTATION_FAILED_NUMBER);
      $this->assertEquals(Status::EXPECTATION_FAILED, $message, 'Message should be ' . Status::EXPECTATION_FAILED);

    }


    public function testVerifyPublishedDomain() {

      $eyeName = 'HelperDomain';

      $conf = [
        'eyes' => [
            $eyeName => [
              'type' => 'HelperDomain',
              'domain' => 'published.com.br'
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

    public function testVerifyPublishedComDomain() {

      $eyeName = 'HelperDomain';

      $conf = [
        'eyes' => [
            $eyeName => [
              'type' => 'HelperDomain',
              'domain' => 'published.com'
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

    public function testVerifyReleaseComBrDomain() {

      $eyeName = 'HelperDomain';

      $conf = [
        'eyes' => [
            $eyeName => [
              'type' => 'HelperDomain',
              'domain' => 'release.com.br'
            ]
        ]
      ];

      $beholder = new BeholderWebClient\Observer();
      $beholder->setConf($conf);
      $beholder->run();

      $result = $beholder->getResult();

      $this->assertArrayHasKey($eyeName, $result);
      $this->assertEquals(Status::RELEASE_PROCESS_NUMBER, $result[$eyeName]['status'], 'Status should be ' . Status::RELEASE_PROCESS_NUMBER);
      $this->assertEquals(Status::RELEASE_PROCESS, $result[$eyeName]['message'], 'Message should be ' . Status::RELEASE_PROCESS);

    }

    public function testVerifyOnHoldComBrDomain() {

      $eyeName = 'HelperDomain';

      $conf = [
        'eyes' => [
          $eyeName => [
            'type' => 'HelperDomain',
            'domain' => 'onhold.com.br'
          ]
        ]
      ];

      $beholder = new BeholderWebClient\Observer();
      $beholder->setConf($conf);
      $beholder->run();

      $result = $beholder->getResult();

      $this->assertArrayHasKey($eyeName, $result);
      $message = substr($result[$eyeName]['message'],0,strlen(Status::UNEXPECTED_STATUS));

      $this->assertEquals(Status::UNEXPECTED_STATUS, $message, 'Message should be ' . Status::UNEXPECTED_STATUS);
      $this->assertEquals(Status::UNEXPECTED_STATUS_NUMBER, $result[$eyeName]['status'], 'Status should be ' . Status::UNEXPECTED_STATUS_NUMBER);

    }

    public function testVerifyNoMatchComBrDomain() {

      $eyeName = 'HelperDomain';

      $conf = [
        'eyes' => [
          $eyeName => [
            'type' => 'HelperDomain',
            'domain' => 'nomatch.com.br'
          ]
        ]
      ];

      $beholder = new BeholderWebClient\Observer();
      $beholder->setConf($conf);
      $beholder->run();

      $result = $beholder->getResult();

      $this->assertArrayHasKey($eyeName, $result);

      $this->assertEquals(Status::NO_MATCH, $result[$eyeName]['message'], 'Message should be ' . Status::NO_MATCH);
      $this->assertEquals(Status::EXPECTATION_FAILED_NUMBER, $result[$eyeName]['status'], 'Status should be ' . Status::EXPECTATION_FAILED_NUMBER);

    }

    public function testVerifyNoMatchComDomain() {

      $eyeName = 'HelperDomain';

      $conf = [
        'eyes' => [
          $eyeName => [
            'type' => 'HelperDomain',
            'domain' => 'nomatch.com'
          ]
        ]
      ];

      $beholder = new BeholderWebClient\Observer();
      $beholder->setConf($conf);
      $beholder->run();

      $result = $beholder->getResult();

      $this->assertArrayHasKey($eyeName, $result);

      $this->assertEquals(Status::NO_MATCH, $result[$eyeName]['message'], 'Message should be ' . Status::NO_MATCH);
      $this->assertEquals(Status::EXPECTATION_FAILED_NUMBER, $result[$eyeName]['status'], 'Status should be ' . Status::EXPECTATION_FAILED_NUMBER);

    }

    public function testVerifyNotRegisteredComDomain() {

      $eyeName = 'HelperDomain';

      $conf = [
        'eyes' => [
          $eyeName => [
            'type' => 'HelperDomain',
            'domain' => 'registered.com'
          ]
        ]
      ];

      $beholder = new BeholderWebClient\Observer();
      $beholder->setConf($conf);
      $beholder->run();

      $result = $beholder->getResult();

      $this->assertArrayHasKey($eyeName, $result);

      $this->assertEquals(Status::NO_MATCH, $result[$eyeName]['message'], 'Message should be ' . Status::NO_MATCH);
      $this->assertEquals(Status::EXPECTATION_FAILED_NUMBER, $result[$eyeName]['status'], 'Status should be ' . Status::EXPECTATION_FAILED_NUMBER);

    }


}
