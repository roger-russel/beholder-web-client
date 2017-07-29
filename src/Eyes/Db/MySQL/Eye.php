<?php

namespace BeholderWebClient\Eyes\Db\MySQL;

use Exception;
use BeholderWebClient\Eyes\Db\MySQL\MySQLStatus as Status;
use BeholderWebClient\Eyes\Db\AbstractDb;

Class Eye extends AbstractDb {

  protected $adapter;

  const DEFAULT_PORT = 3306;

  public function checkRequirement(){

    if(is_null($this->adapter))
      throw new Exception(Status::NO_DRIVER, Status::INTERNAL_SERVER_ERROR);

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

      $adapterFullName = "\BeholderWebClient\Eyes\Db\MySQL\\{$adapterName}";

      if(class_exists($adapterFullName)){

        $this->adapter = new ${'adapterFullName'}($this->conf);

      } else {
        throw new Exception("Driver: {$adapter}, is not implemented", Status::INTERNAL_SERVER_ERROR);
      }

  }

  protected function autoDetectAdapter(){

    switch(true){
      case class_exists("PDO"):
        $this->adapter = new Pdo($this->conf);
        break;
      case class_exists("mysqli"):
        $this->adapter = new Mysqli($this->conf);
        break;
      case function_exists("mysql_connect"):
        $this->adapter = new Mysql($this->conf);
        break;
    }

  }


}
