<?php

use BeholderWebClient\Eyes\Db\DbStatus as Status;

require_once '/var/www/vendor/autoload.php';

class PostgreSQLQueryTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    protected $prefix = '';

    public function __construct(){
      $this->prefix = date('YmdHis');
    }

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

    public function testCreateDatabaseQuery() {

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
                  'create' => [
                    'CREATE DATABASE beholder_pgsql_' . $this->prefix
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
      $this->assertEquals(Status::OK, $result[$eyeName]['message']);
      $this->assertEquals(Status::OK_NUMBER, $result[$eyeName]['status']);

    }

    public function testCreateSchemaQuery() {

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
                  'create' => [
                    'CREATE Schema scm_' . $this->prefix
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
      $this->assertEquals(Status::OK, $result[$eyeName]['message']);
      $this->assertEquals(Status::OK_NUMBER, $result[$eyeName]['status']);

    }

    public function testCreateTableQuery() {

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
                  'create' => [
                    'CREATE table test_' . $this->prefix . ' ( id integer , value integer)'
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
      $this->assertEquals(Status::OK, $result[$eyeName]['message']);
      $this->assertEquals(Status::OK_NUMBER, $result[$eyeName]['status']);

    }

    public function testInsertQuery() {

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
                  'insert' => [
                    'insert into test_' . $this->prefix . ' values (1)'
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
      $this->assertEquals(Status::OK, $result[$eyeName]['message']);
      $this->assertEquals(Status::OK_NUMBER, $result[$eyeName]['status']);

    }

    public function testWrongInsertQuery() {

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
                  'insert' => [
                    'insert into wrongtest_' . $this->prefix . ' values (1)'
                  ]
              ]
            ]
          ]
      ];

      $beholder = new BeholderWebClient\Observer();
      $beholder->setConf($conf);
      $beholder->run();

      $result = $beholder->getResult();
      $message = substr($result[$eyeName]['message'],0,strlen(Status::QUERY_INSERT_FAIL));

      $this->assertArrayHasKey($eyeName, $result);
      $this->assertEquals(Status::QUERY_INSERT_FAIL, $message);
      $this->assertEquals(Status::QUERY_INSERT_FAIL_NUMBER, $result[$eyeName]['status']);

    }


    public function testUpdateQuery() {

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
                  'update' => [
                    'update test_' . $this->prefix . ' set value = 2 where id = 1'
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
      $this->assertEquals(Status::OK, $result[$eyeName]['message']);
      $this->assertEquals(Status::OK_NUMBER, $result[$eyeName]['status']);

    }

    public function testWrongTableUpdateQuery() {

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
                  'update' => [
                    'update wrongtest_' . $this->prefix . ' set value = 2 where id = 1'
                  ]
              ]
            ]
          ]
      ];

      $beholder = new BeholderWebClient\Observer();
      $beholder->setConf($conf);
      $beholder->run();

      $result = $beholder->getResult();
      $message = substr($result[$eyeName]['message'],0,strlen(Status::QUERY_UPDATE_FAIL));

      $this->assertArrayHasKey($eyeName, $result);
      $this->assertEquals(Status::QUERY_UPDATE_FAIL, $message);
      $this->assertEquals(Status::QUERY_UPDATE_FAIL_NUMBER, $result[$eyeName]['status']);

    }

    public function testSelectQuery() {

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
                  'select' => [
                    'select * from test_' . $this->prefix . ' where id = 1 and value = 2'
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
      $this->assertEquals(Status::OK, $result[$eyeName]['message']);
      $this->assertEquals(Status::OK_NUMBER, $result[$eyeName]['status']);

    }

    public function testEmptySelectQuery() {

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
                  'select' => [
                    'select * from test_' . $this->prefix . ' where id = 2 and value = 2'
                  ]
              ]
            ]
          ]
      ];

      $beholder = new BeholderWebClient\Observer();
      $beholder->setConf($conf);
      $beholder->run();

      $result = $beholder->getResult();
      $message = substr($result[$eyeName]['message'],0,strlen(Status::QUERY_SELECT_FAIL));
      $this->assertArrayHasKey($eyeName, $result);
      $this->assertEquals(Status::QUERY_SELECT_FAIL, $message);
      $this->assertEquals(Status::QUERY_SELECT_FAIL_NUMBER, $result[$eyeName]['status']);

    }

    public function testWrongTableSelectQuery() {

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
                  'select' => [
                    'select * from wrong_test_' . $this->prefix . ' where id = 2 and value = 2'
                  ]
              ]
            ]
          ]
      ];

      $beholder = new BeholderWebClient\Observer();
      $beholder->setConf($conf);
      $beholder->run();

      $result = $beholder->getResult();
      $message = substr($result[$eyeName]['message'],0,strlen(Status::QUERY_SELECT_FAIL));
      $this->assertArrayHasKey($eyeName, $result);
      $this->assertEquals(Status::QUERY_SELECT_FAIL, $message);
      $this->assertEquals(Status::QUERY_SELECT_FAIL_NUMBER, $result[$eyeName]['status']);

    }

    public function testDeleteQuery() {

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
                  'delete' => [
                    'delete from test_' . $this->prefix . ' where id = 1'
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
      $this->assertEquals(Status::OK, $result[$eyeName]['message']);
      $this->assertEquals(Status::OK_NUMBER, $result[$eyeName]['status']);

    }

    public function testWrongDeleteQuery() {

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
                  'delete' => [
                    'delete from wrongtest_' . $this->prefix . ' where id = 1'
                  ]
              ]
            ]
          ]
      ];

      $beholder = new BeholderWebClient\Observer();
      $beholder->setConf($conf);
      $beholder->run();

      $result = $beholder->getResult();

      $message = substr($result[$eyeName]['message'],0,strlen(Status::QUERY_DELETE_FAIL));
      $this->assertArrayHasKey($eyeName, $result);
      $this->assertEquals(Status::QUERY_DELETE_FAIL, $message);
      $this->assertEquals(Status::QUERY_DELETE_FAIL_NUMBER, $result[$eyeName]['status']);

    }

    public function testDeleteNothingQuery() {

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
                  'delete' => [
                    'delete from test_' . $this->prefix . ' where id = 1'
                  ]
              ]
            ]
          ]
      ];

      $beholder = new BeholderWebClient\Observer();
      $beholder->setConf($conf);
      $beholder->run();

      $result = $beholder->getResult();

      $message = substr($result[$eyeName]['message'],0,strlen(Status::QUERY_DELETE_FAIL));
      $this->assertArrayHasKey($eyeName, $result);
      $this->assertEquals(Status::QUERY_DELETE_FAIL, $message);
      $this->assertEquals(Status::QUERY_DELETE_FAIL_NUMBER, $result[$eyeName]['status']);

    }

    public function testDropQuery() {

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
                  'drop' => [
                    'drop database beholder_pgsql_' . $this->prefix
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
      $this->assertEquals(Status::OK, $result[$eyeName]['message']);
      $this->assertEquals(Status::OK_NUMBER, $result[$eyeName]['status']);

    }

    public function testWrongDropQuery() {

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
                  'drop' => [
                    'drop database wrongbeholder_pgsql_' . $this->prefix
                  ]
              ]
            ]
          ]
      ];

      $beholder = new BeholderWebClient\Observer();
      $beholder->setConf($conf);
      $beholder->run();

      $result = $beholder->getResult();
      $message = substr($result[$eyeName]['message'],0,strlen(Status::COULD_NOT_DROP));
      $this->assertArrayHasKey($eyeName, $result);
      $this->assertEquals(Status::COULD_NOT_DROP, $message);
      $this->assertEquals(Status::COULD_NOT_DROP_NUMBER, $result[$eyeName]['status']);

    }

}
