<?php

namespace BeholderWebClient\Eyes\Url;

use Exception;
use BeholderWebClient\Eyes\Url\UrlStatus as Status;

Class Eye extends AbstractUrl {

  public function checkRequirement(){

    if(!is_function('curl_init'))
      throw new Exception(Status::REQUERIMENT_FAIL, Status::INTERNAL_SERVER_ERROR_NUMBER);

  }

  protected function testStatusCode() {

    $http_code = $this->response['response_info']['http_code'];
    $expected = isset($this->conf['http_code']) ? (int) $this->conf['http_code'] : 200;

    if ($http_code !== $expected) {
      throw new Exception(Status::STATUS_CODE_WAS_NOT_EXPECTED  . $http_code . ' instead of ' . $expected, Status::STATUS_CODE_WAS_NOT_EXPECTED_NUMBER);
    }

  }

  protected function testConn) {

    if (empty($this->response['response_header']))
      throw new Exception(Status::COULD_NOT_CONNECT . this->conf['uri'], Status::COULD_NOT_CONNECT_NUMBER);

  }

}
