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

      $this->assertEquals($query, [
        [ 'query' => ['1', '7'], 'errNo' =>  Status::COULD_NOT_CREATE_NUMBER, 'errMessage' => Status::COULD_NOT_CREATE ],
        [ 'query' => ['2'], 'errNo' =>  Status::QUERY_INSERT_FAIL_NUMBER, 'errMessage' => Status::QUERY_INSERT_FAIL ],
        [ 'query' => ['3'], 'errNo' =>  Status::QUERY_UPDATE_FAIL_NUMBER, 'errMessage' => Status::QUERY_UPDATE_FAIL ],
        [ 'query' => ['4'], 'errNo' =>  Status::QUERY_SELECT_FAIL_NUMBER, 'errMessage' => Status::QUERY_SELECT_FAIL ],
        [ 'query' => ['5'], 'errNo' =>  Status::QUERY_DELETE_FAIL_NUMBER, 'errMessage' => Status::QUERY_DELETE_FAIL ],
        [ 'query' => ['6'], 'errNo' =>  Status::COULD_NOT_DROP_NUMBER, 'errMessage' => Status::COULD_NOT_DROP ]
      ]);

    }

}
