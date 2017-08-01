#!/bin/bash

DIRFILE="$( cd "$( dirname "${BASH_SOURCE[0]}" )" && pwd )"

sudo /etc/init.d/postgresql stop
docker-compose -f $DIRFILE/docker-compose.yml up -d
