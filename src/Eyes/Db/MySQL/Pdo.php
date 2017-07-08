<?php

namespace BeholderWebClient\Eyes\Db\MySQL;

use PDO as PHPDO;
use Exception;
use BeholderWebClient\Eyes\Db\DbStatus as Status;

class Pdo  extends AbstractAdapter {

  protected $pdo;
  protected $ran = false;

  public function testConn(){

    try {

      $dns = "mysql:host={$this->conf['host']};dbname={$this->conf['dbname']};port={$port};";
      $this->pdo = new PHPDO($dns, $this->conf['user'] , $this->conf['password'],
      [PHPDO::ATTR_ERRMODE => PHPDO::ERRMODE_EXCEPTION]);

    }catch(Exception $ex){
      throw new Exception(Status::couldNotConnectAtSGBD . ' - ' . $ex->getMessage(), Status::couldNotConnectAtSGBD_number, $ex);
    }

  }

  public function testQuery(){

      if(isset($this->conf['querys']['create']))
        $this->execCreateQuerys('create');

      if(isset($this->conf['querys']['insert']))
        $this->execQuerys('insert', Status::queryInsertFail_number, Status::queryInsertFail);

      if(isset($this->conf['querys']['update']))
        $this->execQuerys('update', Status::queryUpdateFail_number, Status::queryUpdateFail);

      if(isset($this->conf['querys']['select']))
        $this->selectQuerys();

      if(isset($this->conf['querys']['delete']))
        $this->execQuerys('delete', Status::queryDeleteFail_number, Status::queryDeleteFail);

      if(isset($this->conf['querys']['drop']))
        $this->execDropQuerys('drop');

      if(!$this->ran){
        throw new Exception(Status::expectationFailed . ' - query bad formated', Status::expectationFailed_number);
      }

  }

  protected function execQuerys($type, $errNo, $errMessage){

    $this->ran = true;

    foreach($this->conf['querys'][$type] as $sql ){

      $sth = $this->pdo->prepare($sql);
      $sth->execute();

      if($sth->rowCount() < 1) {
        throw new Exception($errMessage . " - {$sql}", $errNo);
      }
    }

  }

  protected function selectQuerys(){

    $this->ran = true;

    foreach($this->conf['querys']['select'] as $sql ) {

      $sth = $this->pdo->prepear($sql);
      $sth->execute();

      $result = $sth->fetch(PHPDO::FETCH_NUM);

      if(count($result) < 1){
        throw new Exception(Status::querySelectFail_number, Status::querySelectFail);
      }

    }

  }

  protected function execCreateQuerys(){

    $this->ran = true;

    try {

      foreach($this->conf['querys']['create'] as $sql ){
        $this->pdo->exec($sql);
      }

    } catch(Exception $ex){
        throw new Exception(Status::couldNotCreateTable . " - {$sql} " . $ex->getMessage(), Status::couldNotCreateTable_number);
    }

  }

  protected function execDropQuerys(){

    $this->ran = true;

    try {

      foreach($this->conf['querys']['drop'] as $sql ){
        $this->pdo->exec($sql);
      }

    } catch(Exception $ex){
        throw new Exception(Status::couldNotDropTable . " - {$sql} " . $ex->getMessage(), Status::couldNotDropTable_number);
    }
  }

}
