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

   if( $p === $f )
     throw new Exception(Status::NOT_MOUNTED, Status::NOT_MOUNTED_NUMBER);

  }

  protected function tryWriteFile(){

    try {

      $this->date = date('Y-m-d H:i:s');

      $link = fopen($this->fullFileName,'a+');
      fwrite($link, $this->date . PHP_EOL);
      fclose($link);

    } catch(Exception $ex){

      throw new Exception(Status::COULD_NOT_WRITE_FILE . ' - ' . $ex->getMessage(), Status::COULD_NOT_WRITE_FILE_NUMBER, $ex);

    }

  }

  protected function tryReadFile(){

    try {

      $link = fopen($this->fullFileName,'r');
      fclose($link);

    } catch(Exception $ex){

      throw new Exception(Status::COULD_NOT_READ_FILE . ' - ' . $ex->getMessage(), Status::COULD_NOT_READ_FILE_NUMBER, $ex);

    }


  }

  protected function tryDeleteFile(){

    try {

      unlink($this->fullFileName);

    } catch(Exception $ex){

      throw new Exception(Status::COULD_NOT_DELETE_FILE . ' - ' . $ex->getMessage(), Status::COULD_NOT_DELETE_FILE_NUMBER, $ex);

    }

  }

}
