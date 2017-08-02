<?php

use BeholderWebClient\Eyes\Db\DbStatus as Status;

require_once '/var/www/vendor/autoload.php';

class MySQLQueryTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    public function __construct(){
      date_default_timezone_set('America/Sao_Paulo');
      $this->prefix = date('YmdHis');
      $pdo = require __DIR__ . '/helperPdo.php';
      $pdo->exec('CREATE DATABASE IF NOT EXISTS beholder_test');
    }

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
    public function testCreateDatabaseQuery() {

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
                  'create' => [
                    'CREATE DATABASE beholder_mysql_' . $this->prefix
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
                  'create' => [
                    'CREATE table test_' . $this->prefix . ' ( id int NOT NULL AUTO_INCREMENT primary key, value integer)'
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
                  'insert' => [
                    'insert into test_' . $this->prefix . ' ( value ) values (1)'
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
                  'drop' => [
                    'drop database beholder_mysql_' . $this->prefix
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
                  'drop' => [
                    'drop database wrongbeholder_mysql_' . $this->prefix
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
