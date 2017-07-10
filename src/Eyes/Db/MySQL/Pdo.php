<?php

namespace BeholderWebClient\Eyes\Db\MySQL;

use PDO as PHPDO;
use Exception;
use BeholderWebClient\Eyes\Db\DbStatus as Status;

class Pdo  extends AbstractAdapter {

  protected $pdo;
  protected $ran = false;

  public function checkRequirement(){

    if(!class_exists("PDO"))
      throw new Exception(parent::PREFIX_RQ_FAIL . 'PDO driver not found', Status::internalServerError_number);

  }

  public function testConn(){

    try {

      $dns = "mysql:host={$this->conf['host']};dbname={$this->conf['dbname']};port={$this->conf['port']};";
      $this->pdo = new PHPDO($dns, $this->conf['user'] , $this->conf['password'],
      [PHPDO::ATTR_ERRMODE => PHPDO::ERRMODE_EXCEPTION]);

    }catch(Exception $ex){
      parent::throwCouldNotConnect($ex->getMessage());
    }

  }

  public function testQuery(){

      if(isset($this->conf['query']['create']))
        $this->execCreatequery('create');

      if(isset($this->conf['query']['insert']))
        $this->execquery('insert', Status::queryInsertFail_number, Status::queryInsertFail);

      if(isset($this->conf['query']['update']))
        $this->execquery('update', Status::queryUpdateFail_number, Status::queryUpdateFail);

      if(isset($this->conf['query']['select']))
        $this->selectquery();

      if(isset($this->conf['query']['delete']))
        $this->execquery('delete', Status::queryDeleteFail_number, Status::queryDeleteFail);

      if(isset($this->conf['query']['drop']))
        $this->execDropquery('drop');

      if(!$this->ran)
        parent::throwQueryBadFormated();

  }

  protected function execquery($type, $errNo, $errMessage){

    $this->ran = true;

    foreach($this->conf['query'][$type] as $sql ){

      $sth = $this->pdo->prepare($sql);
      $sth->execute();

      if($sth->rowCount() < 1)
        throw new Exception($errMessage . " - {$sql}", $errNo);

    }

  }

  protected function selectquery(){

    $this->ran = true;

    foreach($this->conf['query']['select'] as $sql ) {

      $sth = $this->pdo->prepare($sql);
      $sth->execute();

      $result = $sth->fetch(PHPDO::FETCH_NUM);

      if(count($result) < 1)
        throw new Exception(Status::querySelectFail_number, Status::querySelectFail);
      

    }

  }

  protected function execCreatequery(){

    $this->ran = true;

    try {

      foreach($this->conf['query']['create'] as $sql ){
        $this->pdo->exec($sql);
      }

    } catch(Exception $ex){
        throw new Exception(Status::couldNotCreateTable . " - {$sql} " . $ex->getMessage(), Status::couldNotCreateTable_number);
    }

  }

  protected function execDropquery(){

    $this->ran = true;

    try {

      foreach($this->conf['query']['drop'] as $sql ){
        $this->pdo->exec($sql);
      }

    } catch(Exception $ex){
        throw new Exception(Status::couldNotDropTable . " - {$sql} " . $ex->getMessage(), Status::couldNotDropTable_number);
    }
  }

}
