#!/bin/bash
docker exec -it beholder-test-mysql bash -c 'mysql -e "create database IF NOT EXISTS beholder_test;" -uroot -pinitial1234;'
