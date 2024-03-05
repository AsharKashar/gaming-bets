#!/bin/bash
docker-compose -f docker-compose.volkan.yml stop
docker-compose -f docker-compose.volkan.yml build
docker-compose -f docker-compose.volkan.yml up -d --remove-orphans
