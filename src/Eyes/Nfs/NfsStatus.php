<?php

namespace BeholderWebClient\Eyes\Nfs;

use BeholderWebClient\Eyes\Status;

class NfsStatus extends Status {

  const REQUERIMENT_FAIL = 'REQUERIMENT FAIL: stat command not found with type -P mountpoint';

  const PATH_NOT_EXIST = 'Path doesn\'t exist: ';
  const PATH_NOT_EXIST_NUMBER = 600;

  const NOT_MOUNTED = 'NFS is not mounted on path: ';
  const NOT_MOUNTED_NUMBER = 601;

  const COULD_NOT_WRITE_FILE = 'Could not write file, permission denied';
  const COULD_NOT_WRITE_FILE_NUMBER = 602;

  const COULD_NOT_READ_FILE = 'Could not read file, permission denied';
  const COULD_NOT_READ_FILE_NUMBER = 603;

  const COULD_NOT_DELETE_FILE = 'Could not delete file, permission denied';
  const COULD_NOT_DELETE_FILE_NUMBER = 604;

}
