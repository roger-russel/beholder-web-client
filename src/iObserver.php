<?php

namespace BeholderWebClient;

interface iObserver {

  public function run();
  public function runnit($name, $conf);
  public function setConf($conf);
  public function writeJson();
  public function getResult();

}
