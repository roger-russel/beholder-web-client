<?php

namespace BeholderWebClient\Eyes\Db\PostgreSQL;

interface iAdapter {

  public function testConn();
  public function testQuery();
  public function checkRequirement();
  public function closeConnection();

}
