<?php

if($_SERVER['REQUEST_METHOD'] !== 'GET'){
  http_response_code(405);
  exit();
};

if($_GET['var1'] == 1 AND $_GET['name'] == 'Alberto'){
  echo "ok";
}else{
  http_response_code(417);
}
