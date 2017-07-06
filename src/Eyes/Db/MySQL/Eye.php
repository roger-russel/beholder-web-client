<?php

namespace BeholderWebClient\Eyes\Db\MySQL;

use Exception;
use BeholderWebClient\Eyes\Status as Status;
use BeholderWebClient\Eyes\Db\AbstractDb;

Class Eye extends AbstractDb {

  protected $mysqli;

  public function testConn(){

    switch($this->conf['drive']){
      case 'mysqli':
      case 'mysql':
        $this->conn_mysqli();
        break;
      case 'pdo':
      default:
        $this->conn_pdo();

    }

  }

  protected function conn_mysqli(){
    $this->mysqli = new mysqli($this->conf['host'], $this->conf['user'] , $this->conf['password']);
    if($this->mysqli->connect_errno)
      throw new Exception('mysqli: ' . $this->mysqli->connect_error, $this->mysqli->connect_errno );
  }

  public function testQuery(){

  }

}
