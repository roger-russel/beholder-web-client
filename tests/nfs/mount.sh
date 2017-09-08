#!/bin/bash

$MOUNT=-t nsf beholder-test-nfs:/var/nfs/

if [[ $EUID -eq 0 ]]; then
  mount $MOUNT/writable
else
  sudo mount $MOUNT/writable
fi
