<?php

namespace BeholderWebClient\Eyes\Db\MySQL;

use Exception;
use BeholderWebClient\Eyes\Db\DbStatus as Status;

class Mysqli extends AbstractAdapter {

  public function checkRequirement(){

    if(!class_exists("mysqli"))
      throw new Exception(parent::PREFIX_RQ_FAIL . 'Mysqli driver not found', Status::internalServerError_number);

  }

  public function testConn(){



  }

  public function testQuery(){



  }

}
