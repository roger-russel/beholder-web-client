<?php

if($_SERVER['REQUEST_METHOD'] !== 'POST'){
  http_response_code(405);
  exit();
};

if($_POST['var1'] == 1 AND $_POST['name'] == 'Alberto'){
  echo "ok";
}else{
  http_response_code(417);
}
