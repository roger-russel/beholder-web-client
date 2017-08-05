<?php

namespace BeholderWebClient\Eyes\Db\MongoDb;

use Exception;
use BeholderWebClient\Eyes\Db\MongoDb\MongoDbStatus as Status;
use BeholderWebClient\Eyes\Db\AbstractDb;
use MongoDB\Driver\Manager as MoManager;

Class Eye extends AbstractDb {

  const DEFAULT_PORT = 27017;

  protected $adapter;
  protected function selectAdapter($adapter){}
  protected function autoDetectAdapter(){}

  public function checkRequirement(){

    if(!class_exists('MongoDB\Driver\Manager'))
      throw new Exception(Status::NO_DRIVER, Status::INTERNAL_SERVER_ERROR_NUMBER);

  }

  protected function getDefaultPort() {
    return self::DEFAULT_PORT;
  }

  public function testConn() {
    try {

      $port = empty($this->conf['port']) ? self::DEFAULT_PORT : $this->conf['port'];

      $this->manager = new MoManager('mongodb://' . $this->conf['host'] . ':' . $port); // connect to a remote host (default port: 27017)
  
      if(empty($this->manager->request_id))
        throw new Exception(Status::COULD_NOT_CONNECT_TO_SGBD, Status::COULD_NOT_CONNECT_TO_SGBD_NUMBER);

    }catch(Exception $ex){
      throw new Exception(Status::COULD_NOT_CONNECT_TO_SGBD . ' - ' . $ex->getMessage(), Status::COULD_NOT_CONNECT_TO_SGBD_NUMBER, $ex);
    }
  }

  public function testQuery(){

  }

}
