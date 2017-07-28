<?php

namespace BeholderWebClient\Eyes\Domain;

use Exception;
use BeholderWebClient\Eyes\Domain\DomainStatus as Status;

Class Eye extends AbstractDomain {

  public function checkRequirement(){

    $result = exec('type -P whois');

    if(!$result OR $result == 'whois: not found')
      throw new Exception(Status::REQUERIMENT_FAIL, Status::INTERNAL_SERVER_ERROR_NUMBER);

    if(empty($this->conf['domain']))
      throw new Exception(Status::EXPECTATION_FAILED, Status::EXPECTATION_FAILED_NUMBER);
  }

  protected function getDomainInfo(){
    $cmd = 'whois ';
    $this->domainInfo = shell_exec($cmd . $this->conf['domain']);
  }

  protected function checkStatusCode() {

    $m = [];
    $r = preg_match('/^status: (.*?)$/', $this->domainInfo ,$m);

    if($r === 0){

      if( preg_match('/(No match for|is not registered)/', $this->domainInfo))
        throw new Exception(Status::NO_MATCH, Status::EXPECTATION_FAILED_NUMBER);

      if( preg_match('/release process/', $this->domainInfo))
        throw new Exception(Status::RELEASE_PROCESS, Status::RELEASE_PROCESS_NUMBER);

    } else {

      $status = $m[1];

      if(!empty($this->conf['status']) and $status !== strtolower($this->conf['status']))
        throw new Exception(Status::UNEXPECTED_STATUS . $status, Status::UNEXPECTED_STATUS_NUMBER);

      if(empty($this->conf['status']) and $status !== self::DEFAULT_STATUS )
        throw new Exception(Status::UNEXPECTED_STATUS . $status, Status::UNEXPECTED_STATUS_NUMBER);

    }

  }

  protected function checkExpireDate() {



  }
}
