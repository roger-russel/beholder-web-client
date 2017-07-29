<?php

namespace BeholderWebClient\Eyes\Db;

interface iAdapter {

  public function testConn();
  public function testQuery();
  public function checkRequirement();
  public function closeConnection();

}
