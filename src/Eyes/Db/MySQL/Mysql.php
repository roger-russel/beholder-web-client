<?php

namespace BeholderWebClient\Eyes\Db\MySQL;

use Exception;
use BeholderWebClient\Eyes\Db\DbStatus as Status;

class Mysql extends AbstractAdapter {

  protected $conn;

  public function checkRequirement(){

    if(!function_exists("mysql_connect"))
      throw new Exception('Mysql driver not found', Status::INTERNAL_SERVER_ERROR_NUMBER);

  }

  public function testConn(){

    $dns = $this->conf['host'] . ':' . $this->conf['port'];

    $this->conn = \mysql_connect($dns, $this->conf['user'], $this->conf['password']);

    if(!$this->conn)
      parent::throwCouldNotConnect();

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
      parent::throwQueryBadFormated();

  }

  public function closeConnection(){
    mysql_close($this->conn);
  }


}
