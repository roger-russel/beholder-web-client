<?php

require_once __DIR__ . '/fixtures/HelperObserver.php';

class YmlConfTest extends \Codeception\Test\Unit
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
    public function testConfFromBeholderYmlFile() {

        $conf = [];

        $beholder = new HelperObserver();
        $beholder->useFileConf(__DIR__ . '/fixtures/beholder.yml');

        $this->assertEquals($beholder->getImportanceDefault(),HelperObserver::IMPORTANCE_DEFAULT);
        $this->assertEquals($beholder->getImportanceAlias(), 'warning');
        $this->assertEquals($beholder->getTimeZone(), HelperObserver::TIMEZONE_DEFAULT);

        $conf = $beholder->getConf();

        $this->assertEquals($conf,[
          'settings' => [
            'importance_alias' => 'warning'
          ],
          'eyes' => [
              'MyEyeName' => [
                'type' => 'Url',
                'uri' => 'http://UrlWhichIwantKeepOnEye',
                'http' => [
                  'method' => 'get'
                ]
              ]
          ]
        ]);

    }

}
