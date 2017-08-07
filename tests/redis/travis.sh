#!/bin/bash

DIRFILE="$( cd "$( dirname "${BASH_SOURCE[0]}" )" && pwd )"

docker-compose -f $DIRFILE/docker-compose.yml up -d
