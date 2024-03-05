#!/bin/bash
cp -r backend/.env.local backend/.env
cp -r frontend/configs/config.js.local frontend/configs/config.js
docker-compose -f docker-compose.local.mac.yml stop
docker-compose -f docker-compose.local.mac.yml build
docker-compose --compatibility -f docker-compose.local.mac.yml up -d --remove-orphans
