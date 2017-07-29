<?php

use BeholderWebClient\Eyes\Db\DbStatus as Status;

require_once '/var/www/vendor/autoload.php';

class PostgreSQLQueryTest extends \Codeception\Test\Unit
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

      $eyeName = 'PostgreSQLConnect';

      $conf = [
        'eyes' => [
            $eyeName => [
              'type' => 'Db\PostgreSQL',
              'host' => 'beholder-test-postgresql',
              'user' => 'root',
              'password' => 'initial1234',
              'dbname' => 'beholder_test',
              'port' => '5432',
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
