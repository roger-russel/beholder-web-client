<?php

if($_SERVER['REQUEST_METHOD'] !== 'POST'){
  http_response_code(405);
  exit();
};

echo "ok";
