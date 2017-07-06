<?php

namespace BeholderWebClient\Eyes\Db;

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
      $this->testQuery();

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

  protected function conn_pdo(){
    $this->pdo = new PDO($this->conf['host'], $this->conf['user'] , $this->conf['password']);
  }

}
