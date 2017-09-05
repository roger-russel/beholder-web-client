<?php

namespace BeholderWebClient\Eyes\Db\Redis;

use Redis;
use Exception;
use BeholderWebClient\Eyes\Db\Redis\RedisStatus as Status;
use BeholderWebClient\Eyes\Db\AbstractAdapter;

class Phpredis extends AbstractAdapter {

  protected $redis;

  public function checkRequirement(){

    if(!class_exists("Redis"))
      throw new Exception(Status::NO_DRIVER, Status::INTERNAL_SERVER_ERROR_NUMBER);

  }

  public function testConn(){

    try {

      $this->redis = new Redis();
      $conn = $this->redis->connect($this->conf['host'], $this->conf['port']);

      if(!$conn)
        parent::throwCouldNotConnect();

    }catch(Exception $ex){
      parent::throwCouldNotConnect($ex->getMessage());
    }
  }

  public function testQuery(){

    throw new Exception(Status::NOT_IMPLEMENTED, Status::NOT_IMPLEMENTED_NUMBER);
    
  }

  public function closeConnection(){
    $this->redis = null;
  }


}
