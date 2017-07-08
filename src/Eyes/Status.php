<?php

namespace BeholderWebClient\Eyes;

/**
 * Yep, they are http status codes
 */
class Status {

  const ok = 'Ok';
  const ok_number = 200;

  const notFound = 'Not Found';
  const notFound_number = 400;

  const expectationFailed = 'Expectation Failed';
  const expectationFailed_number = 417;

  const internalServerError = 'Internal Server Error';
  const internalServerError_number = 500;

  const notImplemented = 'Not Implemented';
  const notImplemented_number = 501;

  //numbers 6[0-9]{2} are reseverd to DBs usage;

}
