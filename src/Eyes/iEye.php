<?php

namespace BeholderWebClient\Eyes;

interface iEye {
  public function checkRequirement();
  public function look();
  public function getStatusCode();
  public function getMessage();
}
