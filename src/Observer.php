<?php

namespace BeholderWebClient;

Class Observer implements iObserver {

  protected $conf;

  protected $response;
  protected $env;
  protected $start;

  protected $importance_alias;
  protected $importance_default;

  protected $timezone;

  const IMPORTANCE_ALIAS = 'importance';
  const IMPORTANCE_DEFAULT = 'regular';
  const TIMEZONE_DEFAULT = 'America/Sao_Paulo';

  public function __construct($conf){

    $this->start = microtime();

    $this->conf = $conf;

    $this->applySettings();

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

    $this->response['info']['runtime'] = $this->microtime_diff($this->start);

  }

  public function runnit($name, $conf){

    try {

      $fullmodulename = "BeholderWebClient\\Eyes\\{$conf['type']}\\Eye";
      $eye = new ${'fullmodulename'}($this->conf['eyes'][$name]);
      $eye->checkRequirement();
      $eye->look();

      $return = [
        'status' => $eye->getStatusCode(),
        'message' => $eye->getMessage(),
        $this->importance_alias => empty($conf['importance'])? $this->importance_default : $conf['importance']
      ];

    } catch (Exception $ex){

      $return = [
          'status' => 500,
          'message' => $ex->getMessage(),
          $this->importance_alias => empty($conf['importance'])? $this->importance_default : $conf['importance']
      ];

    }

    return $return;

  }

  protected function applySettings(){

    if(!isset($this->conf['settings']))
      $this->conf['settings'] = [];

    $this->applyTimeZone();
    $this->applyImportanceAlias();
    $this->applyImportanceDefault();

  }

  protected function applyTimeZone(){

    if(empty($this->conf['settings']['timezone'])){
      $this->timezone = self::TIMEZONE_DEFAULT;
    } else {
      $this->timezone = $this->conf['settings']['timezone'];
    }

    date_default_timezone_set($this->timezone);

  }

  protected function applyImportanceAlias(){
    if(empty($this->conf['settings']['importance_alias'])){
      $this->importance_alias = self::IMPORTANCE_ALIAS;
    } else {
      $this->importance_alias = $this->conf['settings']['importance_alias'];
    }
  }

  protected function applyImportanceDefault(){
    if(empty($this->conf['settings']['importance_default'])){
      $this->importance_default = self::IMPORTANCE_DEFAULT;
    } else {
      $this->importance_default = $this->conf['settings']['importance_default'];
    }
  }

  public function writeJson(){
    header('Content-Type: application/json');
    echo json_encode($this->response);
  }

  public function getResult(){
    return $this->response;
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
