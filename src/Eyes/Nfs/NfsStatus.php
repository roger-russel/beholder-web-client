<?php

namespace BeholderWebClient\Eyes\Nfs;

use BeholderWebClient\Eyes\Status;

class NfsStatus extends Status {

  const REQUERIMENT_FAIL = 'REQUERIMENT FAIL: stat command not found with type -P stat';
  const REQUERIMENT_FAIL_NUMBER = 500;

  const PATH_NOT_EXIST = 'Path doesn\'t not exist: ';
  const PATH_NOT_EXIST_NUMBER = 600;

  const NOT_MOUNTED = 'NFS is not mounted on path: ';
  const NOT_MOUNTED_NUMBER = 601;

}
