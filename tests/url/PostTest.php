<?php

use BeholderWebClient\Eyes\Url\Eye;
use BeholderWebClient\Eyes\Url\UrlStatus as Status;

require_once '/var/www/vendor/autoload.php';

class PostTest extends \Codeception\Test\Unit
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
    public function testPostWithWrongMethod() {

      $eyeName = 'Url';

      $uri = self::URL_BASE . '/postWithData.php';

      $conf = [
        'eyes' => [
            $eyeName => [
              'type' => 'Url',
              'uri' => $uri,
              'http' => [
                'method' => 'post',
                'data' => [
                  'p1' => 1
                ]
              ]
            ]
        ]
      ];

      $beholder = new BeholderWebClient\Observer();
      $beholder->setConf($conf);
      $beholder->run();

      $result = $beholder->getResult();

      $this->assertArrayHasKey($eyeName, $result);
      $message = substr($result[$eyeName]['message'],0,strlen(Status::STATUS_CODE_WAS_NOT_EXPECTED));
      $this->assertEquals(Status::STATUS_CODE_WAS_NOT_EXPECTED_NUMBER, $result[$eyeName]['status'], 'Status code should be ' . Status::STATUS_CODE_WAS_NOT_EXPECTED_NUMBER);
      $this->assertEquals(Status::STATUS_CODE_WAS_NOT_EXPECTED, $message, 'Message should be ' . Status::STATUS_CODE_WAS_NOT_EXPECTED);

    }

    public function testPostWithoutDataMethod() {

      $eyeName = 'Url';

      $uri = self::URL_BASE . '/post.php';

      $conf = [
        'eyes' => [
            $eyeName => [
              'type' => 'Url',
              'uri' => $uri,
              'http' => [
                'method' => 'post'
              ]
            ]
        ]
      ];

      $beholder = new BeholderWebClient\Observer();
      $beholder->setConf($conf);
      $beholder->run();

      $result = $beholder->getResult();

      $this->assertArrayHasKey($eyeName, $result);
      $this->assertEquals(Status::OK_NUMBER, $result[$eyeName]['status'], 'Status code should be ' . Status::OK_NUMBER);
      $this->assertEquals(Status::OK, $result[$eyeName]['message'], 'Message should be ' . Status::OK);

    }

    public function testPostWithDataRightlyMethod() {

      $eyeName = 'Url';

      $uri = self::URL_BASE . '/postWithData.php';

      $conf = [
        'eyes' => [
            $eyeName => [
              'type' => 'Url',
              'uri' => $uri,
              'http' => [
                'method' => 'post',
                'data' => [
                  'var1' => 1,
                  'name' => 'Alberto'
                ]
              ]
            ]
        ]
      ];

      $beholder = new BeholderWebClient\Observer();
      $beholder->setConf($conf);
      $beholder->run();

      $result = $beholder->getResult();

      $this->assertArrayHasKey($eyeName, $result);
      $this->assertEquals(Status::OK_NUMBER, $result[$eyeName]['status'], 'Status code should be ' . Status::OK_NUMBER);
      $this->assertEquals(Status::OK, $result[$eyeName]['message'], 'Message should be ' . Status::OK);

    }

    public function testPostWithDataWronglyMethod() {

      $eyeName = 'Url';

      $uri = self::URL_BASE . '/postWithData.php';

      $conf = [
        'eyes' => [
            $eyeName => [
              'type' => 'Url',
              'uri' => $uri,
              'http' => [
                'method' => 'post',
                'data' => [
                  'var1' => 2,
                  'name' => 'AdAlberto'
                ]
              ]
            ]
        ]
      ];

      $beholder = new BeholderWebClient\Observer();
      $beholder->setConf($conf);
      $beholder->run();

      $result = $beholder->getResult();

      $this->assertArrayHasKey($eyeName, $result);
      $message = substr($result[$eyeName]['message'],0,strlen(Status::STATUS_CODE_WAS_NOT_EXPECTED));
      $this->assertEquals(Status::STATUS_CODE_WAS_NOT_EXPECTED_NUMBER, $result[$eyeName]['status'], 'Status code should be ' . Status::STATUS_CODE_WAS_NOT_EXPECTED_NUMBER);
      $this->assertEquals(Status::STATUS_CODE_WAS_NOT_EXPECTED, $message, 'Message should be ' . Status::STATUS_CODE_WAS_NOT_EXPECTED);

    }


}
