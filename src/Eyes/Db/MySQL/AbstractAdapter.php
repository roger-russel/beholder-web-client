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

}
