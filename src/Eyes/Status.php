<?php

namespace BeholderWebClient\Eyes;

/**
 * Yep, they are http status codes
 */
class Status {

  const OK = 'Ok';
  const OK_NUMBER = 200;

  const NOT_FOUND = 'Not Found';
  const NOT_FOUND_NUMBER = 400;

  const EXPECTATION_FAILED = 'Expectation Failed';
  const EXPECTATION_FAILED_NUMBER = 417;

  const INTERNAL_SERVER_ERROR = 'Internal Server Error';
  const INTERNAL_SERVER_ERROR_NUMBER = 500;

  const NOT_IMPLEMENTED = 'Not Implemented';
  const NOT_IMPLEMENTED_NUMBER = 501;

}
