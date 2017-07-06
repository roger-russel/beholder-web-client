<?php

namespace BeholderWebClient\Eyes;

abstract class AbstractEye implements iEye {
  
  protected $conf;

  public function __construct($conf){
    $this->conf = $conf;
  }

}
