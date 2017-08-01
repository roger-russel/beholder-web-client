<?php

namespace BeholderWebClient\Eyes\HelperDomain;

use BeholderWebClient\Eyes\Domain\Eye as OriginalEye;

class Eye extends OriginalEye {

  public function __construct($conf){
    parent::__construct($conf);

    if(!empty($conf['now']))
      $this->now = $conf['now']; // This make test possible
  }

  protected function getDomainInfo(){
    $this->domainInfo = file_get_contents(__DIR__ . '/' . $this->conf['domain'] . '.txt');
  }

}
