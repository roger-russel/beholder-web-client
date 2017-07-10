<?php

namespace BeholderWebClient\Eyes\Db\MySQL;

use Exception;
use BeholderWebClient\Eyes\Db\DbStatus as Status;

class Mysql extends AbstractAdapter {

  protected $conn;

  public function checkRequirement(){

    if(!function_exists("mysql_connect"))
      throw new Exception('Mysql driver not found', Status::internalServerError_number);

  }

  public function testConn(){

    $dns = $this->conf['host'] . ':' . $this->conf['port'];

    $this->conn = \mysql_connect($dns, $this->conf['user'], $this->conf['password']);

    if(!$this->conn)
      parent::throwCouldNotConnect();

  }

  public function testQuery(){

    $mergedArrQuery = $this->getMergedArrayQuery();

    $result = false;

    foreach( $mergedArrQuery as $arrQuery ){
      foreach( $arrQuery['query'] as $query ) {

          $result = mysql_query($query);

          if(!$result){
            throw new Exception($arrQuery['errMessage'] . ' - ' . $query, $arrQuery['errNo']);
          }
      }
    }

    if(!$result)
      parent::throwQueryBadFormated();

  }

  public function getMergedArrayQuery($arr){

    $f = function($arr, $errNo, $errMessage){
      return [[ 'query' => $arr, 'errNo' => $errNo, 'errMessage' =>  $errMessage]];
    };

    return array_merge(
      isset($arr['create']) ? $f($arr['create'], Status::couldNotCreateTable_number, Status::couldNotCreateTable) : [],
      isset($arr['insert']) ? $f($arr['insert'], Status::queryInsertFail_number, Status::queryInsertFail) : [],
      isset($arr['update']) ? $f($arr['update'], Status::queryUpdateFail_number, Status::queryUpdateFail) : [],
      isset($arr['select']) ? $f($arr['select'], Status::querySelectFail_number, Status::querySelectFail) : [],
      isset($arr['delete']) ? $f($arr['delete'], Status::queryDeleteFail_number, Status::queryDeleteFail) : [],
      isset($arr['drop'])   ? $f($arr['drop'  ], Status::couldNotDropTable_number, Status::couldNotDropTable) : []
    );

  }

}
