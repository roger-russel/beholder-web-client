<?php

namespace BeholderWebClient\Eyes\Db;

use Exception;

use BeholderWebClient\Eyes\Db\DbStatus as Status;
use BeholderWebClient\Eyes\AbstractEye;

abstract class AbstractDb extends AbstractEye implements iDb {

  abstract protected function testConn();
  abstract protected function testQuery();
  abstract protected function getDefaultPort();
  abstract protected function selectAdapter($adapter);
  abstract protected function autoDetectAdapter();

  protected $code;
  protected $message;
  protected $port;

  public function __construct($conf){

    if(!isset($conf['port']))
      $conf['port'] = $this->getDefaultPort();

    parent::__construct($conf);

    if(isset($this->conf['driver'])){
      $this->selectAdapter($this->conf['driver']);
    }else{
      $this->autoDetectAdapter();
    }


  }

  public function look(){

    try {

      $this->testConn();

      if(isset($this->conf['query']))
        $this->testQuery();

      $this->code = Status::OK_NUMBER;
      $this->message = Status::OK;
      
    }catch( Exception $ex ) {
      $this->code = $ex->getCode();
      $this->message = $ex->getMessage();
    }

    $this->closeConnection();

  }

  protected function closeConnection(){

    if($this->adapter){
      $this->adapter->closeConnection();
    }

  }

  public function getMessage(){
    return $this->message;
  }

  public function getStatusCode(){
    return $this->code;
  }

}
