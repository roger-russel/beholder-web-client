<?php

if($_SERVER['REQUEST_METHOD'] !== 'DELETE'){
  http_response_code(405);
  exit();
};

$_DELETE = json_decode(file_get_contents("php://input"), true);

if($_DELETE['var1'] == 1 AND $_DELETE['name'] == 'Alberto'){
  echo "ok";
}else{
  http_response_code(417);
}
