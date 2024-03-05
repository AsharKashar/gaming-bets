#!/bin/bash
COMMIT_INFO_MESSAGE=$1
docker-compose -f docker-compose.test.yml stop
docker-compose -f docker-compose.test.yml build
docker-compose --compatibility -f docker-compose.test.yml run -e COMMIT_INFO_MESSAGE="$COMMIT_INFO_MESSAGE" e2e-chrome
