#!/bin/bash
cp -r backend/.env.staging backend/.env
cp -r frontend/configs/config.js.staging frontend/configs/config.js
docker-compose -f docker-compose.staging.yml stop
docker-compose -f docker-compose.staging.yml build
docker-compose --compatibility -f docker-compose.staging.yml up -d --remove-orphans
