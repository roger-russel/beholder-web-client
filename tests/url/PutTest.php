<?php

use BeholderWebClient\Eyes\Url\Eye;
use BeholderWebClient\Eyes\Url\UrlStatus as Status;

require_once '/var/www/vendor/autoload.php';

class PutTest extends \Codeception\Test\Unit
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

    /**
     * This method verify if page is not accepting any method
     */
    public function testPutWithWrongMethod() {

      $eyeName = 'Url';

      $uri = self::URL_BASE . '/put.php';

      $conf = [
        'eyes' => [
            $eyeName => [
              'type' => 'Url',
              'uri' => $uri,
              'http' => [
                'method' => 'get',
              ]
            ]
        ]
      ];

      $beholder = new BeholderWebClient\Observer($conf);
      $beholder->run();

      $result = $beholder->getResult();

      $this->assertArrayHasKey($eyeName, $result);
      $message = substr($result[$eyeName]['message'],0,strlen(Status::STATUS_CODE_WAS_NOT_EXPECTED));
      $this->assertEquals(Status::STATUS_CODE_WAS_NOT_EXPECTED_NUMBER, $result[$eyeName]['status'], 'Status should be ' . Status::STATUS_CODE_WAS_NOT_EXPECTED_NUMBER);
      $this->assertEquals(Status::STATUS_CODE_WAS_NOT_EXPECTED, $message, 'Message should be ' . Status::STATUS_CODE_WAS_NOT_EXPECTED);

    }

    public function testPutWithoutDataMethod() {

      $eyeName = 'Url';

      $uri = self::URL_BASE . '/put.php';

      $conf = [
        'eyes' => [
            $eyeName => [
              'type' => 'Url',
              'uri' => $uri,
              'http' => [
                'method' => 'put'
              ]
            ]
        ]
      ];

      $beholder = new BeholderWebClient\Observer($conf);
      $beholder->run();

      $result = $beholder->getResult();

      $this->assertArrayHasKey($eyeName, $result);
      $this->assertEquals(Status::OK_NUMBER, $result[$eyeName]['status'], 'Status should be ' . Status::OK_NUMBER);
      $this->assertEquals(Status::OK, $result[$eyeName]['message'], 'Message should be ' . Status::OK);

    }

    public function testPutWithDataRightlyMethod() {

      $eyeName = 'Url';

      $uri = self::URL_BASE . '/putWithData.php';

      $conf = [
        'eyes' => [
            $eyeName => [
              'type' => 'Url',
              'uri' => $uri,
              'http' => [
                'method' => 'put',
                'header' => [
                  'Content-Type' => 'application/json'
                ],
                'data' => json_encode([
                  'var1' => 1,
                  'name' => 'Alberto'
                ])
              ]
            ]
        ]
      ];

      $beholder = new BeholderWebClient\Observer($conf);
      $beholder->run();

      $result = $beholder->getResult();

      $this->assertArrayHasKey($eyeName, $result);
      $this->assertEquals(Status::OK_NUMBER, $result[$eyeName]['status'], 'Status should be ' . Status::OK_NUMBER);
      $this->assertEquals(Status::OK, $result[$eyeName]['message'], 'Message should be ' . Status::OK);

    }

    public function testPutWithDataWronglyMethod() {

      $eyeName = 'Url';

      $uri = self::URL_BASE . '/putWithData.php';

      $conf = [
        'eyes' => [
            $eyeName => [
              'type' => 'Url',
              'uri' => $uri,
              'http' => [
                'method' => 'put',
                'data' => [
                  'var1' => 2,
                  'name' => 'AdAlberto'
                ]
              ]
            ]
        ]
      ];

      $beholder = new BeholderWebClient\Observer($conf);
      $beholder->run();

      $result = $beholder->getResult();

      $this->assertArrayHasKey($eyeName, $result);
      $message = substr($result[$eyeName]['message'],0,strlen(Status::STATUS_CODE_WAS_NOT_EXPECTED));
      $this->assertEquals(Status::STATUS_CODE_WAS_NOT_EXPECTED_NUMBER, $result[$eyeName]['status'], 'Status should be ' . Status::STATUS_CODE_WAS_NOT_EXPECTED_NUMBER);
      $this->assertEquals(Status::STATUS_CODE_WAS_NOT_EXPECTED, $message, 'Message should be ' . Status::STATUS_CODE_WAS_NOT_EXPECTED);

    }


}
