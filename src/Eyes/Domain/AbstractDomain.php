<?php

namespace BeholderWebClient\Eyes\Domain;

use Exception;
use BeholderWebClient\Eyes\AbstractEye;
use BeholderWebClient\Eyes\Domain\DomainStatus as Status;

abstract class AbstractDomain extends AbstractEye implements iDomain {

  protected $code;
  protected $message;
  protected $domainInfo;
  protected $now;

  const DEFAULT_STATUS = 'published';

  abstract protected function checkStatusCode();
  abstract protected function checkExpireDate();
  abstract protected function getDomainInfo();

  public function __construct($conf){
    parent::__construct($conf);
    $this->now = strtotime('now'); // This make test possible
  }

  public function getStatusCode(){
    return $this->code;
  }

  public function getMessage(){
    return $this->message;
  }

  public function look() {

    try {

      $this->getDomainInfo();

      $this->checkStatusCode();

      if(!empty($this->conf['expire']) and $this->conf['expire'] > 0)
        $this->checkExpireDate();

      $this->code = Status::OK_NUMBER;
      $this->message = Status::OK;

    } catch(Exception $ex){

      $this->code = $ex->getCode();
      $this->message = $ex->getMessage();

    }

  }

}
