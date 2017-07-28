# Beholder Eye - PostgreSQL

An Eye on your PostgreSQL server.

## Exemple of use

```
require 'vendor/autoload.php';

$conf = [
  'eyes' => [
      'DB' => [ // This DB is just an alias, it can be anything
        'type' => 'Db\PostgreSQL', // Model wich will be used, this will be usage Db\PostgreSQL Model.
        'host' => 'beholder-test-postgres',
        'user' => 'root',
        'password' => 'initial1234',
//      'port' => 5432, // If not set it will use the default port 5432
        'dbname' => 'beholder_test',
        'querys' => [ //Query which will run on test, it execut into this order CREATE, INSERT, UPDATE, SELECT and DROP.
          'select' => 'select name from user limit 1'
        ]
      ]
  ]
];

$beholder = new BeholderWebClient\Observer($conf);
$beholder->run();
$beholder->writeJson();

```
