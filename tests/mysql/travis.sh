#!/bin/bash

DIRFILE="$( cd "$( dirname "${BASH_SOURCE[0]}" )" && pwd )"

sudo /etc/init.d/mysql stop

docker-compose -f $DIRFILE/docker-compose.yml up -d
