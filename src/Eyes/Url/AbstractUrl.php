<?php

namespace BeholderWebClient\Eyes\Url;

use Exception;
use BeholderWebClient\Eyes\AbstractEye;
use BeholderWebClient\Eyes\Url\UrlStatus as Status;

abstract class AbstractUrl extends AbstractEye implements iUrl {

  protected $code;
  protected $message;
  protected $response;

  abstract protected function testConn();
  abstract protected function testStatusCode();

  public function getStatusCode(){
    return $this->code;
  }

  public function getMessage(){
    return $this->message;
  }

  public function look() {

    try {

      $this->getUrl();
      $this->testConn();
      $this->testStatusCode();

      $this->code = Status::OK_NUMBER;
      $this->message = Status::OK;

    } catch(Exception $ex){

      $this->code = $ex->getCode();
      $this->message = $ex->getMessage();

    }

  }

  protected function getUrl() {

    $uri = $this->conf['uri'];

    $method = strtoupper($this->conf['http']['method']);

    if (empty($method))
      $method = 'GET';

    $cu = curl_init();
    curl_setopt($cu, CURLOPT_RETURNTRANSFER, TRUE);

    switch ($method) {

      case 'DELETE':
        curl_setopt($cu, CURLOPT_CUSTOMREQUEST, 'DELETE');
        curl_setopt($cu, CURLOPT_POSTFIELDS, http_build_query($this->conf['http']['data']));
        break;

      case 'POST':
        curl_setopt($cu, CURLOPT_POST, TRUE);
        curl_setopt($cu, CURLOPT_POSTFIELDS, $this->conf['http']['data']);
        break;

      case 'PUT':
        curl_setopt($cu, CURLOPT_CUSTOMREQUEST, 'PUT');
        curl_setopt($cu, CURLOPT_POSTFIELDS, $this->conf['http']['data']);
        break;

      case 'GET':
        $uri .= '?' . http_build_query($this->conf['http']['data']);
        break;

      default :
        throw new Exception(Status::METHOD_NOT_ALLOWED . $method, Status::METHOD_NOT_ALLOWED_NUMBER);

    }

    curl_setopt($cu, CURLOPT_HTTPHEADER, $this->makeHeader($this->conf['http']['header']));
    curl_setopt($cu, CURLOPT_URL, $uri);
    curl_setopt($cu, CURLOPT_HEADER, true);
    curl_setopt($cu, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($cu, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($cu, CURLINFO_HEADER_OUT, true);


    $response = curl_exec($cu);
    $response_info = curl_getinfo($cu);
    $request_sent = curl_getinfo($cu, CURLINFO_HEADER_OUT);

    curl_close($cu);

    $this->response = [
        'response_header' => trim(substr($response, 0, $response_info['header_size'])),
        'response_body' => substr($response, $response_info['header_size']),
        'response_info' => $response_info,
        'request_sent' => $request_sent
    ];
  }

  private function makeHeader($header) {

    if(!is_array($header))
      $header = [];

    $arrHeader = [];

    foreach ($header as $name => $val) {
      $arrHeader[] = "{$name}: {$val}";
    }

    return $arrHeader;
  }

}
