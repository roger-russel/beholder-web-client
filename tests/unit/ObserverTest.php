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

        $beholder = new HelperObserver();
        $beholder->setConf($conf);

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

      $beholder = new HelperObserver();
      $beholder->setConf($conf);

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

      $beholder = new HelperObserver();
      $beholder->setConf($conf);
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

      $beholder = new HelperObserver();
      $beholder->setConf($conf);

      $beholder->run();
      $result = $beholder->getResult();
      $this->assertEquals($result[$eyeName]['importance'], HelperObserver::IMPORTANCE_DEFAULT);

    }

    public function testOverviewWhenASingleGoesRigth(){

      $path = '/mnt/read';
      $filename = 'notwritable.txt';

      $eyeName = 'test';

      $conf = [
        'eyes' => [
          $eyeName => [
            'type' => 'Nfs',
            'path' => $path,
            'filename' => $filename,
            'write' => false,
            'read' => false
          ]
        ]

      ];

      $beholder = new HelperObserver();
      $beholder->setConf($conf);
      $beholder->run();
      $result = $beholder->getResult();
      $this->assertEquals($result['info']['overview'], HelperObserver::OVERVIEW_OK);

    }

    public function testOverviewWhenAMultipleGoesRigth(){

      $path = '/mnt/read';
      $filename = 'notwritable.txt';

      $conf = [
        'eyes' => [
          'teste1' => [
            'type' => 'Nfs',
            'path' => $path,
            'filename' => $filename,
            'write' => false,
            'read' => false
          ],
          'teste2' => [
            'type' => 'Nfs',
            'path' => $path,
            'filename' => $filename,
            'write' => false,
            'read' => false
          ],
          'teste3' => [
            'type' => 'Nfs',
            'path' => $path,
            'filename' => $filename,
            'write' => false,
            'read' => false
          ]
        ]

      ];

      $beholder = new HelperObserver();
      $beholder->setConf($conf);
      $beholder->run();
      $result = $beholder->getResult();
      $this->assertEquals($result['info']['overview'], HelperObserver::OVERVIEW_OK);

    }

    public function testOverviewWhenASingleGoesWrong(){

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

      $beholder = new HelperObserver();
      $beholder->setConf($conf);
      $beholder->run();
      $result = $beholder->getResult();
      $this->assertEquals($result['info']['overview'], HelperObserver::SOMETHING_IS_WRONG);

    }

    public function testOverviewWhenAMultipleGoesWrong(){

      $path = '/mnt/read';
      $filename = 'notwritable.txt';

      $conf = [
        'eyes' => [
          'teste1' => [
            'type' => 'Nfs',
            'path' => $path,
            'filename' => $filename,
          ],
          'teste2' => [
            'type' => 'Nfs',
            'path' => $path,
            'filename' => $filename,
          ],
          'teste3' => [
            'type' => 'Nfs',
            'path' => $path,
            'filename' => $filename,
          ]
        ]

      ];

      $beholder = new HelperObserver();
      $beholder->setConf($conf);
      $beholder->run();
      $result = $beholder->getResult();
      $this->assertEquals($result['info']['overview'], HelperObserver::SOMETHING_IS_WRONG);

    }

    public function testOverviewWhenASingleGoesWrognOnMultipleWhichGoesRight(){

      $path = '/mnt/read';
      $filename = 'notwritable.txt';

      $conf = [
        'eyes' => [
          'teste1' => [
            'type' => 'Nfs',
            'path' => $path,
            'filename' => $filename,
            'write' => false,
            'read' => false
          ],
          'teste2' => [
            'type' => 'Nfs',
            'path' => $path,
            'filename' => $filename,
          ],
          'teste3' => [
            'type' => 'Nfs',
            'path' => $path,
            'filename' => $filename,
            'write' => false,
            'read' => false            
          ]
        ]

      ];

      $beholder = new HelperObserver();
      $beholder->setConf($conf);
      $beholder->run();
      $result = $beholder->getResult();
      $this->assertEquals($result['info']['overview'], HelperObserver::SOMETHING_IS_WRONG);

    }


}
