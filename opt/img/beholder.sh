#!/bin/bash

DIR=$( cd "$( dirname "${BASH_SOURCE[0]}" )" && pwd )

ls ascii | sort -R | tail -1 | while read file; do cat ./ascii/$file; done;
