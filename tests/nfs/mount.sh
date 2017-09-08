#!/bin/bash

MOUNT="-t nsf -o proto=tcp,port=2049 beholder-test-nfs:/var/nfs/"

if [[ $EUID -eq 0 ]]; then
  mount $MOUNT/writeable /mnt/writeable
else
  sudo mount $MOUNT/writeable /mnt/writeable
fi
