<?php

namespace BeholderWebClient\Eyes\Db\MySQL;

use Exception;
use PDO;
use mysqli;
use BeholderWebClient\Eyes\Status as Status;
use BeholderWebClient\Eyes\Db\AbstractDb;

Class Eye extends AbstractDb {

  protected $mysqli;
  const port = 3306;

  public function testConn(){

    switch(strtolower($this->conf['drive'])){
      case 'mysqli':
      case 'mysql':
        $this->mysqli_conn();
        break;
      case 'pdo':
      default:
        $this->conn_pdo();

    }

  }

  protected function mysqli_conn(){

    $this->mysqli = new mysqli($this->conf['host'], $this->conf['user'] , $this->conf['password']);

    if($this->mysqli->connect_errno)
      throw new Exception('mysqli: ' . $this->mysqli->connect_error, $this->mysqli->connect_errno );

  }

  protected function conn_pdo(){
    $port = isset($this->conf['port']) ? $this->conf['port'] : self::port;
    $dns = "mysql:host={$this->conf['host']};dbname={$this->conf['dbname']};port={$port};";
    $this->pdo = new PDO($dns, $this->conf['user'] , $this->conf['password']);
  }

  public function testQuery(){

    switch(strtolower($this->conf['drive'])){
      case 'mysqli':
      case 'mysql':
        $this->mysqli_testQuery();
        break;
      case 'pdo':
      default:
        $this->pdo_testQuery();
    }

  }

  protected function mysqli_testQuery(){

  }

  protected function pdo_testQuery(){

  }

}
