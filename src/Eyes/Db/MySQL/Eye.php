<?php

namespace BeholderWebClient\Eyes\Db\MySQL;

use Exception;
use BeholderWebClient\Eyes\Db\DbStatus as Status;
use BeholderWebClient\Eyes\Db\AbstractDb;

Class Eye extends AbstractDb {

  protected $adapter;

  const default_port = 3306;

  public function __construct($conf){
    parent::__construct($conf);

    if(isset($this->conf['driver'])){
      $this->selectAdapter($this->conf['driver']);
    }else{
      $this->selectAdapterAuto();
    }

  }

  public function checkRequirement(){

    if(is_null($this->adapter))
      throw new Exception(Status::NO_DRIVER, Status::INTERNAL_SERVER_ERROR);

    $this->adapter->checkRequirement();

  }

  protected function getDefaultPort(){
    return self::default_port;
  }

  public function testConn(){

    try {

      $this->adapter->testConn();

    } catch(Exception $ex) {
      $this->code = $ex->getCode();
      $this->message = $ex->getMessage();
    }

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

  protected function selectAdapterAuto(){

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
