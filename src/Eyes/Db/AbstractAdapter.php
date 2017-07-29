<?php

namespace BeholderWebClient\Eyes\Db;

use Exception;
use BeholderWebClient\Eyes\Db\DbStatus as Status;

Abstract class AbstractAdapter implements iAdapter {

  const PREFIX_RQ_FAIL = 'Requirement fail: ';

  public function __construct($conf){
    $this->conf = $conf;
  }

  public static function throwCouldNotConnect($message, $ex = null){
    throw new Exception(Status::COULD_NOT_CONNECT_TO_SGBD . ' - ' . $message, Status::COULD_NOT_CONNECT_TO_SGBD_NUMBER, $ex);
  }

  public static function throwBadFormatedQuery(){
    throw new Exception(Status::BAD_FORMATED_QUERY, Status::EXPECTATION_FAILED_NUMBER);
  }

  public function getMergedArrayQuery($arr){

    $f = function($arr, $errNo, $errMessage){
      return [[ 'query' => $arr, 'errNo' => $errNo, 'errMessage' =>  $errMessage]];
    };

    return array_merge(
      isset($arr['create']) ? $f($arr['create'], Status::COULD_NOT_CREATE_TABLE_NUMBER, Status::COULD_NOT_CREATE_TABLE) : [],
      isset($arr['insert']) ? $f($arr['insert'], Status::QUERY_INSERT_FAIL_NUMBER, Status::QUERY_INSERT_FAIL) : [],
      isset($arr['update']) ? $f($arr['update'], Status::QUERY_UPDATE_FAIL_NUMBER, Status::QUERY_UPDATE_FAIL) : [],
      isset($arr['select']) ? $f($arr['select'], Status::QUERY_SELECT_FAIL_NUMBER, Status::QUERY_SELECT_FAIL) : [],
      isset($arr['delete']) ? $f($arr['delete'], Status::QUERY_DELETE_FAIL_NUMBER, Status::QUERY_DELETE_FAIL) : [],
      isset($arr['drop'])   ? $f($arr['drop'  ], Status::COULD_NOT_DROP_TABLE_NUMBER, Status::COULD_NOT_DROP_TABLE) : []
    );

  }

}
