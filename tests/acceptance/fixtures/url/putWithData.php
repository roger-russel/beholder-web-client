<?php

if($_SERVER['REQUEST_METHOD'] !== 'PUT'){
  http_response_code(405);
  exit();
};

$_PUT = json_decode(file_get_contents("php://input"), true);

if($_PUT['var1'] == 1 AND $_PUT['name'] == 'Alberto'){
  echo "ok";
}else{
  http_response_code(417);
}
