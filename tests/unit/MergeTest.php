<?php

use BeholderWebClient\Eyes\Db\MySQL\Mysql;
use BeholderWebClient\Eyes\Db\DbStatus as Status;

class MergeTest extends \Codeception\Test\Unit
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
    public function testGetMergedArrayQuery() {

      $array = [];
      $array['drop'] = ['6'];
      $array['create'] = ['1', '7'];
      $array['select'] = ['4'];
      $array['delete'] = ['5'];
      $array['insert'] = ['2'];
      $array['update'] = ['3'];

      $mysql = new Mysql(['query' => $array ]);

      $query = $mysql->getMergedArrayQuery($array);

      print_r($query);
      exit();

      $this->assertEquals($query, [
        [ 'query' => ['1', '7'], 'errNo' =>  Status::couldNotCreateTable_number, 'errMessage' => Status::couldNotCreateTable ],
        [ 'query' => ['2'], 'errNo' =>  Status::queryInsertFail_number, 'errMessage' => Status::queryInsertFail ],
        [ 'query' => ['3'], 'errNo' =>  Status::queryUpdateFail_number, 'errMessage' => Status::queryUpdateFail ],
        [ 'query' => ['4'], 'errNo' =>  Status::querySelectFail_number, 'errMessage' => Status::querySelectFail ],
        [ 'query' => ['5'], 'errNo' =>  Status::queryDeleteFail_number, 'errMessage' => Status::queryDeleteFail ],
        [ 'query' => ['6'], 'errNo' =>  Status::couldNotDropTable_number, 'errMessage' => Status::couldNotDropTable ]

      ]);

    }

}
