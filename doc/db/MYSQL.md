# Beholder Eye - MySQL

This beholder eye keep an eye on your MySQL server.

## Exemple of use

````
require 'vendor/autoload.php';

$conf = [
  'eyes' => [
      'DB' => [ // This DB is just an alias, it can be anything.
        'type' => 'Db\MySQL', //  Model wich will be used.
//      'driver' => 'PDO', // If not set it will execute into this order PDO, mysqli and mysql, if setted it will force use which as setted.
        'host' => 'beholder-test-mysql',
        'user' => 'root',
        'password' => 'initial1234',
//      'port' => 3306, // If not set it will use the default port 3306
        'dbname' => 'beholder_test',
        'query' => [ //Query which will run on test, it will execute into this order CREATE, INSERT, UPDATE, SELECT and DROP.
          'select' => 'select name from user limit 1'
        ]
      ]
  ]
];

$beholder = new BeholderWebClient\Observer($conf);
$beholder->run();
$beholder->writeJson();

````
