<?php

namespace BeholderWebClient\Eyes\Db\Redis;

use Exception;
use BeholderWebClient\Eyes\Db\Redis\RedisStatus as Status;
use BeholderWebClient\Eyes\Db\AbstractDb;

Class Eye extends AbstractDb {

  protected $adapter;

  const DEFAULT_PORT = 6379;

  public function checkRequirement(){

    if(is_null($this->adapter))
      throw new Exception(Status::NO_DRIVER, Status::INTERNAL_SERVER_ERROR_NUMBER);

    $this->adapter->checkRequirement();

  }

  protected function getDefaultPort(){
    return self::DEFAULT_PORT;
  }

  public function testConn(){
    $this->adapter->testConn();
  }

  public function testQuery(){
    $this->adapter->testQuery();
  }

  protected function selectAdapter($adapter){

      $adapterName = ucfirst(strtolower($adapter));

      $adapterFullName = "\BeholderWebClient\Eyes\Db\Redis\\{$adapterName}";

      if(class_exists($adapterFullName)) {
        $this->adapter = new ${'adapterFullName'}($this->conf);
      } else {
        throw new Exception("Driver: {$adapter}, is not implemented", Status::INTERNAL_SERVER_ERROR);
      }

  }

  protected function autoDetectAdapter(){

    switch(true){
      case class_exists("Redis"):
        $this->adapter = new Phpredis($this->conf);
        break;
    }

  }


}
