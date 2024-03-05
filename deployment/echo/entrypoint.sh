#!/bin/sh

npm install -g laravel-echo-server
rm -rf laravel-echo-server.lock
npm config set unsafe-perm true
laravel-echo-server start

# keep up the docker container
while sleep 3600; do :; done
