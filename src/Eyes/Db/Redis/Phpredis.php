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

    $dns = $this->conf['host'] . ':' . $this->conf['port'];

    try {

      $this->redis = new Redis();
      $conn = $this->redis->connect($this->conf['host'], 6379);

      if(!$conn)
        parent::throwCouldNotConnect();
        
    }catch(Exception $ex){
      parent::throwCouldNotConnect($ex->getMessage());
    }
  }

  public function testQuery(){

    $mergedArrQuery = $this->getMergedArrayQuery();

    $result = false;

    foreach( $mergedArrQuery as $arrQuery ){
      foreach( $arrQuery['query'] as $query ) {

          $result = mysql_query($query);

          if(!$result){
            throw new Exception($arrQuery['errMessage'] . ' - ' . $query, $arrQuery['errNo']);
          }
      }
    }

    if(!$result)
      parent::throwBadFormatedQuery();

  }

  public function closeConnection(){
    $this->redis = null;
  }


}
