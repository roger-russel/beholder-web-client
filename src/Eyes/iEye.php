<?php

namespace BeholderWebClient\Eyes;

interface iEye {
  public function look();
  public function getStatusCode();
  public function getMessage();
}
