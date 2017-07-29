<?php

namespace BeholderWebClient\Eyes\Db\MySQL;

use Exception;
use BeholderWebClient\Eyes\Db\MySQL\MySQLStatus as Status;
use BeholderWebClient\Eyes\Db\AbstractAdapter;

class Mysqli extends AbstractAdapter {

  protected function $mysqli;

  public function checkRequirement(){

    if(!class_exists("mysqli"))
      throw new Exception(parent::PREFIX_RQ_FAIL . 'Mysqli driver not found', Status::INTERNAL_SERVER_ERROR_NUMBER);

  }

  public function testConn(){

      $this->mysqli = new mysqli($this->conf['host'], $this->conf['user'] , $this->conf['password']);

      if($this->mysqli->connect_errno)
        throw new Exception('mysqli: ' . $this->mysqli->connect_error, $this->mysqli->connect_errno );

  }

  public function testQuery(){

    $mergedArrQuery = $this->getMergedArrayQuery();

    $result = false;

    foreach( $mergedArrQuery as $arrQuery ){
      foreach( $arrQuery['query'] as $query ) {

          $result = $this->mysqli->query($query);

          if( $result !== false and $result !== true )
            $result->close();

          if($this->mysqli->error)
            throw new Exception($arrQuery['errMessage'] . ' - ' . $query, $arrQuery['errNo']);

      }
    }

    if(!$result)
      parent::throwBadFormatedQuery();

  }

  public function closeConnection(){
    $this->mysqli->close();
  }

}
