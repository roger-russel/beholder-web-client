<?php

namespace BeholderWebClient\Eyes\Nfs;

use Exception;
use BeholderWebClient\Eyes\Nfs\NfsStatus as Status;

Class Eye extends AbstractNfs {

  const NOT_MOUNTED_STRING = 'is not a mountpoint';

  public function checkRequirement(){

    $result = exec('type -P mountpoint');

    if(!$result)
      throw new Exception(Status::REQUERIMENT_FAIL, Status::INTERNAL_SERVER_ERROR_NUMBER);

  }

  protected function checkIfPathIsMounted() {

   $cmd = 'mountpoint ';

   $return = shell_exec($cmd . $this->path);

   if( $return !== false )
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
