<?php

use BeholderWebClient\Eyes\Db\DbStatus as Status;

require_once '/var/www/vendor/autoload.php';

class MySQLQueryTest extends \Codeception\Test\Unit
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

    public function testBadFormatedQuery() {

      $eyeName = 'MySQLConnect';

      $conf = [
        'eyes' => [
            $eyeName => [
              'type' => 'Db\MySQL',
              'host' => 'beholder-test-mysql',
              'user' => 'root',
              'password' => 'initial1234',
              'dbname' => 'beholder_test',
              'port' => '3306',
              'query' => [

              ]
            ]
          ]
      ];

      $beholder = new BeholderWebClient\Observer();
      $beholder->setConf($conf);
      $beholder->run();

      $result = $beholder->getResult();

      $this->assertArrayHasKey($eyeName, $result);
      $this->assertEquals(Status::BAD_FORMATED_QUERY, $result[$eyeName]['message']);
      $this->assertEquals(Status::EXPECTATION_FAILED_NUMBER, $result[$eyeName]['status']);

    }

}
