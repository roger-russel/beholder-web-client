<?php

namespace BeholderWebClient\Eyes\Db\MySQL;

interface iAdapter {

  public function testConn();
  public function testQuery();
  public function checkRequirement();

}
