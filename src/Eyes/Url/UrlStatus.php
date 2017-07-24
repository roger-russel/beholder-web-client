<?php

namespace BeholderWebClient\Eyes\Url;

use BeholderWebClient\Eyes\Status;

class UrlStatus extends Status {

  const REQUERIMENT_FAIL = 'REQUERIMENT FAIL: php lib curl is not installed.';

  const COULD_NOT_CONNECT = 'Could not connect to url: ';
  const COULD_NOT_CONNECT_NUMBER = 600;

  const STATUS_CODE_WAS_NOT_EXPECTED = 'The returned status code was not the expected, received: ';
  const STATUS_CODE_WAS_NOT_EXPECTED_NUMBER = 601;

  const METHOD_NOT_ALLOWED = 'Method is not allowed: ';
  const METHOD_NOT_ALLOWED_NUMBER = 602;

}
