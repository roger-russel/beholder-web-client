# Beholder Monitor - Php Web Client

![Travis:Master](https://travis-ci.org/roger-russel/beholder-web-client.svg?branch=master "Travis Master")
[![Codecov branch](https://img.shields.io/codecov/c/github/roger-russel/beholder-web-client/master.svg)](https://codecov.io/gh/roger-russel/beholder-web-client)
[![Latest Version](https://img.shields.io/packagist/v/roger-russel/beholder-web-client.svg?style=flat-square)](https://packagist.org/packages/roger-russel/beholder-web-client)
[![Packagist](https://img.shields.io/packagist/dt/roger-russel/beholder-web-client.svg)]()
[![Software License](https://img.shields.io/badge/license-Apache-brightgreen.svg?style=flat-square)](LICENSE.md)



Beholder is a simple php monitoring system, this client is made to serve a json response with the current stats of what is been monitored.

![Try Beholder](https://raw.githubusercontent.com/RogerRussel/beholder-web-client/master/opt/img/beholder.jpg)


This client can be used with Zabbix and others tools, just setup those to read the json file which this client give.

## Dependencies

* PHP:5.6, why? For compatibility.
* Composer
* Lib Yaml, required only if you use it. See more here. [here](doc/YAML.md).

Some modules could have more dependencies, please look at src/Eyes/ModuleName/Readme.md too.

## How Install

Use the command below to add the dependencies inside the composer.json file:

> `$ composer require roger-russel/beholder-web-client;`

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

Contribute is easy. Make a fork and start to code, then do a pull request.

You can contribute not just in code, you can make a bug report, a issue asking for a feature or simply giving your suggestion.


### How to run locally

With docker is easy and fun!

* Create a docker network

> `$ docker network create --driver bridge beholder-network`

* Build the project and run the container

> `$ docker-compose build`

> `$ docker-compose up`

* Enter the container and run composer to install the dependencies

> `$ docker exec -it beholder-web-client bash`

> `$ composer install`

Or the one liner command:

> `$ docker exec -it beholder-web-client composer install`

### To run the codeception tests
With the docker container running do the following:

> `$ docker exec -it beholder-web-client bash`

> `$ codecept run`

Or the one liner command:

> `$ docker exec -it beholder-web-client codecept run`

You can run especific tests like the following:

> `$ codecept run nfs`

> `$ codecept run unit`

If you want to run a mysql test, first you need to start the docker mysql container inside tests/mysql/ folder. Then run the following command:

> `$ codecept run mysql `

# License

Apache 2.0
Copyright 2017 Roger Russel, and Alan Yoshida
