<?php

namespace BeholderWebClient\Eyes\Db;

use BeholderWebClient\Eyes\Status;

class DbStatus extends Status {

  const COULD_NOT_CONNECT_TO_SGBD = 'Could not connect to SGBD';
  const COULD_NOT_CONNECT_TO_SGBD_NUMBER = 600;

  const COULD_NOT_CREATE_DATABASE_NUMBER = 601;
  const COULD_NOT_CREATE_DATABASE = 'Could not create database';

  const COULD_NOT_CREATE_SCHEMA_NUMBER = 602;
  const COULD_NOT_CREATE_SCHEMA = 'Could not create Schema';

  const COULD_NOT_CREATE_TABLE_NUMBER = 603;
  const COULD_NOT_CREATE_TABLE = 'Could not create table';

  const COULD_NOT_DROP_DATABASE_NUMBER = 604;
  const COULD_NOT_DROP_DATABASE = 'Could not drop database';

  const COULD_NOT_DROP_SCHEMA_NUMBER = 605;
  const COULD_NOT_DROP_SCHEMA = 'Could not drop Schema';

  const COULD_NOT_DROP_TABLE_NUMBER = 606;
  const COULD_NOT_DROP_TABLE = 'Could not drop table';

  const QUERY_SELECT_FAIL_NUMBER = 610;
  const QUERY_SELECT_FAIL = 'Query select fail';

  const QUERY_INSERT_FAIL_NUMBER = 620;
  const QUERY_INSERT_FAIL = 'Query insert fail';

  const QUERY_UPDATE_FAIL_NUMBER = 630;
  const QUERY_UPDATE_FAIL = 'Query update fail';

  const QUERY_DELETE_FAIL_NUMBER = 640;
  const QUERY_DELETE_FAIL = 'Query delte fail';

}
