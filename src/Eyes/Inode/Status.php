<?php

namespace BeholderWebClient\Eyes\Inode;

use BeholderWebClient\Eyes\Status as EyeStatus;

class Status extends EyeStatus {

  const REQUERIMENT_FAIL = 'REQUERIMENT FAIL: df command not found with type -P df';
  const STORAGE_PATH_NOT_FOUND = 'storage path not found';
  const MAX_USAGE_ALLOWED = 'max usage allowed';
  const MAX_USAGE_ALLOWED_NUMBER = 600;

}
