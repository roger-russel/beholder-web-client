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
    $result = shell_exec('df -i');
    $m = [];

    $path = $this->scapeBar($this->conf['storage_path']);

    $regx = "/^.*?([\d]+%)[\s]+{$path}$/m";

    preg_match($regx, $result, $m);

    if(!isset($m[1]))
      throw new Exception(
        Status::STORAGE_PATH_NOT_FOUND . ' ' . $this->conf['storage_path'],
        Status::EXPECTATION_FAILED_NUMBER
      );

    $inodes_usage = (int)$m[1];

    if( $inodes_usage > (int)$this->conf['acceptable_percents_usage'])
      throw new Exception(Status::MAX_USAGE_ALLOWED, STATUS::MAX_USAGE_ALLOWED_NUMBER);

  }

  protected function scapeBar($string){
    return str_replace('/','\/', $string);
  }

}
