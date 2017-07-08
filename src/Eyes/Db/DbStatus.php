<?php

namespace BeholderWebClient\Eyes\Db;

use BeholderWebClient\Eyes\Status;

class DbStatus extends Status {

  const couldNotConnectAtSGBD = 'Could not connect at SGBD';
  const couldNotConnectAtSGBD_number = 600;

  const couldNotCreateDatabase_number = 601;
  const couldNotCreateDatabase = 'Could not create database';

  const couldNotCreateSchema_number = 602;
  const couldNotCreateSchema = 'Could not create Schema';

  const couldNotCreateTable_number = 603;
  const couldNotCreateTable = 'Could not create table';

  const couldNotDropDatabase_number = 604;
  const couldNotDropDatabase = 'Could not drop database';

  const couldNotDropSchema_number = 605;
  const couldNotDropSchema = 'Could not drop Schema';

  const couldNotDropTable_number = 606;
  const couldNotDropTable = 'Could not drop table';

  const querySelectFail_number = 610;
  const querySelectFail = 'Query select fail';

  const queryInsertFail_number = 620;
  const queryInsertFail = 'Query insert fail';

  const queryUpdateFail_number = 630;
  const queryUpdateFail = 'Query update fail';

  const queryDeleteFail_number = 640;
  const queryDeleteFail = 'Query delte fail';

}
