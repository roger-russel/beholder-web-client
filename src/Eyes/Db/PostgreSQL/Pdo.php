<?php

namespace BeholderWebClient\Eyes\Db\PostgreSQL;

use PDO as PHPDO;
use Exception;
use BeholderWebClient\Eyes\Db\PostgreSQL\PostgreSQLStatus as Status;
use BeholderWebClient\Eyes\Db\AbstractAdapter;

class Pdo  extends AbstractAdapter {

  protected $pdo;
  protected $ran = false;

  public function checkRequirement(){

    if(!class_exists("PDO"))
      throw new Exception(parent::PREFIX_RQ_FAIL . 'PDO driver not found', Status::INTERNAL_SERVER_ERROR_NUMBER);

  }

  public function testConn(){

    try {

      $dns = "pgsql:host={$this->conf['host']};dbname={$this->conf['dbname']};port={$this->conf['port']};";
      $this->pdo = new PHPDO($dns, $this->conf['user'] , $this->conf['password'],
      [PHPDO::ATTR_ERRMODE => PHPDO::ERRMODE_EXCEPTION]);

    }catch(Exception $ex){
      parent::throwCouldNotConnect($ex->getMessage());
    }

  }

  public function testQuery(){

      if(!empty($this->conf['query']['create']))
        $this->execCreatequery('create');

      if(!empty($this->conf['query']['insert']))
        $this->execQuery('insert', Status::QUERY_INSERT_FAIL_NUMBER, Status::QUERY_INSERT_FAIL);

      if(!empty($this->conf['query']['update']))
        $this->execQuery('update', Status::QUERY_UPDATE_FAIL_NUMBER, Status::QUERY_UPDATE_FAIL);

      if(!empty($this->conf['query']['select']))
        $this->selectquery();

      if(!empty($this->conf['query']['delete']))
        $this->execQuery('delete', Status::QUERY_DELETE_FAIL_NUMBER, Status::QUERY_DELETE_FAIL);

      if(!empty($this->conf['query']['drop']))
        $this->execDropquery('drop');

      if(!$this->ran)
        parent::throwBadFormatedQuery();

  }

  protected function execQuery($type, $errNo, $errMessage){

    $this->ran = true;

    try {

      if(!is_array($this->conf['query'][$type]))
        $this->conf['query'][$type] = [$this->conf['query'][$type]];

      foreach($this->conf['query'][$type] as $sql ){

        $sth = $this->pdo->prepare($sql);
        $sth->execute();

        if($sth->rowCount() < 1)
          throw new Exception(STATUS::QUERY_INSERT_NOTHING, $errNo);

      }

    } catch(Exception $ex){
        throw new Exception("{$errMessage} - {$sql} " . $ex->getMessage(), $errNo);
    }

  }

  protected function selectquery(){

    $this->ran = true;

    try {

      if(!is_array($this->conf['query']['select']))
        $this->conf['query']['select'] = [$this->conf['query']['select']];

      foreach($this->conf['query']['select'] as $sql ) {

        $sth = $this->pdo->prepare($sql);
        $sth->execute();

        $result = $sth->fetchAll(PHPDO::FETCH_NUM);

        if(count($result) < 1)
          throw new Exception(Status::QUERY_SELECT_RETURN_NOTHING);

      }

    } catch(Exception $ex){
        throw new Exception(Status::QUERY_SELECT_FAIL . " - {$sql} " . $ex->getMessage(), Status::QUERY_SELECT_FAIL_NUMBER);
    }

  }

  protected function execCreatequery(){

    $this->ran = true;

    try {

      if(!is_array($this->conf['query']['create']))
        $this->conf['query']['create'] = [$this->conf['query']['create']];

      foreach($this->conf['query']['create'] as $sql ){
        $this->pdo->exec($sql);
      }

    } catch(Exception $ex){
        throw new Exception(Status::COULD_NOT_CREATE . " - {$sql} " . $ex->getMessage(), Status::COULD_NOT_CREATE_NUMBER);
    }

  }

  protected function execDropquery(){

    $this->ran = true;

    try {

      if(!is_array($this->conf['query']['drop']))
        $this->conf['query']['drop'] = [$this->conf['query']['drop']];

      foreach($this->conf['query']['drop'] as $sql ){
        $this->pdo->exec($sql);
      }

    } catch(Exception $ex){
        throw new Exception(Status::COULD_NOT_DROP . " - {$sql} " . $ex->getMessage(), Status::COULD_NOT_DROP_NUMBER);
    }
  }

  public function closeConnection(){
    $this->pdo = null;
  }

}
