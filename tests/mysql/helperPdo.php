<?php

$dns = "mysql:host=beholder-test-mysql;dbname=mysql;port=3306;";

return new PDO($dns, 'root', 'initial1234');
