<?php

use BeholderWebClient\Eyes\Url\Eye;
use BeholderWebClient\Eyes\Url\UrlStatus as Status;

require_once '/var/www/vendor/autoload.php';

class DeleteTest extends \Codeception\Test\Unit
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
    public function testDeleteWithWrongMethod() {

      $eyeName = 'Url';

      $uri = self::URL_BASE . '/delete.php';

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
      $this->assertEquals(Status::STATUS_CODE_WAS_NOT_EXPECTED, $message, 'Message should be ' . Status::STATUS_CODE_WAS_NOT_EXPECTED);
      $this->assertEquals(Status::STATUS_CODE_WAS_NOT_EXPECTED_NUMBER, $result[$eyeName]['status'], 'Status should be ' . Status::STATUS_CODE_WAS_NOT_EXPECTED_NUMBER);

    }

    public function testDeleteWithoutDataMethod() {

      $eyeName = 'Url';

      $uri = self::URL_BASE . '/delete.php';

      $conf = [
        'eyes' => [
            $eyeName => [
              'type' => 'Url',
              'uri' => $uri,
              'http' => [
                'method' => 'delete'
              ]
            ]
        ]
      ];

      $beholder = new BeholderWebClient\Observer($conf);
      $beholder->run();

      $result = $beholder->getResult();

      $this->assertArrayHasKey($eyeName, $result);
      $this->assertEquals(Status::OK, $result[$eyeName]['message'], 'Message should be ' . Status::OK);
      $this->assertEquals(Status::OK_NUMBER, $result[$eyeName]['status'], 'Status should be ' . Status::OK_NUMBER);

    }

    public function testDeleteWithDataRightlyMethod() {

      $eyeName = 'Url';

      $uri = self::URL_BASE . '/deleteWithData.php';

      $conf = [
        'eyes' => [
            $eyeName => [
              'type' => 'Url',
              'uri' => $uri,
              'http' => [
                'method' => 'delete',
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
      $this->assertEquals(Status::OK, $result[$eyeName]['message'], 'Message should be ' . Status::OK);
      $this->assertEquals(Status::OK_NUMBER, $result[$eyeName]['status'], 'Status should be ' . Status::OK_NUMBER);

    }

    public function testDeleteWithDataWronglyMethod() {

      $eyeName = 'Url';

      $uri = self::URL_BASE . '/deleteWithData.php';

      $conf = [
        'eyes' => [
            $eyeName => [
              'type' => 'Url',
              'uri' => $uri,
              'http' => [
                'method' => 'delete',
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
      $this->assertEquals(Status::STATUS_CODE_WAS_NOT_EXPECTED, $message, 'Message should be ' . Status::STATUS_CODE_WAS_NOT_EXPECTED);
      $this->assertEquals(Status::STATUS_CODE_WAS_NOT_EXPECTED_NUMBER, $result[$eyeName]['status'], 'Status should be ' . Status::STATUS_CODE_WAS_NOT_EXPECTED_NUMBER);

    }


}
