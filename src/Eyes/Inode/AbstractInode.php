<?php

namespace BeholderWebClient\Eyes\Inode;

use Exception;
use BeholderWebClient\Eyes\AbstractEye;

abstract class AbstractInode extends AbstractEye implements iInode {

  protected $code;
  protected $message;

  public function getStatusCode(){
    return $this->code;
  }

  public function getMessage(){
    return $this->message;
  }

  public function look() {

    try {

      $this->checkRequirement();
      $this->checkParamtersGiven();
      $this->verifyStorage();

      $this->code = Status::OK_NUMBER;
      $this->message = Status::OK;

    } catch(Exception $ex){

      $this->code = $ex->getCode();
      $this->message = $ex->getMessage();

    }

  }

  protected function checkParamtersGiven(){
    //$this->conf['storage_path'] = '/storage';
    //$this->conf['acceptable_percents_usage'] = 70;
  }

}
