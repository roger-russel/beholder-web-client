<?php

namespace BeholderWebClient\Eyes\Nfs;

use Exception;
use BeholderWebClient\Eyes\Nfs\NfsStatus as Status;

Class Eye extends AbstractNfs {

  public function checkRequirement(){

    $result = exec('type -P stat');

    if(!$result)
      throw new Exception(Status::REQUERIMENT_FAIL, Status::REQUERIMENT_FAIL_NUMBER);

  }

  protected function checkIfPathIsMounted() {

   $cmd = 'stat -fc%t:%T ';

   $pathFather = realpath($this->path . '/../');

   $p = shell_exec($cmd . $this->path);
   $f = shell_exec($cmd . $pathFather);

   return $p === $f ? false: true;
  }

  protected function tryWriteFile(){

    $this->date = date('Y-m-d H:i:s');

    $link = fopen($this->path . '/beholder.txt','a+');
    fwrite($link, $this->date);
    fclose($link);

  }

  protected function tryReadFile(){



  }

  protected function tryDeleteFile(){

  }

}
