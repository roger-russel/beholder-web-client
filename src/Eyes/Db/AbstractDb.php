<?php

namespace BeholderWebClient\Eyes\Db;

use Exception;

use BeholderWebClient\Eyes\Status;
use BeholderWebClient\Eyes\AbstractEye;

abstract class AbstractDb extends AbstractEye implements iDb {

  abstract protected function testConn();
  abstract protected function testQuery();

  protected $code;
  protected $message;
  protected $pdo;

  public function look(){

    try {

      $this->testConn();

      if(isset($this->conf['querys']))
        $this->testQuery();

      if( is_null($this->code) ) {
        $this->code = Status::ok;
        $this->message = 'everything worked';
      }

    }catch( Exception $ex ) {
      $this->code = Status::internalServerError;
      $this->message = $ex->getMessage();
    }

  }

  public function getMessage(){
    return $this->message;
  }

  public function getStatusCode(){
    return $this->code;
  }

}
