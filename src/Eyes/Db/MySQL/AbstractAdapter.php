<?php

namespace BeholderWebClient\Eyes\Db\MySQL;

Abstract class AbstractAdapter implements iAdapter {
  
  public function __construct($conf){
    $this->conf = $conf;
  }

}
