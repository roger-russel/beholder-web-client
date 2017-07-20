<?php

namespace BeholderWebClient\Eyes\Url;

use BeholderWebClient\Eyes\Status;

class UrlStatus extends Status {

  const COULD_NOT_CONNECT = 'Could not connect';
  const COULD_NOT_CONNECT_NUMBER = 600;

  const COULD_NOT_CONNECT_URL = 'Could not connect to url: ';
  const COULD_NOT_CONNECT_URL_NUMBER = 601;

  const STATUS_CODE_WAS_NOT_EXPECTED = 'The status code returned was not the expected';
  const STATUS_CODE_WAS_NOT_EXPECTED_NUMBER = 602;

  const EXPECTED_AS = 'It expected a status code 200, but return: ';
  const EXPECTED_AS_NUMBER = 603;

}
