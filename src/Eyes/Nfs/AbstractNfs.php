<?php

namespace BeholderWebClient\Eyes\Nfs;

use Exception;
use BeholderWebClient\Eyes\AbstractEye;
use BeholderWebClient\Eyes\Nfs\NfsStatus as Status;

abstract class AbstractNfs extends AbstractEye implements iNfs {

  protected $path;
  protected $fileName;
  protected $code;
  protected $message;

  const DEFAULT_FILE_NAME = 'beholder.txt';
  const DEFAULT_CONTENT = 'Beholder is observing it.';

  abstract protected function checkIfPathIsMounted();
  abstract protected function tryWriteFile();
  abstract protected function tryReadFile();
  abstract protected function tryDeleteFile();

  public function __construct($conf){
    parent::__construct($conf);
    $this->resolvePath();
    $this->fileName = isset($conf['filename']) ? $conf['filename'] : self::DEFAULT_FILE_NAME;
  }

  public function getStatusCode(){
    return $this->code;
  }

  public function getMessage(){
    return $this->message;
  }

  public function look() {

    try {

      $this->checkIfPathIsMounted();

      if($this->conf['write']!==false) 
        $this->tryWriteFile();

      if(!$this->conf['read']!==false)
        $this->tryReadFile();

      if(!$this->conf['delete']!==false)
        $this->tryDeleteFile();

      $this->code = Status::OK_NUMBER;
      $this->message = Status::OK;

    } catch(Exception $ex){

      $this->code = $ex->getCode();
      $this->message = $ex->getMessage();

    }

  }

  protected function resolvePath() {

    $rootDir = '';

    if (isset($this->conf['rootDir'])){
       $rootDir = $this->conf['rootDir'];
    }

    $this->path = realpath(str_replace('[rootDir]', $rootDir, $this->config['path']));

    if (!$this->path)
      throw new Exception(Status::PATH_NOT_EXIST, Status::PATH_NOT_EXIST_NUMBER);

  }

}
