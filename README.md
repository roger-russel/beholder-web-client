# Beholder Monitor - Php Web Client

![Try Beholder](https://raw.githubusercontent.com/RogerRussel/beholder-web-client/master/opt/img/beholder.jpg)

Beholder is a simple php monitoring system, this client is made to response a json with current stats of which is been monitorated.

This client can be used with Zabbix and others too, just setup those to read the json file which this client give.

## Dependencies

* PHP:5.6, why? For compatibility.

Some modules could have more depencencies, please look at src/Eyes/ModuleName/Readme.md too.

## How Install

### How use


## Contribe

### How dev

With docker is easy and fun!

1. Create a docker network

$ docker network create --driver bridge beholder-network

2. Build project and up the project

$ docker-compose build
$ docker-compose up

3. 
