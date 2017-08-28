<?php

use BeholderWebClient\Observer;

require_once '/var/www/vendor/autoload.php';

class HelperObserver  extends Observer {

  public function getImportanceAlias(){
    return $this->importanceAlias;
  }

  public function getImportanceDefault(){
    return $this->importanceDefault;
  }

  public function getTimeZone(){
    return $this->timezone;
  }

  public function getConf(){
    return $this->conf;
  }

}
