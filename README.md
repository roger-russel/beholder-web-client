# Beholder Monitor - Php Web Client

![Try Beholder](https://raw.githubusercontent.com/RogerRussel/beholder-web-client/master/opt/img/beholder.jpg)

Beholder is a simple php monitoring system, this client is made to response a json with current stats of which is been monitorated.

This client can be used with Zabbix and others too, just setup those to read the json file which this client give.

## Dependencies

* PHP:5.6, why? For compatibility.

## Contribe

### How dev

first create a docker network

$ docker network create --driver bridge beholder-network
