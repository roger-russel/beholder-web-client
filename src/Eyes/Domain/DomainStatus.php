<?php

namespace BeholderWebClient\Eyes\Domain;

use BeholderWebClient\Eyes\Status;

class DomainStatus extends Status {

  const REQUERIMENT_FAIL = 'REQUERIMENT FAIL: whois command not found, it was checked with the command "type -P whois"';
  const NO_MATCH = 'Domain not found'; // error 417 Expectaion fail

  const UNEXPECTED_STATUS = 'The status was not the expected: ';
  const UNEXPECTED_STATUS_NUMBER = 600;

  const RELEASE_PROCESS = 'Domain on release process';
  const RELEASE_PROCESS_NUMBER = 601;

  const UNKNOWN_EXPIRE_DATE = 'Unknown expire date, unfortunately this resource will work only with RegistroBR domains.';

  const CLOSE_TO_EXPIRE = 'Domain is close to expire.';
  const CLOSE_TO_EXPIRE_NUMBER = 603;

}
