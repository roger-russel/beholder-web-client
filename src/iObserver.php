<?php

namespace BeholderWebClient;

interface iObserver {

  public function run();
  public function runnit($name, $conf);

}
