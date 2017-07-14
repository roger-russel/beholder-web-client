# Beholder Monitor - Php Web Client

![Try Beholder](https://raw.githubusercontent.com/RogerRussel/beholder-web-client/master/opt/img/beholder.jpg)

Beholder is a simple php monitoring system, this client is made to serve a json response with the current stats of what is been monitored.

This client can be used with Zabbix and others tools, just setup those to read the json file which this client give.

## Dependencies

* PHP:5.6, why? For compatibility.
* Composer

Some modules could have more dependencies, please look at src/Eyes/ModuleName/Readme.md too.

## How Install

In your composer.json file put the *repositories* and *require* like this:

```
{
  "name": "YourProjectName",
  "description": "Your project description",
  "type": "YourProjectType",
  "repositories": [{
      "type" : "vcs",
      "url": "https://github.com/RogerRussel/beholder-web-client.git"
  }],
  "require": {
    "RogerRussel/beholder-web-client": "\*"
  }
}
```

Then run:

`$ composer install;`

### How to use

You can look at a especific model configuration in doc/ModelName folder.

```
require 'vendor/autoload.php';

$conf = [
  'eyes' => [
      'DB' => [ // This DB is just an alias, it can be anything
        'type' => 'Db\MySQL', // Model wich will be used, this will be usage Db\Mysql Model.
//      'driver' => 'PDO', // If this option is not setted it will try to use one on this order: PDO, mysqli or mysql. If setted it will force to use it.
        'host' => 'beholder-test-mysql',
        'user' => 'root',
        'password' => 'initial1234',
//      'port' => 3306, // If not setted it will use the default port 3306
        'dbname' => 'beholder_test',
        'querys' => [ // Query that will runned on a test, it will be executed into the following order: CREATE, INSERT, UPDATE, SELECT and DROP.
          'select' => 'select name from user limit 1'
        ]
      ]
  ]
];

$beholder = new BeholderWebClient\Observer($conf);
$beholder->run();
```


## How to Contribute

### Steps

With docker is easy and fun!

1. Create a docker network

$ docker network create --driver bridge beholder-network

2. Build the project and run the project

$ docker-compose build
$ docker-compose up
