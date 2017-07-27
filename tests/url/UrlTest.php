<?php

use BeholderWebClient\Eyes\Url\Eye;
use BeholderWebClient\Eyes\Url\UrlStatus as Status;

require_once '/var/www/vendor/autoload.php';

class UrlTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    const URL_BASE = 'http://localhost/url/';

    protected function _before()
    {

    }

    protected function _after()
    {
    }

    public function testSimpleOkUrl() {

      $eyeName = 'Url';

      $uri = self::URL_BASE . '/get.php';

      $conf = [
        'eyes' => [
            $eyeName => [
              'type' => 'Url',
              'uri' => $uri,
            ]
        ]
      ];

      $beholder = new BeholderWebClient\Observer();
      $beholder->setConf($conf);
      $beholder->run();

      $result = $beholder->getResult();

      $this->assertArrayHasKey($eyeName, $result);
      $this->assertEquals(Status::OK, $result[$eyeName]['message'], 'Message should be ' . Status::OK);
      $this->assertEquals(Status::OK_NUMBER, $result[$eyeName]['status'], 'Status code should be ' . Status::OK_NUMBER);


    }

    public function testInexistentUrl() {

      $eyeName = 'Url';

      $uri = 'http://urleiniexistente.pudym.noacredito.org';

      $conf = [
        'eyes' => [
            $eyeName => [
              'type' => 'Url',
              'uri' => $uri,
            ]
        ]
      ];

      $beholder = new BeholderWebClient\Observer();
      $beholder->setConf($conf);
      $beholder->run();

      $result = $beholder->getResult();

      $this->assertArrayHasKey($eyeName, $result);

      $message = substr($result[$eyeName]['message'],0,strlen(Status::COULD_NOT_CONNECT));

      $this->assertEquals(Status::COULD_NOT_CONNECT, $message, 'Message should be ' . Status::COULD_NOT_CONNECT);
      $this->assertEquals(Status::COULD_NOT_CONNECT_NUMBER, $result[$eyeName]['status'], 'Status code should be ' . Status::COULD_NOT_CONNECT_NUMBER);


    }

    public function testSpecificStatusCodeCorrectly() {

      $eyeName = 'Url';
      $statusCode = 404;

      $uri = self::URL_BASE . '/notFound.php';

      $conf = [
        'eyes' => [
            $eyeName => [
              'type' => 'Url',
              'uri' => $uri,
              'http_code' => $statusCode
            ]
        ]
      ];

      $beholder = new BeholderWebClient\Observer();
      $beholder->setConf($conf);
      $beholder->run();

      $result = $beholder->getResult();

      $this->assertArrayHasKey($eyeName, $result);
      $this->assertEquals(Status::OK, $result[$eyeName]['message'], 'Message should be ' . Status::OK);
      $this->assertEquals(Status::OK_NUMBER, $result[$eyeName]['status'], 'Status code should be ' . Status::OK_NUMBER);

    }

    public function testSpecificStatusCodeWrongly() {

      $eyeName = 'Url';
      $statusCode = 404;

      $uri = self::URL_BASE . '/get.php';

      $conf = [
        'eyes' => [
            $eyeName => [
              'type' => 'Url',
              'uri' => $uri,
              'http_code' => $statusCode
            ]
        ]
      ];

      $beholder = new BeholderWebClient\Observer();
      $beholder->setConf($conf);
      $beholder->run();

      $result = $beholder->getResult();

      $message = substr($result[$eyeName]['message'],0,strlen(Status::STATUS_CODE_WAS_NOT_EXPECTED));

      $this->assertArrayHasKey($eyeName, $result);
      $this->assertEquals(Status::STATUS_CODE_WAS_NOT_EXPECTED, $message, 'Message should be ' . Status::STATUS_CODE_WAS_NOT_EXPECTED);
      $this->assertEquals(Status::STATUS_CODE_WAS_NOT_EXPECTED_NUMBER, $result[$eyeName]['status'], 'Status code should be ' . Status::STATUS_CODE_WAS_NOT_EXPECTED_NUMBER);

    }

    public function testInexistentMethod() {

      $eyeName = 'Url';

      $uri = self::URL_BASE . '/get.php';

      $conf = [
        'eyes' => [
            $eyeName => [
              'type' => 'Url',
              'uri' => $uri,
              'http' => [
                'method' => 'blabla'
              ]
            ]
        ]
      ];

      $beholder = new BeholderWebClient\Observer();
      $beholder->setConf($conf);
      $beholder->run();
      $result = $beholder->getResult();

      $message = substr($result[$eyeName]['message'],0,strlen(Status::METHOD_NOT_ALLOWED));

      $this->assertArrayHasKey($eyeName, $result);
      $this->assertEquals(Status::METHOD_NOT_ALLOWED, $message, 'Message should be ' . Status::METHOD_NOT_ALLOWED);
      $this->assertEquals(Status::METHOD_NOT_ALLOWED_NUMBER, $result[$eyeName]['status'], 'Status code should be ' . Status::METHOD_NOT_ALLOWED_NUMBER);

    }

}
