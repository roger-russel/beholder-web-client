<?php

if($_SERVER['REQUEST_METHOD'] !== 'DELETE'){
  http_response_code(405);
  exit();
};

echo "ok";
