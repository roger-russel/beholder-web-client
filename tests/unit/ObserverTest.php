<?php

require_once __DIR__ . '/fixtures/HelperObserver.php';

class ObserverTest extends \Codeception\Test\Unit
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
    public function testObserverWithoutSettings() {

        $conf = [];

        $beholder = new HelperObserver($conf);

        $this->assertEquals($beholder->getImportanceDefault(),HelperObserver::IMPORTANCE_DEFAULT);
        $this->assertEquals($beholder->getImportanceAlias(), HelperObserver::IMPORTANCE_ALIAS);
        $this->assertEquals($beholder->getTimeZone(), HelperObserver::TIMEZONE_DEFAULT);

    }

    public function testObserverWithSettings() {

      $impAlias = 'warning_level';
      $impDefault = 'system down';
      $timezone = 'Asia/Aden';

      $conf = [
        'settings' => [
          'importance_alias' => $impAlias,
          'importance_default' => $impDefault,
          'timezone' => $timezone
        ]
      ];

      $beholder = new HelperObserver($conf);

      $this->assertNotEquals($beholder->getImportanceDefault(),HelperObserver::IMPORTANCE_DEFAULT);
      $this->assertNotEquals($beholder->getImportanceAlias(), HelperObserver::IMPORTANCE_ALIAS);
      $this->assertNotEquals($beholder->getTimeZone(), HelperObserver::TIMEZONE_DEFAULT);

      $this->assertEquals($beholder->getImportanceDefault(), $impDefault);
      $this->assertEquals($beholder->getImportanceAlias(), $impAlias);
      $this->assertEquals($beholder->getTimeZone(), $timezone);

    }

    public function testObserverWithImportaneceOnEye() {

      $path = '/mnt/read';
      $filename = 'notwritable.txt';

      $importance = 'system down';

      $eyeName = 'test';

      $conf = [
        'eyes' => [
          $eyeName => [
            'type' => 'Nfs',
            'path' => $path,
            'filename' => $filename,
            'importance' => $importance
          ]
        ]

      ];

      $beholder = new HelperObserver($conf);

      $beholder->run();
      $result = $beholder->getResult();
      $this->assertEquals($result[$eyeName]['importance'], $importance);

    }

    public function testObserverWithoutImportaneceOnEye() {

      $path = '/mnt/read';
      $filename = 'notwritable.txt';

      $eyeName = 'test';

      $conf = [
        'eyes' => [
          $eyeName => [
            'type' => 'Nfs',
            'path' => $path,
            'filename' => $filename,
          ]
        ]

      ];

      $beholder = new HelperObserver($conf);

      $beholder->run();
      $result = $beholder->getResult();
      $this->assertEquals($result[$eyeName]['importance'], HelperObserver::IMPORTANCE_DEFAULT);

    }

}
