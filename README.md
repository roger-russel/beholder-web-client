# Beholder Monitor - Php Web Client

![Try Beholder](https://raw.githubusercontent.com/RogerRussel/beholder-web-client/master/opt/img/beholder.jpg)

Beholder is a simple php monitoring system, this client is made to response a json with current stats of which is been monitorated.

This client can be used with Zabbix and others too, just setup those to read the json file which this client give.

## Dependencies

* PHP:5.6, why? For compatibility.
* Composer

Some modules could have more depencencies, please look at src/Eyes/ModuleName/Readme.md too.

## How Install

At your composer.json file put repositories and require like this:

<code>
{
  "name": "YourProjectName",
  "description": "Your project description",
  "type": "YourProjectType",
  "repositories": [{
      "type" : "vcs",
      "url": "https://github.com/RogerRussel/beholder-web-client.git"
  }],
  "require": {
    "RogerRussel/beholder-web-client": "*"
  }
}
</code>

Then run:

$ composer install;

### How use

you can look to especific model configuration at doc/ModelName folder.

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
</code>


## Contribe

### How dev

With docker is easy and fun!

1. Create a docker network

$ docker network create --driver bridge beholder-network

2. Build project and up the project

$ docker-compose build
$ docker-compose up

3.
