<?php

namespace BeholderWebClient\Eyes\Db\MySQL;

use PDO as PHPDO;
use Exception;
use BeholderWebClient\Eyes\Db\MySQL\MySQLStatus as Status;
use BeholderWebClient\Eyes\Db\AbstractPdo;

class Pdo  extends AbstractPdo {

  protected $pdo;
  protected $ran = false;

  public function checkRequirement(){

    if(!class_exists("PDO"))
      throw new Exception(parent::PREFIX_RQ_FAIL . 'PDO driver not found', Status::INTERNAL_SERVER_ERROR_NUMBER);

  }

  public function testConn(){

    try {

      $dns = "mysql:host={$this->conf['host']};dbname={$this->conf['dbname']};port={$this->conf['port']};";
      $this->pdo = new PHPDO($dns, $this->conf['user'] , $this->conf['password'],
      [PHPDO::ATTR_ERRMODE => PHPDO::ERRMODE_EXCEPTION]);

    }catch(Exception $ex){
      parent::throwCouldNotConnect($ex->getMessage());
    }

  }

}
