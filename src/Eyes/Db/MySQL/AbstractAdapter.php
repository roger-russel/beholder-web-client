<?php

namespace BeholderWebClient\Eyes\Db\MySQL;

use Exception;
use BeholderWebClient\Eyes\Db\DbStatus as Status;

Abstract class AbstractAdapter implements iAdapter {

  const PREFIX_RQ_FAIL = 'Requeriment fail: ';

  public function __construct($conf){
    $this->conf = $conf;
  }

  public static function throwCouldNotConnect($message, $ex = null){
    throw new Exception(Status::couldNotConnectAtSGBD . ' - ' . $message, Status::couldNotConnectAtSGBD_number, $ex);
  }

  public static function throwQueryBadFormated(){
    throw new Exception(Status::expectationFailed . ' - query bad formated', Status::expectationFailed_number);
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
