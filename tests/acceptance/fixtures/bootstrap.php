<?php

define('ROOT', '/var/www');
require ROOT . '/vendor/autoload.php';

if ( is_file(ROOT . '/c3.php') ){
  require ROOT . '/c3.php';
  define('MY_APP_STARTED', true);
}
