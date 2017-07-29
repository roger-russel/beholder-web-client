<?php

namespace BeholderWebClient\Eyes\Db\MySQL;

use BeholderWebClient\Eyes\Db\DbStatus;

class MySQLStatus extends DbStatus {

  const NO_DRIVER = 'No Mysql driver found, it tried use PDO, mysqli and mysql, but neither of them has been found.';

}
