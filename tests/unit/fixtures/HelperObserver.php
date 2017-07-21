<?php

use BeholderWebClient\Observer;

require_once '/var/www/vendor/autoload.php';

class HelperObserver  extends Observer {

  public function getImportanceAlias(){
    return $this->importance_alias;
  }

  public function getImportanceDefault(){
    return $this->importance_default;
  }

  public function getTimeZone(){
    return $this->timezone;
  }

}
