<?php

namespace BeholderWebClient\Eyes\Db\MongoDb;

use Exception;
use BeholderWebClient\Eyes\Db\PostgreSQL\PostgreSQLStatus as Status;
use BeholderWebClient\Eyes\Db\AbstractDb;

Class Eye extends AbstractDb {

  const DEFAULT_PORT = 27017;

  public function checkRequirement(){

    if(!class_exists('MongoDB\Driver\Manager'))
      throw new Exception(Status::NO_DRIVER, Status::INTERNAL_SERVER_ERROR);

  }

  protected function getDefaultPort(){
    return self::DEFAULT_PORT;
  }

  public function testConn(){

  }

  public function testQuery(){

  }

}
