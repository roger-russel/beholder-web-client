<?php

namespace BeholderWebClient\Eyes\Db;

use BeholderWebClient\Eyes\Status;

class DbStatus extends Status {

  const COULD_NOT_CONNECT_TO_SGBD = 'Could not connect to SGBD';
  const COULD_NOT_CONNECT_TO_SGBD_NUMBER = 600;

  const COULD_NOT_CREATE_NUMBER = 601;
  const COULD_NOT_CREATE = 'Could not create';

  const COULD_NOT_DROP_NUMBER = 602;
  const COULD_NOT_DROP = 'Could not drop';

  const QUERY_SELECT_FAIL_NUMBER = 603;
  const QUERY_SELECT_FAIL = 'Query select fail';

  const QUERY_INSERT_FAIL_NUMBER = 604;
  const QUERY_INSERT_FAIL = 'Query insert fail';

  const QUERY_UPDATE_FAIL_NUMBER = 605;
  const QUERY_UPDATE_FAIL = 'Query update fail';

  const QUERY_DELETE_FAIL_NUMBER = 606;
  const QUERY_DELETE_FAIL = 'Query delete fail';

  const BAD_FORMATED_QUERY = 'Query field was not correcly formated';
  const QUERY_SELECT_RETURN_NOTHING = 'Query select returned nothing';
  const QUERY_INSERT_NOTHING = 'Query insert nothing';

}
