<?php

namespace BeholderWebClient;

Class Observer implements iObserver {

  protected $conf;
  protected $response;
  protected $env;
  protected $start;

  public function __construct($conf){

    $conf['timezone'] = $conf['timezone'] ? $conf['timezone'] : 'America/Sao_Paulo';

    date_default_timezone_set($conf['timezone']);

    $this->start = microtime();

    $this->conf = $conf;
    $this->response['info'] = [
      'startat' => date('Y-m-d H:i:s'),
      'runtime' => null
    ];
  }

  public function run(){

    foreach($this->conf['eyes'] as $name => $conf ) {

      if(isset($this->response[$name]))
        throw new Exception("Monitor Name: {$name}, already in use, please change the name", 1);

      $this->response[$name] = $this->runnit($name, $conf);

    }

    $this->writeJson();

  }

  public function runnit($name, $conf){

    try {

      $fullmodulename = "BeholderWebClient\\Eyes\\{$conf['type']}\\Eye";
      $eye = new ${'fullmodulename'}($this->conf['eyes'][$name]);
      $eye->look();

      $return = [
        'status' => $eye->getStatusCode(),
        'message' => $eye->getMessage()
      ];

    } catch (Exception $e){

      $return = [
          'status' => 500,
          'message' => $e->getMessage()
      ];

    }

    return $return;

  }

  protected function writeJson(){

    header('Content-Type: application/json');

    $this->response['info']['runtime'] = $this->microtime_diff($this->start);

    echo json_encode($this->response);

  }

  protected function microtime_diff($start, $end = null) {

  	if (!$end) {
  		$end = microtime();
  	}

  	list($start_usec, $start_sec) = explode(" ", $start);
  	list($end_usec, $end_sec) = explode(" ", $end);
  	$diff_sec = intval($end_sec) - intval($start_sec);
  	$diff_usec = floatval($end_usec) - floatval($start_usec);
  	return floatval($diff_sec) + $diff_usec;

}

}
