<?php

namespace BeholderWebClient\Eyes\Domain;

use BeholderWebClient\Eyes\Status;

class DomainStatus extends Status {

  const REQUERIMENT_FAIL = 'REQUERIMENT FAIL: whois command not found with type -P whois';

  const NO_MATCH = 'Domain not found'; // error 417 Expectaion fail

  const UNEXPECTED_STATUS = 'The status was not the expected: ';
  const UNEXPECTED_STATUS_NUMBER = 600;

  const RELEASE_PROCESS = 'Domain on realease process';
  const RELEASE_PROCESS_NUMBER = 601;
  
}
