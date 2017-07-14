# Beholder Eye - MySQL

An Eye on your MySQL server.

## Exemple of use

<code>
require 'vendor/autoload.php';

$conf = [
  'eyes' => [
      'DB' => [ // This DB is juts an alias, it can be anything
        'type' => 'Db\MySQL', // Model wich will be used, this will be usage Db\Mysql Model.
//      'driver' => 'PDO', // If not set it will try use into this order PDO, mysqli and mysql, if setted it will force use which as setted.
        'host' => 'beholder-test-mysql',
        'user' => 'root',
        'password' => 'initial1234',
//      'port' => 3306, // If not set it will use the default port 3306
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

</code>
