<?php

namespace BeholderWebClient\Eyes\Inode;

use Exception;

Class Eye extends AbstractInode {

  public function checkRequirement(){

    $result = exec('type -P df');

    if(!$result)
      throw new Exception(Status::REQUERIMENT_FAIL, Status::INTERNAL_SERVER_ERROR_NUMBER);

  }

  public function verifyStorage(){
    $result = exec('df -i');
    $m = [];

    $regx = "/^.*?([\d]+%)[\s]+{$this->conf['storage_path']}\$/";
    preg_match($regx, $result, $m);

    $inodes_usage = (int)$m[1];

    if( $inodes_usage > $this->conf['acceptable_percents_usage'])
      throw new Exception(Status::MAX_USAGE_ALLOWED, STATUS::MAX_USAGE_ALLOWED_NUMBER);

  }

}
