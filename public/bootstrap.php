<?php

define('__ROOT__', '/var/www');
require __ROOT__ . '/vendor/autoload.php';

if ( is_file(__DIR__ . '/../c3.php') ){
  require __DIR__ . '/../c3.php';
  define('MY_APP_STARTED', true);
}
