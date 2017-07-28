<?php

namespace BeholderWebClient\Eyes\HelperDomain;

use BeholderWebClient\Eyes\Domain\Eye as OriginalEye;

class Eye extends OriginalEye {

  protected function getDomainInfo(){
    $this->domainInfo = file_get_contents(__DIR__ . '/' . $this->conf['domain']);
  }

}
