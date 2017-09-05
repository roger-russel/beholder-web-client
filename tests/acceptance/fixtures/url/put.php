<?php

if($_SERVER['REQUEST_METHOD'] !== 'PUT'){
  http_response_code(405);
  exit();
};

echo "ok";
